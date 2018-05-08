<?php
require_once ("services/LoginChecker.php");
//require_once ("services/Functions.php");

if(!Session::isLoggedIn()) {
    header("location: login.php");
}

require_once ("services/Accounts.php");

$messageStatus = '';

$id = $_SESSION['account_id'];
$account = Accounts::getById($id);

$employee = file_get_contents('http://' . SERVICE_HOST . '/leave-application-services/classes/Employees.php?id=' . $account['employee_id']);
$employee = json_decode($employee);

$name = $employee->first_name . ' ' . $employee->middle_name . ' ' . $employee->last_name;
$name = ucwords(strtolower($name));

if( isset($_POST['password']) && isset($_POST['password2']) ) {
    $passwordValue = issetPostValue('password');
    $password2Value = issetPostValue('password2');

    if($passwordValue > '' || $password2Value > '') {

        if ($passwordValue == $password2Value) {
            $updateAcc = new Accounts();
            $updateAcc->id = $account['id'];
            $updateAcc->password = $passwordValue;
            if ( $updateAcc->updatePassword() ) {
                $message = "Successfully updated account!";
            } else {
                $message = "Failed to update account!";
                $messageStatus = 'danger';
            }
        } else {
            $message = "Passwords do not match!";
            $messageStatus = 'danger';
        }
    } else {
        $message = "No Changes has been made!";
        $messageStatus = 'danger';
    }
}