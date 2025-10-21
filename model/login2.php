<?php
class Login2{
    private $email;
    private $password;

    function __get($name){
        return $this->$name;
    }

    function __set($name, $value){
        $this->$name = $value;
    }


    public function verifyPassword($password) {
        return password_verify($password, $this->password);
    }

}
?>
