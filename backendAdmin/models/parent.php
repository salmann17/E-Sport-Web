<?php 
    require_once("data.php");
    class ParentClass {
        protected $mysqli;
        public function __construct(){
            $this->mysqli = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME); 
        }
        function __destruct()
        {
            $this->mysqli->close();
        }
    }
?>