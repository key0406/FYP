<?php
class Patient{
    private $id;
    private $name;
    private $sex;
    private $age;
    private $gap;
    private $koos;
    //private $f_koos;
    //private $comment;

    function __get($name){
        return $this->$name;
    }
    function __set($name,$value){
        $this->$name = $value;
    }
    function getAllPatients() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sex' => $this->sex,
            'age' => $this->age,
            'gap' => $this->gap,
            'koos' => $this->koos,
            //'f_koos' => $this->f_koos,
            //'comment' => $this->comment
        ];
    }

}
?>