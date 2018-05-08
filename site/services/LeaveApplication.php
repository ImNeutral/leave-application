<?php
require_once ("DBQueries.php");

class LeaveApplication extends DBQueries {
    public static $table        = "leave_applications";
    public static $table_fields = array('id', 'account_id', 'school_id', 'date_filed', 'type_of_leave',
                                        'number_days_applied', 'from_date');
    public $id;
    public $account_id;
    public $school_id;
    public $date_filed;
    public $type_of_leave;
    public $number_days_applied;
    public $from_date;


    public function getFormattedDate() {
        $date = date_create($this->from_date);
        return date_format($date,"M d, Y");
    }
}
