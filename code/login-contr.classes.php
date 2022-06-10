<?php


class loginContr extends Login
{

    private $uid;
    private $pwd;


    public function __construct($uid, $pwd)
    {
        $this->uid = $uid;
        $this->pwd = $pwd;

    }

    public function loginUser()
    {
        if (!$this->emptyInput() == false) {
            echo "Empty input";
            header("../index.php?error=stmtfailed");
            exit();
        }

        $this -> getUser($this->uid, $this->pwd);

    }

    private function emptyInput()
    {
        $result = true;;

        if (empty($this->uid) || empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email))
            $result = false;


        return $result;

    }
}

