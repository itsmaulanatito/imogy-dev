<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Mail\MailRemainderProject;
use App\Jobs\QueueEmailRemainder;
use DB;
use Mail;
use Illuminate\Console\Command;

class SendProjectRemainder extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'ProjectRemainder:send {id}';
	// protected $data;
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Remainder for some project';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		// $this->argument('id');
		$project__event_history = DB::table('project__event')
			->where('project_list_id',$this->argument('id'))
			->where('status','Active')
			->join('project__event_history','project__event_history.project_event_id','=','project__event.id')
			->get();

			// After Submit BAST
		if($project__event_history->contains('type','Submit')){
			$project_time_refrance = $project__event_history->where('type','Submit')->first()->time;
			$type_refrence = "BAST Remainder";
		} else {
			// Before Submit BAST
			$project_time_refrance = DB::table('project__event')
				->where('project_list_id',$this->argument('id'))
				->where('status','Active')
				->value('due_date');
			$type_refrence = "PM Remainder";
		}

		$refrence = DB::table('project__remainder_refrence')
			->where('type',$type_refrence)
			->orderBy('number_of_days','ASC')
			->pluck('number_of_days')
			->toArray();

		date_default_timezone_set('Asia/Jakarta');
		$different = ( Carbon::now()->diffInDays(Carbon::parse($project_time_refrance), false ) * -1);
		$output = "Id Project : " . $this->argument('id') . " Date Now " . Carbon::now()->toDateString();
		echo "\n" . $output . "\n";

		

		// print_r("Refrence date \n");
		// print_r($refrence);
		// foreach ($refrence as $key => $value) {
		// 	print_r($value . " " . Carbon::parse($project_time_refrance)->addDays($value) . " \n");
		// }
		$start_cheking_date = Carbon::parse($project_time_refrance)->addDays($this->get_clostest($different,$refrence,$type_refrence)[0] + 1);
		$end_cheking_date =  Carbon::parse($project_time_refrance)->addDays($this->get_clostest($different,$refrence,$type_refrence)[1])->addHours(23)->addMinutes(59);
		print_r("Due date " . $project_time_refrance . "\n");
		print_r("Diff days : " .  $different . "\n");
		print_r("Check update from " . $start_cheking_date  . " to " . $end_cheking_date . "\n");
		// print_r("Clostest to days start : " .  $this->get_clostest($different,$refrence,$type_refrence)[0] . "\n");
		// print_r("Clostest to days end : " .  $this->get_clostest($different,$refrence,$type_refrence)[1] . "\n");

		$project__event_history = DB::table('project__event')
			->where('project_list_id',$this->argument('id'))
			->where('status','Active')
			->whereRaw('`time` BETWEEN "' . $start_cheking_date . '" AND "' . $end_cheking_date . '"')
			->join('project__event_history','project__event_history.project_event_id','=','project__event.id')
			->get();

		// print_r("Event History data \n");
		// print_r($project__event_history);

		$refrence = DB::table('project__remainder_refrence')
			->where('number_of_days',$different)
			->first();

		if( $project__event_history->isEmpty() && isset($refrence) ){
			// echo "true";
			
			// print_r($refrence);
			// print_r(Carbon::now()->diffForHumans(Carbon::parse($project_time_refrance)));
			
			// echo "\n";
			// echo "\n";

			$list = DB::table('project__list')
				->select(
						DB::raw("customer.name as customer"),
						'project__list.project_name',
						'project__list.project_pid',
						DB::raw("coordinator.nickname as project_coordinator"),
						DB::raw("coordinator2.email as project_coordinator_email"),
						DB::raw("leader.nickname as project_leader"),
						DB::raw("leader2.email as project_leader_email"),
						DB::raw("event.name as active_period"),
						DB::raw("event.due_date as due_date"),
						DB::raw("IFNULL(history.`updater`, 0) AS updater"),
						DB::raw("IFNULL(history.`time`, 0) AS time_update"),
						DB::raw("IFNULL(history.`note`, 0) AS note_update")
					)
				->join('project__customer as customer','project__list.project_customer','=','customer.id')
				->join('project__member as coordinator','project__list.project_coordinator','=','coordinator.id')
				->join('users as coordinator2','coordinator.user_id','=','coordinator2.id')
				->join('project__member as leader','project__list.project_leader','=','leader.id')
				->join('users as leader2','leader.user_id','=','leader2.id')
				->join('project__event as event','project__list.id','=','event.project_list_id')
				->join(
					DB::raw("(SELECT max_id.id AS id, `project_event_id`, `updater`, `time`, `note`
							FROM `project__event_history`
							INNER JOIN(
								SELECT MAX(id) AS id
								FROM
									`project__event_history`
								GROUP BY
									`project_event_id`
							) AS max_id
							ON
								`project__event_history`.`id` = max_id.id) AS history")
					,'event.id','=','history.project_event_id','left')
				->where('project__list.id',$this->argument('id'))
				->where('event.status','Active')
				->first();

			// print_r($list);
			setlocale(LC_TIME, 'id_ID.UTF-8');
			$data = collect([
				"to" => $list->project_coordinator_email,
				"cc" => $list->project_leader_email,
				"subject" => "[" . $refrence->refrence_name . "] Project - " . $list->customer,
				"customer" => $list->customer,
				"name_project" => $list->project_name,
				"id_project" => $list->project_pid,
				"active_period" => $list->active_period,
				"due_date" => Carbon::parse($list->due_date)->formatLocalized('%d %B %Y'),
				"last_updater" => $list->updater,
				"last_update_time" => Carbon::parse($list->time_update)->formatLocalized('%R - %d %B %Y'),
				"last_update_note" => $list->note_update,
				"remain_time" => Carbon::now()->diffForHumans(Carbon::parse($project_time_refrance)),
			]);

			// print_r($data);

			// Mail::to("agastya@sinergy.co.id")
			// 	->cc("prof.agastyo@gmail.com")
			// 	->send(new MailRemainderProject($data));

			QueueEmailRemainder::dispatch($data);

			// return new MailRemainderProject($data);
			syslog(LOG_NOTICE, "Check - Id Project : " . $this->argument('id') . " from " . $start_cheking_date  . " to " . $end_cheking_date . " Diff - " .  $different . " [Success]");
		} else {
			echo "Remainder - false";
		}
		echo "\n";
		echo "\n";
	}

	public function get_clostest($number,$array,$type_refrence){
		$closest = null;
		$start = 0;
		$end = 0;
		foreach ($array as $key => $item) {
			if ($number > $item) {
				if($key == count($array) - 1){
					$end = $array[count($array) - 1];
				} else {
					$end = $array[ $key + 1];
					$start = $item;
				}
			} else if ($number <= $array[0] && $number >= 0){
				$end = $array[0];
			}
		}
		return array($start,$end);
	}
}
