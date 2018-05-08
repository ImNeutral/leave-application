<?php
require_once ("services/LoginChecker.php");
require_once ("services/Functions.php");

isAllowedToEnter(5);

require_once ("services/Accounts.php");

$messageStatus = '';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $account = Accounts::getById($id);

    $employee = file_get_contents('http://' . SERVICE_HOST . '/leave-application-services/classes/Employees.php?id=' . $account['employee_id']);
    $employee = json_decode($employee);

//    $schools = file_get_contents('http://' . SERVICE_HOST . '/leave-application-services/classes/Schools.php?id=0');
//    $schools = json_decode($schools);

    $accountType = ['', 'User', 'Principal', 'Human Resource', 'School Superintendent', 'Account Manager'];
    $name = $employee->first_name . ' ' . $employee->middle_name . ' ' . $employee->last_name;
    $name = ucwords(strtolower($name));

    if(isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['accountType'])) {
        $passwordValue = issetPostValue('password');
        $password2Value = issetPostValue('password2');
        $accountTypeValue = issetPostValue('accountType');

        if($passwordValue > '' || $password2Value > '') {

            if ($passwordValue == $password2Value) {
                $updateAcc = new Accounts();
                $updateAcc->id = $account['id'];
                $updateAcc->password = $passwordValue;
                $updateAcc->account_type_id = $accountTypeValue;
                if ($updateAcc->update()) {
                    $message = "Successfully updated account!";
                    $account['account_type_id'] = $accountTypeValue;
                } else {
                    $message = "Failed to update account!";
                    $messageStatus = 'danger';
                }
            } else {
                $message = "Passwords do not match!";
                $messageStatus = 'danger';
            }
        } else if ($accountTypeValue != $account['account_type_id']) {
            $updateAcc = new Accounts();
            $updateAcc->id = $account['id'];
            $updateAcc->account_type_id = $accountTypeValue;
            if ($updateAcc->updateAccountType() ) {
                $message = "Successfully updated account!";
                $account['account_type_id'] = $accountTypeValue;
            }
        } else {
            $message = "No Changes has been made!";
            $messageStatus = 'danger';
        }
    }

} else {
    header("location: manage-accounts.php");
}