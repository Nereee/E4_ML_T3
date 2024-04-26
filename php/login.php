<?php
session_start();

$error_message = ""; // Variable para almacenar el mensaje de error

if (isset($_POST['erabiltzailea']) && isset($_POST['pasahitza'])) {
    
    $servername = "10.5.6.220:3306";
    $username = $_POST["erabiltzailea"];
    $password = $_POST["pasahitza"]; 
    $db = "DB_Sprotify";

    // Konexioa sortu


    error_reporting(0);
    
    // $mysqli = new mysqli($servername, $username, $password, $db);
    $konexioa=@mysqli_connect($servername, $username, $password);

    // Konexioa egiaztatu
    if (!$konexioa) {
        $error_message = "Erabiltzailea edo pasahitza ez daude zuzen";
    }else{
        header("Location: ../html/menu.html");
        mysqli_close($konexioa);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/login.css">
    <link rel="shortcut icon" href="../img/logo/Logo.PNG">
    <title>IJU login</title>
</head>
<body>
<main>
    <div class="kutxa">
        <h1>Login</h1>
        <form id="userform" action="login.php" method="POST">
            <div class="userkutxa">
                <img src="../img/login/profile-svgrepo-com.svg" alt="erabiltzailea">
                <label for="erabiltzailea">Erabiltzailea</label> <br>
            </div>
            <input type="text" id="erabiltzailea" name="erabiltzailea"> <br>
            <div class="userkutxa">
                <img src="../img/login/padlock-svgrepo-com.svg" alt="pasahitza">
                <label for="pasahitza">Pasahitza</label> <br>
            </div>
            <input type="password" id="pasahitza" name="pasahitza">

            <?php
              // Mostrar el mensaje de error si existe
              if (!empty($error_message)) {
                echo '<p style="color: yellow; text-align: center; font-weigth: bold;">' . $error_message . '</p>';
              }
            ?>
            <br>
            <input type="submit" id="jarraitu" value="Jarraitu">
        </form>
    </div>
</main>
</body>
</html>