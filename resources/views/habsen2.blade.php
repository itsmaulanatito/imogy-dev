@extends('layouts.admin.layout')

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header" >
		<img src="img/labelaogy.png" width="120" height="40">
		<ol class="breadcrumb" style="font-size: 15px;">
			<li><a href="{{url('helpdesk')}}"><i class="fa fa-book"></i>My Absent History</a></li>
			<li><a href="{{url('helpdesk')}}"><i class="fa fa-users"></i>My Team Attendance</a></li>
		</ol>
	</section>

	<section class="content">

		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				
				
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-xs-12 text-center">
						<canvas id="canvas" width="300" height="300" style="background-color:rgba(0,0,0,0)"></canvas>
						<br>
						<h3>{{date("l, d M Y")}}</h3>
						<br>

						<div class="row">
							<div class="col-md-4  col-md-offset-4 text-center">
						@if ($sudah=='belum')
								<div class="alert alert-success" role="alert"  id="logined">Absen Complete</div>
								@else 
								<button type="button" class="btn btn-primary " data-toggle="modal" data-target="#myModal" id="habsen">ABSEN</button>
								@endif
								<button style="display: none;" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal2" id="berhasil">Berhasil</button>
								<button style="display: none;" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal3" id="gagal">Gagal</button>
							</div>
						</div>

						<!-- Modal awal -->
						<div class="modal fade" id="myModal" role="dialog">
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Absen Location</h4>
									</div>
									<div class="modal-body">
										<p>You are not office location, pleas go to your area, and login on there</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-success" id="absenLocation">Absen Location</button>
										<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
									</div>
								</div>

							</div>
						</div>

						<!-- Modal berhasil -->
						<div class="modal fade" id="myModal2" role="dialog">
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Login on Position Success</h4>
									</div>
									<div class="modal-body">
										<p>You have been login on your area. Keep spirit for our bussines</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default pull-left" data-dismiss="modal" id="close">Close</button>
									</div>
								</div>

							</div>
						</div>

						<!-- Modal gagal -->
						<div class="modal fade" id="myModal3" role="dialog">
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Login on Position Failed</h4>
									</div>
									<div class="modal-body">
										<p>You are not on your absent area. Please go to {{$point->name}} for successfully login.</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal" id="tryAgain">Try Again</button>
										<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				
			</div>
			<!-- /.box-footer-->
		</div>
		<!-- /.box -->

	</section>
</div>
<script src="{{ asset('js/jquery.js') }}"></script>
<script>
	$(document).ready(function(){
		console.log("{{Auth::user()->name}}");
		$("#absenLocation").click(function () {
			initMap();
		});

		$("#tryAgain").click(function(){
			initMap();
		});
		
		var map, infoWindow, pos;
		function initMap() {

			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function(position) {
					pos = {
						lat: position.coords.latitude,
						lng: position.coords.longitude
					};
					var lat = "{{$point->lat}}";
					var lang = "{{$point->lang}}";
					var p1 = new google.maps.LatLng(lat, lang);
					var p2 = new google.maps.LatLng(pos.lat, pos.lng);

					if(calcDistance(p1, p2) < 0.5) {
						$("#berhasil").click();
						$("#myModal").hide();
						$("#absen").hide();
						alert(calcDistance(p1, p2) + " km, masuk wilayah");
						$("#logined").show(); //
						$("#close").click(function () {
							$(".modal-backdrop").hide();
						});
						$.ajax({
							type: "GET",
							url: "raw3/{{Auth::user()->id}}",
							success: function(){
								location.reload();
							},
						});
						$("#absen").hide();
					} else {
						$("#gagal").click();
						$("#myModal").hide();
						$(".modal-backdrop").hide();
						alert(calcDistance(p1, p2) + " km, keluar wilayah");
					}

					//calculates distance between two points in km's
					function calcDistance(p1, p2) {
						return (google.maps.geometry.spherical.computeDistanceBetween(p1, p2) / 1000).toFixed(2);
					}

					console.log(pos.lat + " , " + pos.lng);	
				}, function() {
					alert("Geolocation is not support");
					// handleLocationError(true, infoWindow, map.getCenter());
				});
			} else {
				// Browser doesn't support Geolocation
				handleLocationError(false, infoWindow, map.getCenter());
			}
		}

		function handleLocationError(browserHasGeolocation, infoWindow, pos) {
			infoWindow.setPosition(pos);
			infoWindow.setContent(browserHasGeolocation ? 'Error: The Geolocation service failed.' : 'Error: Your browser doesn\'t support geolocation.');
			infoWindow.open(map);
		}
	});
</script>
<script>
	var canvas = document.getElementById("canvas");
	var ctx = canvas.getContext("2d");
	var radius = canvas.height / 2;
	ctx.translate(radius, radius);
	radius = radius * 0.90
	setInterval(drawClock, 1000);

	function drawClock() {
		drawFace(ctx, radius);
		drawNumbers(ctx, radius);
		drawTime(ctx, radius);
	}

	function drawFace(ctx, radius) {
		var grad;
		ctx.beginPath();
		ctx.arc(0, 0, radius, 0, 2*Math.PI);
		ctx.fillStyle = 'white';
		ctx.fill();
		grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
		grad.addColorStop(0, 'rgb(43, 78, 98)');
		grad.addColorStop(0.5, 'rgb(43, 78, 98)');
		grad.addColorStop(1, 'rgb(43, 78, 98)');
		ctx.strokeStyle = grad;
		ctx.lineWidth = radius*0.1;
		ctx.stroke();
		ctx.beginPath();
		ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
		ctx.fillStyle = 'rgb(43, 78, 98)';
		ctx.fill();
	}

	function drawNumbers(ctx, radius) {
		var ang;
		var num;
		ctx.font = radius*0.15 + "px arial";
		ctx.textBaseline="middle";
		ctx.textAlign="center";
		for(num = 1; num < 13; num++){
			ang = num * Math.PI / 6;
			ctx.rotate(ang);
			ctx.translate(0, -radius*0.85);
			ctx.rotate(-ang);
			ctx.fillText(num.toString(), 0, 0);
			ctx.rotate(ang);
			ctx.translate(0, radius*0.85);
			ctx.rotate(-ang);
		}
	}

	function drawTime(ctx, radius){
		var now = new Date();
		var hour = now.getHours();
		var minute = now.getMinutes();
		var second = now.getSeconds();
		//hour
		hour=hour%12;
		hour=(hour*Math.PI/6)+
		(minute*Math.PI/(6*60))+
		(second*Math.PI/(360*60));
		drawHand(ctx, hour, radius*0.5, radius*0.07);
		//minute
		minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
		drawHand(ctx, minute, radius*0.8, radius*0.07);
		// second
		second=(second*Math.PI/30);
		drawHand(ctx, second, radius*0.9, radius*0.02);
	}

	function drawHand(ctx, pos, length, width) {
		ctx.beginPath();
		ctx.lineWidth = width;
		ctx.lineCap = "round";
		ctx.moveTo(0,0);
		ctx.rotate(pos);
		ctx.lineTo(0, -length);
		ctx.stroke();
		ctx.rotate(-pos);
	}
</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3&sensor=false&libraries=geometry"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAX4arGqDKY0F0VDrxeR4c5fyAloMqEMis"></script>
@endsection