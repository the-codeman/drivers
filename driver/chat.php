<?
include_once('../common.php');
include_once('../generalFunctions.php');

$generalobj->check_member_login();
$abc = 'driver';
$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$generalobj->setRole($abc, $url);
$action = (isset($_REQUEST['action']) ? $_REQUEST['action'] : '');

if ($_SESSION['sess_user'] == "driver") {
    $sql = "SELECT * FROM register_driver WHERE iDriverId ='" . $_SESSION['sess_iUserId'] . "'";
    $db_data = $obj->MySQLSelect($sql);

} /*else if ($_SESSION['sess_user'] == "rider"){
    $sql = "SELECT * FROM register_user WHERE iUserId ='" . $_SESSION['sess_iUserId'] . "'";
    $db_data = $obj->MySQLSelect($sql);
    
} else if ($_SESSION['sess_user'] == "company"){
    $sql = "SELECT * FROM company WHERE iCompanyId ='" . $_SESSION['sess_iUserId'] . "'";
    $db_data = $obj->MySQLSelect($sql);
}*/

/*************************Driver Data**********************************/

/*if ($_SESSION['sess_user'] == 'driver') {
    $sql     = "select * from register_driver where iDriverId = '" . $_SESSION['sess_iUserId'] . "'";
    $db_user = $obj->MySQLSelect($sql);

}*/

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

 $sql19 = "SELECT * FROM pushnotification_log WHERE eUserType ='driver' and iUserId = '" . $_SESSION['sess_iUserId'] . "' ORDER BY dDateTime DESC";
 $db_noti  = $obj->MySQLSelect($sql19);

 $sql20 = "SELECT count(iPushnotificationId) as noticount FROM pushnotification_log WHERE eUserType ='driver' and iUserId = '" . $_SESSION['sess_iUserId'] . "'";
 $db_noti_count  = $obj->MySQLSelect($sql20);
 $noticount = $db_noti_count[0]['noticount'];
 
 
 
/*************************New Chat**********************************/

$iSubject = $_REQUEST['iSubject'];
$iDriverId = $_REQUEST['iDriverId'];
$iUserId = $_SESSION['sess_iUserId'];

$actions = $_REQUEST['actions'];

$table='chat';
$script = "chat";

$table='chat';
if($_POST) {
	$Data = array();	

	$Data['iSender'] = $_POST['iSender'];
	$Data['iDriverId'] = $_POST['iDriverId']; 
	$Data['Imessage'] = $_POST['Imessage'];    
	$Data['iSubject'] = $_POST['iSubject'];
	$Data['iCompanyId'] = $_POST['iCompanyId']; 
	$Data['iRead'] = $_POST['iRead'];
	
	$id = $obj->MySQLQueryPerform($table,$Data,'insert');  
	
    // $id = $obj->MySQLQueryPerform($table, $Data,'update','iChatId=1' ); 
}

/*if ($_SESSION['sess_user'] == "rider") {
    $sql = "SELECT * FROM chat where iSubject = '" . $iSubject . "' and iUserId = '" . $iUserId . "' order by iDate ASC";
    $db_chat = $obj->MySQLSelect($sql);

    $sql1 = "SELECT * FROM chat where iUserId = '" . $iUserId . "' GROUP by iSubject ORDER BY iDate DESC, iTime DESC";
    $db_chat_all = $obj->MySQLSelect($sql1);
}*/

if ($_SESSION['sess_user'] == "driver" && $iSubject != null) { 
    
    $sql = "SELECT * FROM chat where iSubject = '" . $iSubject . "' and iDriverId = '" . $iUserId . "' order by iDate ASC";
    $db_chat1 = $obj->MySQLSelect($sql);
}

if ($_SESSION['sess_user'] == "driver" ) { 
    
    $sql1 = "SELECT * FROM chat where iDriverId = '" . $iUserId . "' GROUP by iSubject ORDER BY iDate DESC, iTime DESC";
    $db_chat_all = $obj->MySQLSelect($sql1);
}
/*
if ($_SESSION['sess_user'] == "company") { 
    $sql = "SELECT * FROM chat where iSubject = '" . $iSubject . "' and iCompanyId = '" . $iUserId . "' order by iDate ASC";
    $db_chat = $obj->MySQLSelect($sql);

    $sql1 = "SELECT * FROM chat where iCompanyId = '" . $iUserId . "' GROUP by iSubject ORDER BY iDate DESC, iTime DESC";
    $db_chat_all = $obj->MySQLSelect($sql1);
}*/

?>   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Responsive Admin Template" />
    <meta name="author" content="SmartUniversity" />
    <title>Yalla | Chat</title>
</head>
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-white">
    <div class="page-wrapper">
        <? include_once('driver_header.php') ?>
        <div class="page-container">
            <? include_once('sidebar.php') ?>
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Chat</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Chat</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card card-box">
                            
                                <div class="card-head">
                                    <header>Messages List</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
								    	<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
									    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                </div>
                                
                                <div class="card-body no-padding height-9">
                                	<div class="collapse collapse-xs collapse-sm show chat-page" id="open-chats">
				    					<div class="form-group mt-20 is-empty">
					    					<input type="text" value="" placeholder="Search..." class="form-control">
						   					<span class="material-input"></span>
						    			</div>
										<div class="list-unstyled" id="inbox">

											<!--<div class="active">
												<div class="media chat-list">
													<div class="media-left thumb thumb-sm">
														<img alt="" class="media-object chat-img" src="../assets1/img/user/user4.jpg">
													</div>
											    	<div class="media-body">
												    	<p class="media-heading m-b-10">
													     	<span class="text-strong">Sanjay </span>
														    <span class="badge bg-danger">3</span>
														    <small class="pull-right">13:54, 24.01.2017</small>
    													</p>
	    												<small class=" message">Online</small>
		    										</div>
			    								</div>
				    						</div>-->
										    <?php for ($i = 0; $i < count($db_chat_all); $i++) { ?>
											<div class="chat-inactive">
												<!--<div class="media chat-list">-->  
												<a class="media chat-list" onclick="document.getElementById('yes').submit();" href="chat.php?iSubject=<?=$db_chat_all[$i]['iSubject']?>">
													<div class="media-left thumb thumb-sm">
														<img alt="" class="media-object chat-img" src="../assets1/img/user/user3.jpg">
													</div>
													<div class="media-body">
														<p class="media-heading m-b-10">
															<span class="text-strong"><?= $db_chat_all[$i]['iSender']?></span>
															<span class="badge bg-blue">2</span>
															<small class=" pull-right"><?= $db_chat_all[$i]['iTime']?> <?= $db_chat_all[$i]['iDate']?></small>
														</p>
														<span class="contacts-list-msg"><?= $db_chat_all[$i]['iSubject']?></span>
														<!--<small class=" message">Offline</small>-->
													</div>
												</a>
												<!--</div>-->
											</div>
											<? } ?>

										</div>
									</div>
				    			</div>
                            </div>
                        </div>
                       
                        <div class="col-sm-8">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>
                                        <div class="col-sm-16 float-sm-right"><a href="chat.php?actions=new">New Message</a></div>
                                    </header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
						    			<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
							    		<a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body no-padding height-9" style=" overflow-y: auto;">
                                  	<div class="row">
                                  	    <? if ($actions == 'new' && $iSubject == '') { ?>
                                        <div class="box-footer chat-box-submit">
                                            <?php for ($i = 0; $i < count($db_chat1); $i++) { ?>
                                                <? if ($db_chat1[$i]['iSender'] == 'Admin') { ?>
                                            <ul class="chat nice-chat chat-page small-slimscroll-style">
                                                <li class="out"><img src="../assets1/img/user/user4.jpg" class="avatar" alt="">
                                                    <div class="message">
                                                        <span class="arrow"></span>
                                                        <a class="name" href="#"><?= $db_chat1[$i]['iSender']?></a>
                                                        <span class="datetime">at <?= $db_chat1[$i]['iDate']?> <?= $db_chat1[$i]['iTime']?></span>
                                                        <span class="body"><?= $db_chat1[$i]['Imessage']?></span>
                                                    </div>
                                                </li>
                                                <? } else { ?>
                                                <li class="in"><img src="../assets1/img/dp.jpg" class="avatar" alt="">
                                                    <div class="message">
                                                        <span class="arrow"></span>
                                                        <a class="name" href="#"><?= $db_chat1[$i]['iSender']?></a>
                                                        <span class="datetime">at <?= $db_chat1[$i]['iDate']?> <?= $db_chat1[$i]['iTime']?></span> 
                                                        <span class="body"><?= $db_chat1[$i]['Imessage']?></span>
                                                    </div>
                                                </li>
                                            </ul>
                                                <? } ?>
                                            <? } ?>
                                            <form action="" method="post">
                                                <div class="input-group">
                                                    <input type="text" value="" name="Imessage" placeholder="Type Message ..." class="form-control" required>
                                                    <input type="hidden" value="<?= $db_data[0]['vName']?>" name="iSender" >
                                                    <input type="" value="<?= $iSubject ?>" name="iSubject" placeholder="Subject" required>
                                                    <? if ($_SESSION['sess_user'] == "driver") { ?>
                                                    <input type="hidden" value="<?= $iUserId ?>" name="iDriverId" placeholder="Driver id">
                                                    <? } ?>
                                                    
                                                    <!--<? if ($_SESSION['sess_user'] == "rider") { ?>
                                                    <input type="hidden" value="<?= $iUserId ?>" name="iUserId" placeholder="User id">
                                                    <? } ?>
                                                    <? if ($_SESSION['sess_user'] == "company") { ?>
                                                    <input type="hidden" value="<?= $iUserId ?>" name="iCompanyId" placeholder="User id">
                                                    <? } ?>-->
                                                    <span class="input-group-append">
                                                        <button type="submit" class="btn btn-primary">Send</button>
                                                    </span>
                                                </div>
                                            </form>
                                        </div>
                                        <? } ?>
                                  	    
                                  	    <? if ($iSubject != '') { ?>
                                        <div class="box-footer chat-box-submit">
                                            <ul class="chat nice-chat chat-page small-slimscroll-style">
                                            <?php for ($i = 0; $i < count($db_chat1); $i++) { ?>
                                                <? if ($db_chat1[$i]['iSender'] == 'Admin') { ?>
                                            <li class="out"><img src="../assets1/img/user/user4.jpg" class="avatar" alt="">
                                                <div class="message">
                                                    <span class="arrow"></span>
                                                    <a class="name" href="#"><?= $db_chat1[$i]['iSender']?></a>
                                                    <span class="datetime">at <?= $db_chat1[$i]['iDate']?> <?= $db_chat1[$i]['iTime']?></span>
                                                    <span class="body"><?= $db_chat1[$i]['Imessage']?></span>
                                                </div>
                                            </li>
                                                <? } else { ?>
                                            <li class="in"><img src="../assets1/img/dp.jpg" class="avatar" alt="">
                                                <div class="message">
                                                    <span class="arrow"></span>
                                                    <a class="name" href="#"><?= $db_chat1[$i]['iSender']?></a>
                                                    <span class="datetime">at <?= $db_chat1[$i]['iDate']?> <?= $db_chat1[$i]['iTime']?></span> 
                                                    <span class="body"><?= $db_chat1[$i]['Imessage']?></span>
                                                </div>
                                            </li>
                                                <? } ?>
                                            <? } ?>
                                            </ul>
                                            <form action="" method="post">
                                                <div class="input-group">
                                                    <input type="text" value="" name="Imessage" placeholder="Type Message ..." class="form-control" required>
                                                    <input type="hidden" value="<?=$db_data[0]['vName']?>" name="iSender" >
                                                    <input type="hidden" value="<?= $iSubject ?>" name="iSubject" >
                            
                                                    <? if ($_SESSION['sess_user'] == "driver") { ?>
                                                    <input type="hidden" value="<?= $iUserId ?>" name="iDriverId" placeholder="Driver id">
                                                    <? } ?>
                                        
                                                    <!--<? if ($_SESSION['sess_user'] == "rider") { ?>
                                                    <input type="" value="<?= $iUserId ?>" name="iUserId" placeholder="User id">
                                                    <? } ?>
                                                    <? if ($_SESSION['sess_user'] == "company") { ?>
                                                    <input type="" value="<?= $iUserId ?>" name="iCompanyId" placeholder="User id">
                                                    <? } ?>-->
                                                    <span class="input-group-append">
                                                        <button type="submit" class="btn btn-primary">Send</button>
                                                    </span>
                                                </div>
                                            </form>
                                        </div>
                                        <? } ?>
                                    </div>
                                </div>
	    		    		</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="yes" action="" method="post">
        <input type="hidden" value="yes" name="iRead">
    <form>
    <? include_once('footer.php') ?>
    </div>
</body>
</html>