<?php
require_once ("Accounts.php");

header('Content-Type: application/json');
if(isset($_GET['username']) && isset($_GET['password']) ) {
    $username = $_GET['username'];
    $password = $_GET['password'];
    echo json_encode( Accounts::getByUsername($username, $password) );
}
