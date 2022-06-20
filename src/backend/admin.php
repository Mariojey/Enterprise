<?php 
    include('session.php');

    $info = " ";
    $statusInfo = " ";

    if(!isset($_SESSION['login_user']))
    {
        echo "403";
    }
    else{
        if($login_role != "admin"){
            echo "403";
        }
    }

    if (isset($_GET['menu']) && $_GET['menu'] < 5 && $_GET['menu'] > 0) {
        $menu = $_GET['menu'];
    }
    else {
        header("location: admin.php?menu=1");
    }



    //--------------------//

    if(isset($_POST['type'])){

        $type = $_POST['type'];



        //DODAWANIE PRACOWNIKÓW
        if($type == 'addEmployer'){
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $domicle = $_POST['domicle'];
            $post_code = $_POST['post_code'];
            $street = $_POST['street'];
            $adress = $_POST['adress'];
            $department = $_POST['department'];
            $job = $_POST['job'];
            $id_shop = $_POST['id_shop'];
            $email = $_POST['email'];


            if($name != '' && $surname != '' && $domicle != '' && $post_code != '' && $street != '' && $adress != '' && $department != '' && $job != '' && $id_shop != ''){

                try{
                    //$email = filter_input(INPUT_POST, 'email', FILER_VALIDATE_EMAIL);

                    //$query = $conn->prepare("INSERT INTO employers (`id_employee`, `name`, `surname`, `email`, `domicle`, `post_code`, `street`, `adress`, `id_department`, `id_job`, `id_shop`) VALUES (NULL, '$name', '$surname', ':email', '$domicle', '$post_code', '$street', '$adress', '$department', '$job', '$id_shop' )");
                    //$query->bindValue(':email', $email, PDO::PARAM_STR);
                    //$query->execute();
                    $conn->query("INSERT INTO employers (`id_employee`, `name`, `surname`, `email`, `domicle`, `post_code`, `street`, `adress`, `id_department`, `id_job`, `id_shop`) VALUES (NULL, '$name', '$surname', '$email', '$domicle', '$post_code', '$street', '$adress', '$department', '$job', '$id_shop' )");

                    $info = "UDAŁO SIĘ DODAĆ PRACOWNIKA";
                }catch(PDOException $error){
                    $info = $error;
                }
            }
            else{
                $_SESSION['given_name'] = $_POST['name'];
                $_SESSION['given_surname'] = $_POST['surname'];
                $_SESSION['given_domicle'] = $_POST['domicle'];
                $_SESSION['given_post_code'] = $_POST['post_code'];
                $_SESSION['given_street'] = $_POST['street'];
                $_SESSION['given_adress'] = $_POST['adress'];
                $_SESSION['given_department'] = $_POST['department'];
                $_SESSION['given_job'] = $_POST['job'];
                $_SESSION['given_id_shop'] = $_POST['id_shop'];
                $_SESSION['given_email'] = $_POST['email'];

            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>

        <link rel="stylesheet" href="../src/style/style.css" type="text/css">
        <title>Portal Administratora</title>
        
    </head>
    <body>
        
        <section class="wrapper">
            
            <div class="content">

                <nav class="navbar">

                    <ul class="navbarLinks">
                        <li onclick="changepage(1)">
                        <p>Lista Pracowników</p>
                        </li>
                        <li onclick="changepage(2)">
                            Dodaj Pracownika
                        </li>
                    </ul>

                </nav>

                <div class="box">










                    <?php 
                    //WYŚWIETLNIE LISTY PRACOWNIKÓW
                        if ($menu == 1) {
                            $employers = $conn->query("SELECT * FROM employers");
                        
                    ?>
                    <ol>
                    <?php
                        while($row = $employers->fetch(PDO::FETCH_ASSOC)){

                            $row_id = $row['ID_EMPLOYEE'];
                            $row_name = $row['NAME'];
                            $row_surname = $row['SURNAME'];
                            echo "<li>$row_id $row_name $row_surname</li>";
                        
                    ?>
                    </ol>
                    <!------------------------------------------------------------>














                    <?php 
                    //DODAWANIE PRACOWNIKA
                        }}else if($menu == 2){

                            $jobsToSelect = $conn->query("SELECT * FROM jobs");
                        ?>
                            <h1>Dodaj Pracownika</h1> 
                            <form action="" class="form" method="post">
                                <input type="hidden" name="type" value="addEmployer">
                                <input type="text" name="name" placeholder="Podaj imię pracownika">
                                <input type="text" name="surname" placeholder="Podaj nazwisko pracownika">
                                <p>Wybierz dział</p>
                                <select name="department">
                                    <option value="1">Zarząd</option>
                                    <option value="2">Finanse i Rozwój</option>
                                    <option value="3">Dział Kreatywno-Marketingowy</option>
                                    <option value="4">Księgowości</option>
                                    <option value="5">Pracy i Pracownika</option>
                                    <option value="6">Sprzedaży</option>
                                </select>
                                <p>Wybierz stanowisko</p>
                                <select name="job">
                                    <?php 
                                        while($row = $jobsToSelect->fetch(PDO::FETCH_ASSOC)){
                                            $row_id_job = $row['id_job'];
                                            $row_id_department = $row['ID_DEPARTMENT'];
                                            $row_name = $row['name'];
                                            echo "<option value='$row_id_jobs'>$row_name</option>";
                                        }
                                    ?>
                                </select>
                                <input type="text" name="id_shop" placeholder="podaj numer sklepu">
                                <input type="email" name="email" placeholder="Podaj adres email pracownika example@mail.pl">
                                <input type="text" name="domicle" placeholder="Podaj miejsce zamieszkania">
                                <input type="text" name="post_code" placeholder="Podaj kod pocztowy np. 00-000">
                                <input type="text" name="street" placeholder="Podaj ulicę zamieszkania">
                                <input type="text" name="adress" placeholder="Podaj numer domu/bloku">
                                <input type="submit" value="Dodaj pracownika">
                            </form>  
                            <h2><?php echo $info?></h2> 
                    <?php
                    }
                    ?>
                    <!----------------------------------------------------------->















                </div>
            </div>
            
        </section>

        <script>
            function changepage(id)
            {
                window.location.href = "admin.php?menu="+id
            }
        </script>
    </body>
</html>