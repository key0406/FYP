<?php
class Login{
    private $id;
    private $email;
    private $username;
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

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole() {
        return $this->role;
    }

}
?>
