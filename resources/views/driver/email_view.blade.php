@extends('layouts.driver')

@section('main') 
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">View Mail</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="">Email</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">View</li>
                            </ol>
                        </div>
                    </div>
                    <div class="inbox">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-topline-gray">
                                <div class="card-body no-padding height-9">
									<div class="row">
			                            <div class="col-md-3">
			                                <div class="inbox-sidebar">
			                                    <a href="email_compose.html" data-title="Compose" class="btn red compose-btn btn-block m-0">
			                                        <i class="fa fa-edit"></i> Compose </a>
			                                    <ul class="inbox-nav inbox-divider">
			                                        <li class="active"><a href="#"><i
															class="fa fa-inbox"></i> Inbox <span
															class="label mail-counter-style label-danger pull-right">2</span></a>
			                                        </li>
			                                        <li><a href="#"><i
															class="fa fa-envelope"></i> Sent Mail</a>
			                                        </li>
			                                        <li><a href="#"><i
															class="fa fa-briefcase"></i> Important</a>
			                                        </li>
			                                        <li><a href="#"><i
															class="fa fa-star"></i> Starred </a>
			                                        </li>
			                                        <li><a href="#"><i
															class=" fa fa-external-link"></i> Drafts <span
															class="label mail-counter-style label-info pull-right">30</span></a>
			                                        </li>
			                                        <li><a href="#"><i
															class=" fa fa-trash-o"></i> Trash</a>
			                                        </li>
			                                    </ul>
			                                    <ul class="nav nav-pills nav-stacked labels-info inbox-divider">
			                                        <li>
			                                            <h4>Labels</h4>
			                                        </li>
			                                        <li><a href="#"><i
															class="fa fa-tags text-info"></i>  Work</a>
			                                        </li>
			                                        <li>
			                                            <a href="#">
			                                                <i class=" fa fa-tags text-warning"></i> Design
			                                            </a>
			                                        </li>
			                                        <li>
			                                            <a href="#">
			                                                <i class=" fa fa-tags text-danger text-success"></i> Family
			                                            </a>
			                                        </li>
			                                        <li>
			                                            <a href="#">
			                                                <i class=" fa fa-tags text-purple"></i> Friends
			                                            </a>
			                                        </li>
			                                        <li>
			                                            <a href="#">
			                                                <i class=" fa fa-tags "></i> Office
			                                            </a>
			                                        </li>
			                                    </ul>
			                                    <ul class="nav nav-pills nav-stacked labels-info inbox-divider ">
			                                        <li>
			                                            <h4>Buddy online</h4>
			                                        </li>
			                                        <li>
			                                            <a href="#">
			                                                <i class=" fa fa-comments text-success"></i> Jhone Doe
			                                               <span class="online-status">I do not think</span>
			                                            </a>
			                                        </li>
			                                        <li>
			                                            <a href="#">
			                                                <i class=" fa fa-comments text-danger"></i> Sumon
			                                                <span class="online-status">Busy with coding</span>
			                                            </a>
			                                        </li>
			                                        <li>
			                                            <a href="#">
			                                                <i class=" fa fa-comments text-purple "></i> Anjelina Joli
			                                                <span class="online-status">I out of control</span>
			                                            </a>
			                                        </li>
			                                        <li>
			                                            <a href="#">
			                                                <i class=" fa fa-comments text-success "></i> Jonathan Smith
			                                                <span class="online-status">I am not here</span>
			                                            </a>
			                                        </li>
			                                        <li>
			                                            <a href="#">
			                                                <i class=" fa fa-comments text-info "></i> Tawseef
			                                                <span class="online-status">I do not think</span>
			                                            </a>
			                                        </li>
			                                    </ul>
			                                </div>
			                            </div>
			                            <div class="col-md-9">
			                                <div class="inbox-body">
			                                    <div class="inbox-header">
			                                        <div class="mail-option">
														<div class="btn-group group-padding">
			                                             <button class="mdl-button mdl-js-button mdl-button--icon margin-right-10 tooltips" data-placement="top" data-original-title="Back">
														  	<i class="material-icons">arrow_back</i>
														 </button>
														 <button class="mdl-button mdl-js-button mdl-button--icon margin-right-10 tooltips" data-placement="top" data-original-title="Archive">
														  	<i class="material-icons">archive</i>
														 </button>
														 <button class="mdl-button mdl-js-button mdl-button--icon margin-right-10 tooltips" data-placement="top" data-original-title="Spam">
														  	<i class="material-icons">report</i>
														 </button>
														  <button class="mdl-button mdl-js-button mdl-button--icon margin-right-10 tooltips" data-placement="top" data-original-title="Delete">
														  	<i class="material-icons">delete</i>
														 </button>
			                                            </div>
			                                        </div>
			                                    </div>
			                                    <div class="inbox-body no-pad">
			                                        <section class="mail-list">
			                                            <div class="mail-sender">
			                                            	<div class="mail-heading">
			                                                	<h4 class="vew-mail-header"><b>Hi Dear, How are you?</b></h4>
			                                                </div>
			                                                <hr>
															<div class="media">
																<a href="#" class="pull-left"> <img alt=""
																	src="../../assets/img/user/user2.jpg" class="img-circle" width="40">
																</a>
																<div class="media-body">
																	<span class="date pull-right">4:15AM 04 April
																		2014</span>
																	<h4 class="text-primary">Sarah Smith</h4>
																	<small class="text-muted">From:
																		sarah@example.com</small>
																</div>
															</div>
														</div>
			                                            <div class="view-mail">
			                                                <p>Donec ultrices faucibus rutrum. Phasellus sodales vulputate urna, vel accumsan augue egestas ac. Donec vitae leo at sem lobortis porttitor eu consequat risus. Mauris sed congue orci. Donec ultrices faucibus rutrum. Phasellus sodales vulputate urna, vel accumsan augue egestas ac. Donec vitae leo at sem lobortis porttitor eu consequat risus. Mauris sed congue orci. Donec ultrices faucibus rutrum. Phasellus sodales vulputate urna, vel accumsan augue egestas ac. Donec vitae leo at sem lobortis porttitor eu consequat risus. Mauris sed congue orci.</p>
			                                                <p>
			                                                    Porttitor eu consequat risus. <a href="#">Mauris sed
																	congue orci. Donec ultrices faucibus rutrum</a>. Phasellus sodales vulputate urna, vel accumsan augue egestas ac. Donec vitae leo at sem lobortis porttitor eu consequat risus. Mauris sed congue orci. Donec ultrices faucibus rutrum. Phasellus sodales vulputate urna, vel accumsan augue egestas ac. Donec vitae leo at sem lobortis porttitor eu consequat risus. Mauris sed congue orci.
			                                                </p>
			                                                <p>
			                                                    Sodales <a href="#">vulputate urna, vel accumsan augue
																	egestas ac</a>. Donec vitae leo at sem lobortis porttitor eu consequat risus. Mauris sed congue orci. Donec ultrices faucibus rutrum. Phasellus sodales vulputate urna, vel accumsan augue egestas ac. Donec vitae leo at sem lobortis porttitor eu consequat risus. Mauris sed congue orci.
			                                                </p>
			                                            </div>
			                                            <div class="attachment-mail">
			                                                <p>
			                                                    <span><i class="fa fa-paperclip"></i> 2 attachments
																	— </span> <a href="#">Download all attachments</a> | <a href="#">View
																	all images</a>
			                                                </p>
			                                                <ul>
			                                                    <li>
			                                                        <a class="atch-thumb" href="#"> <img src="../../assets/img/user/user10.jpg" alt="image upload" class="doctor-pic">
			                                                        </a> <a class="name" href="#"> IMG_001.jpg <span>20KB</span>
																</a>
			                                                        <div class="links">
			                                                            <a href="#">View</a> - <a href="#">Download</a>
			                                                        </div>
			                                                    </li>
			                                                    <li>
			                                                        <a class="atch-thumb" href="#"> <img src="../../assets/img/user/user5.jpg" alt="image upload" class="doctor-pic">
			                                                        </a> <a class="name" href="#"> IMG_001.jpg <span>20KB</span>
																</a>
			                                                        <div class="links">
			                                                            <a href="#">View</a> - <a href="#">Download</a>
			                                                        </div>
			                                                    </li>
			                                                </ul>
			                                            </div>
			                                            <div class="compose-btn pull-left">
			                                                <a href="email_compose.html" class="btn btn-sm btn-primary"><i
																class="fa fa-reply"></i> Reply</a>
			                                                <button class="btn btn-sm btn-default">
			                                                    <i class="fa fa-arrow-right"></i> Forward
			                                                </button>
			                                                <button class="btn  btn-sm btn-default tooltips" data-original-title="Print" type="button" data-toggle="tooltip" data-placement="top" title="">
			                                                    <i class="fa fa-print"></i>
			                                                </button>
			                                                <button class="btn btn-sm btn-default tooltips" data-original-title="Trash" data-toggle="tooltip" data-placement="top" title="">
			                                                    <i class="fa fa-trash-o"></i>
			                                                </button>
			                                            </div>
			                                        </section>
			                                    </div>
			                                </div>
			                            </div>
			                        </div>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- end page content -->
			@endsection