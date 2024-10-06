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

    public function Login($username, $password)
    {
        $statement = $this->mysqli->prepare("select * from member where username=?");
        $statement->bind_param("s", $username);
        $statement->execute();

        $result = $statement->get_result();

        if ($row = $result->fetch_assoc()) {

            if (password_verify($password, $row['password'])) {
                if ($row['profile'] == 'Admin') {
                    header("location: DashboardAdmin.php");
                }
            } 

        }
        return $result;
    }

    public function Register($fnama, $lname, $username, $password)
    {
        $hash_password = password_hash($password, PASSWORD_DEFAULT);

        $statement = $this->mysqli->prepare("INSERT INTO member (fname, lname, username, password, profile) VALUES (?,?,?,?,'Admin')");
        $statement->bind_param("ssss", $fnama,$lname,$username,$hash_password);
        $statement->execute();
        $result = $statement->get_result();
        return $result;
    }
}
?>