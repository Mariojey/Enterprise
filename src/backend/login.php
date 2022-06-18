<?php


    require_once('db_connect.php');

    session_start();
    $error = '';

    if(isset($_POST['submit']))
    {
        if(empty($_POST['login']) || empty($_POST['password']))
        {
            $error = "Wykryto niepoprawne dane logowania!";
        }
        else{
            $login = $_POST['login'];
            $password = $_POST['password'];

            try{                
                $query = $conn->query("SELECT login FROM admins WHERE login = '$login' AND password = '$password'");

                if($query->fetch(PDO::FETCH_ASSOC))
                {
                    $_SESSION['login_user'] = $login;
                    header("Location: admin.php");

                    $query->close();    
                }
                else{
                    $query->$conn("SELECT login FROM users WHERE login = '$login' AND password = '$password'");

                    if($query->fetch(PDO::FETCH_ASSOC))
                    {
                        $_SESSION['login_user'] = $login;
                        header("Location: user.php");
                    }
                    else
                    {
                        $error = "Wprowadzono złe zdane logowania!";
                    }
                }
            }catch(PDOException $e)
            {
                $error = "Brak połączenia z bazą!";
            }
        }
    }