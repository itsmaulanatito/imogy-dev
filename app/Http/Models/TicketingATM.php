<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class TicketingATM extends Model
{
    //
    protected $table = 'ticketing__atm';
	
	protected $primaryKey = 'id';
	
	public $timestamps = false;
	
	protected $fillable = [
		'owner',
		'atm_id',
		'serial_number',
		'location',
		'address',
		'activation',
		'note',
	];
}
