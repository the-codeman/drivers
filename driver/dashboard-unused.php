<?
include_once('../common.php');
include_once('../generalFunctions.php');
include_once ('../data.php');
$generalobj->check_member_login();




    $sqlDriver = "select * from register_driver where iDriverId = '" . $_SESSION['sess_iUserId'] . "'";
    $dbDriver = $obj->MySQLSelect($sql);


    $sqlDoc = "SELECT dm.doc_masterid masterid, dm.doc_usertype ,dm.doc_name_" . $_SESSION['sess_lang'] . "  as d_name , dm.doc_name ,dm.ex_status,dm.status, dl.doc_masterid masterid_list ,dl.ex_date,dl.doc_file , dl.status, dm.eType FROM document_master dm left join (SELECT * FROM `document_list` where doc_userid='" . $_SESSION['sess_iUserId'] . "' ) dl on dl.doc_masterid=dm.doc_masterid where dm.doc_usertype='driver' and dm.status='Active' and (dm.country ='" . $db_user[0]['vCountry'] . "' OR dm.country ='All')";
    $db_userdoc = $obj->MySQLSelect($sqlDoc);

    $count_all_doc = count($db_userdoc);

?>

<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->
<head>
     <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Responsive Admin Template" />
    <meta name="author" content="SmartUniversity" />
    <title>Yalla | Driver Dashboard</title>
</head>
<!-- END HEAD -->
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-white">
    <div class="page-wrapper">
        <? include_once('driver_header.php') ?>
        <div class="page-container">
 			<? include_once('sidebar.php') ?>
 			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">My Profile</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">My Profile</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PROFILE SIDEBAR -->
                            <div class="profile-sidebar">
                                <div class="card card-topline-aqua">
                                    <div class="card-body no-padding height-9">
                                        <div class="row">
                                            <div class="profile-userpic">
                                                <?$img_path = $tconfig["tsite_upload_images_driver"];?>
												<img src = "<?=$img_path . '/' . $_SESSION['sess_iUserId'] . '/2_' . $db_data[0]['vImage']?>" class="img-responsive" alt="">
											</div>
                                        </div>
                                        <div class="profile-usertitle">
                                            <div class="profile-usertitle-name"><?= $generalobj->cleanall(htmlspecialchars($db_user[0]['vName'] . " " . $db_user[0]['vLastName'])); ?></div>
                                            <div class="profile-usertitle-job"><?=($drivercompany);?></div>
                                        </div> 
                                        <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item">
                                                <b>Trips</b> <a class="pull-right"><?=($tripscount);?></a>  
                                            </li>
                                            <li class="list-group-item">
                                                <b>Total Earning</b> <a class="pull-right">£<?=round(($totalearn),2);?></a>   
                                            </li>
                                            <li class="list-group-item">
                                                <b>Yalla Fee</b> <a class="pull-right">£<?=round(($commision),2);?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Net Earning</b> <a class="pull-right">£<?=round(($totalearn - $commision),2);?></a>
                                            </li>
                                        </ul>
                                        <!-- END SIDEBAR USER TITLE -->
                                        <!-- SIDEBAR BUTTONS -->
                                        <div class="profile-userbuttons">
                                            <button onclick=window.location.href='payment-request' type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-primary">View</button>
                                        </div>
                                        <!-- END SIDEBAR BUTTONS -->
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-head card-topline-aqua">
                                        <header>About Me</header>
                                    </div>
                                    <div class="card-body no-padding height-9">
                                        <div class="profile-desc">
                                            Ae
                                        </div>
                                        
                                        <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item">
                                                <b>First Name</b>
                                                <div class="profile-desc-item pull-right"><?= $db_user[0]['vName']; ?></div>    
                                            </li>
                                            <li class="list-group-item">
                                                <b>Last Name</b>
                                                <div class="profile-desc-item pull-right"><?= $db_user[0]['vLastName']; ?></div>   <!--<?= $generalobj->cleanall(htmlspecialchars($db_user[0]['vName'] . " " . $db_user[0]['vLastName'])); ?>-->
                                            </li>
                                            <li class="list-group-item">
                                                <b>Age</b>
                                                <div class="profile-desc-item pull-right"><?=($eAge);?></div>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Gender</b>
                                                <div class="profile-desc-item pull-right"><?=($eGender);?></div>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Address</b>
                                                <div class="profile-desc-item pull-right"><?=($vCaddress.' '.$vCadress2.', '.$vCity.', '.$vState.'<br> '.$vZip);?></div>
                                            </li>
                                        </ul>
                                        
                                        <div class="row list-separated profile-stat">
                                            <div class="col-md-4 col-sm-4 col-6">
                                                <div class="uppercase profile-stat-text"> Wallet Balance </div>
                                                <div class="uppercase profile-stat-title">£<?=($balance);?></div>  
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-6">
                                                <div class="uppercase profile-stat-text">Trips</div>
                                                <div class="uppercase profile-stat-title"> 51 </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-6">
                                                <div class="uppercase profile-stat-text">Uploads</div>
                                                <div class="uppercase profile-stat-title">61</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!--<div class="card">
                                    <div class="card-head card-topline-aqua">
                                        <header>Address</header>
                                    </div>
                                    <div class="card-body no-padding height-9">
                                        <div class="row text-center m-t-10">
                                            <div class="col-md-12">
                                                <p><?=($vCaddress.' '.$vCadress2.', '.$vCity.', '.$vState.'<br> '.$vZip);?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="card">
                                    <div class="card-head card-topline-aqua">
                                        <header>Work Expertise</header>
                                    </div>
                                    <div class="card-body no-padding height-9">
                                        <div class="work-monitor work-progress">
                                            <div class="states">
                                                <div class="info">
                                                    <div class="desc pull-left">Total Trips</div>
                                                    <div class="percent pull-right">100%</div>
                                                </div>
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                        <span class="sr-only">100% </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="states">
                                                <div class="info">
                                                    <div class="desc pull-left">Cancelled</div>
                                                    <div class="percent pull-right"><?= round(($CanceledTrip / $driverTrips *100),2);?>%</div> 
                                                </div>
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?= round(($CanceledTrip / $driverTrips *100),2);?>%">   
                                                        <span class="sr-only"><?=($CanceledTrip / $driverTrips *100);?>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="states">
                                                <div class="info">
                                                    <div class="desc pull-left">Finished</div>
                                                    <div class="percent pull-right"><?= round((100-$CanceledTrip / $driverTrips *100),2);?>%</div>
                                                </div>
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?= round((100-$CanceledTrip / $driverTrips *100),2);?>%">
                                                        <span class="sr-only">20% </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END BEGIN PROFILE SIDEBAR -->
                            
                            <!-- BEGIN PROFILE CONTENT -->
                            <div class="profile-content">
                                <div class="row">
									<div class="profile-tab-box">
										<div class="p-l-20">
											<ul class="nav ">
												<li class="nav-item tab-all"><a
													class="nav-link active show" href="#tab1" data-toggle="tab">About Me</a></li>
												<li class="nav-item tab-all p-l-20"><a class="nav-link"
													href="#tab2" data-toggle="tab">Edit</a></li>
												<li class="nav-item tab-all p-l-20"><a class="nav-link"
													href="#tab3" data-toggle="tab">Settings</a></li>
											</ul>
										</div>
									</div>
									<div class="white-box">
					                           <!-- Tab panes -->
				                        <div class="tab-content">
				                            <div class="tab-pane active fontawesome-demo" id="tab1">
												<div id="biography" >
						                            <div class="row">
						                                <div class="col-md-3 col-6 b-r"> <strong>Full Name</strong>    
						                                    <br>
						                                    <p class="text-muted"><?=$vName,' ',$vLastName;?></p>
						                                </div>
						                                <div class="col-md-3 col-6 b-r"> <strong>Mobile</strong>  
						                                    <br>
						                                    <p class="text-muted">+44 <?=$vPhone;?></p>  
						                                </div>
						                                <div class="col-md-3 col-6 b-r"> <strong>Email</strong>
						                                       <br>
						                                       <p class="text-muted"><?=$vEmail;?></p>
						                                </div>
						                                <div class="col-md-3 col-6"> <strong>Last Online</strong>
						                                    <br>
						                                        <p class="text-muted"><?=$tLastOnline;?></p>
						                                </div>
						                            </div>
						                            <br>
						                            <h4 class="font-bold">Vehicle Information</h4>
						                            <hr>
						                            <div class="row">
							                            <div class="col-md-3">Licence Number:</div> 
							                            <div class="col-md-9"><?= $vLicencePlate ;?></div>
							                        </div>
							                        <div class="row">
						                                <div class="col-md-3">Cab Type:</div>  
							                            <div class="col-md-9"><?= $vVehicleType ;?></div>
							                        </div>
							                        <div class="row">
							                            <div class="col-md-3">Cab Model:</div>
							                            <div class="col-md-9">XUV</div>
							                      	</div>
							                        <div class="row">
							                            <div class="col-md-3">Seating Capacity:</div>
							                            <div class="col-md-9">5</div>
							                       	</div>
							                       	<div class="row">
							                            <div class="col-md-3">Cab Number:</div>
							                            <div class="col-md-9">XP 09 4564</div>
							                      	</div>
							                       	<div class="row">
							                            <div class="col-md-3">Tax Renewal Date:</div>
							                            <div class="col-md-9">05-07-2018</div>
							                       	</div>
							                       	<div class="row">
							                            <div class="col-md-3">Insurance Renewal Date:</div>
							                            <div class="col-md-9">25-04-2018</div>
							                        </div>
						                            <br>
						                            <h4 class="font-bold">Work History</h4>
						                            <hr>
						                            <ul>
						                                <li>On</li>
						                                <li>Ty</li>
						                                <li>Lo</li>
						                                <li>Lo</li>
						                                <li>Lo</li>
						                                <li>Lo</li>
						                            </ul>
					                                <br>
						                        </div>
							    			</div>
					                        <div class="tab-pane" id="tab2">
											   <div class="row">
													<div class="col-md-12 col-sm-12">
								                        <div class="card-head">
								                            <header>Edit My Information</header>
								                            <button id = "panel-button2" class = "mdl-button mdl-js-button mdl-button--icon pull-right" data-upgraded = ",MaterialButton">
												                <i class = "material-icons">more_vert</i>
												            </button>
												            <ul class = "mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" data-mdl-for = "panel-button2">
												                <li class = "mdl-menu__item"><i class="material-icons">assistant_photo</i>Action</li>
												                <li class = "mdl-menu__item"><i class="material-icons">print</i>Another action</li>
												                <li class = "mdl-menu__item"><i class="material-icons">favorite</i>Something else here</li>
												            </ul>
								                        </div>
								                        
								                        <h4>Coming Soon<h4>
								                        
								                        
								                      <!--  <div class="card-body " id="bar-parent1">
								                            <div class="row">
									                            <form id="frm1" method="post" action="javascript:void(0);" >
					        	                                     <input  type="hidden" class="edit" name="action" value="login">
	                                        						<div class="show-edit-profile-part">
	                                        						<br>
	                                        						<span>
			                                        				    <label><?=$langage_lbl['LBL_SIGN_UP_FIRST_NAME_HEADER_TXT'];?></label>
	                                        						    <input type="text" class="form-control" placeholder="<?=$langage_lbl['LBL_YOUR_FIRST_NAME'];?>" value = "<?=$generalobj->cleanall(htmlspecialchars($db_user[0]['vName']));?>" name="name" >
		                                        					</span><br>
	                                        						<span>
	                                        						    <label><?=$langage_lbl['LBL_YOUR_LAST_NAME'];?></label>
		                                          						<input type="text" class="form-control" placeholder="<?=$langage_lbl['LBL_YOUR_LAST_NAME'];?>" value = "<?=$generalobj->cleanall(htmlspecialchars($db_user[0]['vLastName']));?>" name="lname" >
	                                           						</span><br>
											        				<span>
										                                <label><?=$langage_lbl['LBL_Phone_Number'];?></label>
								                                        <input name="phone" class="form-control" id="phone" type="text" value="0<?=$db_user[0]['vPhone']?>" placeholder="<?=$langage_lbl['LBL_Phone_Number'];?>"  title="Please enter proper phone number." />
										                            </span><br>
											        				<span>
								                                        <label>Email</label>
						                                        		<input type="hidden" name="uid" id="u_id1" value="<?=$_SESSION['sess_iUserId'];?>">
					                                        			<input type="hidden" name="user_type" id="user_type" value="<?=$_SESSION['sess_user'];?>">
	                                        							<input class="form-control" type="email" id="in_email" placeholder="<?=$langage_lbl['LBL_PROFILE_YOUR_EMAIL_ID'];?>" value = "<?=$db_user[0]['vEmail']?>" name="email" <?=isset($db_user[0]['vEmail']) ? '' : '';?>   >
	                                         							<div class="required-label" id="emailCheck"></div>
				                                        			</span><br>
											        				<span>
						                         				        <strong><label for="simpleFormEmail">Licence Authority</label></strong>
							                                            <select class="form-control" value = "<?=$generalobj->cleanall(htmlspecialchars($db_user[0]['vLicence']));?>" name ='iCompanyId' id="iCompanyId" >
							                                         	    <option value=""><?=$Licence?></option> 
												                        </select>
								                                	</span><br>
								                                	<span>
						                         				        <strong><label for="simpleFormEmail">Age</label></strong>
							                                            <select class="form-control" value = "<?=$generalobj->cleanall(htmlspecialchars($eAge));?>" name ='iCompanyId' id="iCompanyId" >
							                                         	    <option value=""><?=$eAge?></option> 
												                        </select>
								                                	</span><br>
								                                	<span>
	                                        						    <label><?=$langage_lbl['LBL_YOUR_LAST_NAME'];?></label>
		                                          						<input type="text" class="form-control" placeholder="<?=$langage_lbl['LBL_YOUR_LAST_NAME'];?>" value = "<?=$generalobj->cleanall(htmlspecialchars($db_user[0]['vLastName']));?>" name="lname" >
	                                           						</span><br>
	                                           							<span>
	                                        						    <label><?=$langage_lbl['LBL_YOUR_LAST_NAME'];?></label>
		                                          						<input type="text" class="form-control" placeholder="<?=$langage_lbl['LBL_YOUR_LAST_NAME'];?>" value = "<?=$generalobj->cleanall(htmlspecialchars($db_user[0]['vLastName']));?>" name="lname" >
	                                           						</span><br>
									                                <p class="save-button11">
	                                        					        <input name="save" id="validate_submit" type="submit" value="<?=$langage_lbl['LBL_Save'];?>" class="btn btn-primary" > <!-- onClick="return validate_email_submit('login')" 
	                                         						    <input name="" id="hide-edit-profile-div" type="button" value="<?=$langage_lbl['LBL_BTN_PROFILE_CANCEL_TRIP_TXT'];?>" class="btn btn-primary">
		                                          					</p>
	                                        						<div style="clear:both;"></div>
			                     		                	    </div>
						                                    </form>
     							   form finish   </div> 
									                </div> -->
												</div>
											</div>
										</div>
										<div class="tab-pane" id="tab3">
											<div class="row">
												<div class="col-md-12 col-sm-12">
								                    <div class="card-head">
								                        <header>Password Change</header>
								                        <button id = "panel-button2" class = "mdl-button mdl-js-button mdl-button--icon pull-right" data-upgraded = ",MaterialButton">
												            <i class = "material-icons">more_vert</i>
												        </button>
												        <ul class = "mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" data-mdl-for = "panel-button2">
												            <li class = "mdl-menu__item"><i class="material-icons">assistant_photo</i>Action</li>
												            <li class = "mdl-menu__item"><i class="material-icons">print</i>Another action</li>
												            <li class = "mdl-menu__item"><i class="material-icons">favorite</i>Something else here</li>
												        </ul>
								                    </div>
								                    <div class="card-body " id="bar-parent1">
								                        <form id="frm3" method="post" action="javascript:void(0);" onSubmit="return <?=($db_user[0]['vFbId'] >= 0 && $db_user[0]['vPassword'] != "") ? 'validate_password()' : 'validate_password_fb()';?>">
								                            <p class="password-pointer"><img src="assets/img/pas-img1.jpg" alt=""></p>
								                         	<h3><i class="fa fa-unlock-alt" aria-hidden="true"></i><?=$langage_lbl['LBL_PROFILE_PASSWORD_LBL_TXT'];?></h3>
								                        	<input type="hidden" name="action" id="action" value = "pass"/>
								                        	<div class="row">
										                       	<span>
								                                    <div class="form-group">
								                                        <label for="simpleFormEmail">User Name</label>
								                                        <input type="password" class="form-control" name="cpass" id="cpass" onkeyup="nospaces(this)" placeholder="<?=$langage_lbl['LBL_CURR_PASS_HEADER'];?>">
								                                    </div>
								                                    <div class="form-group">
								                                        <label for="simpleFormPassword">Current Password</label>
								                                        <input type="password" class="form-control" id="simpleFormPassword" placeholder="<?=$langage_lbl['LBL_UPDATE_PASSWORD_HEADER_TXT'];?>" name="npass" id="npass" onkeyup="nospaces(this)">
								                                    </div>
								                                    <div class="form-group">
								                                        <label for="simpleFormPassword">New Password</label>
								                                        <input type="password" class="form-control" id="newpassword" placeholder="<?=$langage_lbl['LBL_Confirm_New_Password'];?>" name="ncpass" id="ncpass" onkeyup="nospaces(this)" required>
								                                    </div>
								                                     	<input name="save" type="submit" value="<?=$langage_lbl['LBL_Save'];?>" class="btn btn-primary">
										                                <input id="hide-edit-password-div" type="button" value="<?=$langage_lbl['LBL_BTN_PROFILE_CANCEL_TRIP_TXT'];?>" class="btn btn-primary">
								                        </form>
					                                </div>
									            </div>
											</div>
										</div>
					                </div>
					            </div>
                            </div>
                        </div>
                            <!-- END PROFILE CONTENT -->
                    </div>
                </div>
            </div>
            <!-- end page content -->
        </div>
            
    </div>
    <? include_once('footer.php') ?>
</div>
<script type="text/javascript" src="<?php echo $tconfig["tsite_url_main_admin"] ?>js/moment.min.js"></script>
<script type="text/javascript" src="<?php echo $tconfig["tsite_url_main_admin"] ?>js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo $tconfig["tsite_url_main_admin"] ?>js/validation/jquery.validate.min.js" ></script>
<script type="text/javascript" src="../assets/js/validation/additional-methods.js" ></script>
<script type="text/javascript">
function nospaces(t){

	if(t.value.match(/\s/g)){
	    alert('Password should not contain whitespace.');
    	//t.value=t.value.replace(/\s/g,'');
		t.value = '';
	}
}
//$(".demo-success").hide(1000);
//var successMsg = '<?php echo $var_msg; ?>';
var successMSG1 = '<?php echo $success; ?>';

if (successMSG1 != '') {
	setTimeout(function () {
    	$(".msgs_hide").hide(1000)
	}, 5000);
}

				$("#dp3").datepicker();
				$("#dp3").datepicker({
					dateFormat: "yy-mm-dd",
					changeYear: true,
					changeMonth: true,
					yearRange: "-100:+10"
				});
				$(document).ready(function () {
					$("#show-edit-profile-div").click(function () {
						$("#hide-profile-div").hide();
						$("#show-edit-profile").show();
					});
					$("#hide-edit-profile-div").click(function () {
						$("#show-edit-profile").hide();
						$("#hide-profile-div").show();
						$("#frm1")[0].reset();
						var selectedOption = $('.custom-select-new.vCountry').find(":selected").text();
						var selectedOption1 = $('.custom-select-new.vCurrencyDriver').find(":selected").text();
						if(selectedOption != "" || selectedOption1!= "") {
							$('.custom-select-new.vCountry').next(".holder").text(selectedOption);
							$('.custom-select-new.vCurrencyDriver').next(".holder").text(selectedOption1);
						}
					});

					$("#show-edit-password-div").click(function () {
						$('.hidev').show();
						$('.showV').hide();
						$(".hide-password-div").hide();
						$("#show-edit-password").show(300);
					});
					$("#hide-edit-password-div").click(function () {
						$('.hidev').show();
						$('.showV').hide();
						$("#show-edit-password").hide();
						$(".hide-password-div").show();
						$("#frm3")[0].reset();
					});

					$("#show-edit-address-div").click(function () {
						$('.hidev').show();
						$('.showV').hide();
						$(".hide-address-div").hide();
						$("#show-edit-address").show(300);
					});
					$("#hide-edit-address-div").click(function () {
						$('.hidev').show();
						$('.showV').hide();
						$("#show-edit-address").hide();
						$(".hide-address-div").show();
						$("#frm2")[0].reset();
						var selectedOption = $('#vCountry').find(":selected").text();
						var selectedOption1 = $('#vState').find(":selected").text();
						var selectedOption2 = $('#vCity').find(":selected").text();
						if(selectedOption != "" || selectedOption1!= "" || selectedOption2!="") {
							$('#vCountry').next(".holder").text(selectedOption);
							$('#vState').next(".holder").text(selectedOption1);
							$('#vCity').next(".holder").text(selectedOption2);
						}
					});

					$("#show-edit-language-div").click(function () {
						$('.hidev').show();
						$('.showV').hide();
						$(".hide-language-div").hide();
						$("#show-edit-language").show(300);
					});
					$("#hide-edit-language-div").click(function () {
						$('.hidev').show();
						$('.showV').hide();
						$("#show-edit-language").hide();
						$(".hide-language-div").show();
						$("#frm4")[0].reset();
						var selectedOption = $('.profile-language-input').find(":selected").text();
						if(selectedOption != ""){
							$('.profile-language-input').next(".holder").text(selectedOption);
						}
					});

					$("#show-edit-bankdetail-div").click(function () {
						$('.hidev').show();
						$('.showV').hide();
						$(".hide-bankdetail-div").hide();
						$("#show-edit-bankdeatil").show(300);
					});
					$("#hide-edit-bankdetail-div").click(function () {
						$('.hidev').show();
						$('.showV').hide();
						$("#show-edit-bankdeatil").hide();
						$(".hide-bankdetail-div").show();
						$("#frm6")[0].reset();
					});

					$("#show-edit-vat-div").click(function () {
						$("#hide-vat-div").hide();
						$("#show-edit-vat").show();
					});
					$("#hide-edit-vat-div").click(function () {
						$("#show-edit-vat").hide();
						$("#hide-vat-div").show();
					});

					$("#show-edit-accessibility-div").click(function () {
						$("#hide-accessibility-div").hide();
						$("#show-edit-accessibility").show();
					});
					$("#hide-edit-accessibility-div").click(function () {
						$("#show-edit-accessibility").hide();
						$("#hide-accessibility-div").show();
					});

					$('.demo-close').click(function (e) {
						$(this).parent().hide(1000);
					});

					var user = '<?=SITE_TYPE;?>';
					if (user == 'Demo') {
						var a = '<?=$new;?>';
						if (a != undefined && a != '') {
							$('#formModal').modal('show');
						}
						//$('#formModal').modal('show');
					}

					$('[data-toggle="tooltip"]').tooltip();

					$('#cancel-btn').on( 'click', function () {
						$('#photo').val('');
					});

					$('.frm9').validate({
						ignore: 'input[type=hidden]',
						errorClass: 'help-block',
						errorElement: 'span',
						errorPlacement: function(error, element) {
							if (element.attr("name") == "photo")
							{
								error.insertAfter("span.file_error");
								} else {
								error.insertAfter(element);
							}
						},
						rules: {
							photo: {
								required: {
									depends: function(element) {
										if ($("#photo").val() == "NONE" || $("#photo").val() == "") {
											return true;
											} else {
											return false;
										}
									}
								},
								extension: "jpg|jpeg|png|gif"
							}
						},
						messages: {
							photo: {
								required: '<?=addslashes($langage_lbl['LBL_UPLOAD_IMG']);?>',
								extension: '<?=addslashes($langage_lbl['LBL_UPLOAD_IMG_ERROR']);?>'
							}
						}
					});
				});
				function setModel001(idVal) {
					// $('#uiModal').on('show.bs.modal', function (e) {
					// var rowid = $(e.relatedTarget).data('id');
					var id = '<?php echo $_SESSION['sess_iUserId']; ?>';
					var user = '<?php echo $_SESSION['sess_user']; ?>';

					$.ajax({
						type: 'post',
						url: 'driver_document_fetch.php', //Here you will fetch records
						data: 'rowid=' + idVal + '-' + id+'-'+user, //Pass $id
						success: function (data) {
							$('#uiModal').modal('show');
							$('.fetched-data').html(data);//Show fetched data from database
						}
					});
				}

				function validate_password_fb() {
					//var cpass = document.getElementById('cpass').value;
					var npass = document.getElementById('npass').value;
					var ncpass = document.getElementById('ncpass').value;
					// var pass = '<?=$newp?>';
					var err = '';
					if (npass == '') {
						err += "<?php echo addslashes($langage_lbl['LBL_NEW_PASS_MSG']); ?><BR>";
					}
					if (npass.length < 6) {
						err += "<?php echo addslashes($langage_lbl['LBL_PASS_LENGTH_MSG']); ?><BR>";
					}
					if (ncpass == '') {
						err += "<?php echo addslashes($langage_lbl['LBL_REPASS_MSG']); ?><BR>";
					}
					if (err == "") {
						if (npass != ncpass)
						err += "<?php echo addslashes($langage_lbl['LBL_PASS_NOT_MATCH']); ?><BR>";
					}
					if (err == "")
					{
						editProfile('pass');
						return false;
					}
					else {
						$('#npass').val('');
						$('#ncpass').val('');
						bootbox.dialog({
							message: "<h3>"+err+"</h3>",
							buttons: {
								danger: {
									label: "Ok",
									className: "btn-danger",
								},
							}
						});
						//document.getElementById("err_password").innerHTML = '<div class="alert alert-danger">' + err + '</div>';
						return false;
					}
				}
				function validate_password() {
					var cpass = document.getElementById('cpass').value;
					var npass = document.getElementById('npass').value;
					var ncpass = document.getElementById('ncpass').value;
					var err = '';

					if (cpass == '') {
						err += "<?=addslashes($langage_lbl['LBL_CURRENT_PASS_MSG']);?><br />";
					}
					if (npass == '') {
						err += "<?=addslashes($langage_lbl['LBL_NEW_PASS_MSG']);?><br />";
					}
					if (npass.length < 6) {
						err += "<?=addslashes($langage_lbl['LBL_PASS_LENGTH_MSG']);?><br />";
					}
					if (npass.length > 16) {
						err += "<?=addslashes($langage_lbl['LBL_PASS__MAX_LENGTH_MSG']);?><br />";
					}
					if (ncpass == '') {
						err += "<?=addslashes($langage_lbl['LBL_REPASS_MSG']);?><br />";
					}

					if (err == "") {
						if (npass != ncpass)
						err += "<?=addslashes($langage_lbl['LBL_PASS_NOT_MATCH']);?><br />";
					}
					if (err == "")
					{
						$.ajax({
							type: "POST",
							url: 'ajax_check_password_a.php',
							data: {cpass: cpass},
							success: function (dataHtml)
							{
								if(dataHtml.trim() == 1){
									editProfile('pass');
									return false;
									}else {
									err += "<?=addslashes($langage_lbl['LBL_INCCORECT_CURRENT_PASS_ERROR_MSG']);?><BR>";
									$('#cpass').val('');
									$('#npass').val('');
									$('#ncpass').val('');
									bootbox.dialog({
										message: "<h3>"+err+"</h3>",
										buttons: {
											danger: {
												label: "Ok",
												className: "btn-danger",
											},
										}
									});
									return false;
								}
							}
						});
						} else {
						$('#cpass').val('');
						$('#npass').val('');
						$('#ncpass').val('');
						bootbox.dialog({
							message: "<h3>"+err+"</h3>",
							buttons: {
								danger: {
									label: "Ok",
									className: "btn-danger",
								},
							}
						});

						return false;
					}
				}

				function editPro(action)
				{
					editProfile(action);
					return false;
				}

				function editProfile(action)
				{
					var chk = '<?php echo SITE_TYPE; ?>';

					if (action == 'login')
					{
						data = $("#frm1").serialize();
					}
					if (action == 'address')
					{
						data = $("#frm2").serialize();
					}
					if (action == 'pass')
					{
						data = $("#frm3").serialize();
					}
					if (action == 'lang')
					{
						data = $("#frm4").serialize();
					}
					if (action == 'vat')
					{
						data = $("#frm5").serialize();
					}
					if (action == 'access')
					{
						data = $("#frm10").serialize();
					}
					if (action == 'bankdetail')
					{
						data = $("#frm6").serialize();
					}

					var request = $.ajax({
						type: "POST",
						url: 'profile_action.php',
						data: data,
						success: function (data)
						{
							if(data == '2'){
								window.location = "profile.php?success=2&var_msg="+ data;
								return false;
							} else {
								window.location = 'profile.php?success=1&var_msg=' + data;
								return false;
							}
						}
					});

					request.fail(function (jqXHR, textStatus) {
						alert("Request failed: " + textStatus);
						return true;
					});
				}

				function changeCode(id)
				{
					var request = $.ajax({
						type: "POST",
						url: 'change_code.php',
						data: 'id=' + id,
						success: function (data)
						{
							document.getElementById("code").value = data;
						}
					});
				}

				function setCity(id,selected)
				{
					var fromMod = 'driver';
					var request = $.ajax({
						type: "POST",
						url: 'change_stateCity.php',
						data: {stateId: id, selected: selected,fromMod:fromMod},
						success: function (dataHtml)
						{
							$("#vCity").html(dataHtml);
						}
					});
				}

				function setState(id,selected)
				{
					var fromMod = 'driver';
					var request = $.ajax({
						type: "POST",
						url: 'change_stateCity.php',
						data: {countryId: id, selected: selected,fromMod:fromMod},
						success: function (dataHtml)
						{
							$("#vState").html(dataHtml);
							if(selected == '')
							setCity('',selected);
						}
					});
				}

				setState('<?php echo $db_user[0]['vCountry']; ?>','<?php echo $db_user[0]['vState']; ?>');
				setCity('<?php echo $db_user[0]['vState']; ?>','<?php echo $db_user[0]['vCity']; ?>');
			</script>
			<script type="text/javascript">
				user = '<?=$user?>';
				var dataa = {};
				if(user == 'company'){
					dataa.iCompanyId = "<?=$_SESSION['sess_iUserId'];?>";
					dataa.usertype = user;
				} else {
					dataa.iDriverId = "<?=$_SESSION['sess_iUserId'];?>";
					dataa.usertype = user;
				}
				var errormessage;
				$('#frm1').validate({
					ignore: 'input[type=hidden]',
					errorClass: 'help-block error',
					errorElement: 'span',
					errorPlacement: function(error, element) {
					    if(element.attr("name") == "vCurrencyDriver")
					    	error.appendTo('#vCurrencyDriverCheck');
					   	else if(element.attr("name") == "vCountry")
					    	error.appendTo('#vCountryCheck');
					    else
					        error.insertAfter(element);
					},
					onkeyup: function( element, event ) {
				        if ( event.which === 9 && this.elementValue(element) === "" ) {
				            return;
				        } else {
				            this.element(element);
				        }
				    },
					rules: {
						email:{required: true, email: true,
							remote: {
								url: 'ajax_validate_email.php',
								type: "post",
								cache: false,
							    data: {
							    	id:function(e){
		                                return $('#in_email').val();
		                            },
			                        usr:function(e){
		                                return user;
		                            },
		                            uid:function(e){
		                                return $("#u_id1").val();
		                            }
			                    },
			                    dataFilter: function(response) {
			                        //response = $.parseJSON(response);
			                        if (response == 'deleted')  {
			                            errormessage = "<?=addslashes($langage_lbl['LBL_CHECK_DELETE_ACCOUNT']);?>";
			                            return false;
			                        } else if(response == 'false'){
			                            errormessage = "<?=addslashes($langage_lbl['LBL_EMAIL_EXISTS_MSG']);?>";
			                            return false;
			                        } else {
			                            return true;
			                        }
			                    },
			                    async: false
							}
						},
						name: {required: function(e){
							return $('input[name=user_type]').val() == 'driver';
						}, minlength: function(e){
							if($('input[name=user_type]').val() == 'driver') { return 2; } else {return false;}
                        },maxlength: function(e){
							if($('input[name=user_type]').val() == 'driver') { return 30; } else { return false;}
                        }},
						lname: {required: function(e){
							return $('input[name=user_type]').val() == 'driver';
						}, minlength: function(e){
							if($('input[name=user_type]').val() == 'driver') { return 2; } else {return false;}
                        },maxlength: function(e){
							if($('input[name=user_type]').val() == 'driver') { return 30; } else { return false;}
                        }},
                        vCompany: {required: function(e){
                            return $('input[name=user_type]').val() == 'company';
                        }, minlength: function(e){
							if($('input[name=user_type]').val() == 'company') { return 2; } else {return false;}
                        },maxlength: function(e){
							if($('input[name=user_type]').val() == 'company') { return 30; } else { return false;}
                        }},
						phone: {required: true,minlength: 3,digits: true,
							remote: {
								url: 'ajax_driver_mobile_new.php',
								type: "post",
								data: dataa,
								dataFilter: function(response) {
			                        //response = $.parseJSON(response);
			                        if (response == 'deleted')  {
			                            errormessage = "<?=addslashes($langage_lbl['LBL_PHONE_CHECK_DELETE_ACCOUNT']);?>";
			                            return false;
			                        } else if(response == 'false'){
			                            errormessage = "<?=addslashes($langage_lbl['LBL_PHONE_EXIST_MSG']);?>";
			                            return false;
			                        } else {
			                            return true;
			                        }
			                    },
								async: false
							}
						},
					},
					messages: {
						email: {remote: function(){ return errormessage; }},
						vCompany: {
	                        required: 'Company Name is required.',
	                        minlength: 'Company Name at least 2 characters long.',
	                        maxlength: 'Please enter less than 30 characters.'
	                    },
	                    name: {
	                        required: 'First Name is required.',
	                        minlength: 'First Name at least 2 characters long.',
	                        maxlength: 'Please enter less than 30 characters.'
	                    },
	                    lname: {
	                        required: 'Last Name is required.',
	                        minlength: 'Last Name at least 2 characters long.',
	                        maxlength: 'Please enter less than 30 characters.'
	                    },
						phone: {minlength: 'Please enter at least three Number.',digits: 'Please enter proper mobile number.',remote: function(){ return errormessage; }}
					},
					submitHandler: function () {
						if ($("#frm1").valid()) {
						    editProfile('login');
						}
					}
				});

				//var from = document.getElementById('vWorkLocation');
			//autocomplete_from1 = new google.maps.places.Autocomplete(from);
		/*		google.maps.event.addListener(autocomplete_from1, 'place_changed', function() {
					var placeaddress = autocomplete_from1.getPlace();

					$('#vWorkLocationLatitude').val(placeaddress.geometry.location.lat());
					$('#vWorkLocationLongitude').val(placeaddress.geometry.location.lng());

				});  */
			</script>
</body>
</html>