<?php
require_once ("services/LoginChecker.php");
require_once ("services/Functions.php");

isAllowedToEnter(5);

require_once ("services/Accounts.php");

$accountType = ['', 'User', 'Principal', 'Human Resource', 'School Superintendent', 'Account Manager'];
$employee = null;
$account = null;
$message = "Name not found on employee list!";
$messageStatus = '';

if(isset($_GET['first_name']) && isset($_GET['last_name'])) {
    $searchString = "searchType=name&first_name=" . replaceSpaces($_GET['first_name']) . "&last_name=" . replaceSpaces($_GET['last_name']);
    $employee = file_get_contents('http://' . SERVICE_HOST . '/leave-application-services/classes/Employees.php?' . $searchString);
    $employee = json_decode($employee);
}

$firstName = issetGetValue('first_name');
$lastName  = issetGetValue('last_name');
$username  = issetPostValue('username');
$accountTypeOld  = issetPostValue('accountType');


if(isset($employee->id) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['accountType'])) {
    $usernameValue = $_POST['username'];
    $passwordValue = $_POST['password'];
    $accountTypeValue = $_POST['accountType'];

    if(Accounts::isUsernameExist($usernameValue)) {
        $message = "Username already exist!";
        $messageStatus = 'danger';
    } else if (issetPostValue('password') != issetPostValue('password2')) {
        $message = "Passwords do not match!";
        $messageStatus = 'danger';
    } else {
        $newAcc = new Accounts;

        $newAcc->account_type_id = $accountTypeValue;
        $newAcc->employee_id = $employee->id;
        $newAcc->username = $usernameValue;
        $newAcc->password = $passwordValue;
        if($newAcc->save()) {
            $message = 'Successfully created new account!';
        } else {
            $message = 'Failed to create new account!';
            $messageStatus = 'danger';
        }

    }
}

