<?php
class Messages{
    private $id;
    private $sender_id;
    private $receiver_id;
    private $message;
    private $date;

    function __get($name){
        return $this->$name;
    }

    function __set($name, $value){
        $this->$name = $value;
    }
}