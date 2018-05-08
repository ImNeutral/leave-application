<?php
require_once ("Session.php");

function isAllowedToEnter($accountTypeAllowed) {
    $currPage = basename($_SERVER['PHP_SELF']);
    if(!Session::isLoggedIn()) {
        header("location: login.php");
    } else if ($accountTypeAllowed != Session::getAccountTypeId()) {
        if(Session::getAccountTypeId() == 1 && $currPage != 'leave-application.php') { // user
            header("location: leave-application.php");
        } else if(Session::getAccountTypeId() == 2 && $currPage != 'manage-applications-principal.php') { // principal
            header("location: manage-applications-principal.php");
        } else if(Session::getAccountTypeId() == 3 && $currPage != 'manage-applications-hr.php') { // hr
            header("location: manage-applications-hr.php");
        } else if(Session::getAccountTypeId() == 4 && $currPage != 'manage-applications-sds.php') { // sds
            header("location: manage-applications-sds.php");
        } else if(Session::getAccountTypeId() == 5 && $currPage != 'manage-accounts.php') { // account manager
            header("location: manage-accounts.php");
        }
    }
}

//if( !Session::isLoggedIn() ) {
//    header("location: login.php");
//} else if(Session::getAccountTypeId() == 1 && $currPage != 'leave-application.php') { // user
//    header("location: leave-application.php");
//} else if(Session::getAccountTypeId() == 2 && $currPage != 'manage-applications-principal.php') { // principal
//    header("location: manage-applications-principal.php");
//} else if(Session::getAccountTypeId() == 3 && $currPage != 'manage-applications-hr.php') { // hr
//    header("location: manage-applications-hr.php");
//} else if(Session::getAccountTypeId() == 4 && $currPage != 'manage-applications-sds.php') { // sds
//    header("location: manage-applications-sds.php");
//} else if(Session::getAccountTypeId() == 5 && $currPage != 'manage-accounts.php') { // account manager
//    header("location: manage-accounts.php");
//} else {
//}