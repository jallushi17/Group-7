<?php


class SignupContr extends Signup
{

    private $uid;
    private $pwd;
    private $pwdRepeat;
    private $email;

    public function __construct($uid, $pwd, $pwdRepeat, $email){
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->email = $email;
    }

    public function signupUser(){
        if($this-> emptyInput()==false){
            echo "Empty input";
            header("../index.php?error=stmtfailed");
            echo "<br><a class ='story' href='../login.php'>Try again!</a> ";
            exit();
        }

        if($this-> invalidUid()==false){
            echo "Invalid username or username length isn't above 8";


              echo "<br><a class ='story' href='../login.php'>Try again!</a> ";

            exit();

        }

        if($this-> invalidEmail()==false){
            echo "Invalid email";
            echo "<br><a class ='story' href='../login.php'>Try again!</a> ";
            exit();
        }

        if($this-> pwdMatch()==false){
            echo "password don't match or password length isn't above 8";
            echo "<br><a class ='story' href='../login.php'>Try again!</a> ";
            exit();
        }
        if($this->uidTakenCheck()==false){
            echo "username or email taken!";
            echo "<br><a class ='story' href='../login.php'>Try again!</a> ";
            exit();
        }

        $this->setUser($this->uid, $this->pwd, $this->email );
    }

    private function emptyInput()
    {
        $result = true;;

        if (empty($this->uid) || empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email))
            $result = false;



        return $result;

    }

    private function invalidUid()
    {
        $result = true;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->uid) || strlen($this->uid)<=8 ){
            $result = false;
        }

        return $result;

    }

    private function invalidEmail(){
        $result = true;
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL) ) $result=false;

        return $result;
    }

    private function pwdMatch(){
        $result = true;

        if($this->pwd !== $this->pwdRepeat || strlen($this->pwd)<=8) $result=false;

        return $result;
    }

    private function uidTakenCheck(){
        $result = true;

        if(!$this->checkUser( $this->uid,$this->email) ) $result=false;

        return $result;
    }
}