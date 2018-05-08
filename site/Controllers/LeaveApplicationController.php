<?php
require_once ("services/LoginChecker.php");
isAllowedToEnter(1);
require_once ("services/Functions.php");
require_once ("services/LeaveApplication.php");

$successApplication = 0;

if( isset($_POST['submit']) ) {
    $successApplication = 1;

    $typeOfLeave = issetPostValue('type_of_leave');

    if($typeOfLeave == 'others') {
        $typeOfLeave = issetPostValue('others_reason');
    } else if ($typeOfLeave == 'vacation-others') {
        $typeOfLeave = 'Vacation - ' . issetPostValue('others_reason');
    }
    $accountID  = $_SESSION['account_id'];
    $schoolID   = $_SESSION['school_id'];

    $daysApplied    = issetPostValue('days_applied');
    if($typeOfLeave == 'Maternity') {
        $daysApplied = 0;
    }

    $dateFromYear   = issetPostValue('date_from_year');
    $dateFromMonth  = issetPostValue('date_from_month');
    $dateFromDay    = issetPostValue('date_from_day');

    $placeLeaveStay = issetPostValue('place');
    $placeLeaveStaySpecify = '';
    if($placeLeaveStay == 'within_philippines') {
        $placeLeaveStaySpecify = "Within Philippines";
    } else if($placeLeaveStay == 'abroad') {
        $placeLeaveStaySpecify = issetPostValue('abroad_specify');
    } else if($placeLeaveStay == 'in_hospital') {
        $placeLeaveStaySpecify = issetPostValue('in_hospital_specify');
    } else if($placeLeaveStay == 'out_patient') {
        $placeLeaveStaySpecify = issetPostValue('out_patient_specify');
    }

    $commutationRequested = issetPostValue('commutation_requested');

    $leaveApplication = new LeaveApplication();
    $leaveApplication->account_id = $accountID;
    $leaveApplication->school_id = $schoolID;
    $leaveApplication->date_filed = date('Y-m-d');
    $leaveApplication->type_of_leave = $typeOfLeave;
    $leaveApplication->number_days_applied = $daysApplied;
    $leaveApplication->from_date = $dateFromYear . '-' . $dateFromMonth . '-' . $dateFromDay;

    $leaveApplication->save();
}