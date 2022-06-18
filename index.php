<?php
    include('src/backend/login.php');

    if(isset($_SESSION['login_user']))
    {
        include('src/backend/session.php');
        if($login_role == "user")
        {
            header("Location: src/backend/user.php");
        }
        if($login_role == "admin")
        {
            header("Location: src/backend/admin.php");
        }
    }
?>

<!DOCTYPE html>
<html>
    <title>Portal Pracownika - Login</title>
<head>
</head>
<body>
    <section class="section">
        <article class="article">
            <div class="login">
                <h1>PORTAL PRACOWNIKA</h1>
                <form action="src/backend/login.php" class="form" method="post">
                    <label>
                        <input type="text" id="name" name="login" placeholder="Nazwa Użytkownika">
                    </label>
                    <label>
                        <input type="password" id="password" name="password" placeholder="Hasło">
                    </label>
                    <br><br><br>
                    <input name="submit" type="submit" class="button" value="Zaloguj">

                    <span><?php echo $error; ?></span>
                </form>
            </div>
        </article>
    </section>
</body>
</html>