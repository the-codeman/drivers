@extends('layouts.driver')

@section('main') 
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Dashboard</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                   <!-- start widget -->
					<div class="row">
	                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
	                    	<div class="card card-box">
                                 <div class="card-head">
                                     <header>Trips</header>
                                 </div>
                                 <div class="card-body ">
									<div class="row">
										<div class="col-sm-4 col-4 m-b-10">
											<span class="text-muted">This Week</span>
											<h5 class="m-b-0">5,286</h5>
											<span><i class="material-icons text-success">trending_up</i>
												+28%</span>
										</div>
										<div class="col-sm-4 col-4 m-b-10">
											<span class="text-muted">This Month</span>
											<h5 class="m-b-0">421</h5>
											<span><i class="material-icons text-danger">trending_down</i>
												-9%</span>
										</div>
										<div class="col-sm-4 col-4 m-b-10">
											<span class="text-muted">Average</span>
											<h5 class="m-b-0">1081</h5>
											<span><i class="material-icons text-success">trending_up</i>
												+7%</span>
										</div>
									</div>
									<div id="sparkline28"></div>
								</div>
                             </div>
	                    </div>
	                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
	                    	<div class="card card-box">
                                 <div class="card-head">
                                     <header>Earning</header>
                                 </div>
                                 <div class="card-body ">
                                 	<div class="row">
										<div class="col-sm-4 col-4 m-b-10">
											<span class="text-muted">This Week</span>
											<h5 class="m-b-0">1,389</h5>
											<span><i class="material-icons text-success">trending_up</i>
												+21%</span>
										</div>
										<div class="col-sm-4 col-4 m-b-10">
											<span class="text-muted">This Month</span>
											<h5 class="m-b-0">591</h5>
											<span><i class="material-icons text-danger">trending_down</i>
												-6.3%</span>
										</div>
										<div class="col-sm-4 col-4 m-b-10">
											<span class="text-muted">Average</span>
											<h5 class="m-b-0">781</h5>
											<span><i class="material-icons text-success">trending_up</i>
												+6%</span>
										</div>
									</div>
									<div id="sparkline29"></div>
                                 </div>
                             </div>
	                    </div>
	                </div>
					<!-- end widget -->
					<!-- start widget -->
					<div class="row">
		                    <div class="col-lg-3 col-md-6 col-sm-12 col-12">
		                        <div class="card">
		                            <div class="panel-body">
		                                <h3>Booked Trips</h3>
		                                <div class="progressbar-xs progress box-shadow-1">
		                                    <div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 65%;"></div>
		                                </div>
		                                <span class="text-small margin-top-10 full-width">14% higher than last month</span> </div>
		                        </div>
		                    </div>
		                    <div class="col-lg-3 col-md-6 col-sm-12 col-12">
		                        <div class="card">
		                            <div class="panel-body">
		                                <h3>Cancelled Trip</h3>
		                                <div class="progressbar-xs progress box-shadow-1">
		                                    <div class="progress-bar progress-bar-orange" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 68%;"></div>
		                                </div>
		                                <span class="text-small margin-top-10 full-width">7% higher than last month</span> </div>
		                        </div>
		                    </div>
		                    <div class="col-lg-3 col-md-6 col-sm-12 col-12">
		                        <div class="card">
		                            <div class="panel-body">
		                                <h3>Users Rating</h3>
		                                <div class="progressbar-xs progress box-shadow-1" >
		                                    <div class="progress-bar progress-bar-purple" role="progressbar" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100" style="width: 52%;"></div>
		                                </div>
		                                <span class="text-small margin-top-10 full-width">34% higher than last month</span> </div>
		                        </div>
		                    </div>
			                    <div class="col-lg-3 col-md-6 col-sm-12 col-12">
			                        <div class="card">
			                            <div class="panel-body">
			                                <h3>Earning</h3>
			                                <div class="progressbar-xs progress box-shadow-1" >
			                                    <div class="progress-bar progress-bar-cyan" role="progressbar" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100" style="width: 56%;"></div>
			                                </div>
			                                <span class="text-small margin-top-10 full-width">20% higher than last month</span> </div>
			                        </div>
								</div>
			        		</div>
					<!-- end widget -->
                     <div class="row">
	                    <div class="col-md-12">
                            <div class="card-box">
                                <div class="card-head">
                                <header>Fare Charge List</header>
                                    <button id = "panel-button" 
			                           class = "mdl-button mdl-js-button mdl-button--icon pull-right" 
			                           data-upgraded = ",MaterialButton">
			                           <i class = "material-icons">more_vert</i>
			                        </button>
			                        <ul class = "mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
			                           data-mdl-for = "panel-button">
			                           <li class = "mdl-menu__item"><i class="material-icons">assistant_photo</i>Action</li>
			                           <li class = "mdl-menu__item"><i class="material-icons">print</i>Another action</li>
			                           <li class = "mdl-menu__item"><i class="material-icons">favorite</i>Something else here</li>
			                        </ul>
                                </div>
                                <div class="card-body ">
                                  <div class="table-scrollable">
                                    <table class="table table-hover table-checkable order-column full-width">
                                        <thead>
                                            <tr>
                                            	<th>#</th>
                                                <th class="center"> Vehicle Type </th>
                                                <th class="center"> Fare Per KM </th>
                                                <th class="center"> Minimum Fare </th>
                                                <th class="center"> Minimum Distance</th>
                                                <th class="center"> Waiting Fare</th>
                                                <th class="center"> Commission </th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<tr class="odd gradeX">
												<td class="center">1</td>
												<td class="center">SUV</td>
												<td class="center">$2</td>
												<td class="center">$10</td>
												<td class="center">10KM</td>
												<td class="center">$2</td>
												<td class="center">20%</td>
											</tr>
											<tr class="odd gradeX">
												<td class="center">2</td>
												<td class="center">SEDAN</td>
												<td class="center">$3</td>
												<td class="center">$14</td>
												<td class="center">5KM</td>
												<td class="center">$1</td>
												<td class="center">16%</td>
											</tr>
											<tr class="odd gradeX">
												<td class="center">3</td>
												<td class="center">Crossover</td>
												<td class="center">$2</td>
												<td class="center">$20</td>
												<td class="center">13KM</td>
												<td class="center">$4</td>
												<td class="center">12%</td>
											</tr>
											<tr class="odd gradeX">
												<td class="center">4</td>
												<td class="center">Coupe</td>
												<td class="center">$2</td>
												<td class="center">$15</td>
												<td class="center">10KM</td>
												<td class="center">$1</td>
												<td class="center">20%</td>
											</tr>
											<tr class="odd gradeX">
												<td class="center">5</td>
												<td class="center">Van</td>
												<td class="center">$2</td>
												<td class="center">$10</td>
												<td class="center">10KM</td>
												<td class="center">$2</td>
												<td class="center">15%</td>
											</tr>
											<tr class="odd gradeX">
												<td class="center">6</td>
												<td class="center">Wagon</td>
												<td class="center">$3</td>
												<td class="center">$14</td>
												<td class="center">20KM</td>
												<td class="center">$1</td>
												<td class="center">10%</td>
											</tr>
										</tbody>
                                    </table>
                                  </div>
                                </div>
                            </div>
	                      </div>
					</div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="card bg-b-purple">
			                    <div class="text-white py-3 px-4">
			                      <h6 class="card-title text-white mb-0">Page View</h6>
			                      <p>7582</p>
			                      <div id="sparkline26"></div>
			                      <small class="text-white">View Details</small>
			                    </div>
			                  </div>
			                  <div class="card bg-b-green">
			                    <div class="text-white py-3 px-4">
			                      <h6 class="card-title text-white mb-0">Earning</h6>
			                      <p>3669.25</p>
			                      <div id="sparkline27"></div>
			                      <small class="text-white">View Details</small>
			                    </div>
			                  </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                        	<div class="card  card-box">
                                <div class="card-head">
                                    <header>Notifications</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
	                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
	                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body no-padding height-9">
                                    <div class="row">
                                        <div class="noti-information notification-menu">
                                            <div class="notification-list mail-list not-list small-slimscroll-style">
                                                <a href="javascript:;" class="single-mail"> <span class="icon bg-b-green box-shadow-1"> <i class="fa fa-user-o"></i>
												</span> <span class="text-purple">Abhay Jani</span> Booked a car
                                                    <span class="notificationtime">
                                                        <small>Just Now</small>
                                                    </span>
                                                </a>
                                                <a href="javascript:;" class="single-mail"> <span class="icon bg-b-orange box-shadow-1"> <i class="fa fa-envelope-o"></i>
												</span> <span class="text-purple">John Doe</span> Give review for ride
                                                    <span class="notificationtime">
                                                        <small>Just Now</small>
                                                    </span>
                                                </a>
                                                <a href="javascript:;" class="single-mail"> <span class="icon bg-b-purple box-shadow-1"> <i class="fa fa-check-square-o"></i>
												</span> Success Message
                                                    <span class="notificationtime">
                                                        <small> 2 Days Ago</small>
                                                    </span>
                                                </a>
                                                <a href="javascript:;" class="single-mail"> <span class="icon bg-b-black box-shadow-1"> <i class="fa fa-warning"></i>
												</span>Database Overloaded Warning!
                                                    <span class="notificationtime">
                                                        <small>1 Week Ago</small>
                                                    </span>
                                                </a>
                                                <a href="javascript:;" class="single-mail"> <span class="icon bg-b-pink box-shadow-1"> <i class="fa fa-user-o"></i>
												</span> <span class="text-purple">Abhay Jani</span> Added you as friend
                                                    <span class="notificationtime">
                                                        <small>Just Now</small>
                                                    </span>
                                                </a>
                                                <a href="javascript:;" class="single-mail"> <span class="icon bg-b-yellow box-shadow-1"> <i class="fa fa-envelope-o"></i>
												</span> <span class="text-purple">John Doe</span> send you a mail
                                                    <span class="notificationtime">
                                                        <small>Just Now</small>
                                                    </span>
                                                </a>
                                                <a href="javascript:;" class="single-mail"> <span class="icon bg-success box-shadow-1"> <i class="fa fa-check-square-o"></i>
												</span> Success Message
                                                    <span class="notificationtime">
                                                        <small> 2 Days Ago</small>
                                                    </span>
                                                </a>
                                                <a href="javascript:;" class="single-mail"> <span class="icon bg-warning box-shadow-1"> <i class="fa fa-warning"></i>
												</span> <strong>Database Overloaded Warning!</strong>
                                                    <span class="notificationtime">
                                                        <small>1 Week Ago</small>
                                                    </span>
                                                </a>
                                                <a href="javascript:;" class="single-mail"> <span class="icon bg-danger box-shadow-1"> <i class="fa fa-times"></i>
												</span> <strong>Server Error!</strong>
                                                    <span class="notificationtime">
                                                        <small>10 Days Ago</small>
                                                    </span>
                                                </a>
                                            </div>
											<div class="full-width text-center p-t-10" >
												<button type="button" class="btn purple btn-outline btn-circle margin-0">View All</button>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="card  card-box">
                                <div class="card-head">
                                    <header>Earning</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
	                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
	                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body no-padding height-9">
                                    <div class="row text-center">
			                            <div class="col-sm-4 col-6">
			                                <h4 class="margin-0">$ 209 </h4>
			                                <p class="text-muted"> Today</p>
			                            </div>
			                            <div class="col-sm-4 col-6">
			                                <h4 class="margin-0">$ 837 </h4>
			                                <p class="text-muted">This Week</p>
			                            </div>
			                            <div class="col-sm-4 col-6">
			                                <h4 class="margin-0">$ 3410 </h4>
			                                <p class="text-muted">This Month</p>
			                            </div>
			                        </div>
			                        <div class="row">
                                        <div id="donut_chart" style="width:100%; height:250px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
							<div class="col-lg-8 col-md-12 col-sm-12 col-12">
                                   <div class="card-box ">
                                <div class="card-head">
                                    <header>Guest Review</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
	                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
	                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body ">
                                  <div class="row">
                                        <ul class="docListWindow small-slimscroll-style">
                                            <li>
                                            	<div class="row">
	                                            	<div class="col-md-8 col-sm-8">
		                                                <div class="prog-avatar">
		                                                    <img src="../../assets/img/user/user1.jpg" alt="" width="40" height="40">
		                                                </div>
		                                                <div class="details">
		                                                    <div class="title">
		                                                        <a href="#">Rajesh Mishra</a> 
		                                                        <p class="rating-text">Awesome!!! Highly recommend</p>
		                                                    </div>
		                                                </div>
	                                                </div>
	                                                <div class="col-md-4 col-sm-4 rating-style">
		                                                <i class="material-icons">star</i>
		                                                <i class="material-icons">star</i>
		                                                <i class="material-icons">star</i>
		                                                <i class="material-icons">star_half</i>
		                                                <i class="material-icons">star_border</i>
	                                                </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
	                                            	<div class="col-md-8 col-sm-8">
		                                                <div class="prog-avatar">
		                                                    <img src="../../assets/img/user/user2.jpg" alt="" width="40" height="40">
		                                                </div>
		                                                <div class="details">
		                                                    <div class="title">
		                                                        <a href="#">Sarah Smith</a> 
		                                                        <p class="rating-text">Very bad service :(</p>
		                                                    </div>
		                                                </div>
	                                                </div>
	                                                <div class="col-md-4 col-sm-4 rating-style">
		                                                <i class="material-icons">star</i>
		                                                <i class="material-icons">star_half</i>
		                                                <i class="material-icons">star_border</i>
		                                                <i class="material-icons">star_border</i>
		                                                <i class="material-icons">star_border</i>
	                                                </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
	                                            	<div class="col-md-8 col-sm-8">
		                                                <div class="prog-avatar">
		                                                    <img src="../../assets/img/user/user3.jpg" alt="" width="40" height="40">
		                                                </div>
		                                                <div class="details">
		                                                    <div class="title">
		                                                        <a href="#">John Simensh</a> 
		                                                        <p class="rating-text"> Staff was good nd i'll come again</p>
		                                                    </div>
		                                                </div>
	                                                </div>
	                                                <div class="col-md-4 col-sm-4 rating-style">
		                                                <i class="material-icons">star</i>
		                                                <i class="material-icons">star</i>
		                                                <i class="material-icons">star</i>
		                                                <i class="material-icons">star</i>
		                                                <i class="material-icons">star</i>
	                                                </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
	                                            	<div class="col-md-8 col-sm-8">
		                                                <div class="prog-avatar">
		                                                    <img src="../../assets/img/user/user4.jpg" alt="" width="40" height="40">
		                                                </div>
		                                                <div class="details">
		                                                    <div class="title">
		                                                        <a href="#">Priya Sarma</a> 
		                                                        <p class="rating-text">The price I received was good value.</p>
		                                                    </div>
		                                                </div>
	                                                </div>
	                                                <div class="col-md-4 col-sm-4 rating-style">
		                                                <i class="material-icons">star</i>
		                                                <i class="material-icons">star</i>
		                                                <i class="material-icons">star</i>
		                                                <i class="material-icons">star</i>
		                                                <i class="material-icons">star_half</i>
	                                                </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
	                                            	<div class="col-md-8 col-sm-8">
		                                                <div class="prog-avatar">
		                                                    <img src="../../assets/img/user/user5.jpg" alt="" width="40" height="40">
		                                                </div>
		                                                <div class="details">
		                                                    <div class="title">
		                                                        <a href="#">Serlin Ponting</a> 
		                                                        <p class="rating-text">Not Satisfy !!!1</p>
		                                                    </div>
		                                                </div>
	                                                </div>
	                                                <div class="col-md-4 col-sm-4 rating-style">
		                                                <i class="material-icons">star</i>
		                                                <i class="material-icons">star_border</i>
		                                                <i class="material-icons">star_border</i>
		                                                <i class="material-icons">star_border</i>
		                                                <i class="material-icons">star_border</i>
	                                                </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
	                                            	<div class="col-md-8 col-sm-8">
		                                                <div class="prog-avatar">
		                                                    <img src="../../assets/img/user/user6.jpg" alt="" width="40" height="40">
		                                                </div>
		                                                <div class="details">
		                                                    <div class="title">
		                                                        <a href="#">Priyank Jain</a> 
		                                                        <p class="rating-text">Good....</p>
		                                                    </div>
		                                                </div>
	                                                </div>
	                                                <div class="col-md-4 col-sm-4 rating-style">
		                                                <i class="material-icons">star</i>
		                                                <i class="material-icons">star</i>
		                                                <i class="material-icons">star</i>
		                                                <i class="material-icons">star_half</i>
		                                                <i class="material-icons">star_border</i>
	                                                </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="full-width text-center p-t-10" >
												<a href="#" class="btn purple btn-outline btn-circle margin-0">View All</a>
											</div>
                                    </div>	
                                </div>
                            </div>
							</div>
							<div class="col-lg-4 col-md-12 col-sm-12 col-12">
                             <div class="card-box">
                                 <div class="card-head">
                                     <header>Todo List</header>
                                     <button id = "panel-button1" 
				                           class = "mdl-button mdl-js-button mdl-button--icon pull-right" 
				                           data-upgraded = ",MaterialButton">
				                           <i class = "material-icons">more_vert</i>
				                        </button>
				                        <ul class = "mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
				                           data-mdl-for = "panel-button1">
				                           <li class = "mdl-menu__item"><i class="material-icons">assistant_photo</i>Action</li>
				                           <li class = "mdl-menu__item"><i class="material-icons">print</i>Another action</li>
				                           <li class = "mdl-menu__item"><i class="material-icons">favorite</i>Something else here</li>
				                        </ul>
                                 </div>
                                 <div class="card-body ">
                                 	<ul class="to-do-list ui-sortable" id="sortable-todo">
                                            <li class="clearfix">
                                                <div class="todo-check pull-left">
                                                    <input type="checkbox" value="None" id="todo-check1">
                                                    <label for="todo-check1"></label>
                                                </div>
                                                <p class="todo-title">Add fees details in system
                                                </p>
                                                <div class="todo-actionlist pull-right clearfix">
                                                    <a href="#" class="todo-remove"><i class="fa fa-times"></i></a>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <div class="todo-check pull-left">
                                                    <input type="checkbox" value="None" id="todo-check2">
                                                    <label for="todo-check2"></label>
                                                </div>
                                                <p class="todo-title">Announcement for holiday
                                                </p>
                                                <div class="todo-actionlist pull-right clearfix">
                                                    <a href="#" class="todo-remove"><i class="fa fa-times"></i></a>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <div class="todo-check pull-left">
                                                    <input type="checkbox" value="None" id="todo-check3">
                                                    <label for="todo-check3"></label>
                                                </div>
                                                <p class="todo-title">call bus driver</p>
                                                <div class="todo-actionlist pull-right clearfix">
                                                    <a href="#" class="todo-remove"><i class="fa fa-times"></i></a>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <div class="todo-check pull-left">
                                                    <input type="checkbox" value="None" id="todo-check4">
                                                    <label for="todo-check4"></label>
                                                </div>
                                                <p class="todo-title">School picnic</p>
                                                <div class="todo-actionlist pull-right clearfix">
                                                    <a href="#" class="todo-remove"><i class="fa fa-times"></i></a>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <div class="todo-check pull-left">
                                                    <input type="checkbox" value="None" id="todo-check5">
                                                    <label for="todo-check5"></label>
                                                </div>
                                                <p class="todo-title">Exam time table generate
                                                </p>
                                                <div class="todo-actionlist pull-right clearfix">
                                                    <a href="#" class="todo-remove"><i class="fa fa-times"></i></a>
                                                </div>
                                            </li>
                                        </ul>
                                 </div>
                             </div>
                         </div>
					</div>
					<div class="row">
	                    <div class="col-md-12">
                            <div class="card-box">
                                <div class="card-head">
                                <header>Upcomming Trips</header>
                                    <button id = "panel-button2" 
			                           class = "mdl-button mdl-js-button mdl-button--icon pull-right" 
			                           data-upgraded = ",MaterialButton">
			                           <i class = "material-icons">more_vert</i>
			                        </button>
			                        <ul class = "mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
			                           data-mdl-for = "panel-button2">
			                           <li class = "mdl-menu__item"><i class="material-icons">assistant_photo</i>Action</li>
			                           <li class = "mdl-menu__item"><i class="material-icons">print</i>Another action</li>
			                           <li class = "mdl-menu__item"><i class="material-icons">favorite</i>Something else here</li>
			                        </ul>
                                </div>
                                <div class="card-body ">
                                  <div class="table-scrollable">
                                    <table class="table table-hover table-checkable order-column full-width">
                                        <thead>
                                            <tr>
                                            	<th>#</th>
								                <th>Trip Id</th>
								                <th>Passenger Name</th>
								                <th>Trip From</th>
								                <th>Trip To</th>
								                <th>Start Time</th>
								                <th>View Route</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<tr>
												<td>1</td>
												<td>ID234</td>
												<td>Kevin Wilson</td>
												<td>34, Alax street</td>
												<td>99 Myrtle Dr.Long Branch</td>
												<td>12:34</td>
												<td>
													<a href="route_map.html" class="btn btn-tbl-delete btn-xs">
														<i class="fa fa-map-marker"></i>
													</a>
												</td>
											</tr>
											<tr>
												<td>2</td>
												<td>ID244</td>
												<td>Daniel Davis</td>
												<td>823 Lincoln Ave.Huntsville</td>
												<td>3 Cedar Swamp Rd. Crown Point</td>
												<td>12:34</td>
												<td>
													<a href="route_map.html" class="btn btn-tbl-delete btn-xs">
														<i class="fa fa-map-marker"></i>
													</a>
												</td>
											</tr>
											<tr>
												<td>3</td>
												<td>ID254</td>
												<td>Jason Smith</td>
												<td>7578 Vale Ave. Canfield</td>
												<td>619 S. Wayne Ave. Fairport</td>
												<td>12:34</td>
												<td>
													<a href="route_map.html" class="btn btn-tbl-delete btn-xs">
														<i class="fa fa-map-marker"></i>
													</a>
												</td>
											</tr>
											<tr>
												<td>4</td>
												<td>ID264</td>
												<td>William Miller</td>
												<td>568 Canal Street Toledo</td>
												<td>892 Myers Ave. Des Moines</td>
												<td>12:34</td>
												<td>
													<a href="route_map.html" class="btn btn-tbl-delete btn-xs">
														<i class="fa fa-map-marker"></i>
													</a>
												</td>
											</tr>
											<tr>
												<td>5</td>
												<td>ID274</td>
												<td>Ronald Thomas</td>
												<td>114 East Edgewood St. Lake Charles</td>
												<td>7 Glen Ridge Street Fairmont</td>
												<td>12:34</td>
												<td>
													<a href="route_map.html" class="btn btn-tbl-delete btn-xs">
														<i class="fa fa-map-marker"></i>
													</a>
												</td>
											</tr>
											<tr>
												<td>6</td>
												<td>ID284</td>
												<td>Mary White</td>
												<td>624 Monroe St. Irmo</td>
												<td>8373 S. Santa Clara Drive Mc Lean</td>
												<td>12:34</td>
												<td>
													<a href="route_map.html" class="btn btn-tbl-delete btn-xs">
														<i class="fa fa-map-marker"></i>
													</a>
												</td>
											</tr>
											<tr>
												<td>7</td>
												<td>ID294</td>
												<td>Nancy Clark</td>
												<td>37 La Sierra St. Mount Holly</td>
												<td>425 Sage Street Leesburg</td>
												<td>12:34</td>
												<td>
													<a href="route_map.html" class="btn btn-tbl-delete btn-xs">
														<i class="fa fa-map-marker"></i>
													</a>
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