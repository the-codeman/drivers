@extends('layouts.driver')

@section('main') 
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Route Map</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="">Trip</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Route Map</li>
                            </ol>
                        </div>
                    </div>
					<div class="row">
						<div class="col-md-12">
							<div class="card card-box">
								<div class="card-head">
									<header>Route Detail</header>
									<div class="tools">
										<a class="fa fa-repeat btn-color box-refresh"
											href="javascript:;"></a> <a
											class="t-collapse btn-color fa fa-chevron-down"
											href="javascript:;"></a> <a
											class="t-close btn-color fa fa-times" href="javascript:;"></a>
									</div>
								</div>
								<div class="card-body ">
									<div class="tab-content">
										<div class="row">
											<div class="col-md-3">Trip ID</div>
											<!--.col-md-3-->
											<div class="col-md-1">:</div>
											<!--.col-md-3-->
											<div class="col-md-8">ID45345</div>
											<!--.col-md-9-->
										</div>
										<!--.row-->
										<div class="row">
											<div class="col-md-3">Driver</div>
											<!--.col-md-3-->
											<div class="col-md-1">:</div>
											<!--.col-md-3-->
											<div class="col-md-3">Kevin Wilson</div>
											<!--.col-md-9-->
										</div>
										<!--.row-->
										<div class="row">
											<div class="col-md-3">Passenger</div>
											<!--.col-md-3-->
											<div class="col-md-1">:</div>
											<!--.col-md-3-->
											<div class="col-md-8">William Miller</div>
											<!--.col-md-9-->
										</div>
										<!--.row-->
										<div class="row">
											<div class="col-md-3">Cab Type</div>
											<!--.col-md-3-->
											<div class="col-md-1">:</div>
											<!--.col-md-3-->
											<div class="col-md-8">SUV</div>
											<!--.col-md-9-->
										</div>
										<!--.row-->
										<div class="row">
											<div class="col-md-3">Trip From</div>
											<!--.col-md-3-->
											<div class="col-md-1">:</div>
											<!--.col-md-3-->
											<div class="col-md-8">address here</div>
											<!--.col-md-9-->
										</div>
										<!--.row-->
										<div class="row">
											<div class="col-md-3">Trip To</div>
											<!--.col-md-3-->
											<div class="col-md-1">:</div>
											<!--.col-md-3-->
											<div class="col-md-8">address here </div>
										</div>
										<!--.row-->
										<div class="row">
											<div class="col-md-3">Start Time</div>
											<!--.col-md-3-->
											<div class="col-md-1">:</div>
											<!--.col-md-3-->
											<div class="col-md-8">2017-10-23 06:51:17</div>
											<!--.col-md-9-->
										</div>
										<!--.row-->
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card card-box">
								<div class="card-head">
									<header>Route</header>
									<div class="tools">
										<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
										<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
										<a class="t-close btn-color fa fa-times" href="javascript:;"></a>
									</div>
								</div>
								<div class="card-body ">
									<form class="form-inline mg-bottom-10" action="#">
										<input type="button" id="routes_start" class="btn deepPink-bgcolor" value="Show Route" />
									</form>
									<div class="label label-danger visible-ie8">Not supported in Internet Explorer 8</div>
									<div id="gmap_routes" class="gmaps"></div>
									<ol id="routes_instructions"></ol>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
            <!-- end page content -->
			@endsection