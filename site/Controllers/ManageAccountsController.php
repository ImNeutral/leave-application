<?php
require_once ("services/LoginChecker.php");

isAllowedToEnter(5);

require_once ("services/Accounts.php");


$page = 1;
$limit = 10;
if(isset($_GET['page'])) {
    $page = $_GET['page'];
}

$accounts = Accounts::getAllPaginated($limit, ($page - 1) * $limit );
$accountCount = Accounts::count()['count(id)'];
$pagesCount = (int)($accountCount / $limit);
if($accountCount % $limit > 0) {
    $pagesCount+=1;
}

$tableNumber = ($page-1) * $limit;

$accountType = ['', 'User', 'Principal', 'Human Resource', 'School Superintendent', 'Account Manager'];

//
//print_r($accounts);