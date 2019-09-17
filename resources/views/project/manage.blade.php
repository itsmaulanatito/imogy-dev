@extends((Auth::user()->jabatan == "1") ? 'layouts.admin.layout' : ((Auth::user()->jabatan == "2") ? 'layouts.helpdesk.hlayout' : ((Auth::user()->jabatan == "3") ? 'layouts.engineer.elayout' : ((Auth::user()->jabatan == "4") ? 'layouts.projectcor.playout' : ((Auth::user()->jabatan == "5") ? 'layouts.superuser.slayout' :'layouts.engineer.elayout')))))

@section('head')
<link rel="stylesheet" href="{{url('plugins/datepicker/datepicker3.css')}}">
<link rel="stylesheet" href="{{url('plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{url('dist/css/AdminLTE.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/datatables/dataTables.bootstrap.css')}}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
<link rel="stylesheet" href="{{url('dist/css/AdminLTE.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

<link rel="stylesheet" href="{{ url('plugins/timepicker/bootstrap-timepicker.min.css')}}">
<link rel="stylesheet" href="{{ url('plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="{{ url('plugins/daterangepicker/daterangepicker.css')}}">
<link rel="stylesheet" href="{{ url('plugins/morris/morris.css')}}">

<link rel="stylesheet" href="{{ url('plugins/datepicker/datepicker3.css')}}">
<style type="text/css">
	.dataTables_filter {display: none;}
	select[readonly].select2-hidden-accessible + .select2-container {
		pointer-events: none;
		touch-action: none;
	}

	select[readonly].select2-hidden-accessible + .select2-container .select2-selection {
		background: #eee;
		box-shadow: none;
	}

	select[readonly].select2-hidden-accessible + .select2-container .select2-selection__arrow,
	select[readonly].select2-hidden-accessible + .select2-container .select2-selection__clear {
		display: none;
	}
	td.details-control {
		background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
		cursor: pointer;
	}
	tr.shown td.details-control {
		background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
	}

	.time-label {
		cursor: pointer;
	}

	tfoot {
		display: table-header-group;
	}
</style>
@endsection
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Manage
			<small>finish and update all activiy of project</small>
		</h1>
		<ol class="breadcrumb">
			<button type="button" class="btn btn-flat btn-success btn-xs" data-toggle="modal" data-target="#modalInputProject"
				onclick='
					document.getElementById("inputProjectForm1").style.display = "inline";
					document.getElementById("inputProjectForm2").style.display = "none";
					document.getElementById("inputProjectForm3").style.display = "none";
					document.getElementById("inputProjectForm4").style.display = "none";
					clearInputProject();
					initFormInputProject();
				'>Add Project</button>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">All Project</h3>

						<div class="box-tools">
							<div class="input-group input-group-sm" style="width: 150px;">
								<input type="text" id="searchBar" class="form-control pull-right" placeholder="Search">

								<div class="input-group-btn">
									<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
						<table id="tableProjectManage" class="table table-hover">
							<thead>
								<tr>
									<th></th>
									<th>Customer</th>
									<th>Name Project</th>
									<th>Time to Due Date</th>
									<th>Time to Due Date</th>
									<th>Coordinator</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th></th>
									<th>Customer</th>
									<th></th>
									<th>Time to Due Date</th>
									<th>Time to Due Date</th>
									<th>Coordinator</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modalInputProject">
			<div class="modal-dialog" id="modal-default-size">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Add Project</h4>
					</div>
					<div id="inputProjectForm1">
						<div class="modal-body">
							<p>Please input detail customer</p>
							<form role="form">
								<!-- <input type="hidden" class="form-control"> -->
								<div class="form-group">
									<label>Customer</label>
									<select class="form-control select2" id="inputProjectCustomer" style="width: 100%" required></select>
								</div>
								<div class="form-group">
									<label>Project Name</label>
									<input type="text" class="form-control" id="inputProjectName" required>
								</div>
								<div class="form-group">
									<label>Project ID (PID)</label>
									<input type="text" class="form-control" id="inputProjectPID" required>
								</div>
								<div class="form-group">
									<label>Project Type</label>
									<select class="form-control" id="inputProjectType">
										<option value="Maintenance Service">MS - Maintenance Service</option>
										<option value="After Sales">AS - After Sales</option>
									</select>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" id="next" onclick='
								document.getElementById("inputProjectForm2").style.display = "inline";
								document.getElementById("inputProjectForm1").style.display = "none";'>Next</button>
						</div>
					</div>

					<div id="inputProjectForm2" style="display: none">
						<div class="modal-body">
							<p>Please input periode project.</p>
							<form role="form">
								<!-- <input type="hidden" class="form-control"> -->
								<div class="form-group">
									<!-- <label>Start Date</label> -->
									<!-- <input type="text" class="form-control" id="inputProjectStart" required=""> -->
									<label>Start Date</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" class="form-control pull-right" id="inputProjectStart" required>
									</div>
									<p style="font-size: x-small;">Start date depends on contract/spk or base on BAST date.</p>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>How many Periode</label>
											<input type="number" class="form-control" id="inputProjectPeriod" required></input>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Duration Per Periode</label>
											<select class="form-control" id="inputProjectDuration" required>
												<option value="1">1 Month</option>
												<option value="2">2 Month</option>
												<option value="3">3 Month</option>
												<option value="4">4 Month</option>
												<option value="6">6 Month</option>
												<option value="12">12 Month</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12" id="inputProjectPeriodResult">
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" id="back" onclick='document.getElementById("inputProjectForm1").style.display = "inline";document.getElementById("inputProjectForm2").style.display = "none";'>Back</button>
							<button type="button" class="btn btn-primary" id="next" onclick='document.getElementById("inputProjectForm3").style.display = "inline";document.getElementById("inputProjectForm2").style.display = "none";'>Next</button>
						</div>
					</div>

					<div id="inputProjectForm3" style="display: none">
						<div class="modal-body">
							<p>Please fill in the team concerned</p>
							<form role="form">
								<!-- <input type="hidden" class="form-control"> -->
								<div class="form-group">
									<label>Project Coordinator</label>
									<select class="form-control select2" id="inputProjectCoordinator" style="width: 100%" required></select>
									<!-- <input type="text" class="form-control" id="inputProjectCoordinator" required=""> -->
								</div>
								<div class="form-group">
									<label>Team Lead</label>
									<select class="form-control select2" id="inputProjectLead" style="width: 100%" required></select>
								</div>
								<div class="form-group">
									<label>Team Member</label>
									<select class="form-control select2" id="inputProjectMember" style="width: 100%" multiple="multiple" required></select>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" id="back" onclick='
								document.getElementById("inputProjectForm2").style.display = "inline";
								document.getElementById("inputProjectForm3").style.display = "none";'>Back</button>
							<button type="button" class="btn btn-primary" id="next" onclick='
								document.getElementById("inputProjectForm4").style.display = "inline";
								document.getElementById("inputProjectForm3").style.display = "none";
								document.getElementById("modal-default-size").classList.add("modal-lg");
								correctionInputProject();'>Next</button>
						</div>
					</div>

					<div id="inputProjectForm4" style="display: none">
						<div class="modal-body">
							<p>Please check whether it matches the data you input.</p>
							<form role="form">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Customer</label>
											<input type="text" class="form-control" id="inputProjectCustomerCorrection" readonly>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>PID</label>
											<input type="text" class="form-control" id="inputProjectPIDCorrection" readonly>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Type</label>
											<input type="text" class="form-control" id="inputProjectTypeCorrection" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Project Name</label>
											<input type="text" class="form-control" id="inputProjectNameCorrection" readonly>
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Start of Periods</label>
													<input type="text" class="form-control" id="inputProjectStartCorrection" readonly>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Duration of Periods</label>
													<input type="text" class="form-control" id="inputProjectDurationCorrection" readonly>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Number of Periods</label>
													<input type="text" class="form-control" id="inputProjectPeriodCorrection" readonly>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6" id="inputProjectPeriodResult2">
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Project Coordinator</label>
											<input type="text" class="form-control select2" id="inputProjectCoordinatorCorrention" readonly></select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Team Leader</label>
											<input type="text" class="form-control" id="inputProjectLeadCorrention" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Team Member / 3rd party</label>
											<select class="form-control select2" id="inputProjectMemberCorrention" style="width: 100%" multiple="multiple" readonly></select>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" id="back" onclick='
								document.getElementById("inputProjectForm3").style.display = "inline";
								document.getElementById("inputProjectForm4").style.display = "none";
								$("span.select2-selection__choice__remove").show();
								document.getElementById("modal-default-size").classList.remove("modal-lg");'>Back</button>
							<button type="button" class="btn btn-success" id="next" onclick='
								sendInputProject();
								document.getElementById("modal-default-size").classList.remove("modal-lg")'>Finish</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modalShowProject">
			<div class="modal-dialog" id="modal-default-size2">
				<div class="modal-content">
					<div class="modal-header">
						Show Project Detail
					</div>
					<div class="modal-body">
						<!-- <div class="form-group">
							<div class="input-group">
								<div class="input-group-btn">
									<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" id="updateBtn">Update
										<span class="fa fa-caret-down"></span>
									</button>
									<ul class="dropdown-menu">
										<li onclick="document.getElementById('updateBtn').innerHTML = 'Update <span class=&quot;fa fa-caret-down&quot;></span>';"><a href="#">Update</a></li>
										<li onclick="document.getElementById('updateBtn').innerHTML = 'Pending <span class=&quot;fa fa-caret-down&quot;></span>';"><a href="#">Pending</a></li>
										<li onclick="document.getElementById('updateBtn').innerHTML = 'Finish <span class=&quot;fa fa-caret-down&quot;></span>';"><a href="#">Finish</a></li>
									</ul>
								</div>
								<input type="text" class="form-control" id="inputUpdateEventProject">
								<input type="hidden" id="inputIdUpdateEventProject">
								<div class="input-group-btn">
									<button type="button" class="btn btn-primary" onclick="updateEventProject()">Go</button>
								</div>
							</div>
						</div>
						<hr> -->
						<ul class="timeline" id="timelineDetailProject">
						</ul>
					</div>
					<div class="modal-footer">
						
					</div>
				</div>
			</div>
		</div>

		<div id="successAddProject" class="alert alert-success alert-dismissible" style="margin-top: 150px;margin-right: 10px; position:fixed; top:0; right:0; width:300px;display: none;">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4>
				<i class="icon fa fa-check"></i> Success!
			</h4>
			Change time for {{session('status')}} success.
		</div>
	</section>
</div>

@endsection 

@section('script')
<!-- moment.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<!-- HumanizeDuration.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/humanize-duration/3.20.1/humanize-duration.js"></script>
<!-- bootstrap datepicker -->
<script src="{{url('plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<!-- Datatables -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script src="{{url('js/hue-to-rgb.js')}}"></script>

<script>
	var append = "";
	var member = [];
	var memberNickname = [];

	$(document).ready(function(){

		$("#inputProjectStart").val("");
		$("#inputProjectPeriod").val("");
		$("#inputProjectDuration").val("");

		getAllProjectList();

		// initFormInputProject();

		$('#searchBar').keyup(function(){
			$("#tableProjectManage").DataTable().search($(this).val()).draw();
			console.log($(this).val());
		})

		//Date picker for Input Project
		$('#inputProjectStart').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy'
		});

		// Listener at project timeline for Input Project
		$("#inputProjectStart, #inputProjectPeriod, #inputProjectDuration").bind("change",function(){
			if($("#inputProjectStart").val() != "" && $("#inputProjectPeriod").val() != "" && $("#inputProjectDuration").val() != null){
				var start = $("#inputProjectStart").val();
				var periode = $("#inputProjectPeriod").val();
				var duration = $("#inputProjectDuration").val();
				append = "";
				append = append + "<table class='table'>";
				append = append + "<tr>";
				append = append + "<th>Periode</th>";
				append = append + "<th>Start</th>";
				append = append + "<th>End</th>";
				append = append + "</tr>";
				for (var i = 0; i < periode; i++) {
					append = append + "<tr>";
					append = append + "<th>Periode " + (i+1) + "</th>";
					append = append + "<td>" + moment(start,"DD/MM/YYYY").add(duration * (i+1),'month').subtract(duration,'month').format('D MMMM YYYY') + "</td>";
					append = append + "<td>" + moment(start,"DD/MM/YYYY").add(duration * (i+1),'month').subtract(1,'days').format('D MMMM YYYY') + "</td>";
					append = append + "</tr>";
				}
				append = append + "</table>";

				$("#inputProjectPeriodResult").html("");
				$("#inputProjectPeriodResult").append(append);
			}
		});

		// showProjectDetail(128);
	});

	function initFormInputProject(){
		$('#inputProjectCoordinator, #inputProjectMember, #inputProjectMemberCorrention, #inputProjectCustomer').empty().trigger("change");

		// Get Customer for Input Project
		$.ajax({
			type:"GET",
			url:'{{url("project/manage/getCustomer")}}',
			success: function(result){
				var listCustomer = result;
				listCustomer.unshift({id:0,text:"Add New Customer"});
				$("#inputProjectCustomer").select2({
					placeholder: "Select a customer",
					data: result
				});
			}
		});

		// Get Member for Input Project
		$.ajax({
			type:"GET",
			url:'{{url("project/manage/getMember")}}',
			success: function(result){
				$("#inputProjectCoordinator").select2({
					placeholder: "Select a Coordinator",
					data: result.coordinator
				});
				$("#inputProjectLead").select2({
					placeholder: "Select a Project Lead",
					data: result.all
				});

				result.all.unshift({id:0,text:"Add New 3rd Party"});
				$("#inputProjectMember, #inputProjectMemberCorrention").select2({
					closeOnSelect: false,
					placeholder: "Select Member",
					data: result.all
				});
			}
		});

		// Add new customer for Input Project
		$("#inputProjectCustomer").on('select2:close',function(){
			if($("#inputProjectCustomer").select2('data')[0].text == "Add New Customer"){
				var newCustomer = prompt("Enter new customer :");
				if(newCustomer !== null){
					var newOption = new Option(newCustomer, 0, false, false);
					newOption.selected = true;
					$('#inputProjectCustomer').append(newOption);
					$('#inputProjectCustomer').trigger('change');
				}
			}
		});

		// // Add new member for Input Project
		$("#inputProjectMember").on('select2:select',function(){
			if($("#inputProjectMember").select2('data')[0].text == "Add New 3rd Party"){
				var newMember = prompt("Enter new 3rd Party :");
				if(newMember !== null){
					$("#inputProjectMember").select2().val('Add New 3rd Party').trigger('change');
					var newOption = new Option(newMember, newMember, false, false);
					newOption.selected = true;
					$('#inputProjectMember').append(newOption).trigger('change');
					var newOption2 = new Option(newMember, newMember, false, false);
					$('#inputProjectMemberCorrention').append(newOption2).trigger('change');
				}
			}
		});
	}

	function correctionInputProject(){
		
		// Correction Customer
		$("#inputProjectCustomerCorrection").val($("#inputProjectCustomer").select2('data')[0].text);
		$("#inputProjectPIDCorrection").val($("#inputProjectPID").val());
		$("#inputProjectTypeCorrection").val($("#inputProjectType").val());
		$("#inputProjectNameCorrection").val($("#inputProjectName").val());

		// Correction Periode Input
		$("#inputProjectStartCorrection").val(moment($("#inputProjectStart").val(),"DD/MM/YYYY").format('DD MMMM YYYY'));
		$("#inputProjectDurationCorrection").val($("#inputProjectPeriod").val() + " Month");
		$("#inputProjectPeriodCorrection").val($("#inputProjectDuration").val() + " Periode");

		// Correction Periode View
		$("#inputProjectPeriodResult2").html("");
		$("#inputProjectPeriodResult2").append(append);

		// Correction Project Member
		var coordinator = $("#inputProjectCoordinator").select2('data');
		var leader = $("#inputProjectLead").select2('data');
		var members = $("#inputProjectMember").select2('data');
		
		$("#inputProjectCoordinatorCorrention").val(coordinator[0].text);
		$("#inputProjectLeadCorrention").val(leader[0].text);
		member = [];
		memberNickname = [];
		$("#inputProjectMemberCorrention").select2().val(null).trigger('change');
		members.forEach(function(eachMember){
			member.push(eachMember.id);
			memberNickname.push(eachMember.text);
		});
		
		$("#inputProjectMemberCorrention").select2().val(member).trigger("change");
		$("span.select2-selection__choice__remove").hide();
		$("#inputProjectMemberCorrention").next().find(".select2-selection__choice").css("background-color","#e4e4e4").css("border","1px solid #aaa").css("color","#333").css("padding","1px 10px")
	};

	function sendInputProject(){
		$.ajax({
			type:"POST",
			url:"{{url('project/manage/setProjectList')}}",
			data:{
				"_token": "{{ csrf_token() }}",
				"Customer":$("#inputProjectCustomer").select2('data')[0].id,
				"CustomerName":$("#inputProjectCustomer").select2('data')[0].text,
				"PID":$("#inputProjectPIDCorrection").val(),
				"Type":$("#inputProjectTypeCorrection").val(),
				"Name":$("#inputProjectNameCorrection").val(),
				"Duration":$("#inputProjectDuration").val(),
				"Period":$("#inputProjectPeriod").val(),
				"StartPeriod":moment($("#inputProjectStartCorrection").val(),"DD MMMM YYYY").format("YYYY-MM-DD"),
				"Coordinator":$("#inputProjectCoordinator").select2('data')[0].id,
				"Lead":$("#inputProjectLead").select2('data')[0].id,
				"Member":memberNickname
			},
			success : function(result){
				clearInputProject();
				// initFormInputProject();
				$("#modalInputProject").modal('hide');
				$("#tableProjectManage").DataTable().ajax.reload();
				// getAllProjectList()
				$("#successAddProject").show().delay(2000).fadeOut();
			},
		});
	}

	function clearInputProject(){
		$("#inputProjectCustomer").select2().val(null).trigger('change');
		$("#inputProjectCustomerCorrection").val("");
		$("#inputProjectPID").val("");
		$("#inputProjectPIDCorrection").val("");
		$("#inputProjectName").val("")
		$("#inputProjectNameCorrection").val("");

		$("#inputProjectStart").val("");
		$("#inputProjectStartCorrection").val("");
		$("#inputProjectDuration").val("");
		$("#inputProjectDurationCorrection").val("");
		$("#inputProjectPeriod").val("");
		$("#inputProjectPeriodCorrection").val("");

		$("#inputProjectCoordinator").select2().val(null).trigger('change');
		$("#inputProjectCoordinatorCorrention").val("");
		$("#inputProjectLead").select2().val(null).trigger('change');
		$("#inputProjectLeadCorrention").val("");
		$("#inputProjectMember").select2().val(null).trigger('change');
		$("#inputProjectMemberCorrention").select2().val(null).trigger('change');

		$("#inputProjectPeriodResult").html("");
		$("#inputProjectPeriodResult2").html("");
	}

	function filterBinary(arr,max,min){
		var len = arr.length
		var up = -1
		var down = len
		var rrange = []
		var mid = Math.floor(len/2)
		var i = 0;
		while (i < len){
			if(arr[i] < max && arr[i] > min){
				rrange.push(i)
			}
			i++;
		}
		return rrange;   
	}

	function filter_due_date_remain(startDate, endDate){
		if(typeof startDate !== 'undefined'){
			$.fn.dataTableExt.afnFiltering.length = 0;
			filter_process(4, startDate, endDate);
			$("#tableProjectManage").DataTable().draw(); 
		} else {
			$.fn.dataTableExt.afnFiltering.length = 0;
			$("#tableProjectManage").DataTable().draw(); 
		}
	}

	function filter_process (column, startDate, endDate) {
		$.fn.dataTableExt.afnFiltering.push(
			function( oSettings, aData, iDataIndex ) {
				var rowDate = aData[column];
				var start = startDate;
				var end = endDate;
				
				if (start <= rowDate && rowDate <= end) {
					return true;
				} else if (rowDate >= start && end === '' && start !== ''){
					return true;
				} else if (rowDate <= end && start === '' && end !== ''){
					return true;
				} else {
					return false;
				}
			}
		);
	};

	function getAllProjectList(){
		$("#tableProjectManage").DataTable({
			"ajax":{
				"type":"GET",
				"url":"{{url('project/manage/getAllProjectList')}}",
				"dataSrc": function (json){
					var i = 120 / (json.data.length - 1);
					var x = 0;
					var v = 95;
					var s = 90;
					json.data.forEach(function(data,index){
						var color = hsvToRgb(i * x,s,v)[0] + "," + hsvToRgb(i * x,s,v)[1] + "," + hsvToRgb(i * x,s,v)[2];
						fontColor = "#333;";
						if(data.project_start < 0){
							data.project_start = "<span class='label' style='background-color:rgb(" + color + ");color:" + fontColor + "'> " + humanizeDuration(moment.duration(data.project_start,'days').asMilliseconds(),{ units: ['y','mo','d'], round: true, }) + " ago </span>";
						} else {
							data.project_start = "<span class='label' style='background-color:rgb(" + color + ");color:" + fontColor + "'> in " + humanizeDuration(moment.duration(data.project_start,'days').asMilliseconds(),{ units: ['y','mo','d'], round: true, }) + "</span>";
						}
						x++;
					});
					return json.data;
				}
			},
			"columns": [
				 {
					"className": 'details-control',
					"orderable": false,
					"data": null,
					"defaultContent": ''
				},
				{ "data": "project_customer" },
				{ "data": "project_name" },
				{ "data": "project_start" , "orderData":[ 4 ] , "targets": [ 1 ]},
				{ "data": "project_start2" , "targets": [ 4 ] , "visible": false , "searchable": true},
				{ "data": "project_coordinator" },
			],
			"order": [[ 4, "asc" ]],
			searching: true,
			paging: false,
			info:false,
			scrollX: false,
			order: [[1, 'asc']],

			initComplete: function () {
				var duration_to_due_date = ["1 month","2 months","3 months","4 months","6 months"]
				var duration_to_due_date_start = [-15,-30,-45,-60,-90]
				var duration_to_due_date_end = [15,30,45,60,90]
				this.api().columns().every( function () {
					if(this.index() != 0 && this.index() != 2){
						console.log('every colom data')
						var column = this;
						var select = $('<select class="form-control"><option value="">Show All</option></select>')
							.appendTo( $(column.footer()).empty() )
							.on( 'change', function () {
								var val = $.fn.dataTable.util.escapeRegex(
									$(this).val()
								);

								column
									.search( val ? '^'+val+'$' : '', true, false )
									.draw();
							} );

						
						column.data().unique().each( function ( d, j ) {
							select.append( '<option value="' + d + '">' + d +'</option>' )
						})
					}
				})
				console.log()
				var column = this.api().columns(3)
				var column_next = this.api().columns(4)
				var select = $('<select class="form-control"><option value="">Show All</option></select>').appendTo( $(column.footer()).empty() ).on( 'change', function () {
					var val = $.fn.dataTable.util.escapeRegex(
						$(this).val()
					);
					filter_due_date_remain(duration_to_due_date_start[val],duration_to_due_date_end[val])
				})
				
				duration_to_due_date.forEach( function ( d, j ) {
					select.append( '<option value="' + j + '">' + d +'</option>' )
				})

				console.log(duration_to_due_date)
			}
		})

	}


	function showProjectDetail( id ){
		// console.log(id);
		// $("#inputIdUpdateEventProject").val(id);
		createTimelineProject(id);
		$("#modalShowProject").modal('show');
	}

	function updateEventProject( bg_color , classTimeline , id_event){
		// console.log($("#updateBtn" + id_event).text());
		var typeUpdate = $("#updateBtn" + id_event).text();
		typeUpdate = typeUpdate.substr(0,typeUpdate.length - 1);
		
		iconTimeline = "fa-cog";
		$.ajax({
			type:"POST",
			url:"{{url('project/manage/setUpdateEventProject')}}",
			data:{
				_token: "{{ csrf_token() }}",
				id:$("#inputIdUpdateEventProject" + id_event).val(),
				note:$("#inputUpdateEventProject" + id_event).val(),
				type:typeUpdate,
				time:moment().format("YYYY-MM-DD HH:mm:ss"),
			},
			success:function(result){
				if(typeUpdate == "Finish"){
					$(".activeTime").insertAfter('.updateCollom' + (id_event - 1))

					$(".activeTime span.bg-green").removeClass('bg-green').addClass('bg-gray')
					$(".activeTime i.bg-green").removeClass('bg-green').addClass('bg-gray')

					$(".activeTime.time-label").attr('onclick','$(".afterTime' + id_event + '").slideToggle()')
					$(".activeTime").removeClass('activeTime' + id_event).addClass('afterTime' + id_event)
					$(".activeTime").removeClass('activeTime').addClass('afterTime')

					$(".activeTimeTogle").removeClass('activeTimeTogle').addClass('afterTimeTogle')
					$(".afterTime" + id_event + ".time-label").removeClass('afterTime' + id_event);
					
					
					$(".beforeTime.beforeTimeTogle.updateCollom" + (parseInt(id_event) + 1)).insertAfter(".activeTimeButton")
					$(".time-label.beforeTime.beforeTimeTogle:first").next().insertAfter(".activeTimeButton")
					$(".beforeTimeButton:first").next().insertAfter(".activeTimeButton")

					$(".beforeTime.beforeTimeTogle i.bg-red:first").removeClass('bg-red').addClass('bg-green')
					$(".time-label.beforeTime.beforeTimeTogle span:first").removeClass('bg-red').addClass('bg-green')
					$(".beforeTime.beforeTimeTogle.updateCollom" + (parseInt(id_event) + 1)).removeClass('beforeTime' + (parseInt(id_event) + 1)).addClass('activeTime' + (parseInt(id_event) + 1)).removeClass('beforeTime').removeClass('beforeTimeTogle').addClass('activeTime').addClass('activeTimeTogle')

					id_event = parseInt(id_event) + 1;

					$(".time-label.beforeTime.beforeTimeTogle:first").attr('onclick','$(".activeTime' + id_event + '").slideToggle()')
					$(".time-label.beforeTime.beforeTimeTogle:first").removeClass('beforeTime').removeClass('beforeTimeTogle').addClass('activeTime').addClass('activeTimeTogle')
					$(".beforeTime.beforeTimeTogle:first").removeClass('beforeTime' + id_event).addClass('activeTime' + id_event).removeClass('beforeTime').removeClass('beforeTimeTogle').addClass('activeTime').addClass('activeTimeTogle')
					
					id_event = parseInt(id_event) - 1;
					bg_color = "bg-gray";
					classTimeline = "afterTime";
					iconTimeline = "fa-check";
				}

				var append = "";
				append = append + '<li class="' + classTimeline + ' ' + classTimeline + 'Togle ' + classTimeline + id_event + '">';
				append = append + '	<i class="fa ' + iconTimeline + ' ' + bg_color + '"></i>';
				append = append + '	<div class="timeline-item">';
				append = append + '		<span class="time" title="' + moment().format("HH:mm:ss") + '"><i class="fa fa-clock-o"></i> ' + moment().format("DD MMMM YYYY") + '</span>';
				append = append + '		<h3 class="timeline-header"><a href="#">[{{Auth::user()->nickname}}]</a></h3>';
				append = append + '		<div class="timeline-body">'
				append = append + '				<p>' + $("#inputUpdateEventProject" + id_event).val() + '</p>'
				append = append + '		</div>'
				append = append + '	</div>';
				append = append + '</li>';
				$(append).insertBefore('.updateCollom' + id_event);
				$("#tableProjectManage").DataTable().ajax.reload();
			}
		});
	}
	
	function createTimelineProject(id){
		$.ajax({
			type:"GET",
			url:"{{url('project/manage/getDetailProjectList')}}",
			data:{
				id:id
			},
			success:function(result){
				var append = "";
				$("#timelineDetailProject").html("");
				var active = false;
				var before = false;
				var after = false;
				var classTimeline = "";
				result.event.forEach(function(dataEvent){
					var bg_color = "";
					var style = "";
					// if(moment(dataEvent.due_date,"YYYY-MM-DD").isBefore(moment())){
					if(dataEvent.status == "Passed"){
						bg_color = "bg-gray";
						style = "display:none";
						classTimeline = "afterTime";
						if(after == false){
							after = true;
							append = append + '<li class="time-label ' + classTimeline + 'Button" onclick="($(&quot;.' + classTimeline + 'Togle&quot;).length === $(&quot;.' + classTimeline + 'Togle:visible&quot;).length || $(&quot;.' + classTimeline + 'Togle:visible&quot;).length === 0) ? $(&quot;.' + classTimeline + '&quot;).slideToggle() : $(&quot;.' + classTimeline + '&quot;).slideUp()" >';
							append = append + '	<span class="' + bg_color + '">';
							append = append + '		Show Previous Event';
							append = append + '	</span>';
							append = append + '</li>';
						}
					} else {
						if(dataEvent.status == "Active"){
							active = true;
							classTimeline = "activeTime";
							bg_color = "bg-green";
							append = append + '<li class="time-label ' + classTimeline + 'Button" style="' + style + '" onclick="($(&quot;.' + classTimeline + 'Togle&quot;).length === $(&quot;.' + classTimeline + 'Togle:visible&quot;).length || $(&quot;.' + classTimeline + 'Togle:visible&quot;).length === 0) ? $(&quot;.' + classTimeline + '&quot;).slideToggle() : $(&quot;.' + classTimeline + '&quot;).slideUp()" >';
							append = append + '	<span class="' + bg_color + '">';
							append = append + '		Active Event';
							append = append + '	</span>';
						} else {
							bg_color = "bg-red";
							style = "display:none";
							classTimeline = "beforeTime";
							if(before == false){
								before = true;
								append = append + '<li class="time-label ' + classTimeline + 'Button" onclick="($(&quot;.' + classTimeline + 'Togle&quot;).length === $(&quot;.' + classTimeline + 'Togle:visible&quot;).length || $(&quot;.' + classTimeline + 'Togle:visible&quot;).length === 0) ? $(&quot;.' + classTimeline + '&quot;).slideToggle() : $(&quot;.' + classTimeline + '&quot;).slideUp()" >';
								append = append + '	<span class="' + bg_color + '">';
								append = append + '		Show Next Event';
								append = append + '	</span>';
								append = append + '</li>';
							}
						}
					}
					append = append + '<li class="time-label ' + classTimeline + ' ' + classTimeline + 'Togle " style="' + style + '" onclick="$(&quot;.' + classTimeline + dataEvent.id + '&quot;).slideToggle()">';
					append = append + '	<span class="' + bg_color + '">';
					// append = append + '		' + moment(dataEvent.due_date,"YYYY-MM-DD").format("DD MMMM YYYY");
					append = append + '		' + dataEvent.name;
					append = append + '	</span>';
					append = append + '</li>';
					append = append + '<li class="' + classTimeline + ' ' + classTimeline + 'Togle ' + classTimeline + dataEvent.id + '" style="' + style + '" >';
					append = append + '	<i class="fa fa-cog ' + bg_color + '"></i>';
					append = append + '	<div class="timeline-item">';
					append = append + '		<h3 class="timeline-header"><a href="#">[System]</a> ' + dataEvent.name + '</h3>';
					append = append + '			<div class="timeline-body">'
					append = append + '				<b>' + dataEvent.note +'</b>'
					append = append + '			</div>'
					append = append + '	</div>';
					append = append + '</li>';
					result.eventHistory.forEach(function(dataHistory,index){
						if(dataHistory.project_event_id == dataEvent.id){
							append = append + '<li class="' + classTimeline + ' ' + classTimeline + 'Togle ' + classTimeline + dataEvent.id + '" style="' + style + '">';
							if(dataHistory.type == "Finish"){
								append = append + '	<i class="fa fa-check ' + bg_color + '"></i>';
							} else if (dataHistory.type == "Submit"){
								append = append + '	<i class="fa fa-bookmark ' + bg_color + '"></i>';
							} 
							else {
								append = append + '	<i class="fa fa-cog ' + bg_color + '"></i>';
							}
							append = append + '	<div class="timeline-item">';
							append = append + '		<span class="time" title="' + moment(dataHistory.time,"YYYY-MM-DD HH:mm:ss").format("HH:mm:ss") + '"><i class="fa fa-clock-o"></i> ' + moment(dataHistory.time,"YYYY-MM-DD HH:mm:ss").format("DD MMMM YYYY") + '</span>';
							append = append + '		<h3 class="timeline-header no-border"><a href="#">[' + dataHistory.updater + ']</a></h3>';
							append = append + '		<div class="timeline-body">'
							append = append + '				<p>' + dataHistory.note + '</p>'
							append = append + '		</div>'
							append = append + '	</div>';
							append = append + '</li>';
						}
					});
					append = append + '<li class="' + classTimeline + ' ' + classTimeline + 'Togle ' + classTimeline + dataEvent.id + ' updateCollom' + dataEvent.id + '" style="' + style + '">';
					// append = append + '	<i class="fa fa-cog ' + bg_color + '"></i>';
					append = append + '	<div class="timeline-item">';
					append = append + '		<div class="timeline-body">'
					append = append + '			<div class="input-group">';
					append = append + '				<div class="input-group-btn">';
					append = append + '					<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" id="updateBtn' + dataEvent.id + '">Update';
					append = append + '						<span class="fa fa-caret-down"></span>';
					append = append + '					</button>';
					append = append + '					<ul class="dropdown-menu">';
					append = append + '						<li onclick="document.getElementById(&apos;updateBtn' + dataEvent.id + '&apos;).innerHTML = &apos;Update <span class=&quot;fa fa-caret-down&quot;></span>&apos;;"><a href="#">Update</a></li>';
					append = append + '						<li onclick="document.getElementById(&apos;updateBtn' + dataEvent.id + '&apos;).innerHTML = &apos;Submit <span class=&quot;fa fa-caret-down&quot;></span>&apos;;"><a href="#">Submit</a></li>';
					append = append + '						<li onclick="document.getElementById(&apos;updateBtn' + dataEvent.id + '&apos;).innerHTML = &apos;Finish <span class=&quot;fa fa-caret-down&quot;></span>&apos;;"><a href="#">Finish</a></li>';
					append = append + '					</ul>';
					append = append + '				</div>';
					append = append + '				<input type="text" class="form-control" id="inputUpdateEventProject' + dataEvent.id + '">';
					append = append + '				<input type="hidden" id="inputIdUpdateEventProject' + dataEvent.id + '" value=' + dataEvent.id + '>';
					append = append + '				<div class="input-group-btn">';
					append = append + '					<button type="button" class="btn btn-primary" onclick="updateEventProject(&quot;' + bg_color + '&quot;,&quot;' + classTimeline + '&quot;,&quot;' + dataEvent.id + '&quot;)">Go</button>';
					append = append + '				</div>';
					append = append + '			</div>';
					append = append + '		</div>';
					append = append + '	</div>';
					append = append + '</li>';
				});
				append = append + '<li class="beforeTime" style="display:none">';
				append = append + '	<i class="fa fa-clock-o bg-gray"></i>';
				append = append + '</li>';
				$("#timelineDetailProject").append(append);
			}
		});
	}

	// DataTables child controll
	function format( data , result ) {
		return '<div class="row">' +
			'<div class="col-md-1">' +
				'<button class="btn btn-primary" onclick="showProjectDetail(' + data.id + ')">Update</button>' +
			'</div>' +
			'<div class="col-md-2">' +
				'<label>Occouring Event</label>' +
				'<p> ' + result.event_now + '</p>' +
			'</div>' +
			'<div class="col-md-6">' +
				'<label>Lastest Update</label>' +
				'<p>' + result.lastest_update + '</p>' +
			'</div>' +
			'<div class="col-md-3">' +
				'<label>Project ID</label>' +
				'<p>' + result.project_id + '</p>' +
			'</div>' +
		'</div>';
	}

	$('#tableProjectManage').on('click','td.details-control', function () {
		// console.log(tr);
		var tr = $(this).closest('tr');
		var row = $("#tableProjectManage").DataTable().row( tr );

		if ( row.child.isShown() ) {
			// This row is already open - close it
			row.child.hide();
			tr.removeClass('shown');
		}
		else {
			// Open this row
			$.ajax({
				type:"GET",
				url:"{{url('project/manage/getShortDetailProjectList')}}",
				data:{
					id_project:row.data().id
				},
				success:function(result){
					$("#tableProjectManage").DataTable().row( tr ).child( format(row.data(), result) ).show()
					tr.addClass('shown');
				}
			});
			// row.child( format(row.data(),ajaxData) ).show();
		}
	});

	
</script>
@endsection