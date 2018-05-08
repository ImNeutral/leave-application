<?php

class Session {

    function __construct() { 	
		self::session_start();	 
    }

    public static function isLoggedIn() {
        if(isset($_SESSION['username'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function getAccountTypeId() {
        return $_SESSION['account_type_id'];
    }


    public static function session_start() {	
		if(!isset($_SESSION)) { 
			session_start(); 
		}
		
    }

    public function logout() {
        session_unset();
    }
}

Session::session_start();