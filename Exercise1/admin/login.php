<?php
session_start();
function login()
{
    
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $psw = $_POST['psw'];
        $connec = new mysqli("localhost","root","","customer");
        mysqli_set_charset($connec,"utf-8");
        if($connec -> connect_error){
            var_dump($connec-> connect_error);
            die();
        }
        $query = "SELECT * FROM USERTABLE WHERE EMAIL = '".$email."' AND PASSWORD = '".$psw."'";
        $result = mysqli_query($connec,$query);
        $data = array();
        while($row = mysqli_fetch_array($result,1)){
            $data[]= $row;
        }
        if ($data != null && count($data) > 0)
        {
            $_SESSION['username'] =$email; 
            header("Location: ./index.php");
        }
        $connec -> close();
    }
}

login();
