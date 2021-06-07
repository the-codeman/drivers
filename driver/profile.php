<?php
include_once '../common.php';

$script = "Profile";

$user = isset($_SESSION["sess_user"]) ? $_SESSION["sess_user"] : '';
$success = isset($_REQUEST["success"]) ? $_REQUEST["success"] : '';
$var_msg = isset($_REQUEST["var_msg"]) ? $_REQUEST["var_msg"] : '';
$new = '';
$db_doc = array();

if (isset($_SESSION['sess_new'])) {
    $new = $_SESSION['sess_new'];
    unset($_SESSION['sess_new']);
}

if (empty($SHOW_CITY_FIELD)) {
    $SHOW_CITY_FIELD = $generalobj->getConfigurations("configurations", "SHOW_CITY_FIELD");
}

$generalobj->check_member_login();
$access = 'driver';

$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$generalobj->setRole($access, $url);

$sql = "select * from country where eStatus = 'Active' ORDER BY vCountry ASC ";
$db_country = $obj->MySQLSelect($sql);

$sql = "select * from currency where eStatus = 'Active' order by iDispOrder ASC";
$db_currency = $obj->MySQLSelect($sql);

if (isset($_SESSION['sess_user']) && $_SESSION['sess_user'] == 'driver') {
    $sql = "select * from register_driver where iDriverId = '" . $_SESSION['sess_iUserId'] . "'";
    $db_user = $obj->MySQLSelect($sql);

    $sql = "SELECT dm.doc_masterid masterid, dm.doc_usertype ,dm.doc_name_" . $_SESSION['sess_lang'] . "  as d_name , dm.doc_name ,dm.ex_status,dm.status, dl.doc_masterid masterid_list ,dl.ex_date,dl.doc_file , dl.status, dm.eType FROM document_master dm left join (SELECT * FROM `document_list` where doc_userid='" . $_SESSION['sess_iUserId'] . "' ) dl on dl.doc_masterid=dm.doc_masterid where dm.doc_usertype='driver' and dm.status='Active' and (dm.country ='" . $db_user[0]['vCountry'] . "' OR dm.country ='All')";

    $db_userdoc = $obj->MySQLSelect($sql);
    $count_all_doc = count($db_userdoc);

    if ($SITE_VERSION == "v5") {
        $data_driver_pref = $generalobj->Get_User_Preferences($_SESSION['sess_iUserId']);
    }
}

$noc = $certi = $licence = "";

if (count($db_doc) > 0) {
    $noc = $db_doc[0]['vNoc'];
    $certi = $db_doc[0]['vCerti'];
    if (isset($_SESSION['sess_user']) && $_SESSION['sess_user'] == 'driver') {
        $licence = $db_doc[0]['vLicence'];
    }
}

$sql = "select * from language_master where eStatus = 'Active' order by iDispOrder ASC";
$db_lang = $obj->MySQLSelect($sql);
$lang = "";
for ($i = 0; $i < count($db_lang); $i++) {
    if ($db_user[0]['vLang'] == $db_lang[$i]['vCode']) {
        $lang_user = $db_lang[$i]['vTitle'];
    }
}

if ($action = 'document' && isset($_POST['doc_type'])) {
    $expDate = $_POST['dLicenceExp'];
    
    $user = $_POST['user'];
    $masterid = $_REQUEST['master'];

    if (isset($_POST['doc_path'])) {
        $doc_path = $_POST['doc_path'];
    }
    $temp_gallery = $doc_path . '/';
    $image_object = $_FILES['driver_doc']['tmp_name'];
    $image_name = $_FILES['driver_doc']['name'];

    if (empty($image_name)) {
        $image_name = $_POST['driver_doc_hidden'];
    }
    if ($image_name == "") {
        if ($expDate != "") {
             
                $sql = "select ex_date from document_list where doc_userid='" . $_REQUEST['id'] . "' and doc_usertype='driver' and doc_masterid='" . $masterid . "'";
            
            $query = $obj->MySQLSelect($sql);
            $fetch = $query[0];

            if ($fetch['ex_date'] == $expDate) {
                  
                    $sql = "UPDATE `document_list` SET  ex_date='" . $expDate . "' WHERE doc_userid='" . $_REQUEST['id'] . "' and doc_usertype='driver' and doc_masterid='" . $masterid . "'";
                 
            } else {
                  
                    $sql = " INSERT INTO `document_list` ( `doc_masterid`, `doc_usertype`, `doc_userid`, `ex_date`, `doc_file`, `status`, `edate`) VALUES ( '" . $_REQUEST['doc_type'] . "', 'driver', '" . $_REQUEST['id'] . "', '" . $expDate . "', '', 'Inactive', CURRENT_TIMESTAMP)";
                 
            }
            $query = $obj->sql_query($sql);
        }

        $var_msg = $langage_lbl['LBL_UPLOAD_IMG_ERROR'];
        header("location:profile.php?success=0&id=" . $_REQUEST['id'] . "&var_msg=" . $var_msg);
    }

    if ($_FILES['driver_doc']['name'] != "") {
         

        $filecheck = basename($_FILES['driver_doc']['name']);
        $fileextarr = explode(".", $filecheck);
        $ext = strtolower($fileextarr[count($fileextarr) - 1]);
        $flag_error = 0;
        
        if ($ext != "jpg" && $ext != "gif" && $ext != "png" && $ext != "jpeg" && $ext != "bmp" && $ext != "pdf" && $ext != "doc" && $ext != "docx") {
            $flag_error = 1;
            $var_msg = $langage_lbl['LBL_WRONG_FILE_SELECTED_TXT'];
        }

        if ($flag_error == 1) {
            header("location:profile.php?success=0&id=" . $_REQUEST['id'] . "&var_msg=" . $var_msg);
            
            exit;
        } else {
            $Photo_Gallery_folder = $doc_path . '/' . $_REQUEST['id'] . '/';
            if (!is_dir($Photo_Gallery_folder)) {
                mkdir($Photo_Gallery_folder, 0777);
            }
            $vFile = $generalobj->fileupload($Photo_Gallery_folder, $image_object, $image_name, $prefix = '', $vaildExt = "pdf,doc,docx,jpg,jpeg,gif,png");
            $vImage = $vFile[0];
            $var_msg = $langage_lbl['LBL_UPLOAD_MSG'];
            $tbl = 'document_list';
            $sql = "select doc_id from  " . $tbl . "  where doc_userid='" . $_REQUEST[id] . "' and doc_usertype='driver'  and doc_masterid=" . $_REQUEST['doc_type'];
            $db_data = $obj->MySQLSelect($sql);
            $q = "INSERT INTO ";
            $where = '';

            if (count($db_data) > 0) {
                $query = "UPDATE `" . $tbl . "` SET `doc_file`='" . $vImage . "' , `ex_date`='" . $expDate . "' WHERE doc_userid='" . $_REQUEST[id] . "' and doc_usertype='driver'  and doc_masterid=" . $_REQUEST['doc_type'];
                $q = "UPDATE ";
                $where = " WHERE `iDriverId` = '" . $_REQUEST['id'] . "'";
            } else {
                $query = " INSERT INTO `" . $tbl . "` ( `doc_masterid`, `doc_usertype`, `doc_userid`, `ex_date`, `doc_file`, `status`, `edate`) " . "VALUES " . "( '" . $_REQUEST['doc_type'] . "', 'driver', '" . $_REQUEST['id'] . "', '" . $expDate . "', '" . $vImage . "', 'Inactive',     CURRENT_TIMESTAMP)";
            }

            $obj->sql_query($query);

            ###### Email #######
            $maildata['NAME'] = $db_user[0]['vName'] . " " . $db_user[0]['vLastName'] . " (" . $langage_lbl['LBL_DOCUMNET_UPLOAD_BY_DRIVER'] . ")";
            $maildata['EMAIL'] = $db_user[0]['vEmail'];
            $docname_SQL = "SELECT doc_name_" . $default_lang . " as docname FROM document_master WHERE doc_masterid = '" . $_REQUEST['doc_type'] . "'";
            $docname_data = $obj->MySQLSelect($docname_SQL);
            $maildata['DOCUMENTTYPE'] = $docname_data[0]['docname'];
            $maildata['DOCUMENTFOR'] = $langage_lbl['LBL_DOCUMNET_UPLOAD_BY_DRIVER'];
            
            $generalobj->send_email_user("DOCCUMENT_UPLOAD_WEB", $maildata);

            if ($user == 'driver') {
                $sqlquery = "SELECT vEmail,vCompany FROM company WHERE iCompanyId = '" . $_SESSION['sess_iCompanyId'] . "'";
                $Companydata = $obj->MySQLSelect($sqlquery);
                $maildata['COMPANYEMAIL'] = $Companydata[0]['vEmail'];
                $maildata['COMPANYNAME'] = $Companydata[0]['vCompany'];
                $generalobj->send_email_user("DOCCUMENT_UPLOAD_WEB_COMPANY", $maildata);
            }
            
            #######Email ##########
            //Start :: Log Data Save
            $vNocPath = $vImage;
            $generalobj->save_log_data($_SESSION['sess_iUserId'], $_REQUEST['id'], 'company', 'noc', $vNocPath);
            
            header("location:profile.php?success=1&id=" . $_REQUEST['id'] . "&var_msg=" . $var_msg);
        }
    } else {
        $vImage = $_POST['driver_doc_hidden'];
        $var_msg = $langage_lbl['LBL_UPLOAD_DOC_SUCCESS_UPLOAD_DOC'];
        $tbl = 'document_list';
        if ($user == 'company') {
            $sql = "select doc_id from  " . $tbl . "  where doc_userid='" . $_REQUEST[id] . "' and doc_usertype='company'  and doc_masterid=" . $_REQUEST['doc_type'];
        } else {
            $sql = "select doc_id from  " . $tbl . "  where doc_userid='" . $_REQUEST[id] . "' and doc_usertype='driver'  and doc_masterid=" . $_REQUEST['doc_type'];
        }
        $db_data = $obj->MySQLSelect($sql);
        $q = "INSERT INTO ";
        $where = '';
        if (count($db_data) > 0) {
            $query = "UPDATE `" . $tbl . "` SET `doc_file`='" . $vImage . "' , `ex_date`='" . $expDate . "' WHERE doc_userid='" . $_REQUEST[id] . "' and doc_usertype='driver'  and doc_masterid=" . $_REQUEST['doc_type'];
            $q = "UPDATE ";
            $where = " WHERE `iDriverId` = '" . $_REQUEST['id'] . "'";
        } else {
            $query = " INSERT INTO `" . $tbl . "` ( `doc_masterid`, `doc_usertype`, `doc_userid`, `ex_date`, `doc_file`, `status`, `edate`) " . "VALUES " . "( '" . $_REQUEST['doc_type'] . "', 'driver', '" . $_REQUEST['id'] . "', '" . $expDate . "', '" . $vImage . "', 'Inactive',     CURRENT_TIMESTAMP)";
        }
        
        $obj->sql_query($query);
        $vNocPath = $vImage;
        $generalobj->save_log_data($_SESSION['sess_iUserId'], $_REQUEST['id'], 'company', 'noc', $vNocPath);
        header("location:profile.php?success=1&id=" . $_REQUEST['id'] . "&var_msg=" . $var_msg);
    }
}

if (count($db_userdoc) > 0) {
    for ($i = 0; $i < count($db_userdoc); $i++) {
        if ($db_userdoc[$i]['doc_file'] != "") {
            $test[] = '1';
        }
    }
}

if (count($test) == count($db_userdoc)) {
    $UploadDocuments = 'Yes';
} else {
    $UploadDocuments = 'No';
}
?>

<!DOCTYPE html>
<html lang="en" dir="<?= (isset($_SESSION['eDirectionCode']) && $_SESSION['eDirectionCode'] != "") ? $_SESSION['eDirectionCode'] : 'ltr'; ?>">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title><?= $SITE_NAME ?> |<?= $langage_lbl['LBL_HEADER_PROFILE_TXT']; ?> </title>
        
        <?php include_once "../top/top_script.php"; ?>
        <link rel="stylesheet" href="../assets/css/bootstrap-fileupload.min.css" >
        <?php if ($_SESSION['sess_user'] == 'driver' && $APP_TYPE == 'UberX') { ?>
            <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&language=en&key=<?= $GOOGLE_SEVER_API_KEY_WEB ?>"></script>
        <?php } ?>
    </head>
    <body>
    <div id="main-uber-page">
        <?php include_once "../top/left_menu.php"; ?>
        <?php include_once "../top/header_topbar.php"; ?>
        <div class="page-contant">
            <div class="page-contant-inner">
                <h2 class="header-page-p"><?= $langage_lbl['LBL_PROFILE_HEADER_PROFILE_TXT']; ?></h2>
                <?php  if ($UploadDocuments == 'No') { ?>
                    <div class="demo-warning">
                        <p><?php if (isset($_REQUEST['first']) && $_REQUEST['first'] == 'yes') { echo $langage_lbl['LBL_PROFILE_WE_SEE_YOU_HAVE_REGISTERED_AS_A_DRIVER']; } ?></p>
                        <p><?php if ($db_user[0]['eStatus'] == 'inactive') { echo $langage_lbl['LBL_INACTIVE_DRIVER_MESSAGE']; } ?></p>
                        <p><?= $langage_lbl['LBL_KINDLY_PROVIDE_BELOW_VISIBLE']; ?></p>
                    </div>
                <?php } else if ($db_user[0]['eStatus'] == 'inactive') { ?>
                    <div class="demo-warning">
                        <p><?= $langage_lbl['LBL_INACTIVE_DRIVER_MESSAGE']; ?></p>
                    </div>
                <?php } ?>
                <!-- profile page -->
                <div class="driver-profile-page">

                    <?php if ($success == 1) { ?>
                    <div class="demo-success msgs_hide">
                        <button class="demo-close" type="button">×</button>
                        <?= $var_msg ?>
                    </div> 

                    <?php } else if ($success == 2) { ?>
                    <div class="demo-danger msgs_hide">
                        <button class="demo-close" type="button">×</button>
                        <?= $langage_lbl['LBL_EDIT_DELETE_RECORD']; ?>
                    </div>

                    <?php } else if ($success == 0 && $var_msg != "") { ?>
                    <div class="demo-danger msgs_hide">
                        <button class="demo-close" type="button">×</button>
                        <?= $var_msg; ?>
                    </div>
                    <?php } ?>

                    <div class="driver-profile-top-part" id="hide-profile-div">
                        <div class="driver-profile-img">
                        <span>
                            <?php
                        
                            $img_path = $tconfig["tsite_upload_images_driver"];
                            $profileImgpath = $tconfig["tsite_upload_images_driver_path"];

                            if (($db_user[0]['vImage'] == 'NONE' || $db_user[0]['vImage'] == '') || !file_exists($profileImgpath. '/' . $_SESSION['sess_iUserId'] . '/2_' . $db_user[0]['vImage'])) { ?>
                                <img src="assets/img/profile-user-img.png" alt="">
                           
                            <? } else { ?>
                                <img src = "<?= $img_path . '/' . $_SESSION['sess_iUserId'] . '/2_' . $db_user[0]['vImage'] ?>" style="height:150px;"/>
                            <?php } ?>
                        </span>
                        <b><a data-toggle="modal" data-target="#uiModal_4"><i class="fa fa-pencil" aria-hidden="true"></i></a></b>
                    </div>
                    <div class="driver-profile-info">
                        <h3><? if ($_SESSION['sess_user'] == 'driver') { echo $generalobj->cleanall(htmlspecialchars($db_user[0]['vName'] . " " . $db_user[0]['vLastName'])); } ?></h3>
                        <p><?= $db_user[0]['vEmail'] ?></p>
                        <p><?php if (!empty($db_user[0]['vPhone'])) { ?> (+<?= $db_user[0]['vCode'] ?>) <?= $db_user[0]['vPhone'] ?><?php } ?></p>
                        <? if ($REFERRAL_SCHEME_ENABLE == 'Yes') { ?>
                            <p> <?php echo $langage_lbl['LBL_MY_REFERAL_CODE']; ?>&nbsp; : <?= $db_user[0]['vRefCode']; ?></p>
                        <?php } ?>
                        <span><a id="show-edit-profile-div"><i class="fa fa-pencil" aria-hidden="true"></i><?= $langage_lbl['LBL_PROFILE_EDIT']; ?></a></span>
                    </div>
                </div>
                <!-- form -->
                <div class="edit-profile-detail-form" id="show-edit-profile" style="display: none;">
                    <form id="frm1" method="post" action="javascript:void(0);" >
                                <input  type="hidden" class="edit" name="action" value="login">
                                <div class="show-edit-profile-part">
                                    <span>
                                        <label><?= $langage_lbl['LBL_PROFILE_YOUR_EMAIL_ID']; ?> <span class="red">*</span></label>
                                        <input type="hidden" name="uid" id="u_id1" value="<?= $_SESSION['sess_iUserId']; ?>">
                                        <input type="hidden" name="user_type" id="user_type" value="<?= $_SESSION['sess_user']; ?>">
                                        <input type="email" id="in_email" class="edit-profile-detail-form-input" placeholder="<?= $langage_lbl['LBL_PROFILE_YOUR_EMAIL_ID']; ?>" value = "<?= $db_user[0]['vEmail'] ?>" name="email" <?= isset($db_user[0]['vEmail']) ? '' : ''; ?>  required>
                                        <div class="required-label" id="emailCheck"></div>
                                    </span>











                                    <?php if ($_SESSION['sess_user'] == 'driver') { ?>
                                        <span>
                                            <label><?= $langage_lbl['LBL_SIGN_UP_FIRST_NAME_HEADER_TXT']; ?><span class="red">*</span></label>
                                            <input type="text" class="edit-profile-detail-form-input" placeholder="<?= $langage_lbl['LBL_YOUR_FIRST_NAME']; ?>" value = "<?= $generalobj->cleanall(htmlspecialchars($db_user[0]['vName'])); ?>" name="name" required>
                                        </span>
                                        <span>
                                            <label><?= $langage_lbl['LBL_YOUR_LAST_NAME']; ?><span class="red">*</span></label>
                                            <input type="text" class="edit-profile-detail-form-input" placeholder="<?= $langage_lbl['LBL_YOUR_LAST_NAME']; ?>" value = "<?= $generalobj->cleanall(htmlspecialchars($db_user[0]['vLastName'])); ?>" name="lname" required>
                                        </span>
                                        <? } else if ($_SESSION['sess_user'] == 'company') {?>
                                        <span>
                                            <label><?= $langage_lbl['LBL_COMPANY_SIGNUP']; ?><span class="red">*</span></label>
                                            <input type="text" class="edit-profile-detail-form-input"  placeholder="<?= $langage_lbl['LBL_PROFILE_Company_name']; ?>" value = "<?= $generalobj->cleanall(htmlspecialchars($db_user[0]['vCompany'])); ?>" name="vCompany" required >
                                        </span>
                                    <? } ?>
  
                                    






                                    <span>
                                        <label><?= $langage_lbl['LBL_SELECT_CONTRY']; ?><span class="red">*</span></label>
                                        <select class="custom-select-new vCountry" name = 'vCountry' onChange="changeCode(this.value);" required>
                                            <option value="">--select--</option>
                                            <? for ($i = 0; $i < count($db_country); $i++) { ?>
                                                <option value = "<?= $db_country[$i]['vCountryCode'] ?>" <? if ($db_user[0]['vCountry'] == $db_country[$i]['vCountryCode']) { ?>selected<? } ?>><?= $db_country[$i]['vCountry'] ?></option>
                                            <? } ?>
                                        </select>
                                        <div class="required-label" id="vCountryCheck"></div>
                                    </span>
                                    <span>
                                        <label><?= $langage_lbl['LBL_Phone_Number']; ?><span class="red">*</span></label>
                                        <input type="text" class="input-phNumber1" id="code" name="vCode" value="<?= $db_user[0]['vCode'] ?>" readonly >
                                        <input name="phone" id="phone" type="text" value="<?= $db_user[0]['vPhone'] ?>" class="edit-profile-detail-form-input input-phNumber2" placeholder="<?= $langage_lbl['LBL_Phone_Number']; ?>"  title="Please enter proper phone number." required/>
                                        <!-- pattern="[0-9]{1,}" -->
                                    </span>
                                    
                                    <?php if ($_SESSION['sess_user'] == 'company') { ?>
                                    <span>
                                        <label><?= $langage_lbl['LBL_VAT_NUMBER_SIGNUP']; ?></label>
                                        <input type="text" class="form-control" name="vVatNum"  id="vVatNum" value="<?= $db_user[0]['vVat']; ?>" placeholder="VAT Number" >
                                    </span>
                                    <?php } ?>
                                    <?php if ($_SESSION['sess_user'] == 'driver') { ?>
                                    <span>
                                        <label><?= $langage_lbl['LBL_SELECT_CURRENCY']; ?><span class="red">*</span></label>
                                        <select class="custom-select-new vCurrencyDriver" name = 'vCurrencyDriver' required>
                                            <option value="">--select--</option>
                                            <? for ($i = 0; $i < count($db_currency); $i++) { ?>
                                            <option value = "<?= $db_currency[$i]['vName'] ?>" <? if ($db_user[0]['vCurrencyDriver'] == $db_currency[$i]['vName']) { ?>selected<? } ?>><?= $db_currency[$i]['vName'] ?></option>
                                            <? } ?>
                                        </select>
                                        <div class="required-label" id="vCurrencyDriverCheck"></div>
                                    </span>
                                    <?php } ?>
                                    
                                    <?php if ($_SESSION['sess_user'] == 'driver' && ($APP_TYPE == 'UberX' || $APP_TYPE == 'Ride-Delivery-UberX') && ONLYDELIVERALL != 'Yes') { ?>
                                    <span>
                                        <label><?= $langage_lbl['LBL_PROFILE_DESCRIPTION']; ?></label>
                                        <textarea name="tProfileDescription" rows="3" cols="40" class="form-control" id="tProfileDescription" placeholder="<?= $langage_lbl['LBL_PROFILE_DESCRIPTION']; ?>"><?= $db_user[0]['tProfileDescription'] ?></textarea>
                                    </span>
                                    <?php } ?>

                                    <p class="save-button11">
                                        <input name="save" id="validate_submit" type="submit" value="<?= $langage_lbl['LBL_Save']; ?>" class="save-but" > <!-- onClick="return validate_email_submit('login')" -->
                                        <input name="" id="hide-edit-profile-div" type="button" value="<?= $langage_lbl['LBL_BTN_PROFILE_CANCEL_TRIP_TXT']; ?>" class="cancel-but">
                                    </p>

                                    <div style="clear:both;"></div>
                                </div>
                            </form>
                        </div>

                        <!-- from -->
                        <div class="detail-driver driver-profile-mid-part" >
                            <ul >
                                <li class='driver-profile-mid-part-details'>
                                    <div class="driver-profile-mid-inner">
                                        <div class="profile-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                        <h3><?= $langage_lbl['LBL_PROFILE_ADDRESS']; ?></h3>
                                        <p><?php echo $generalobj->cleanall(htmlspecialchars($db_user[0]['vCaddress'])); ?></p>
                                        <span><a id="show-edit-address-div" class="hide-address-div hidev"><i class="fa fa-pencil" aria-hidden="true"></i><?= $langage_lbl['LBL_PROFILE_EDIT']; ?></a></span>
                                    </div>
                                </li>
                                <li class='driver-profile-mid-part-details'>
                                    <div class="driver-profile-mid-inner-a">
                                        <div class="profile-icon"><i class="fa fa-unlock-alt" aria-hidden="true"></i></div>
                                        <h3><?= $langage_lbl['LBL_PROFILE_PASSWORD_LBL_TXT']; ?></h3>
                                        <span><a id="show-edit-password-div" class="hide-password-div hidev"><i class="fa fa-pencil" aria-hidden="true"></i><?= $langage_lbl['LBL_PROFILE_EDIT']; ?></a></span>
                                    </div>
                                </li>
                                <li class='driver-profile-mid-part-details'>
                                    <div class="driver-profile-mid-inner">
                                        <div class="profile-icon"><i class="fa fa-language" aria-hidden="true"></i></div>
                                        <h3><?= $langage_lbl['LBL_PROFILE_LANGUAGE_TXT']; ?></h3>
                                        <p><?= $lang_user ?></p>
                                        <span><a id="show-edit-language-div" class="hide-language-div hidev"><i class="fa fa-pencil" aria-hidden="true"></i><?= $langage_lbl['LBL_PROFILE_EDIT']; ?></a></span>
                                    </div>
                                </li>
                                 
                                <li class='driver-profile-mid-part-details'>
                                    <div class="driver-profile-mid-inner">
                                        <div class="profile-icon"><i class="fa fa-bank" aria-hidden="true"></i></div>
                                        <h3><?= $langage_lbl['LBL_BANK_DETAILS_TXT']; ?></h3>
                                        <p><?= $db_user[0]['vBankName'] ?></p>
                                        <span><a id="show-edit-bankdetail-div" class="hide-bankdetail-div hidev"><i class="fa fa-pencil" aria-hidden="true"></i><?= $langage_lbl['LBL_PROFILE_EDIT']; ?></a></span>
                                    </div>
                                </li>
                                 
                            </ul>
                        </div>

                        <!-- Address form -->
                        <div class="profile-Password showV" id="show-edit-address" style="display: none;">
                            <form id = "frm2" method = "post" onsubmit ="return editPro('address')">
                                <p class="address-pointer" ><img src="assets/img/pas-img1.jpg" alt=""></p>
                                <h3><i class="fa fa-map-marker" aria-hidden="true"></i><?= $langage_lbl['LBL_PROFILE_ADDRESS']; ?></h3>
                                <input  type="hidden" class="edit" name="action" value="address">
                                <div class="profile-address-part">
                                    <span>
                                        <label><?= $langage_lbl['LBL_ADDRESS_SIGNUP'] ?><?php if ($_SESSION['sess_user'] == 'company') { ?><span class="red">*</span><? } ?></label>
                                        <input type="text" class="profile-address-input" placeholder="<?= $langage_lbl['LBL_PROFILE_ADDRESS']; ?> 1" value="<?= $generalobj->cleanall(htmlspecialchars($db_user[0]['vCaddress'])); ?>" name="address1"  <?php if ($_SESSION['sess_user'] == 'company') { ?>required<? } ?> >
                                    </span>
                                    <span>
                                        <label><?= $langage_lbl['LBL_COUNTRY_TXT'] ?><span class="red">*</span></label>
                                        <select class="form-control" name = 'vCountry' id="vCountry" onChange="setState(this.value, '');" required>
                                            <option value="">Select</option>
                                    
                                            <? for ($i = 0; $i < count($db_country); $i++) { ?>
                                            <option  <? if ($db_user[0]['vCountry'] == $db_country[$i]['vCountryCode']) { ?>selected<? } ?> value = "<?= $db_country[$i]['vCountryCode'] ?>"><?= $db_country[$i]['vCountry'] ?></option>
                                            <? } ?>
                                    
                                        </select>
                                        <div class="required-label" id="vCountryCheck"></div>
                                    </span>
                                    <span>
                                        <label><?= $langage_lbl['LBL_STATE_TXT'] ?> </label>
                                        <select class="form-control" name = 'vState' id="vState" onChange="setCity(this.value, '');" >
                                            <option value="">Select</option>
                                        </select>
                                    </span>
                                    
                                    <?php if($SHOW_CITY_FIELD=='Yes') { ?>
                                    <span>
                                        <label><?= $langage_lbl['LBL_CITY_TXT'] ?></label>
                                        <select class="form-control" name = 'vCity' id="vCity"  >
                                            <option value="">Select</option>
                                        </select>
                                    </span> 
                                    <?php } ?>

                                    <span>
                                        <label>Post Code<span class="red">*</span></label>
                                        <input type="text" class="profile-address-input" placeholder="<?= $langage_lbl['LBL_ZIP_CODE']; ?>" value="<?= $db_user[0]['vZip'] ?>" name="vZipcode" <?php if ($_SESSION['sess_user'] == 'company') { ?> required <? } ?>></span>
                                </div>
                                <span>
                                    <b>
                                        <input name="save" type="submit" value="<?= $langage_lbl['LBL_Save']; ?>" class="profile-Password-save">
                                        <input name="" id="hide-edit-address-div" type="button" value="<?= $langage_lbl['LBL_BTN_PROFILE_CANCEL_TRIP_TXT']; ?>" class="profile-Password-cancel">
                                    </b>
                                </span>
                                <div style="clear:both;"></div>
                            </form>
                        </div>
                        <!-- End: Address Form -->

                        <!-- Password form -->
                        <div class="profile-Password showV" id="show-edit-password" style="display: none;">
                            <form id="frm3" method="post" action="javascript:void(0);" onSubmit="return <?= ($db_user[0]['vFbId'] >= 0 && $db_user[0]['vPassword'] != "") ? 'validate_password()' : 'validate_password_fb()'; ?>">
                                <p class="password-pointer"><img src="assets/img/pas-img1.jpg" alt=""></p>
                                <h3><i class="fa fa-unlock-alt" aria-hidden="true"></i><?= $langage_lbl['LBL_PROFILE_PASSWORD_LBL_TXT']; ?></h3>
                                <input type="hidden" name="action" id="action" value = "pass"/>
                                <div class="row">
                                    
                                    <?php if ($db_user[0]['vFbId'] >= 0 && $db_user[0]['vPassword'] != "") { ?>
                                    <div class="col-md-4">
                                        <span>
                                            <label><?= $langage_lbl['LBL_CURR_PASS_HEADER']; ?><span class="red">*</span></label>
                                            <input type="password" class="input-box" placeholder="<?= $langage_lbl['LBL_CURR_PASS_HEADER']; ?>" name="cpass" id="cpass" onkeyup="nospaces(this)"  required>
                                        </span>
                                    </div>
                                    <?php } ?>
                                    
                                    <div class="col-md-4">
                                        <span>
                                            <label><?= $langage_lbl['LBL_NEW_PASSWORD_TXT']; ?><span class="red">*</span> </label>
                                            <input type="password" class="input-box" placeholder="<?= $langage_lbl['LBL_UPDATE_PASSWORD_HEADER_TXT']; ?>" name="npass" id="npass" onkeyup="nospaces(this)"  required>
                                        </span>
                                    </div>
                                    <div class="col-md-4">
                                        <span>
                                            <label><?= $langage_lbl['LBL_Confirm_New_Password']; ?><span class="red">*</span></label>
                                            <input type="password" class="input-box" placeholder="<?= $langage_lbl['LBL_Confirm_New_Password']; ?>" name="ncpass" id="ncpass" onkeyup="nospaces(this)"  required>
                                        </span>
                                    </div>
                                </div>
                                <div class="btn-block">
                                    <input name="save" type="submit" value="<?= $langage_lbl['LBL_Save']; ?>" class="profile-Password-save">
                                    <input name="" id="hide-edit-password-div" type="button" value="<?= $langage_lbl['LBL_BTN_PROFILE_CANCEL_TRIP_TXT']; ?>" class="profile-Password-cancel">
                                </div>
                                <div style="clear:both;"></div>
                            </form>
                        </div>
                        <!-- End: Password Form -->

                        <!-- Language form -->
                        <div class="profile-Password showV" id="show-edit-language" style="display: none;">
                            <form id="frm4" method = "post">
                                <p class="language-pointer"><img src="assets/img/pas-img1.jpg" alt=""></p>
                                <h3><i class="fa fa-language" aria-hidden="true"></i><?= $langage_lbl['LBL_PROFILE_LANGUAGE_TXT']; ?></h3>
                                <input type="hidden" value= "lang1" name="action">

                                <div class="edit-profile-detail-form-password-inner profile-language-part">
                                    <span>
                                        <label><?= $langage_lbl['LBL_PROFILE_SELECT_LANGUAGE']; ?></label>
                                        <select name="lang1" class="custom-select-new profile-language-input">
                                            <?php for ($i = 0; $i < count($db_lang); $i++) { ?>
                                            <option value="<?= $db_lang[$i]['vCode'] ?>" <? if ($db_user[0]['vLang'] == $db_lang[$i]['vCode']) { ?> selected <? } ?> ><? echo $db_lang[$i]['vTitle']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </span>
                                </div>

                                <div class="btn-block">
                                    <input name="save" type="button" value="<?= $langage_lbl['LBL_Save']; ?>" class="profile-Password-save" onClick="editProfile('lang');">
                                    <input name="" id="hide-edit-language-div" type="button" value="<?= $langage_lbl['LBL_BTN_PROFILE_CANCEL_TRIP_TXT']; ?>" class="profile-Password-cancel">
                                </div>
                                <div style="clear:both;"></div>
                            </form>
                        </div>
                        <!-- End: Language Form -->

                        <!-- bank detail -->
                        <?php if ($_SESSION['sess_user'] == 'driver') { ?>

                        <div class="profile-Password showV" id="show-edit-bankdeatil" style="display: none;">
                            <form id = "frm6" method = "post" onsubmit ="return editPro('bankdetail')">
                                <p class="bankdeail-pointer"><img src="assets/img/pas-img1.jpg" alt=""></p>
                                <h3><i class="fa fa-bank" aria-hidden="true"></i><?= $langage_lbl['LBL_BANK_DETAILS_TXT']; ?></h3>
                                <input  type="hidden" class="edit" name="action" value="bankdetail">
                                <div class="profile-address-part">
                                    <span>
                                        <label><?= $langage_lbl['LBL_PAYMENT_EMAIL_TXT']; ?><span class="red">*</span></label>
                                        <input type="email" class="profile-address-input" placeholder="<?= $langage_lbl['LBL_PAYMENT_EMAIL_TXT']; ?>" value="<?= $db_user[0]['vPaymentEmail'] ?>" name="vPaymentEmail" required>
                                    </span>
                                    <span>
                                        <label><?= $langage_lbl['LBL_PROFILE_BANK_HOLDER_TXT']; ?>  </label>
                                        <input type="text" class="profile-address-input" placeholder="<?= $langage_lbl['LBL_ACCOUNT_HOLDER_NAME']; ?>" value="<?= $db_user[0]['vBankAccountHolderName'] ?>" name="vBankAccountHolderName" ></span>
                                    <span>
                                        <label><?= $langage_lbl['LBL_ACCOUNT_NUMBER']; ?></label>
                                        <input type="text" class="profile-address-input" placeholder="<?= $langage_lbl['LBL_ACCOUNT_NUMBER']; ?>" value="<?= $db_user[0]['vAccountNumber'] ?>" name="vAccountNumber">
                                    </span>
                                    <span>
                                        <label><?= $langage_lbl['LBL_BANK_NAME']; ?> </label>
                                        <input type="text" class="profile-address-input" placeholder="<?= $langage_lbl['LBL_NAME_OF_BANK']; ?>" value="<?= $db_user[0]['vBankName'] ?>" name="vBankName">
                                    </span>
                                    <span>
                                        <label><?= $langage_lbl['LBL_BANK_LOCATION']; ?></label>
                                        <input type="text" class="profile-address-input" placeholder="<?= $langage_lbl['LBL_BANK_LOCATION']; ?>" value="<?= $db_user[0]['vBankLocation'] ?>" name="vBankLocation" >
                                    </span>
                                    <span>
                                        <label><?= $langage_lbl['LBL_BIC_SWIFT_CODE']; ?></label>
                                        <input type="text" class="profile-address-input" placeholder="<?= $langage_lbl['LBL_BIC_SWIFT_CODE']; ?>" value="<?= $db_user[0]['vBIC_SWIFT_Code'] ?>" name="vBIC_SWIFT_Code" >
                                    </span>
                                </div>
                                <span>
                                    <b>
                                        <input name="save" type="submit" value="<?= $langage_lbl['LBL_Save']; ?>" class="profile-Password-save">
                                        <input name="" id="hide-edit-bankdetail-div" type="button" value="<?= $langage_lbl['LBL_BTN_PROFILE_CANCEL_TRIP_TXT']; ?>" class="profile-Password-cancel">
                                    </b>
                                </span>
                                <div style="clear:both;"></div>
                            </form>
                        </div>
                        <?php } if ($APP_TYPE == 'UberX') { $class_name = 'driver-profile-bottom-part required-documents-bottom-part two-part-document'; } else { $class_name = 'driver-profile-bottom-part required-documents-bottom-part'; } ?>
                        <!-- end bank detail -->
                        <? if ($SITE_VERSION == "v5" && $_SESSION['sess_user'] == "driver") { ?>
                        <div class="<?php echo $class_name; ?>">
                            <h3><?= $langage_lbl['LBL_PREFERENCES_TEXT'] ?></h3>
                            <p>
                                <div class="driver-profile-info-aa col-md-5">
                                <? foreach ($data_driver_pref as $val) { ?>
                                    <img data-toggle="tooltip" class="borderClass-aa border_class-bb" title="<?= $val['pref_Title'] ?>" src="<?= $tconfig["tsite_upload_preference_image_panel"] . $val['pref_Image'] ?>">
                                <? } ?>
                                </div>
                                <span class="col-md-5">
                                    <a href="preferences.php" id="show-edit-language-div" class="hide-language">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                        <?= $langage_lbl['LBL_PROFILE_EDIT'] ?>
                                    </a>
                                </span>
                            </p>
                        </div>
                        <? } ?>
                    
                        <?php if ($count_all_doc != 0) { ?>

                            <div class="<?php echo $class_name; ?>">
                                <h3><?= $langage_lbl['LBL_REQUIRED_DOCS']; ?></h3>
                                <div class="profile-req-doc driver-document-action-page">
                                    <div class="profile-req-doc-inner pro-required">
                                        <?php for ($i = 0; $i < $count_all_doc; $i++) { $etypeName = $db_userdoc[$i]['eType'];  ?>
                                            <div class="panel panel-default upload-clicking">
                                                <input  type="hidden" id="ex_status" value="<?php echo $db_userdoc[$i]['ex_status']; ?>">
                                                <div class="panel-heading">
                                                    <div><?php echo $db_userdoc[$i]['d_name']; ?></div>
                                                </div>
                                                <input type="hidden" id="doc_id" value="<?php $db_userdoc[$i]['doc_file']; ?>">
                                                <div class="panel-body">
                                                    <label>
                                                        <?php if ($db_userdoc[$i]['doc_file'] != '') { ?>
                                                            <?php
                                                                $file_ext = $generalobj->file_ext($db_userdoc[$i]['doc_file']);
                                                                if ($file_ext == 'is_image') { 
                                                                    $path = $tconfig["tsite_upload_driver_doc"]; ?><a href="<?= $path . '/' . $_SESSION['sess_iUserId'] . '/' . $db_userdoc[$i]['doc_file'] ?>" target="_blank"><img src = "<?= $path . '/' . $_SESSION['sess_iUserId'] . '/' . $db_userdoc[$i]['doc_file'] ?>" style="width:200px;cursor:pointer;" alt ="<?= $db_userdoc[$i]['d_name']; ?> Image" /></a>
                                                                <?php } else { 
                                                                    $tconfig_new = $tconfig["tsite_upload_driver_doc"]; ?>
                                                                    <p><a href="<?= $tconfig_new . '/' . $_SESSION['sess_iUserId'] . '/' . $db_userdoc[$i]['doc_file'] ?>" target="_blank"><?php echo $db_userdoc[$i]['d_name']; ?></a></p>
                                                                <?php } ?>
                                                            <?php
                                                        } else {
                                                            echo '<p>' . $db_userdoc[$i]['d_name'] . " " . $langage_lbl['LBL_NOT_FOUND'] . '</p>';
                                                        } ?>
                                                    </label>
                                                    <br/>
                                                    <b>
                                                        <button class="btn btn-info" data-toggle="modal" data-target="#uiModal" id="custId"  onClick="setModel001('<?php echo $db_userdoc[$i]['masterid']; ?>')" >
                                                            <?php
                                                            if ($db_userdoc[$i]['doc_file'] != '') {
                                                                echo $db_userdoc[$i]['d_name'];
                                                            } else {
                                                                echo $db_userdoc[$i]['d_name'];
                                                            } ?>
                                                        </button>
                                                    </b>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="col-lg-12">
                                    <div class="modal fade" id="uiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-content image-upload-1">
                                        <div class="fetched-data"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="modal fade" id="uiModal_4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-content image-upload-1 popup-box3">
                            <div class="upload-content">
                                <h4><?= $langage_lbl['LBL_PROFILE_PICTURE']; ?></h4>
                                <form class="form-horizontal frm9" id="frm9" method="post" enctype="multipart/form-data" action="../upload_doc.php" name="frm9">
                                    <input type="hidden" name="action" value ="photo"/>
                                    <input type="hidden" name="img_path" value ="
                                    <?php echo $tconfig["tsite_upload_images_driver_path"]; ?>"/>
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-preview thumbnail">
                                                    <?php    
                                                        $img_path = $tconfig["tsite_upload_images_driver"];
                                                        $profileImgpath = $tconfig["tsite_upload_images_driver_path"];
                               
                                                        if (($db_user[0]['vImage'] == 'NONE' || $db_user[0]['vImage'] == '') || !file_exists($profileImgpath. '/' . $_SESSION['sess_iUserId'] . '/2_' . $db_user[0]['vImage'])) { ?>
                                                            <img src="assets/img/profile-user-img.png" alt="">
                                                        <? } else { ?>
                                                            <img src = "<?= $img_path . '/' . $_SESSION['sess_iUserId'] . '/2_' . $db_user[0]['vImage'] ?>" style="height:150px;"/>
                                                    <?php } ?>
                                                </div>
                                                <div>
                                                    <span class="btn btn-file btn-success"><span class="fileupload-new"><?= $langage_lbl['LBL_UPLOAD_PHOTO']; ?></span><span class="fileupload-exists"><?= $langage_lbl['LBL_CHANGE']; ?></span>
                                                        <input type="file" name="photo"/>
                                                        <input type="hidden" name="photo_hidden"  id="photo" value="<?php echo ($db_user[0]['vImage'] != "") ? $db_user[0]['vImage'] : ''; ?>" />
                                                    </span>
                                                    <a href="#" class="btn btn-danger" id="cancel-btn" data-dismiss="fileupload">X</a>
                                                </div>
                                                <div class="upload-error"><span class="file_error"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="submit" class="save" name="save" value="<?= $langage_lbl['LBL_Save']; ?>"><input type="button" class="cancel" data-dismiss="modal" name="cancel" value="<?= $langage_lbl['LBL_BTN_PROFILE_CANCEL_TRIP_TXT']; ?>">
                                </form>
                                <div style="clear:both;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content modal-content-profile">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="H2"><?= $langage_lbl['LBL_NOTE_FOR_DEMO']; ?></h4>
                                </div>
                                <div class="modal-body">
                                    <form role="form" name="verification" id="verification">
                                        <p><?= $langage_lbl['LBL_SINCE_IT_IS_DEMO_VERSION_ADDVEHICLE']; ?></p>
                                        <p><?= $langage_lbl['LBL_HOWEVER_IN_REAL_SYSTEM_DRIVER']; ?></p>
                                        <p class="help-block" id="verification_error"></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer part -->
                <?php include_once '../footer/footer_home.php'; ?>
                <!-- footer part end -->
                <div style="clear:both;"></div>
            </div>
            <!-- home page end-->
            <!-- Footer Script -->
            <?php include_once '../top/footer_script.php';
            $lang = get_langcode($_SESSION['sess_lang']); ?>
            <link rel="stylesheet" href="../assets/plugins/datepicker/css/datepicker.css" />
            <style>
                .upload-error .help-block {
                    color:#b94a48;
                }
            </style>
        <script src="../assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>
        <link rel="stylesheet" href="../assets/validation/validatrix.css" />
        <script type="text/javascript" src="../assets/plugins/jasny/js/bootstrap-fileupload.js"></script>

        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $tconfig["tsite_url_main_admin"] ?>css/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">
        <script type="text/javascript" src="<?php echo $tconfig["tsite_url_main_admin"] ?>js/moment.min.js"></script>
        <script type="text/javascript" src="<?php echo $tconfig["tsite_url_main_admin"] ?>js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="<?php echo $tconfig["tsite_url_main_admin"] ?>js/validation/jquery.validate.min.js" ></script>
    
        
        <script type="text/javascript" src="assets/js/validation/additional-methods.js" ></script>
     
        <script type="text/javascript">
            function nospaces(t) {
                if (t.value.match(/\s/g)) {
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
                    if (selectedOption != "" || selectedOption1 != "") {
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
                    if (selectedOption != "" || selectedOption1 != "" || selectedOption2 != "") {
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
                    if (selectedOption != "") {
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

                var user = '<?= SITE_TYPE; ?>';
                if (user == 'Demo') {
                    var a = '<?= $new; ?>';
                    if (a != undefined && a != '') {
                        $('#formModal').modal('show');
                    }
                    //$('#formModal').modal('show');
                }

                $('[data-toggle="tooltip"]').tooltip();

                $('#cancel-btn').on('click', function () {
                    $('#photo').val('');
                });

                $('.frm9').validate({
                    ignore: 'input[type=hidden]',
                    errorClass: 'help-block',
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
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
                                depends: function (element) {
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
                            required: '<?= addslashes($langage_lbl['LBL_UPLOAD_IMG']); ?>',
                            extension: '<?= addslashes($langage_lbl['LBL_UPLOAD_IMG_ERROR']); ?>'
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
                    url: '../driver_document_fetch.php', //Here you will fetch records
                    data: 'rowid=' + idVal + '-' + id + '-' + user, //Pass $id
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
                } else {
                    $('#npass').val('');
                    $('#ncpass').val('');
                    bootbox.dialog({
                        message: "<h3>" + err + "</h3>",
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
                    err += "<?= addslashes($langage_lbl['LBL_CURRENT_PASS_MSG']); ?><br />";
                }
                if (npass == '') {
                    err += "<?= addslashes($langage_lbl['LBL_NEW_PASS_MSG']); ?><br />";
                }
                if (npass.length < 6) {
                    err += "<?= addslashes($langage_lbl['LBL_PASS_LENGTH_MSG']); ?><br />";
                }
                if (npass.length > 16) {
                    err += "<?= addslashes($langage_lbl['LBL_PASS__MAX_LENGTH_MSG']); ?><br />";
                }
                if (ncpass == '') {
                    err += "<?= addslashes($langage_lbl['LBL_REPASS_MSG']); ?><br />";
                }

                if (err == "") {
                    if (npass != ncpass)
                        err += "<?= addslashes($langage_lbl['LBL_PASS_NOT_MATCH']); ?><br />";
                }
                if (err == "")
                {
                    $.ajax({
                        type: "POST",
                        url: '../ajax_check_password_a.php',
                        data: {cpass: cpass},
                        success: function (dataHtml)
                        {
                            if (dataHtml.trim() == 1) {
                                editProfile('pass');
                                return false;
                            } else {
                                err += "<?= addslashes($langage_lbl['LBL_INCCORECT_CURRENT_PASS_ERROR_MSG']); ?><BR>";
                                $('#cpass').val('');
                                $('#npass').val('');
                                $('#ncpass').val('');
                                bootbox.dialog({
                                    message: "<h3>" + err + "</h3>",
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
                        message: "<h3>" + err + "</h3>",
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
                        if (data == '2' || data == '3') {
                            window.location = "profile.php?success=2&var_msg=" + data;
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

            function setCity(id, selected)
            {
                var fromMod = 'driver';
                var request = $.ajax({
                    type: "POST",
                    url: '../change_stateCity.php',
                    data: {stateId: id, selected: selected, fromMod: fromMod},
                    success: function (dataHtml)
                    {
                        $("#vCity").html(dataHtml);
                    }
                });
            }

            function setState(id, selected)
            {
                var fromMod = 'driver';
                var request = $.ajax({
                    type: "POST",
                    url: '../change_stateCity.php',
                    data: {countryId: id, selected: selected, fromMod: fromMod},
                    success: function (dataHtml)
                    {
                        $("#vState").html(dataHtml);
                        if (selected == '')
                            setCity('', selected);
                    }
                });
            }

            setState('<?php echo $db_user[0]['vCountry']; ?>', '<?php echo $db_user[0]['vState']; ?>');
            setCity('<?php echo $db_user[0]['vState']; ?>', '<?php echo $db_user[0]['vCity']; ?>');
        </script>
        <script type="text/javascript">
            user = '<?= $user ?>';
            var dataa = {};
            var selectedCountryCode = $("#vCountry").val();
            if (user == 'company') {
                dataa.iCompanyId = "<?= $_SESSION['sess_iUserId']; ?>";
            } else {
                dataa.iDriverId = "<?= $_SESSION['sess_iUserId']; ?>";
            }
            dataa.usertype = user;
            dataa.vCountry = selectedCountryCode;
            var errormessage;
            $('#frm1').validate({
                ignore: 'input[type=hidden]',
                errorClass: 'help-block error',
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    if (element.attr("name") == "vCurrencyDriver")
                        error.appendTo('#vCurrencyDriverCheck');
                    else if (element.attr("name") == "vCountry")
                        error.appendTo('#vCountryCheck');
                    else
                        error.insertAfter(element);
                },
                onkeyup: function (element, event) {
                    if (event.which === 9 && this.elementValue(element) === "") {
                        return;
                    } else {
                        this.element(element);
                    }
                },
                rules: {
                    email: {required: true, email: true,
                        remote: {
                            url: '../ajax_validate_email.php',
                            type: "post",
                            cache: false,
                            data: {
                                id: function (e) {
                                    return $('#in_email').val();
                                },
                                usr: function (e) {
                                    return user;
                                },
                                uid: function (e) {
                                    return $("#u_id1").val();
                                }
                            },
                            dataFilter: function (response) {
                                //response = $.parseJSON(response);
                                if (response == 'deleted') {
                                    errormessage = "<?= addslashes($langage_lbl['LBL_CHECK_DELETE_ACCOUNT']); ?>";
                                    return false;
                                } else if (response == 'false') {
                                    errormessage = "<?= addslashes($langage_lbl['LBL_EMAIL_EXISTS_MSG']); ?>";
                                    return false;
                                } else {
                                    return true;
                                }
                            },
                            async: false
                        }
                    },
                    name: {required: function (e) {
                            return $('input[name=user_type]').val() == 'driver';
                        }, minlength: function (e) {
                            if ($('input[name=user_type]').val() == 'driver') {
                                return 2;
                            } else {
                                return false;
                            }
                        }, maxlength: function (e) {
                            if ($('input[name=user_type]').val() == 'driver') {
                                return 30;
                            } else {
                                return false;
                            }
                        }},
                    lname: {required: function (e) {
                            return $('input[name=user_type]').val() == 'driver';
                        }, minlength: function (e) {
                            if ($('input[name=user_type]').val() == 'driver') {
                                return 2;
                            } else {
                                return false;
                            }
                        }, maxlength: function (e) {
                            if ($('input[name=user_type]').val() == 'driver') {
                                return 30;
                            } else {
                                return false;
                            }
                        }},
                    vCompany: {required: function (e) {
                            return $('input[name=user_type]').val() == 'company';
                        }, minlength: function (e) {
                            if ($('input[name=user_type]').val() == 'company') {
                                return 2;
                            } else {
                                return false;
                            }
                        }, maxlength: function (e) {
                            if ($('input[name=user_type]').val() == 'company') {
                                return 30;
                            } else {
                                return false;
                            }
                        }},
                    phone: {required: true, minlength: 3, digits: true,
                        remote: {
                            url: '../ajax_driver_mobile_new.php',
                            type: "post",
                            data: dataa,
                            dataFilter: function (response) {
                                //response = $.parseJSON(response);
                                if (response == 'deleted') {
                                    errormessage = "<?= addslashes($langage_lbl['LBL_PHONE_CHECK_DELETE_ACCOUNT']); ?>";
                                    return false;
                                } else if (response == 'false') {
                                    errormessage = "<?= addslashes($langage_lbl['LBL_PHONE_EXIST_MSG']); ?>";
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
                    email: {remote: function () {
                            return errormessage;
                        }},
                    vCompany: {
                        //required: 'Company Name is required.',
                        //minlength: 'Company Name at least 2 characters long.',
                        //maxlength: 'Please enter less than 30 characters.'
                    },
                    name: {
                        //required: 'First Name is required.',
                        //minlength: 'First Name at least 2 characters long.',
                        //maxlength: 'Please enter less than 30 characters.'
                    },
                    lname: {
                        //required: 'Last Name is required.',
                        //minlength: 'Last Name at least 2 characters long.',
                        //maxlength: 'Please enter less than 30 characters.'
                    },
                    phone: {
                        //minlength: 'Please enter at least three Number.', 
                        //digits: 'Please enter proper mobile number.', 
                        remote: function () {
                            return errormessage;
                        }}
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
