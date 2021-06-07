@extends('layouts.driver')

@section('main') 
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">New Mail</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="">Email</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Compose</li>
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
		                                            <div class="btn-group">
		                                                <button class="btn btn-primary btn-sm margin-right-10"><i class="fa fa-check"></i> Send</button>
		                                                <button class="btn btn-sm btn-default margin-right-10"><i class="fa fa-times"></i> Discard</button>
		                                            </div>
		                                            <div class="btn-group">
		                                                <button class="btn btn-sm btn-default margin-right-10">Draft</button>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="inbox-body no-pad">
		                                        <div class="mail-list">
		                                            <div class="compose-mail">
		                                                <form method="post">
		                                                    <div class="form-group">
		                                                        <label for="to" class="">To:</label>
		                                                        <input type="text" tabindex="1" id="to" class="form-control">
		                                                        <div class="compose-options">
		                                                            <a onclick="$(this).hide(); $('#cc').parent().removeClass('hidden'); $('#cc').focus();" href="javascript:;">Cc</a>
		                                                            <a onclick="$(this).hide(); $('#bcc').parent().removeClass('hidden'); $('#bcc').focus();" href="javascript:;">Bcc</a>
		                                                        </div>
		                                                    </div>
		                                                    <div class="form-group hidden">
		                                                        <label for="cc" class="">Cc:</label>
		                                                        <input type="text" tabindex="2" id="cc" class="form-control">
		                                                    </div>
		                                                    <div class="form-group hidden">
		                                                        <label for="bcc" class="">Bcc:</label>
		                                                        <input type="text" tabindex="2" id="bcc" class="form-control">
		                                                    </div>
		                                                    <div class="form-group">
		                                                        <label for="subject" class="">Subject:</label>
		                                                        <input type="text" tabindex="1" id="subject" class="form-control">
		                                                    </div>
		                                                    <div class="compose-editor">
		                                                        <div id="summernote"></div>
		                                                        <input type="file" class="default" multiple>
		                                                    </div>
		                                                    <div class="btn-group margin-top-20 ">
				                                                <button class="btn btn-primary btn-sm margin-right-10"><i class="fa fa-check"></i> Send</button>
				                                                <button class="btn btn-sm btn-default margin-right-10"><i class="fa fa-times"></i> Discard</button>
				                                            </div>
				                                            <div class="btn-group margin-top-20 ">
				                                                <button class="btn btn-sm btn-default margin-right-10">Draft</button>
				                                            </div>
		                                                </form>
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
                </div>
            </div>
            <!-- end page content -->
			@endsection