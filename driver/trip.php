<?
include_once('../common.php');
include_once('../generalFunctions.php');
$tbl_name = 'register_driver';
$script = "Trips";
$generalobj->check_member_login();
$abc = 'driver';
$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$generalobj->setRole($abc, $url);
$action = (isset($_REQUEST['action']) ? $_REQUEST['action'] : '');
$ssql = '';
if ($action != '') {
    $startDate = $_REQUEST['startDate'];
    $endDate = $_REQUEST['endDate'];
    if ($startDate != '') {
        $ssql .= " AND Date(t.tTripRequestDate) >='" . $startDate . "'";
    }
    if ($endDate != '') {
        $ssql .= " AND Date(t.tTripRequestDate) <='" . $endDate . "'"; 
    }
}
if ($_SESSION['sess_user'] == "driver") {
    $sql = "SELECT * FROM register_" . $_SESSION['sess_user'] . " WHERE iDriverId='" . $_SESSION['sess_iUserId'] . "'";
    $db_booking = $obj->MySQLSelect($sql);
    $sql = "SELECT fThresholdAmount, Ratio, vName, vSymbol FROM currency WHERE vName='" . $db_booking[0]['vCurrencyDriver'] . "'";
    $db_curr_ratio = $obj->MySQLSelect($sql);
} else {
    $sql = "SELECT * FROM register_" . $_SESSION['sess_user'] . " WHERE iUserId='" . $_SESSION['sess_iUserId'] . "'";
    $db_booking = $obj->MySQLSelect($sql);
    $sql = "SELECT fThresholdAmount, Ratio, vName, vSymbol FROM currency WHERE vName='" . $db_booking[0]['vCurrencyPassenger'] . "'";
    $db_curr_ratio = $obj->MySQLSelect($sql);
}
$tripcursymbol = $db_curr_ratio[0]['vSymbol'];
$tripcur = $db_curr_ratio[0]['Ratio'];
$tripcurname = $db_curr_ratio[0]['vName'];
$tripcurthholsamt = $db_curr_ratio[0]['fThresholdAmount'];
$deafultLang = $_SESSION['sess_lang'];
$sql = "SELECT t.*, u.vName, u.vLastName,t.tEndDate, t.tTripRequestDate, t.iActive, d.vAvgRating, t.iFare, d.iDriverId,t.fRatioDriver,t.vCurrencyDriver,t.fTripGenerateFare,t.fHotelCommision,t.iRentalPackageId, t.vRideNo, t.tSaddress,t.eType, t.eHailTrip, d.vName AS name, d.vLastName AS lname,t.eCarType,t.iTripId,vt.vVehicleType_" . $deafultLang . " as vVehicleType,vt.vRentalAlias_" . $deafultLang . " as vRentalVehicleTypeName FROM register_driver d RIGHT JOIN trips t ON d.iDriverId = t.iDriverId LEFT JOIN vehicle_type vt ON vt.iVehicleTypeId = t.iVehicleTypeId LEFT JOIN  register_user u ON t.iUserId = u.iUserId WHERE d.iDriverId = '" . $_SESSION['sess_iUserId'] . "' AND eSystem = 'General' " . $ssql . " ORDER BY t.iTripId DESC";
$db_dtrip = $obj->MySQLSelect($sql);
$sql = "SELECT vName FROM currency WHERE eDefault='Yes'";
$db_currency = $obj->MySQLSelect($sql);
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

if ($host_system == 'cubetaxishark' || $host_system == 'cubetaxi5plus') {
    $canceled_icon = "orange/canceled-invoice.png";
    $invoice_icon = "orange/driver-view-icon.png";

} else {
    $invoice_icon = "driver-view-icon.png";
    $canceled_icon = "canceled-invoice.png";
}
$vehilceTypeArr = array();
$getVehicleTypes = $obj->MySQLSelect("SELECT iVehicleTypeId,vVehicleType_" . $deafultLang . " AS vehicleType FROM vehicle_type WHERE 1=1");
for ($r = 0; $r < count($getVehicleTypes); $r++) {
    $vehilceTypeArr[$getVehicleTypes[$r]['iVehicleTypeId']] = $getVehicleTypes[$r]['vehicleType'];
}
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
    <title>Yalla | My Trips</title>
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
                                <div class="page-title">My Trips</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">My Trips</li>
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
                                                    <!--<?php if ($APP_TYPE != 'UberX' && $APP_TYPE != 'Delivery') { ?> 
                                                    <th><?= $langage_lbl['LBL_TRIP_JOB_TYPE_FRONT']; ?></th>
                                                    <?php } ?>-->
                                                    <th style="text-align: center;">ID</th>
                                                    <th style="text-align: center;" width=""><?= $langage_lbl['LBL_MYTRIP_RIDE_NO_TXT']; ?></th>
                                                    <th style="text-align: center;" width="18%"><?= $langage_lbl['LBL_MYTRIP_TRIP_RIDER']; ?></th>
                                                    <th style="text-align: center;" width="15%"><?= $langage_lbl['LBL_MYTRIP_TRIPDATE']; ?></th>
                                                    <th style="text-align: center;" width="15%"><?= $langage_lbl['LBL_DRIVER_TRIP_FARE_TXT']; ?></th>
                                                    <th style="text-align: center;" width="15%"><?= $langage_lbl['LBL_MYTRIP_CAR_TYPE']; ?></th>
                                                    <th style="text-align: center;" width="16%"><?= $langage_lbl['LBL_View_Invoice']; ?></th>
                                                </tr>
                                            </thead>
										    <tbody>
                                                <? if (count($db_dtrip) > 0) {  
                                                    for ($i = 0; $i < count($db_dtrip); $i++) {
                                                        $poolTxt = $seriveJson = "";
                                                        if ($db_dtrip[$i]['ePoolRide'] == "Yes") {
                                                            $poolTxt = " (Pool)";
                                                        }
                                                        $pickup = $db_dtrip[$i]['tSaddress'];
                                                        $iFare = $db_dtrip[$i]['fTripGenerateFare'];
                                                        $fDiscount = $db_dtrip[$i]['fDiscount'];
                                                        if (($iFare == "" || $iFare == 0) && $db_dtrip[$i]['fDiscount'] > 0) {
                                                            $total_main_price = ($db_dtrip[$i]['fDiscount'] - $db_dtrip[$i]['fCommision'] - $db_dtrip[$i]['fTax1'] - $db_dtrip[$i]['fTax2'] - $db_dtrip[$i]['fOutStandingAmount']) + $db_dtrip[$i]['fTipPrice'] - $db_dtrip[$i]['fHotelCommision'];
                                                        } else if ($iFare != "" && $iFare > 0) {
                                                            $total_main_price = ($iFare - $db_dtrip[$i]['fCommision'] - $db_dtrip[$i]['fTax1'] - $db_dtrip[$i]['fTax2'] - $db_dtrip[$i]['fOutStandingAmount']) + $db_dtrip[$i]['fTipPrice'] - $db_dtrip[$i]['fHotelCommision'];
                                                        }
                                                        $fare = $generalobj->trip_currency_payment($total_main_price, $db_dtrip[$i]['fRatio_' . $tripcurname]);
                                                        if ($db_dtrip[$i]['iRentalPackageId'] > 0) {
                                                            if(!empty($db_dtrip[$i]['vRentalVehicleTypeName'])){
                                                                $car = $db_dtrip[$i]['vRentalVehicleTypeName'];
                                                            } else{
                                                                $car = $db_dtrip[$i]['vVehicleType'];
                                                            }
                                                        } else {
                                                        $car = $db_dtrip[$i]['vVehicleType'];
                                                    }
                                                    $viewService = 0;
                                                    if (isset($db_dtrip[$i]['tVehicleTypeData']) && $db_dtrip[$i]['tVehicleTypeData'] != "" && $car == "") {
                                                        $viewService = 1;
                                                        $seriveJson = $db_dtrip[$i]['tVehicleTypeData'];
                                                    }
                                                    $name = $generalobj->clearName($db_dtrip[$i]['vName'] . ' ' . $db_dtrip[$i]['vLastName']);
                                                    $eType = $db_dtrip[$i]['eType'];
                                                    $link_page = "invoice.php";
                                                    if ($eType == 'Ride') {
                                                        $trip_type = 'Ride';
                                                    } else if ($eType == 'UberX') {
                                                        $trip_type = 'Other Services';
                                                    } else if ($eType == 'Multi-Delivery') {
                                                        $trip_type = 'Multi-Delivery';
                                                        $link_page = "invoice_multi_delivery.php";
                                                    } else {
                                                        $trip_type = 'Delivery';
                                                    }
                                                    $trip_type .= $poolTxt;
                                                    $systemTimeZone = date_default_timezone_get();
                                                    if ($db_dtrip[$i]['tTripRequestDate'] != "" && $db_dtrip[$i]['vTimeZone'] != "") {
                                                        $dBookingDate = converToTz($db_dtrip[$i]['tTripRequestDate'], $db_dtrip[$i]['vTimeZone'], $systemTimeZone);
                                                    } else {
                                                        $dBookingDate = $db_dtrip[$i]['tTripRequestDate'];
                                                    } ?>
                                                <tr class="gradeA">
                                                    <td style="text-align: center;" align="center"><?= $db_dtrip[$i]['iTripId']; ?></td>
                                                    <!--<?php if ($APP_TYPE != 'UberX' && $APP_TYPE != 'Delivery') { ?> 
                                                    <td><?
                                                        if ($db_dtrip[$i]['eHailTrip'] == "Yes" && $db_dtrip[$i]['iRentalPackageId'] > 0) {
                                                            echo "Rental " . $trip_type . "<br/> ( Hail )";
                                                        } else if ($db_dtrip[$i]['iRentalPackageId'] > 0) {
                                                            echo "Rental " . $trip_type;
                                                        } else if ($db_dtrip[$i]['eHailTrip'] == "Yes") {
                                                            echo "Hail " . $trip_type;
                                                        } else {
                                                            echo $trip_type;
                                                        } ?>
                                                    </td>
                                                    <?php } ?>-->
                                                    <td align="center"><?= $db_dtrip[$i]['vRideNo']; ?></td>
                                                    <td align="center"><?= $name; ?></td>
                                                    <td align="center" data-order="<?= $db_dtrip[$i]['iTripId'] ?>"><?= $generalobj->DateTime1($dBookingDate, 'no'); ?></td>
                                                    <td align="center"><?= $tripcursymbol . ' ' . $fare; ?></td>
                                                    <td align="center" class="center">
                                                        <?php 
                                                            if ($viewService == 1) { ?>
                                                                <button class="btn btn-success" data-trip="<?= $db_dtrip[$i]['vRideNo']; ?>" data-json='<?= $seriveJson; ?>' onclick="return showServiceModal(this);">
                                                                    <i class="fa fa-certificate icon-white"><b> View Service</b></i>
                                                                </button>
                                                                <?php
                                                            } else {
                                                                echo $car;
                                                            } ?>
                                                    </td>
                                                        <?php if ($db_dtrip[$i]['iActive'] == 'Canceled' && $db_dtrip[$i]['fTripGenerateFare'] <= 0) { ?>
                                                    <td class="center">
                                                        <img src="../assets/img/<?php echo $canceled_icon; ?>" title="<?= $langage_lbl['LBL_MYTRIP_CANCELED_TXT']; ?>">
                                                    </td>
                                                        <?php } else if (($db_dtrip[$i]['iActive'] == 'Canceled' && $db_dtrip[$i]['fTripGenerateFare'] > 0) || ($db_dtrip[$i]['iActive'] == 'Finished' && $db_dtrip[$i]['eCancelled'] == "Yes")) { ?>
                                                    <td align="center" width="10%">
                                                        <a  target = "_blank" href="<?= $link_page ?>?iTripId=<?= base64_encode(base64_encode($db_dtrip[$i]['iTripId'])) ?>"><strong><img src="../assets/img/<?php echo $invoice_icon; ?>"></strong></a>
                                                        <div style="font-size: 12px;">Cancelled</div>
                                                    </td>
                                                        <? } else { ?>	
                                                    <td class="center">
                                                        <a  target = "_blank" href="<?= $link_page ?>?iTripId=<?= base64_encode(base64_encode($db_dtrip[$i]['iTripId'])) ?>"><strong><img src="../assets/img/<?php echo $invoice_icon; ?>"></strong></a>
                                                    </td>
                                                    <?php } ?>
                                                </tr>
                                                <? } ?>
                                            </tbody>	
                                            <? } else { ?>
                                            <tr class="odd">
                                            <td class="center" align="center" colspan="7">No Details found</td>
                                            </tr>	 
                                            <? } ?>
							    		</table>
                                 	</div>
                                </div>
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>
        </div>
        <? include_once('footer.php') ?>
    </div>
    
<script type="text/javascript">

var typeArr = '<?= json_encode($vehilceTypeArr); ?>';
$(document).ready(function () {
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
    <?php if ($APP_TYPE == 'UberX' || $APP_TYPE == 'Delivery') { ?>
    $('#dataTables-example').dataTable({
        "order": [[2, "desc"]],
        "aoColumns": [
            null,
            null,
            null,
            null,
            null,
            {"bSortable": false}
        ]
    });
    <?php } else { ?>
    $('#dataTables-example').dataTable({
        "order": [[3, "desc"]],
        "aoColumns": [
            null,
            null,
            null,
            null,
            null,
            null,
            {"bSortable": false}
        ]
    });
    <?php } ?>
    // formInit();
});

function todayDate() {
    
    $("#dp4").val('<?= $Today; ?>');
    $("#dp5").val('<?= $Today; ?>');
}

function reset() {
    location.reload();
}

function yesterdayDate() {
    
    $("#dp4").val('<?= $Yesterday; ?>');
    $("#dp5").val('<?= $Yesterday; ?>');
    $("#dp4").datepicker('refresh');
    $("#dp5").datepicker('refresh');
}

function currentweekDate(dt, df) {
    
    $("#dp4").val('<?= $monday; ?>');
    $("#dp5").val('<?= $sunday; ?>');
    $("#dp4").datepicker('refresh');
    $("#dp5").datepicker('refresh');
}

function previousweekDate(dt, df) {
    $("#dp4").val('<?= $Pmonday; ?>');
    $("#dp5").val('<?= $Psunday; ?>');
    $("#dp4").datepicker('refresh');
    $("#dp5").datepicker('refresh');
}

function currentmonthDate(dt, df) {
    
    $("#dp4").val('<?= $currmonthFDate; ?>');
    $("#dp5").val('<?= $currmonthTDate; ?>');
    $("#dp4").datepicker('refresh');
    $("#dp5").datepicker('refresh');
}

function previousmonthDate(dt, df) {
    
    $("#dp4").val('<?= $prevmonthFDate; ?>');
    $("#dp5").val('<?= $prevmonthTDate; ?>');
    $("#dp4").datepicker('refresh');
    $("#dp5").datepicker('refresh');
}

function currentyearDate(dt, df) {
    
    $("#dp4").val('<?= $curryearFDate; ?>');
    $("#dp5").val('<?= $curryearTDate; ?>');
    $("#dp4").datepicker('refresh');
    $("#dp5").datepicker('refresh');
}

function previousyearDate(dt, df) {
    
    $("#dp4").val('<?= $prevyearFDate; ?>');
    $("#dp5").val('<?= $prevyearTDate; ?>');
    $("#dp4").datepicker('refresh');
    $("#dp5").datepicker('refresh');
}

function checkvalid() {
    if ($("#dp5").val() < $("#dp4").val()) {
        //bootbox.alert("<h4>From date should be lesser than To date.</h4>");
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

function showServiceModal(elem) {
    var tripJson = JSON.parse($(elem).attr("data-json"));
    var rideNo = $(elem).attr("data-trip");
    var typeNameArr = JSON.parse(typeArr)
    var serviceHtml = "";
    var srno = 1;
    for (var g = 0; g < tripJson.length; g++) {
        serviceHtml += "<p>" + srno + ") " + typeNameArr[tripJson[g]['iVehicleTypeId']] + "</p>";
        srno++;
    }
    $("#service_detail").html(serviceHtml);
    $("#servicetitle").text("Service Details : " + rideNo);
    $("#service_modal").modal('show');
    return false;
}
        
$(document).ready(function () {
    $("[name='dataTables-example_length']").each(function () {
        $(this).wrap("<em class='select-wrapper'></em>");
        $(this).after("<em class='holder'></em>");
    });
    $("[name='dataTables-example_length']").change(function () {
        var selectedOption = $(this).find(":selected").text();
        $(this).next(".holder").text(selectedOption);
    }).trigger('change');
});
</script>
</body>
</html>

