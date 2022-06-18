<?php 

    include('session.php');

    $info = "";
    $statusInfo = "";

    if(!isset($_SESSION['login_user'])){
        echo "403";
    }else{
        if ($login_role != "user") {
            echo "403";
        }
    }

    if(isset($_GET['menu']) && $_GET['menu'] < 5 && $_GET['menu'] > 0){
        $menu = $_GET['menu'];
    }else{
        header("Location: user.php?menu=1");
    }


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Portal Pracownika</title>
    </head>
    <body>
        

    </body>
</html>