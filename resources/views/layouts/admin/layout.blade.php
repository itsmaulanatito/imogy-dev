<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>IMOGY </title>
	<link href="img/imoicon.png" rel="icon" type="image/x-icon">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/AdminLTE.min.css')}}">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
			 folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
	<!-- Morris chart -->
	<link rel="stylesheet" href="plugins/morris/morris.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
	<!-- Date Picker -->
	<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
	
	<!-- Select2 -->
	<link rel="stylesheet" href="../../plugins/select2/select2.min.css">

	<!-- fullCalendar 2.2.5-->
	<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fullcalendar/fullcalendar.min.css')}}">
	<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fullcalendar/fullcalendar.print.css')}}" media="print">
	<!-- DataTables -->
	<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables/dataTables.bootstrap.css')}}">
	
	<!-- Pace style -->
	<!-- <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/pace/pace.min.css')}}" > -->
	 <!-- CHART -->
  
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	   folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">	

	
	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

	@yield('head')
	<style type="text/css">
		.switch {
			position: relative;
			display: inline-block;
			width: 60px;
			height: 34px;
		}

		.switch input {display:none;}

		.slider {
			position: absolute;
			cursor: pointer;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-color: #ccc;
			-webkit-transition: .4s;
			transition: .4s;
		}

		.slider:before {
			position: absolute;
			content: "";
			height: 26px;
			width: 26px;
			left: 4px;
			bottom: 4px;
			background-color: white;
			-webkit-transition: .4s;
			transition: .4s;
		}

		input:checked + .slider {
			background-color: #2196F3;
		}

		input:focus + .slider {
			box-shadow: 0 0 1px #2196F3;
		}

		input:checked + .slider:before {
			-webkit-transform: translateX(26px);
			-ms-transform: translateX(26px);
			transform: translateX(26px);
		}

		/* Rounded sliders */
		.slider.round {
			border-radius: 34px;
		}

		.slider.round:before {
			border-radius: 50%;
		}
	</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

	<header class="main-header">
		<!-- Logo -->
		<a href="{{url('admin')}}" class="logo"  style="background-color: #2b4e62">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini"><img src="img/iconwhitek.png" style="padding:5px;width: 45px; height: 45px;"></span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg" style="background-color: #2b4e62"><img src="img/bar.png" width="70px" align="center"></span>
		</a>
		<!-- Header Navbar: style can be found in header.less -->
		<nav class="navbar navbar-static-top" style=" background-color: #2b4e62">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>

			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<!-- Messages: style can be found in dropdown.less-->
					<!-- User Account: style can be found in dropdown.less -->
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							@if(Auth::user()->foto == "0")
							<img src="{{url('img/no-image.png')}}" class="user-image" alt="User Image">
							@else
							<img src="{{url(Auth::user()->foto)}}" class="user-image" alt="User Image">
							@endif
							<span class="hidden-xs">{{Auth::user()->name}}</span>
						</a>
						<ul class="dropdown-menu">
							<!-- User image -->
							<li class="user-header" style="background-color:#222d32">
								@if(Auth::user()->foto == "0")
								<img src="{{url('img/no-image.png')}}" class="img-circle" alt="User Image">
								@else
								<img src="{{url(Auth::user()->foto)}}" class="img-circle" alt="User Image">
								@endif

								<p>
									{{Auth::user()->name}} 
										<small><i class="fa fa-circle text-success"></i> Admin</small>
								</p>
							</li>
							<!-- Menu Body -->
							<!-- <li class="user-body">
								<div class="row">
									<div class="col-xs-4 text-center">
										<a href="#">Followers</a>
									</div>
									<div class="col-xs-4 text-center">
										<a href="#">Sales</a>
									</div>
									<div class="col-xs-4 text-center">
										<a href="#">Friends</a>
									</div>
								</div>
								<!- /.row -->
							</li>
							<!-- Menu Footer-->
							<li class="user-footer">
								@if(Auth::user()->id != 4)
								<div class="pull-left">
									<a href="{{ url('profile')}}" class="btn btn-default btn-flat">Profile</a>
								</div>
								@else
								<div class="pull-left">
									@if(isset($debug))
									<a href="{{ url('debugMode')}}" class="btn btn-danger btn-flat">Active</a>
									@else
									<a href="{{ url('debugMode')}}" class="btn btn-success btn-flat">Passive</a>
									@endif
								</div>
								@endif
								<!-- <div class="pull-left">
									<a href="{{ url('debugMode')}}" class="btn btn-danger btn-flat">Debug</a>
								</div> -->
								<div class="pull-right">

									<a class="btn btn-default btn-flat"  href="{{ route('logout') }}"
												onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
										</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											{{ csrf_field() }}
										</form>
								</div>
							</li>
						</ul>
					</li>
					<!-- Control Sidebar Toggle Button -->
				</ul>
			</div>
		</nav>
	</header>

	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">
			<!-- Sidebar user panel -->
			<div class="user-panel">
				<a href="{{ url('profile')}}" class="pull-left image">
					@if(Auth::user()->foto == "0")
						<img src="{{url('img/no-image.png')}}" class="img-circle" alt="User Image">
					@else
						<img src="{{url(Auth::user()->foto)}}" class="img-circle" alt="User Image">
					@endif
				</a>
				<div class="pull-left info">
					<p>{{Auth::user()->name}}</p>
						<small><i class="fa fa-circle text-success"> </i>  Admin</small>					
				</div>
			</div>
			<!-- search form -->
			<!-- <form action="#" method="get" class="sidebar-form">
				<div class="input-group">
					<input type="text" name="q" class="form-control" placeholder="Search...">
					<span class="input-group-btn">
						<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
						</button>
					</span>
				</div>
			</form>
			<!- /.search form -->
			<!-- sidebar menu: : style can be found in sidebar.less -->
			
			<ul class="sidebar-menu" data-widget="tree">
				<li class="header" onclick="url()">
							Main Menu
						</li>
				<li class="" id="dashboard">
					<a href="{{ url('/admin') }}">
						<i class="fa fa-dashboard"></i> <span>Dashboard</span>
					</a>
				</li>
				<li class="" id="absen">
					<a href="{{ url('absen')}}">
						<i class="fa fa-clock-o"></i>
						<span>AOGY</span>
					</a>
				</li>
				<!-- <li class="" id="tisygy">
					<a href="{{ url('tisygy')}}">
						<i class="fa fa-paper-plane"></i>
						<span>TISYGY</span>
					</a>
				</li> -->
				<!-- @if(Auth::user()->id == 4 || Auth::user()->id == 6)
				<li class="" id="controll">
					<a href="{{ url('/controll')}}">
						<i class="fa fa-check-square-o"></i>
						<span>Control</span>
					</a>
				</li>
				@endif -->
				<li class="" id="usermanage">
					<a href="{{ url('usermanage')}}">
						<i class="fa fa-users"></i>
						<span>Users Management</span>
					</a>
				</li>
				<li class="" id="schedule">
					<a href="{{ url('schedule')}}">
						<i class="fa fa-flag-o"></i>
						<span>Shifting Schedule</span>
					</a>
				</li>
				<li class="" id="location">
					<a href="{{ url('location')}}">
						<i class="fa fa-location-arrow"></i>
						<span>Set Absent Location</span>
					</a>
				</li>
				<!-- <li class="" id="project">
					<a href="{{ url('project/manage')}}">
						<i class="fa fa-calendar"></i>
						<span>Project Manage</span>
					</a>
				</li> -->
				<!-- <li class="" id="announcement">
					<a href="{{ url('announcement')}}">
						<i class="fa fa-bookmark-o"></i>
						<span>Announcement</span>
					</a>
				</li>
				<li class="" id="announcement">
					<a href="{{ url('test_page')}}">
						<i class="fa fa-test-o"></i>
						<span>Test Page</span>
					</a>
				</li> -->
			</ul>
		</section>
		<!-- /.sidebar -->
	</aside>

	<!-- Content Wrapper. Contains page content -->
	@yield('content')
	<!-- /.content-wrapper -->
	<!-- Control Sidebar -->
	<!-- /.control-sidebar -->
	<!-- Add the sidebar's background. This div must be placed
			 immediately after the control sidebar -->
	
</div>
<!-- ./wrapper -->

<!-- jQuery 3.1.1 -->
<script src="plugins/jQuery/jquery-3.1.1.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 3.3.7 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard.js"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/select2.full.min.js"></script>
<!-- <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script> -->
<script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<!-- chart-->
<script src="{{ asset('AdminLTE/plugins/jQuery/jquery-3.1.1.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('AdminLTE/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- ChartJS 1.0.1 -->
<script src="{{ asset('AdminLTE/plugins/chartjs/Chart.min.js')}}"></script>
<!-- PACE -->	
<!-- <script src="{{ asset('AdminLTE/plugins/pace/pace.min.js')}}"></script> -->
<!-- FastClick -->
<script src="{{ asset('AdminLTE/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('AdminLTE/dist/js/demo.js')}}"></script>
<!-- page script -->
<script src="{{asset('AdminLTE/plugins/jQuery/jquery-3.1.1.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('js/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('js/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('js/demo.js')}}"></script>
<!-- Date Range Picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/locale/id.js"></script>

<!-- fullCalendar 2.2.5 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{asset('js/fullcalendar.min.js')}}"></script>


<script type="text/javascript">
$(document).ready(function(){
	var path = (document.URL).split("/");
	switch(path[path.length - 1]) {
		case "admin":
			$("#dashboard").addClass("active");
			$("#absen").removeClass("active");
			$("#tisygy").removeClass("active");
			$("#usermanage").removeClass("active");
			$("#schedule").removeClass("active");
			$("#location").removeClass("active");
			$("#schedule#").removeClass("active");
			$("#project").removeClass("active");
			console.log("admin");
			break;

		case "absen":
			$("#dashboard").removeClass("active");
			$("#absen").addClass("active");
			$("#tisygy").removeClass("active");
			$("#usermanage").removeClass("active");
			$("#schedule").removeClass("active");
			$("#location").removeClass("active");
			$("#schedule#").removeClass("active");
			$("#project").removeClass("active");
			console.log("absen");
			break;

		case "ahistory":
			$("#dashboard").removeClass("active");
			$("#absen").addClass("active");
			$("#tisygy").removeClass("active");
			$("#usermanage").removeClass("active");
			$("#schedule").removeClass("active");
			$("#location").removeClass("active");
			$("#schedule#").removeClass("active");
			$("#project").removeClass("active");
			console.log("ahistory");
			break;

		case "ateamhistory":
			$("#dashboard").removeClass("active");
			$("#absen").addClass("active");
			$("#tisygy").removeClass("active");
			$("#usermanage").removeClass("active");
			$("#schedule").removeClass("active");
			$("#location").removeClass("active");
			$("#schedule#").removeClass("active");
			$("#project").removeClass("active");

			console.log("ateamhistory");
			break;

		case "areport":
			$("#dashboard").removeClass("active");
			$("#absen").addClass("active");
			$("#tisygy").removeClass("active");
			$("#usermanage").removeClass("active");
			$("#schedule").removeClass("active");
			$("#location").removeClass("active");
			$("#schedule#").removeClass("active");
			$("#project").removeClass("active");
			console.log("location");
			break;

		case "tisygy":
			$("#dashboard").removeClass("active");
			$("#absen").removeClass("active");
			$("#tisygy").addClass("active");
			$("#usermanage").removeClass("active");
			$("#schedule").removeClass("active");
			$("#location").removeClass("active");
			$("#schedule#").removeClass("active");
			$("#project").removeClass("active");
			console.log("tisygy");
			break;
			
		case "usermanage":
			$("#dashboard").removeClass("active");
			$("#absen").removeClass("active");
			$("#tisygy").removeClass("active");
			$("#usermanage").addClass("active");
			$("#schedule").removeClass("active");
			$("#location").removeClass("active");
			$("#schedule#").removeClass("active");
			$("#project").removeClass("active");
			console.log("usermanage");
			break;
		
		case "schedule":
			$("#dashboard").removeClass("active");
			$("#absen").removeClass("active");
			$("#tisygy").removeClass("active");
			$("#usermanage").removeClass("active");
			$("#schedule").addClass("active");
			$("#location").removeClass("active");
			$("#schedule#").removeClass("active");
			$("#project").removeClass("active");
			console.log("schedule");
			break;

		case "location":
			$("#dashboard").removeClass("active");
			$("#absen").removeClass("active");
			$("#tisygy").removeClass("active");
			$("#usermanage").removeClass("active");
			$("#schedule").removeClass("active");
			$("#location").addClass("active");
			$("#schedule#").removeClass("active");
			$("#project").removeClass("active");
			console.log("location");
			break;

		case "schedule#":
			$("#dashboard").removeClass("active");
			$("#absen").removeClass("active");
			$("#tisygy").removeClass("active");
			$("#usermanage").removeClass("active");
			$("#schedule").removeClass("active");
			$("#location").removeClass("active");
			$("#schedule#").addClass("active");
			$("#project").removeClass("active");
			console.log("location");
			break;

		case "project":
			$("#dashboard").removeClass("active");
			$("#absen").removeClass("active");
			$("#tisygy").removeClass("active");
			$("#usermanage").removeClass("active");
			$("#schedule").removeClass("active");
			$("#location").removeClass("active");
			$("#project").addClass("active");
			console.log("location");
			break;				

		default:
			$("#dashboard").addClass("active");
	};
	// console.log(path[path.length - 1]);
});
</script>
@yield('script')
</body>
</html>
