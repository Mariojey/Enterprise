<?php
require_once('db_connect.php');
//SQL queries
session_start();
if(isset($_SESSION['login_user']))
{
    $user_check = $_SESSION['login_user'];
    $selectLoginFromAdmins = "SELECT login FROM admins WHERE login = '$user_check'";
    $query = $conn->query($selectLoginFromAdmins);
    $row = $query->fetch(PDO::FETCH_ASSOC);

    if($row){
        $login_session = $row['login'];
        $login_role = "admin";
    }
    else{
        $selectLoginFromUsers =  "SELECT login from users WHERE login = '$user_check'";
        $query = $conn->query($selectLoginFromUsers);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if($row)
        {
            $login_session = $row['login'];
            $login_role = "user";
        }
    }
}