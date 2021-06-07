<?

/**************************Driver Data*********************************/

if ($_SESSION['sess_user'] == 'driver') {
    $sql     = "select * from register_driver where iDriverId = '" . $_SESSION['sess_iUserId'] . "'";
    $db_user = $obj->MySQLSelect($sql);
    
    $sqldoc = "SELECT dm.doc_masterid masterid, dm.doc_usertype ,dm.doc_name_" . $_SESSION['sess_lang'] . "  
    as d_name , dm.doc_name ,dm.ex_status,dm.status, dl.doc_masterid masterid_list ,dl.ex_date,dl.doc_file , dl.status, 
    dm.eType FROM document_master dm left join (SELECT * FROM `document_list` where doc_userid='" . $_SESSION['sess_iUserId'] . "' ) 
    dl on dl.doc_masterid=dm.doc_masterid where dm.doc_usertype='driver' and dm.status='Active' and 
    (dm.country ='" . $db_user[0]['vCountry'] . "' OR dm.country ='All')";
    
    $db_userdoc    = $obj->MySQLSelect($sqldoc);
    $count_all_doc = count($db_userdoc);
}

?>
	<!-- start sidebar menu -->
	<div class="sidebar-container">
		<div class="sidemenu-container navbar-collapse collapse fixed-menu">
            <div id="remove-scroll">
                <ul class="sidemenu page-header-fixed p-t-20" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                    <li class="sidebar-toggler-wrapper hide">
                        <div class="sidebar-toggler">
                            <span></span>
                        </div>
                    </li>
                    <li class="sidebar-user-panel">
                        <div class="user-panel">
                            <div class="pull-left image"> 
                            <?php $img_path = $tconfig["tsite_upload_images_driver"];?>
                                <img src ="<?=$img_path . '/' . $_SESSION['sess_iUserId'] . '/2_' . $db_user[0]['vImage']?>" class="img-circle user-img-circle" alt="User Image" /> 
                            </div>
                            <div class="pull-left info">
                                <p> <?if ($_SESSION['sess_user'] == 'driver') {echo $generalobj->cleanall(htmlspecialchars($db_user[0]['vName'] ));}?></p>
                                <small><?if ($_SESSION['sess_user'] == 'driver') {echo $generalobj->cleanall(htmlspecialchars($db_user[0]['vLastName']));}?></small>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item start">
                        <!--<a href="dashboard.php" class="nav-link nav-toggle">-->
                        <a href="../driver-profile.php" class="nav-link nav-toggle">
                            <i class="material-icons">dashboard</i>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <!--<a href="profile.php" class="nav-link nav-toggle">-->
                        <a href="../driver-profile.php" class="nav-link nav-toggle">
                            <i class="material-icons">vpn_key</i>
                            <span class="title">My Profile</span>
                        </a>   
                    </li>
                    <li class="nav-item">
                        <a href="../vehicle" class="nav-link nav-toggle">
                            <i class="material-icons">vpn_key</i>
                            <span class="title">My Vehicle</span>
                        </a>
                    </li>
                    <!--<li class="nav-item">
                        <a href="../payment-request" class="nav-link nav-toggle">
                            <i class="material-icons">vpn_key</i>
                            <span class="title">My Earning</span>
                        </a>
                    </li>-->
                    <li class="nav-item">
                        <a href="driver_wallet" class="nav-link nav-toggle">
                            <i class="material-icons">vpn_key</i>
                            <span class="title">My Wallet</span>
                        </a>
                    </li>
                   <!-- <li class="nav-item">
                        <a href="#" class="nav-link nav-toggle">
                            <i class="material-icons">email</i>
                            <span class="title">Email</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item">
                                <a href="email_inbox.html" class="nav-link ">
                                    <span class="title">Inbox</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="email_view.html" class="nav-link ">
                                    <span class="title">View Mail</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="email_compose.html" class="nav-link ">
                                    <span class="title">Compose Mail</span>
                                </a>
                            </li>
                        </ul>
                    </li> 
                    <li class="nav-item">
                        <a href="calendar.html" class="nav-link nav-toggle">
                            <i class="material-icons">business_center</i>
                            <span class="title">Calendar</span> 
                        </a>
                    </li> -->
                    <li class="nav-item active">
                        <a href="trips" class="nav-link nav-toggle">
                            <i class="material-icons">vpn_key</i>
                            <span class="title">Trip History</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a href="chat.php" class="nav-link nav-toggle">
                            <i class="material-icons">vpn_key</i>
                            <span class="title">Chat with Admin</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link nav-toggle">
                            <i class="material-icons">business_center</i>
                            <span class="title">Upcomming Trips</span>
                        </a>
                    </li>
                    <!--<li class="nav-item">
	                    <a href="" class="nav-link nav-toggle">
	                        <i class="material-icons">vpn_key</i>
	                        <span class="title">Tax &amp; Insurance</span>    
	                    </a>
	                </li>-->
	                <li class="nav-item">
	                    <a href="../logout.php" class="nav-link nav-toggle">
	                        <i class="material-icons">business_center</i>
	                        <span class="title">Log Out</span>
	                    </a>
	                </li>
	            </ul>
	        </div>
        </div>
    </div>
			<!-- end sidebar menu -->