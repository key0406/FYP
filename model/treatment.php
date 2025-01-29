<?php
class Treatment{
    private $id;
    private $p_id;
    private $p_name;
    private $sex;
    private $p_koos;
    private $p_diagnosis;
    private $treatment_1;
    private $p_goal_1;
    private $p_time_1;
    private $treatment_2;
    private $p_goal_2;
    private $p_time_2;
    private $treatment_3;
    private $p_goal_3;
    private $p_time_3;
    private $r_1;
    private $r_goal;
    private $r_2;
    private $r_goal_2;
    private $c_1;
    private $c_2;
    private $c_3;
    private $rb_1;
    private $rb_2;
    private $signature_patient;
    private $p_date;
    private $signature_doctor;
    private $d_date;

    
    function __get($name){
        return $this->$name;
    }

    function __set($name, $value){
        $this->$name = $value;
    }
}
?>