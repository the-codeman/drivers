@extends('layouts.driver')
@section('main') 
<?php

// $class = DB::select('SELECT * FROM teachers WHERE class_id = ? ',$id);
//	$trips = DB::table('trips')->get();
$trips = DB::table('trips')->where('user_id', @Auth::user()->id )->get()

?>
<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Trip History</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Trip History</li>
                </ol>
            </div>
        </div>
	    <div class="row">
            <div class="col-md-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Trip History {{ @Auth::user()->id }} </header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="table-scrollable">
                            <table id="tableExport" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Trip Id</th>
							            <th>Passenger Name</th>
							            <th>Trip From</th>
							            <th>Trip To</th>
							            <th>Start Time</th>
							            <th>End Time</th>
							            <th>Distance</th>
							            <th>Fare</th>
							            <th>View Route</th>
							        </tr>
							    </thead>
			     				<tbody>
			     				    @foreach($trips as $trip)
			 						<tr>
										<td>{{ @$trip->id }}</td>
										<td>{{ @$trip->pickup_latitude }}</td>
										<td>{{ @$trip->pickup_longitude }}</td>
										<td>{{ @$trip->drop_latitude }}</td>>
										<td>{{ @$trip->id }}</td>
										<td>{{ @$trip->id }}</td>
										<td>{{ @$trip->id }}</td>
										<td>{{ @$trip->id }}</td>
										<td>
										    <a href="route_map?id={{ @$trip->id }}" class="btn btn-tbl-delete btn-xs">
									    		<i class="fa fa-map-marker"></i>
								    		</a>
							    		</td>
									</tr>
									@endforeach
								</tbody>
				    		</table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection