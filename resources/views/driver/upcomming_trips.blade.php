@extends('layouts.driver')

@section('main') 
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Upcomming Trips</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Upcomming Trips</li>
                            </ol>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Future Trips</header>
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
								                <th>#</th>
								                <th>Trip Id</th>
								                <th>Passenger Name</th>
								                <th>Trip From</th>
								                <th>Trip To</th>
								                <th>Start Time</th>
								                <th>Action</th>
								            </tr>
								        </thead>
											<tbody>
												
												<tr>
													<td>18</td>
													<td>ID236</td>
													<td>John Smith</td>
													<td>34, Alax street</td>
													<td>Au, xyz road</td>
													<td>18-02-2018 12:34</td>
													<td>
														<a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
															<i class="fa fa-pencil"></i>
														</a>
														<button class="btn btn-tbl-delete btn-xs">
															<i class="fa fa-trash-o "></i>
														</button>
													</td>
												</tr>
											</tbody>
										</table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page content -->
			@endsection