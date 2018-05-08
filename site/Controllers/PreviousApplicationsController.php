<?php

require_once ("services/LoginChecker.php");
isAllowedToEnter(1);
require_once ("services/Functions.php");
require_once ("services/LeaveApplication.php");


$page = 1;
$limit = 10;
if(isset($_GET['page'])) {
    $page = $_GET['page'];
}

$leaveApplications = LeaveApplication::getAllPaginated($limit, ($page - 1) * $limit );
$leaveApplicationsCount = LeaveApplication::count()['count(id)'];
$pagesCount = (int)($leaveApplicationsCount / $limit);
if($leaveApplicationsCount % $limit > 0) {
    $pagesCount+=1;
}


$tableNumber = ($page-1) * $limit;
