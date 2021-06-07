@extends('layouts.driver')

@section('main') 
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">My Earning</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">My Earning</li>
                            </ol>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>My Earning</header>
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
								                <th>Date</th>
								                <th>Payment Mode</th>
								                <th>Amount</th>
								                <th>Balance</th>
								            </tr>
								        </thead>
											<tbody>
												<tr>
													<td>1</td>
													<td>ID234</td>
													<td>12-05-2017</td>
													<td>Cash</td>
													<td>$20</td>
													<td>$20</td>
												</tr>
												<tr>
													<td>2</td>
													<td>ID654</td>
													<td>13-05-2017</td>
													<td>Credit Card</td>
													<td>$10</td>
													<td>$30</td>
												</tr>
												<tr>
													<td>3</td>
													<td>ID298</td>
													<td>14-05-2017</td>
													<td>Wallet</td>
													<td>$20</td>
													<td>$50</td>
												</tr>
												<tr>
													<td>4</td>
													<td>ID764</td>
													<td>15-05-2017</td>
													<td>Cash</td>
													<td>$15</td>
													<td>$65</td>
												</tr>
												<tr>
													<td>5</td>
													<td>ID098</td>
													<td>16-05-2017</td>
													<td>Credit Card</td>
													<td>$10</td>
													<td>$75</td>
												</tr>
												<tr>
													<td>6</td>
													<td>ID234</td>
													<td>17-05-2017</td>
													<td>Cash</td>
													<td>$20</td>
													<td>$95</td>
												</tr>
												<tr>
													<td>7</td>
													<td>ID657</td>
													<td>18-05-2017</td>
													<td>Wallet</td>
													<td>$5</td>
													<td>$100</td>
												</tr>
												<tr>
													<td>8</td>
													<td>ID234</td>
													<td>12-05-2017</td>
													<td>Cash</td>
													<td>$20</td>
													<td>$20</td>
												</tr>
												<tr>
													<td>9</td>
													<td>ID654</td>
													<td>13-05-2017</td>
													<td>Credit Card</td>
													<td>$10</td>
													<td>$30</td>
												</tr>
												<tr>
													<td>10</td>
													<td>ID298</td>
													<td>14-05-2017</td>
													<td>Wallet</td>
													<td>$20</td>
													<td>$50</td>
												</tr>
												<tr>
													<td>11</td>
													<td>ID764</td>
													<td>15-05-2017</td>
													<td>Cash</td>
													<td>$15</td>
													<td>$65</td>
												</tr>
												<tr>
													<td>12</td>
													<td>ID098</td>
													<td>16-05-2017</td>
													<td>Credit Card</td>
													<td>$10</td>
													<td>$75</td>
												</tr>
												<tr>
													<td>13</td>
													<td>ID234</td>
													<td>17-05-2017</td>
													<td>Cash</td>
													<td>$20</td>
													<td>$95</td>
												</tr>
												<tr>
													<td>14</td>
													<td>ID657</td>
													<td>18-05-2017</td>
													<td>Wallet</td>
													<td>$5</td>
													<td>$100</td>
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