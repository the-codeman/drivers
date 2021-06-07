<?
include_once('../common.php');
include_once('../generalFunctions.php');
if ($WALLET_ENABLE == "No") {
    header('Location: ../index.php');
    exit;
}

$tbl_name = 'user_wallet';
$script = "Rider Wallet";
$generalobj->check_member_login();

// $abc = 'admin,rider';
$abc = 'driver';
$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$generalobj->setRole($abc,$url);
$action = (isset($_REQUEST['action']) ? $_REQUEST['action'] : '');
$type = (isset($_REQUEST['type']) ? $_REQUEST['type'] : '');
if (ucfirst($_SESSION['sess_user']) != $type) {
    header('Location: index.php');
    exit;
}
$ssql = '';
if ($action != '') {
    $startDate = $_REQUEST['startDate'];
    $endDate = $_REQUEST['endDate'];
    if ($startDate != '') {
        $ssql .= " AND DATE(u.dDate) >='" . $startDate . "'";
    }
    if ($endDate != '') {
        $ssql .= " AND DATE(u.dDate) <='" . $endDate . "'";
    }
}
 $sql = "SELECT u.vName, u.vLastName,t.tEndDate, t.iFare,t.fRatioPassenger,t.vCurrencyPassenger, d.iDriverId, t.vRideNo, t.tSaddress, d.vName AS name, d.vLastName AS lname,t.eCarType,t.iTripId,vt.vVehicleType
 FROM register_user u
 RIGHT JOIN trips t ON u.iUserId = t.iUserId
 LEFT JOIN register_driver d ON t.iDriverId = d.iDriverId
 LEFT JOIN vehicle_type vt ON vt.iVehicleTypeId = t.iVehicleTypeId
 WHERE u.iUserId = '".$_SESSION['sess_iUserId']."'".$ssql." ORDER BY t.iTripId DESC";

/* for Withdrawal Money Bank Details */
#echo "type = ".$type;
if ($type == 'Driver') {
    $sql = "SELECT * from register_driver where iDriverId='" . $_SESSION['sess_iUserId'] . "'";
    $db_driver = $obj->MySQLSelect($sql);
}
/* for Withdrawal Money Bank Details end */

$sql = "SELECT u.*,ru.vTimeZone from user_wallet as u LEFT JOIN register_user as ru on ru.iUserId=u.iUserId where u.iUserId='" . $_SESSION['sess_iUserId'] . "' AND u.eUserType = '" . $type . "' " . $ssql . " ORDER BY u.iUserWalletId ASC";

$db_trip = $obj->MySQLSelect($sql);

$user_available_balance = $generalobj->get_user_available_balance($_SESSION['sess_iUserId'], $type);
//$user_available_balance = get_user_available_balance($_SESSION['sess_iUserId'],$type);

$Today = Date('Y-m-d');
$tdate = date("d") - 1;
$mdate = date("d");
$Yesterday = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 1, date("Y")));
$curryearFDate = date("Y-m-d", mktime(0, 0, 0, '1', '1', date("Y")));
$curryearTDate = date("Y-m-d", mktime(0, 0, 0, "12", "31", date("Y")));
$prevyearFDate = date("Y-m-d", mktime(0, 0, 0, '1', '1', date("Y") - 1));
$prevyearTDate = date("Y-m-d", mktime(0, 0, 0, "12", "31", date("Y") - 1));
$currmonthFDate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - $tdate, date("Y")));
$currmonthTDate = date("Y-m-d", mktime(0, 0, 0, date("m") + 1, date("d") - $mdate, date("Y")));
$prevmonthFDate = date("Y-m-d", mktime(0, 0, 0, date("m") - 1, date("d") - $tdate, date("Y")));
$prevmonthTDate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - $mdate, date("Y")));
$monday = date('Y-m-d', strtotime('sunday this week -1 week'));
$sunday = date('Y-m-d', strtotime('saturday this week'));
$Pmonday = date('Y-m-d', strtotime('sunday this week -2 week'));
$Psunday = date('Y-m-d', strtotime('saturday this week -1 week'));



/************************Notifacation For Driver**********************************/
	
	$ssql = "SELECT vTitle as title, tDescription as description, tPublishdate as date, eUserType as user, eStatus as eStatus FROM newsfeed  WHERE eUserType ='driver' OR eUserType ='all' AND eStatus='Active'";
    $db_record = $obj->MySQLSelect($ssql);
    //for($i=0;$i<count($db_dtrip);$i++)
    $title = $db_record[0]['title']; 
    $description = $db_record[1]['description']; 
    $date = $db_record[0]['date']; 
    $user = $db_record[0]['user']; 
   // $available = $db_record[0]['available']; 
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
    <title>Yalla | My Wallet</title>
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
                                <div class="page-title">My Wallet</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">My Wallet</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>
                                        <form name="search" action="" method="post" onSubmit="return checkvalid()">
                                            <input type="hidden" name="action" value="search" />
                                            <span style="font-size: 1rem;" style="padding-bottom: 10rem;">
                                                <a onClick="return todayDate('dp4', 'dp5');"><?= $langage_lbl['LBL_MYTRIP_Today']; ?></a> | 
                                                <a onClick="return yesterdayDate('dFDate', 'dTDate');"><?= $langage_lbl['LBL_MYTRIP_Yesterday']; ?></a> | 
                                                <a onClick="return currentweekDate('dFDate', 'dTDate');"><?= $langage_lbl['LBL_MYTRIP_Current_Week']; ?></a> | 
                                                <a onClick="return previousweekDate('dFDate', 'dTDate');"><?= $langage_lbl['LBL_MYTRIP_Previous_Week']; ?></a> | 
                                                <a onClick="return currentmonthDate('dFDate', 'dTDate');"><?= $langage_lbl['LBL_MYTRIP_Current_Month']; ?></a> | 
                                                <a onClick="return previousmonthDate('dFDate', 'dTDate');"><?= $langage_lbl['LBL_MYTRIP_Previous Month']; ?></a> | 
                                                <a onClick="return currentyearDate('dFDate', 'dTDate');"><?= $langage_lbl['LBL_MYTRIP_Current_Year']; ?></a> | 
                                                <a onClick="return previousyearDate('dFDate', 'dTDate');"><?= $langage_lbl['LBL_MYTRIP_Previous_Year']; ?></a>
                                                <br>
                                                <br>
                                                <br>
                                            </span>
                                            <span style = "margin-left:.3rem;">
                                                <input type="text" id="dp4" name="startDate" placeholder="From" class="form-control-sm" value=""/>
                                                <input type="text" id="dp5" name="endDate" placeholder="To" class="form-control-sm" value=""/>
                                                <b><button class="btn btn-round btn-primary"><?= $langage_lbl['LBL_Search']; ?></button>
                                                <button onclick="reset();" class="btn btn-round btn-primary"><?= $langage_lbl['LBL_MYTRIP_RESET_TXT']; ?></button></b> 
                                            </span>
                                        </form>
                                    </header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
	                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
	                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="table-scrollable">
                                        <table id="tableExport" class="table table-striped table-bordered" style="width: 100%">
						    		        <thead>
						    		            <tr>
						    		                <th style=text-align:center width="20%"><?= $langage_lbl['LBL_DESCRIPTION']; ?></th>
                                                    <th style=text-align:center width="15%"><?= $langage_lbl['LBL_AMOUNT']; ?></th>
                                                    <th style=text-align:center width="10%"><?= "For"; ?></th>
                                                    <th style=text-align:center width="15%"><?= $langage_lbl['LBL_TRANSACTION_DATE']; ?></th>
                                                    <th style=text-align:center width="20%"><?= $langage_lbl['LBL_BALANCE_TYPE']; ?></th>
                                                    <th style=text-align:center width="10%"><?= $langage_lbl['LBL_BALANCE']; ?></th>
						    		            </tr>
						    		        </thead>
										    <tbody>
                                            <? if (count($db_trip) > 0) {
                                            $prevbalance = 0;
                                            for ($i = 0; $i < count($db_trip); $i++) {
                                            echo $direction_lng;
                                            $tDescription = $db_trip[$i]['tDescription'];
                                            $iBalance = $db_trip[$i]['iBalance'] * $db_trip[$i]['fRatio_' . $_SESSION["sess_vCurrency"]];
                                            $iTripId = $db_trip[$i]['iTripId'];
                                            if ($iTripId == "0")
                                            $iTripId = "-";
                                            if ($db_trip[$i]['eFor'] == "Deposit") {
                                            $eFor = $langage_lbl['LBL_DEPOSIT'];
                                            } else if ($db_trip[$i]['eFor'] == "Booking") {
                                            $eFor = $langage_lbl['LBL_BOOKING'];
                                            } else if ($db_trip[$i]['eFor'] == "Refund") {
                                            $eFor = $langage_lbl['LBL_REFUND'];
                                            } else if ($db_trip[$i]['eFor'] == "Withdrawl") {
                                            $eFor = $langage_lbl['LBL_WITHDRAWL'];
                                            } else if ($db_trip[$i]['eFor'] == "Charges") {
                                            $eFor = $langage_lbl['LBL_CHARGES_TXT'];
                                            } else if ($db_trip[$i]['eFor'] == "Referrer") {
                                            $eFor = $langage_lbl['LBL_DEPOSIT'];
                                            }
                                            if ($db_trip[$i]['eType'] == "Credit") {
                                            $eType = $langage_lbl['LBL_CREDIT'];
                                            } else if ($db_trip[$i]['eType'] == "Debit") {
                                            $eType = $langage_lbl['LBL_DEBIT'];
                                            }
                                            $systemTimeZone = date_default_timezone_get();
                                            if ($db_trip[$i]['dDate'] != "" && $db_trip[$i]['vTimeZone'] != "") {
                                            $dBookingDate = converToTz($db_trip[$i]['dDate'], $db_trip[$i]['vTimeZone'], $systemTimeZone);
                                            } else {
                                            $dBookingDate = $db_trip[$i]['dDate'];
                                            }
                                            //  if($direction_lng != ''){
                                            //$dDate = date('M-d-Y',strtotime($db_trip[$i]['dDate']));
                                            //}else{
                                            $dDate = $generalobj->DateTime1($dBookingDate, 'no');
                                            // }											 
                                            if ($db_trip[$i]['eType'] == "Credit") {
                                            $db_trip[$i]['currentbal'] = $prevbalance + ($iBalance);
                                            } else {
                                            $db_trip[$i]['currentbal'] = $prevbalance - ($iBalance);
                                            }
                                            $prevbalance = $db_trip[$i]['currentbal']; ?>
                                            <tr class="gradeA">
                                                <td style=text-align:left width="40%" data-order="<?= $db_trip[$i]['iUserWalletId'] ?>">
                                                    <?php
                                                    $pat = '/\#([^\"]*?)\#/';
                                                    preg_match($pat, $db_trip[$i]['tDescription'], $tDescription_value);
                                                    $tDescription_translate = $langage_lbl[$tDescription_value[1]];
                                                    $row_tDescription = str_replace($tDescription_value[0], $tDescription_translate, $db_trip[$i]['tDescription']);
                                                    echo $row_tDescription;
                                                    ?></td>
                                                <td style=text-align:left width="12%"><?= $generalobj->userwalletcurrencyFront(0, $iBalance, $_SESSION["sess_vCurrency"]); ?></td>
                                                <!-- <td style=text-align:center width="15%"><?= $iTripId; ?></td> -->
                                                <td style=text-align:center width="11%"><?= $eFor; ?></td>
                                                <td style=text-align:left width="20%"><?= $dDate; ?></td>
                                                <td style=text-align:center width="10%"><?= $eType; ?></td>
                                                <td style=text-align:left width="11%"><?= $final = $generalobj->userwalletcurrencyFront(0, $db_trip[$i]['currentbal'], $_SESSION["sess_vCurrency"]); ?></td>
                                            </tr>
                                            <? } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr class="gradeA odd ">
                                                    <td class="last_record_row" style="border-right:0px;"></td>
                                                    <td></td>
                                                    <td></td>
                                                    <!-- <td></td> -->
                                                    <td></td>
                                                    <td rowspan="1" colspan="1" align="right" style="font-weight:bold;text-align:right;"><?= $langage_lbl['LBL_WALLET_TOTAL_BALANCE']; ?></td>
                                                    <td rowspan="1" colspan="1" align="center" class="center"><?= $final; ?></td>
                                                </tr>
                                            </tfoot>	
                                            <? } else { ?>
                                            <!--  <tr class="odd">
                                            <td class="center" align="center" colspan="7">No Details found</td>
                                            </tr>	 -->
                                            <? } ?>
							    		</table>
									</div>
                                </div>
                            </div>
                            <div class="singlerow-login-log" style = "margin: auto">
                                <a href="javascript:void(0);" data-toggle="modal" class="btn btn-primary m-b-10" data-target="#uiModal"><?= $langage_lbl['LBL_WITHDRAW_REQUEST']; ?></a>
                                <!-- <div class="singlerow-login-log"><button type="" href="javascript:void(0);" onClick="javascript:check_skills_edit(); return false;" class="btn btn-primary m-b-10" data-toggle="modal" data-target="#newModal"><?=$langage_lbl['LBL_Send_transfer_Request'];?></button>
                                </div> -->
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="uiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Withdraw Request</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">                
                        <form class="form-horizontal" id="frm6" method="post" enctype="multipart/form-data" name="frm6">
                            <input type="hidden" id="action" name="action" value="send_equest">
                            <input type="hidden"  name="eTransRequest" id="eTransRequest" value="">
                            <input type="hidden"  name="iUserId" id="iUserId" value="<?= $_SESSION['sess_iUserId']; ?>">
                            <input type="hidden"  name="eUserType" id="eUserType" value="<?= $type; ?>">
                            <input type="hidden"  name="User_Available_Balance" id="User_Available_Balance" value="<?= $user_available_balance; ?>">
                            <div class="col-lg-13">
                                <div class="input-append" >
                                    <h5><b><?= $langage_lbl['LBL_WALLET_ACCOUNT_HOLDER_NAME']; ?></b></h5>
                                    <input type="text" name="vHolderName" id="vHolderName" class="form-control vHolderName"  <? if ($type == 'Driver') { ?>value="<?= $db_driver[0]['vBankAccountHolderName']; ?>"<? } ?>>
                                    <h5><b><?= $langage_lbl['LBL_WALLET_NAME_OF_BANK']; ?></b></h5>
                                    <input type="text" name="vBankName" id="vBankName" class="form-control vBankName" <? if ($type == 'Driver') { ?>value="<?= $db_driver[0]['vBankName']; ?>"<? } ?>>
                                    <h5><b><?= $langage_lbl['LBL_WALLET_ACCOUNT_NUMBER']; ?></b></h5>
                                    <input type="text" name="iBankAccountNo" id="iBankAccountNo" class="form-control iBankAccountNo" <? if ($type == 'Driver') { ?>value="<?= $db_driver[0]['vAccountNumber']; ?>"<? } ?>>
                                    <h5><b><?= $langage_lbl['LBL_WALLET_BIC_SWIFT_CODE']; ?></b></h5>
                                    <input type="text" name="BICSWIFTCode" id="BICSWIFTCode" class="form-control BICSWIFTCode" <? if ($type == 'Driver') { ?>value="<?= $db_driver[0]['vBIC_SWIFT_Code']; ?>"<? } ?>>
                                    <h5><b><?= $langage_lbl['LBL_WALLET_BANK_LOCATION']; ?></b></h5>
                                    <input type="text" name="vBankBranch" id="vBankBranch" class="form-control vBankBranch" <? if ($type == 'Driver') { ?>value="<?= $db_driver[0]['vBankLocation']; ?>"<? } ?>>
                                    <h5><b><?= $langage_lbl['LBL_ENTER_AMOUNT']; ?></b></h5>
                                    <input type="text" name="fAmount" id="fAmount" class="form-control fAmount" value="">
                                </div>
                            </div>
                            <br>
                            <input type="button" onClick="check_login_small();" id="withdrawal_request" class="btn btn-round btn-primary" name="<?= $langage_lbl['LBL_WALLET_save']; ?>" value="<?= $langage_lbl['LBL_BTN_SEND_TXT']; ?>">
                            <input type="button" class="btn btn-round btn-secondary" data-dismiss="modal" name="<?= $langage_lbl['LBL_WALLET_BTN_PROFILE_CANCEL_TRIP_TXT']; ?>" value="<?= $langage_lbl['LBL_WALLET_BTN_PROFILE_CANCEL_TRIP_TXT']; ?>">
                        </form>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>
        </div>            
        <? include_once('footer.php') ?>
    </div>
   
    <script type="text/javascript">
    
        $(document).ready(function () {
            
            $(".fAmount").keydown(function (e) {
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    (e.keyCode == 67 && e.ctrlKey === true) ||
                    (e.keyCode == 88 && e.ctrlKey === true) ||
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    return;
                }
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
            $("#dp4").datepicker({
                dateFormat: "yy-mm-dd",
                changeYear: true,
                changeMonth: true,
                yearRange: "-100:+10"
            });
            $("#dp5").datepicker({
                dateFormat: "yy-mm-dd",
                changeYear: true,
                changeMonth: true,
                yearRange: "-100:+10"
            });
            if ('<?= $startDate ?>' != '') {
                $("#dp4").val('<?= $startDate ?>');
                $("#dp4").datepicker('refresh');
            }                                                                        
            if ('<?= $endDate ?>' != '') {
                $("#dp5").val('<?= $endDate; ?>');
                $("#dp5").datepicker('refresh');
            }
            $('#dataTables-example').dataTable({
                fixedHeader: {
                    footer: true
                },
                "order": [[3, "asc"]],
                "aaSorting": []});
            });
            function todayDate(){
                $("#dp4").val('<?= $Today; ?>');
                $("#dp5").val('<?= $Today; ?>');
            }
            function reset() {
                location.reload();
            }
            function yesterdayDate(){
                $("#dp4").val('<?= $Yesterday; ?>');
                $("#dp5").val('<?= $Yesterday; ?>');
                $("#dp4").datepicker('refresh');
                $("#dp5").datepicker('refresh');
            }
            function currentweekDate(dt, df){
                $("#dp4").val('<?= $monday; ?>');
                $("#dp5").val('<?= $sunday; ?>');
                $("#dp4").datepicker('refresh');
                $("#dp5").datepicker('refresh');
            }
            function previousweekDate(dt, df){
                $("#dp4").val('<?= $Pmonday; ?>');
                $("#dp5").val('<?= $Psunday; ?>');
                $("#dp4").datepicker('refresh');
                $("#dp5").datepicker('refresh');
            }
            function currentmonthDate(dt, df){
                $("#dp4").val('<?= $currmonthFDate; ?>');
                $("#dp5").val('<?= $currmonthTDate; ?>');
                $("#dp4").datepicker('refresh');
                $("#dp5").datepicker('refresh');
            }
            function previousmonthDate(dt, df){
                $("#dp4").val('<?= $prevmonthFDate; ?>');
                $("#dp5").val('<?= $prevmonthTDate; ?>');
                $("#dp4").datepicker('refresh');
                $("#dp5").datepicker('refresh');
            }
            function currentyearDate(dt, df){
                $("#dp4").val('<?= $curryearFDate; ?>');
                $("#dp5").val('<?= $curryearTDate; ?>');
                $("#dp4").datepicker('refresh');
                $("#dp5").datepicker('refresh');
            }
            function previousyearDate(dt, df){
                $("#dp4").val('<?= $prevyearFDate; ?>');
                $("#dp5").val('<?= $prevyearTDate; ?>');
                $("#dp4").datepicker('refresh');
                $("#dp5").datepicker('refresh');
            }
            function checkvalid() {
                if ($("#dp5").val() < $("#dp4").val()) {
                    bootbox.dialog({
                    message: "<h4><?php echo addslashes($langage_lbl['LBL_FROM_TO_DATE_ERROR_MSG']); ?></h4>",
                    buttons: {
                        danger: {
                            label: "OK",
                            className: "btn-danger"
                        }
                    }
                });
                return false;
            }
        }
        function check_skills_edit() {
            y = getCheckCount(document.frmbooking);
            if (y > 0){
                $("#eTransRequest").val('Yes');
                document.frmbooking.submit();
            } else {
                alert("<?php echo addslashes($langage_lbl['LBL_SELECT_RIDE_FOR_TRANSFER_MSG']); ?>")
                return false;
            }
        }
        function check_login_small() {
            var maxamount = document.getElementById("User_Available_Balance").value;
            var requestamount = document.getElementById("fAmount").value;
            var vHolderName = document.getElementById("vHolderName").value;
            var vBankName = document.getElementById("vBankName").value;
            var iBankAccountNo = document.getElementById("iBankAccountNo").value;
            var BICSWIFTCode = document.getElementById("BICSWIFTCode").value;
            var vBankBranch = document.getElementById("vBankBranch").value;
            if (vHolderName == '') {
                alert("<?php echo addslashes($langage_lbl['LBL_ACCOUNT_HOLDER_NAME_MSG']); ?>");
                return false;
            }
            if (vBankName == '') {
                alert("<?php echo addslashes($langage_lbl['LBL_BANK_MSG']); ?>");
                return false;
            }
            if (iBankAccountNo == '') {
                alert("<?php echo addslashes($langage_lbl['LBL_ACCOUNT_NUM_MSG']); ?>");
                return false;
            }
            if (BICSWIFTCode == '') {
                alert("<?php echo addslashes($langage_lbl['LBL_BIC_SWIFT_CODE_MSG']); ?>");
                return false;
            }
            if (vBankBranch == '') {
                alert("<?php echo addslashes($langage_lbl['LBL_BANK_BRANCH_MSG']); ?>");
                return false;
            }
            if (requestamount == '') {
                alert("<?php echo addslashes($langage_lbl['LBL_WITHDRAW_AMT_MSG']); ?>");
                return false;
            }
            if (requestamount == 0) {
                alert("<?php echo addslashes($langage_lbl['LBL_WITHDRAW_AMT_ERROR']); ?>");
                return false;
            }
            $("#eTransRequest").val('Yes');
                if (vHolderName != "" && vBankName != "" && iBankAccountNo != "" && BICSWIFTCode != "" && vBankBranch != "" && requestamount != "") {
                    $("#withdrawal_request").val('Please wait ...').attr('disabled', 'disabled');
                    var request = $.ajax({
                    type: "POST",
                    url: 'user_withdraw_request.php',
                    data: $("#frm6").serialize(),
                    success: function (data){
                    if (data == 0){
                        var err = "<?php echo addslashes($langage_lbl['LBL_WITHDRAW_AMT_VALIDATION_MSG']); ?>";
                        bootbox.dialog({
                        message: "<h3>" + err + "</h3>",
                        buttons: {
                            danger: {
                                label: "Ok",
                                className: "btn-danger",
                                callback: function () {
                                    $("#withdrawal_request").val('Send').removeAttr('disabled');
                                }
                            },
                        }
                    });
                return false;
            } else if (data == 1){
                $('#uiModal').modal('hide');
                var err = "<?php echo addslashes($langage_lbl['LBL_WITHDRAW_AMT_SUCCESS_MSG']); ?>";
                bootbox.dialog({
                    message: "<h3>" + err + "</h3>",
                    buttons: {
                        danger: {
                            label: "Ok",
                            className: "btn-danger",
                            callback: function () {
                            $("#withdrawal_request").val('Send').removeAttr('disabled');
                            $('#uiModal #frm6')[0].reset();
                        }
                    },
                }
            });
            return true;
        }
    }
});
    request.fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
    }
    }
    function add_money_to_wallet() {
        var priceamount = document.getElementById("fAmountprice").value;
        if (priceamount == '') {
        alert("<?php echo addslashes($langage_lbl['LBL_WITHDRAW_AMT_MSG']); ?>");
        return false;
    }
        document.addmoney.submit();
    }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('[data-dismiss=modal]').on('click', function (e) {
                $('#uiModal #frm6')[0].reset();
            });
            $("[name='dataTables-example_length']").each(function () {
                $(this).wrap("<em class='select-wrapper'></em>");
                $(this).after("<em class='holder'></em>");
            });
            $("[name='dataTables-example_length']").change(function () {
                var selectedOption = $(this).find(":selected").text();
                $(this).next(".holder").text(selectedOption);
            }).trigger('change');
        })
    </script>


</body>
</html>