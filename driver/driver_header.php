<?
include_once('../common.php');
include_once('../generalFunctions.php');


/************************Notifacation For Driver**********************************/

 //$sql19 = "SELECT * FROM newsfeed WHERE eStatus='Active' ORDER BY tPublishdate ASC";
// $db_noti  = $obj->MySQLSelect($sql19);

 //$sql20 = "SELECT count(iNewsfeedId) as noticount FROM newsfeed WHERE eStatus='Active'";
// $db_noti_count  = $obj->MySQLSelect($sql20);
// $noticount = $db_noti_count[0]['noticount'];
/*	
vTitle                 
tDescription 
tPublishdate
eUserType 
eStatus 
eStatus 
*/

 $sql19 = "SELECT * FROM pushnotification_log WHERE eUserType ='driver' and iUserId = '" . $_SESSION['sess_iUserId'] . "' ORDER BY dDateTime ASC";
 $db_noti  = $obj->MySQLSelect($sql19);

 $sql20 = "SELECT count(iPushnotificationId) as noticount FROM pushnotification_log WHERE eUserType ='driver' and iUserId = '" . $_SESSION['sess_iUserId'] . "'";
 $db_noti_count  = $obj->MySQLSelect($sql20);
 $noticount = $db_noti_count[0]['noticount'];


/************************Chat For Driver**********************************/

$sql21 = "SELECT * FROM chat WHERE iDriverId = '" . $_SESSION['sess_iUserId'] . "' and eStatus = 'Active' ORDER BY iDate ASC";
 $db_chat  = $obj->MySQLSelect($sql21);

 $sql22 = "SELECT count(iPushnotificationId) as noticount FROM pushnotification_log WHERE eUserType ='driver' and iUserId = '" . $_SESSION['sess_iUserId'] . "'";
 $db_noti_count  = $obj->MySQLSelect($sql20);
 $noticount = $db_noti_count[0]['noticount'];
?>   

<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
<link href="../assets1/fonts/material-design-icons/material-icon.css" rel="stylesheet" type="text/css" />
<link href="../assets1/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets1/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../assets1/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets1/links/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../assets1/plugins/material/material.min.css">
<link rel="stylesheet" href="../assets1/css/material_style.css">
<link href="../assets1/css/pages/animate_page.css" rel="stylesheet">
<link href="../assets1/css/style.css" rel="stylesheet" type="text/css"/>
<link href="../assets1/css/plugins.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets1/css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="../assets1/css/theme-color.css" rel="stylesheet" type="text/css"/>
<!-- favicon -->
<link rel="shortcut icon" href="../assets1/img/favicon.ico"/>
<link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<!-- favicon -->
<link rel="shortcut icon" href="../assets1/img/favicon.ico"/>
<link href="../assets1/plugins/summernote/summernote.css" rel="stylesheet">
<!-- morris chart -->
<link href="../assets1/plugins/morris/morris.css" rel="stylesheet" type="text/css" />


	<div class="page-header navbar navbar-fixed-top">
        <div class="page-header-inner ">
            <!-- logo start -->
            <div class="page-logo">
                <a href="index.html">
                <img alt="" src="assets1/img/logo.png">
                <span class="logo-default" ></span> </a>
            </div>
            <!-- logo end -->
			<ul class="nav navbar-nav navbar-left in">
				<li><a href="#" class="menu-toggler sidebar-toggler font-size-23"><i class="fa fa-bars"></i></a></li>
			</ul>
            <ul class="nav navbar-nav navbar-left in">
            	<!-- start full screen button -->
                <li><a href="javascript:;" class="fullscreen-click font-size-20"><i class="fa fa-arrows-alt"></i></a></li>
                <!-- end full screen button -->
            </ul>
            <form class="search-form-opened" action="#" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search..." name="query">
                    <span class="input-group-btn search-btn">
                        <a href="javascript:;" class="btn submit">
                            <i class="fa fa-search"></i>
                        </a>
                    </span>
                </div>
            </form>
            <!-- start mobile menu -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                <span></span>
            </a>
            <!-- end mobile menu -->
            <!-- start header menu -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- start notification dropdown -->
                    <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="fa fa-bell-o"></i>
                            <span class="notify"></span>
                            <span class="heartbeat"></span>
                        </a>
                        <ul class="dropdown-menu pullDown">
                            <li class="external">
                                <h3><span class="bold">Notifications</span></h3>
                                <span class="notification-label purple-bgcolor"><?=$noticount?></span>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
                                    <li>
                                        <a href="javascript:;">
                                            <span class="details">
                                                <?php for ($i = 0; $i < count($db_noti); $i++) { ?>                  
                                                <span class="notification-icon circle deepPink-bgcolor box-shadow-1"><i class="fa fa-bell"></i></span><?= $db_noti[$i]['dDateTime'] ?><br><?= $db_noti[$i]['tMessage']?><br>
                                            </span>
                                            <? } ?>
                                        </a>
                                    </li>
                                </ul>
                                <div class="dropdown-menu-footer">
                                    <a href="javascript:void(0)"> All notifications </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- end notification dropdown -->
                    <!-- start message dropdown -->
 					<li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="fa fa-envelope-o"></i>
                            <span class="notify"></span>
                            <span class="heartbeat"></span>
                        </a>
                        <ul class="dropdown-menu animated pullDown">
                            <li class="external">
                                <h3><span class="bold">Messages</span></h3>
                                <span class="notification-label cyan-bgcolor">New 2</span>  
                            </li>
                            <li>
                                <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
                                    <?php for ($i = 0; $i < count($db_chat); $i++) { ?> 
                                    <li>
                                        <a href="#">
                                            <span class="photo">
                                            	<img src="assets1/assets/img/user/user2.jpg" class="img-circle" alt="">
                                            </span>
                                            <span class="subject">
                                            	<span class="from"><?= $db_chat[$i]['iSender']?></span>
                                            	<span class="time"><?= $db_chat[$i]['iTime']?> <?= $db_chat[$i]['iDate']?></span>
                                            </span>
                                            <span class="message"><?= $db_chat[$i]['Imessage']?></span>
                                        </a>
                                    </li>
                                     <? } ?>
                                </ul>
                                <div class="dropdown-menu-footer">
                                    <a href="#"> All Messages </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- end message dropdown -->
 					<!-- start manage user dropdown -->
 					<li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle " src="assets/img/gear.png" />
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default animated jello">
                            <li>
                                <a href="driver-index.php">
                                <i class="fa fa-user-o"></i> Profile </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-cogs"></i> Settings
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-question-circle"></i> Help
                                </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="lock_screen.html">
                                    <i class="fa fa-lock"></i> Lock
                                </a>
                            </li>
                            <li>
                                <a href="logout.php">
                                    <i class="fa fa-sign-out"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                    <!-- end manage user dropdown -->
                    <li class="dropdown dropdown-quick-sidebar-toggler">
                        <a id="headerSettingButton" class="mdl-button mdl-js-button mdl-button--icon pull-right" data-upgraded=",MaterialButton">
	                        <i class="material-icons">more_vert</i>
	                    </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    
    
    
    <!-- start chat sidebar -->
    <div class="chat-sidebar-container" data-close-on-body-click="false">
        <div class="chat-sidebar">
            <ul class="nav nav-tabs">
            	<li class="nav-item">
                    <a href="#quick_sidebar_tab_1" class="nav-link active tab-icon"  data-toggle="tab">Theme</a>
                </li>
                <li class="nav-item">
                    <a href="#quick_sidebar_tab_2" class="nav-link tab-icon"  data-toggle="tab">Settings
                    </a>
                </li>
            </ul>
            <div class="tab-content">
            	<div class="tab-pane chat-sidebar-settings in show active animated shake" role="tabpanel" id="quick_sidebar_tab_1">
					<div class="slimscroll-style">
						<div class="theme-light-dark">
							<h6>Sidebar Theme</h6>
							<button type="button" data-theme="white" class="btn lightColor btn-outline btn-circle m-b-10 theme-button">Light Sidebar</button>
							<button type="button" data-theme="dark" class="btn dark btn-outline btn-circle m-b-10 theme-button">Dark Sidebar</button>
						</div>
						<div class="theme-light-dark">
							<h6>Sidebar Color</h6>
							<ul class="list-unstyled">
								<li class="complete">
									<div class="theme-color sidebar-theme">
										<a href="#" data-theme="white"><span class="head"></span><span class="cont"></span></a>
										<a href="#" data-theme="dark"><span class="head"></span><span class="cont"></span></a>
										<a href="#" data-theme="blue"><span class="head"></span><span class="cont"></span></a>
										<a href="#" data-theme="indigo"><span class="head"></span><span class="cont"></span></a>
										<a href="#" data-theme="cyan"><span class="head"></span><span class="cont"></span></a>
										<a href="#" data-theme="green"><span class="head"></span><span class="cont"></span></a>
										<a href="#" data-theme="red"><span class="head"></span><span class="cont"></span></a>
									</div>
								</li>
							</ul>
							<h6>Header Brand color</h6>
							<ul class="list-unstyled">
								<li class="theme-option">
									<div class="theme-color logo-theme">
						             	<a href="#" data-theme="logo-white"><span class="head"></span><span class="cont"></span></a>
										<a href="#" data-theme="logo-dark"><span class="head"></span><span class="cont"></span></a>
										<a href="#" data-theme="logo-blue"><span class="head"></span><span class="cont"></span></a>
										<a href="#" data-theme="logo-indigo"><span class="head"></span><span class="cont"></span></a>
										<a href="#" data-theme="logo-cyan"><span class="head"></span><span class="cont"></span></a>
										<a href="#" data-theme="logo-green"><span class="head"></span><span class="cont"></span></a>
										<a href="#" data-theme="logo-red"><span class="head"></span><span class="cont"></span></a>
						           	</div>
						        </li>
							</ul>
							<h6>Header color</h6>
							<ul class="list-unstyled">
								<li class="theme-option">
									<div class="theme-color header-theme">
						             	<a href="#" data-theme="header-white"><span class="head"></span><span class="cont"></span></a>
						             	<a href="#" data-theme="header-dark"><span class="head"></span><span class="cont"></span></a>
						             	<a href="#" data-theme="header-blue"><span class="head"></span><span class="cont"></span></a>
						             	<a href="#" data-theme="header-indigo"><span class="head"></span><span class="cont"></span></a>
						             	<a href="#" data-theme="header-cyan"><span class="head"></span><span class="cont"></span></a>
						             	<a href="#" data-theme="header-green"><span class="head"></span><span class="cont"></span></a>
						             	<a href="#" data-theme="header-red"><span class="head"></span><span class="cont"></span></a>
						          	</div>
						        </li>
							</ul>
						</div>
					</div>
				</div>
                <!-- Start Setting Panel --> 
 				<div class="tab-pane chat-sidebar-settings animated slideInUp" id="quick_sidebar_tab_2">
                    <div class="chat-sidebar-settings-list slimscroll-style">
                        <div class="chat-header"><h5 class="list-heading">Layout Settings</h5></div>
	                    <div class="chatpane inner-content ">
							<div class="settings-list">
			                    <div class="setting-item">
			                        <div class="setting-text">Sidebar Position</div>
			                        <div class="setting-set">
			                           <select class="sidebar-pos-option form-control input-inline input-sm input-small ">
                                           <option value="left" selected="selected">Left</option>
	                                        <option value="right">Right</option>
                                    	</select>
			                        </div>
			                    </div>
			                    <div class="setting-item">
			                        <div class="setting-text">Header</div>
			                        <div class="setting-set">
			                           <select class="page-header-option form-control input-inline input-sm input-small ">
	                                              <option value="fixed" selected="selected">Fixed</option>
	                                              <option value="default">Default</option>
                                    	</select>
			                        </div>
			                    </div>
			                    <div class="setting-item">
			                        <div class="setting-text">Sidebar Menu</div>
			                        <div class="setting-set">
			                           <select class="sidebar-menu-option form-control input-inline input-sm input-small ">
	                                              <option value="accordion" selected="selected">Accordion</option>
	                                              <option value="hover">Hover</option>
                                    	</select>
			                        </div>
			                    </div>
			                    <div class="setting-item">
			                        <div class="setting-text">Footer</div>
			                        <div class="setting-set">
			                           <select class="page-footer-option form-control input-inline input-sm input-small ">
	                                              <option value="fixed">Fixed</option>
	                                              <option value="default" selected="selected">Default</option>
                                    	</select>
			                        </div>
			                    </div>
			                </div>
							<div class="chat-header"><h5 class="list-heading">Account Settings</h5></div>
							<div class="settings-list">
			                    <div class="setting-item">
			                        <div class="setting-text">Notifications</div>
			                        <div class="setting-set">
			                            <div class="switch">
			                                <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect" 
							                  for = "switch-1">
							                  <input type = "checkbox" id = "switch-1" 
							                     class = "mdl-switch__input" checked>
							               	</label>
			                            </div>
			                        </div>
			                    </div>
			                    <div class="setting-item">
			                        <div class="setting-text">Show Online</div>
			                        <div class="setting-set">
			                            <div class="switch">
			                                <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect" 
							                  for = "switch-7">
							                  <input type = "checkbox" id = "switch-7" 
							                     class = "mdl-switch__input" checked>
							               	</label>
			                            </div>
			                        </div>
			                    </div>
			                    <div class="setting-item">
			                        <div class="setting-text">Status</div>
			                        <div class="setting-set">
			                            <div class="switch">
			                                <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect" 
							                  for = "switch-2">
							                  <input type = "checkbox" id = "switch-2" 
							                     class = "mdl-switch__input" checked>
							               	</label>
			                            </div>
			                        </div>
			                    </div>
			                    <div class="setting-item">
			                        <div class="setting-text">2 Steps Verification</div>
			                        <div class="setting-set">
			                            <div class="switch">
			                                <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect" 
							                  for = "switch-3">
							                  <input type = "checkbox" id = "switch-3" 
							                     class = "mdl-switch__input" checked>
							               	</label>
			                            </div>
			                        </div>
			                    </div>
			                </div>
                            <div class="chat-header"><h5 class="list-heading">General Settings</h5></div>
                            <div class="settings-list">
			                    <div class="setting-item">
			                        <div class="setting-text">Location</div>
			                        <div class="setting-set">
			                            <div class="switch">
			                                <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect" 
							                  for = "switch-4">
							                  <input type = "checkbox" id = "switch-4" 
							                     class = "mdl-switch__input" checked>
							               	</label>
			                            </div>
			                        </div>
			                    </div>
			                    <div class="setting-item">
			                        <div class="setting-text">Save Histry</div>
			                        <div class="setting-set">
			                            <div class="switch">
			                                <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect" 
							                  for = "switch-5">
							                  <input type = "checkbox" id = "switch-5" 
							                     class = "mdl-switch__input" checked>
							               	</label>
			                            </div>
			                        </div>
			                    </div>
			                    <div class="setting-item">
			                        <div class="setting-text">Auto Updates</div>
			                        <div class="setting-set">
			                            <div class="switch">
			                                <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect" 
							                  for = "switch-6">
							                  <input type = "checkbox" id = "switch-6" 
							                     class = "mdl-switch__input" checked>
							               	</label>
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
      