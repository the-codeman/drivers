@extends('layouts.driver')

@section('main') 
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Tax &amp; Insurance</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Tax &amp; Insurance</li>
                            </ol>
                        </div>
                    </div>
                      <!-- start tax Details -->
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="card  card-box">
                                <div class="card-head">
                                    <header>Tax Details</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
	                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
	                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body ">
                                  <div class="table-wrap">
										<div class="table-responsive tblDriverDetail">
											<table class="table display product-overview mb-30" id="support_table5">
												<thead>
													<tr>
														<th>No</th>
														<th>Year</th>
														<th>Payment Date</th>
														<th>Tax Type</th>
														<th>Status</th>
														<th>Amount</th>
														<th>Vehicle Number</th>
														<th>Edit</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>1</td>
														<td>2015-16</td>
														<td>23/02/2016</td>
														<td>Service Tax</td>
														<td>
															<span class="label label-sm box-shadow-1 label-success">Paid</span>
														</td>
														<td>$132</td>
														<td>XN 01 1235</td>
														<td>
															<a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
																<i class="fa fa-pencil"></i>
															</a>
															<button class="btn btn-tbl-delete btn-xs">
																<i class="fa fa-trash-o "></i>
															</button>
														</td>
													</tr>
													<tr>
														<td>2</td>
														<td>2016-17</td>
														<td>24/05/2017</td>
														<td>Transportation Tax</td>
														<td>
															<span class="label label-sm box-shadow-1 label-warning">Pending </span>
														</td>
														<td>$543</td>
														<td>Xp 09 4354</td>
														<td>
															<a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
																<i class="fa fa-pencil"></i>
															</a>
															<button class="btn btn-tbl-delete btn-xs">
																<i class="fa fa-trash-o "></i>
															</button>
														</td>
													</tr>
													<tr>
														<td>3</td>
														<td>2017-18</td>
														<td>17/05/2017</td>
														<td>Income Tax</td>
														<td>
															<span class="label label-sm box-shadow-1 label-success ">Paid</span>
														</td>
														<td>$129</td>
														<td>Xp 09 4357</td>
														<td>
															<a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
																<i class="fa fa-pencil"></i>
															</a>
															<button class="btn btn-tbl-delete btn-xs">
																<i class="fa fa-trash-o "></i>
															</button>
														</td>
													</tr>
													<tr>
														<td>4</td>
														<td>2015-16</td>
														<td>23/02/2016</td>
														<td>Service Tax</td>
														<td>
															<span class="label label-sm box-shadow-1 label-success">Paid</span>
														</td>
														<td>$132</td>
														<td>XN 01 1235</td>
														<td>
															<a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
																<i class="fa fa-pencil"></i>
															</a>
															<button class="btn btn-tbl-delete btn-xs">
																<i class="fa fa-trash-o "></i>
															</button>
														</td>
													</tr>
													<tr>
														<td>5</td>
														<td>2016-17</td>
														<td>24/05/2017</td>
														<td>Transportation Tax</td>
														<td>
															<span class="label label-sm box-shadow-1 label-warning">Pending </span>
														</td>
														<td>$543</td>
														<td>Xp 09 4354</td>
														<td>
															<a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
																<i class="fa fa-pencil"></i>
															</a>
															<button class="btn btn-tbl-delete btn-xs">
																<i class="fa fa-trash-o "></i>
															</button>
														</td>
													</tr>
													<tr>
														<td>6</td>
														<td>2017-18</td>
														<td>17/05/2017</td>
														<td>Income Tax</td>
														<td>
															<span class="label label-sm box-shadow-1 label-success ">Paid</span>
														</td>
														<td>$129</td>
														<td>Xp 09 4357</td>
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
                    <!-- end Tax Details -->
                       <!-- start tax Details -->
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="card  card-box">
                                <div class="card-head">
                                    <header>Insurance Details</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
	                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
	                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body ">
                                  <div class="table-wrap">
										<div class="table-responsive tblDriverDetail">
											<table class="table display product-overview mb-30" id="insurenceTable">
												<thead>
													<tr>
														<th>No</th>
														<th>Year</th>
														<th>Payment Date</th>
														<th>Insurance Type</th>
														<th>Status</th>
														<th>Amount</th>
														<th>Vehicle Number</th>
														<th>Edit</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>1</td>
														<td>2015-16</td>
														<td>23/02/2016</td>
														<td>Full Insurance</td>
														<td>
															<span class="label label-sm box-shadow-1 label-success">Paid</span>
														</td>
														<td>$132</td>
														<td>XN 01 1235</td>
														<td>
															<a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
																<i class="fa fa-pencil"></i>
															</a>
															<button class="btn btn-tbl-delete btn-xs">
																<i class="fa fa-trash-o "></i>
															</button>
														</td>
													</tr>
													<tr>
														<td>2</td>
														<td>2016-17</td>
														<td>24/05/2016</td>
														<td>Third Party Insurance</td>
														<td>
															<span class="label label-sm box-shadow-1 label-warning">Pending </span>
														</td>
														<td>$543</td>
														<td>Xp 09 4354</td>
														<td>
															<a href="edit_booking.html" class="btn btn-tbl-edit btn-xs">
																<i class="fa fa-pencil"></i>
															</a>
															<button class="btn btn-tbl-delete btn-xs">
																<i class="fa fa-trash-o "></i>
															</button>
														</td>
													</tr>
													<tr>
														<td>3</td>
														<td>2017-18</td>
														<td>17/05/2017</td>
														<td>Full Insurance</td>
														<td>
															<span class="label label-sm box-shadow-1 label-success ">Paid</span>
														</td>
														<td>$129</td>
														<td>Xp 09 4357</td>
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
                    <!-- end Tax Details -->
                </div>
            </div>
            <!-- end page content -->
			@endsection