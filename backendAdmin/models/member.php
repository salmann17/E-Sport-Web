<?php
require_once("parent.php");
class Member extends ParentClass
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getMemberbyId($idmember)
    {
        $statement = $this->mysqli->prepare("select * from member where idmember=?");
        $statement->bind_param("i", $idmember);
        $statement->execute();
        $result = $statement->get_result();
        return $result;
    }

    public function getMember($username, $password)
    {
        $statement = $this->mysqli->prepare("select * from member where username=? and password=md5(?)");
        $statement->bind_param("ss", $username, $password);
        $statement->execute();

        $result = $statement->get_result();
        return $result->fetch_assoc();
    }

    public function Login($username, $password)
    {
        $statement = $this->mysqli->prepare("select * from member where username=? and password=md5(?)");
        $statement->bind_param("ss", $username, $password);
        $statement->execute();

        $result = $statement->get_result();
        if( $result->num_rows > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function Register($fnama, $lname, $username, $password)
    {
        $statement = $this->mysqli->prepare("INSERT INTO member (fname, lname, username, password, profile) VALUES (?,?,?,md5(?),'Member')");
        $statement->bind_param("ssss", $fnama,$lname,$username,$password);
        $statement->execute();
    }
}
?>