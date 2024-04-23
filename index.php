<?php
session_start();

$error_message = ""; // Variable para almacenar el mensaje de error

if (isset($_POST['erabiltzailea']) && isset($_POST['pasahitza'])) {
    
    $servername = "10.5.6.220:3306";
    $username = "username";
    $password = "password";
    $db = "DB_Sprotify";

    // Konexioa sortu


    error_reporting(0);
    
    $mysqli = new mysqli($servername, $username, $password, $db);

    // Konexioa egiaztatu
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Kontsulta
    $erabiltzailea = $_POST["erabiltzailea"];
    $pwd = $_POST["pasahitza"]; 

    $sql = "SELECT Pasahitza FROM Bezeroa WHERE Erabiltzailea = '$erabiltzailea'";
    
    // Kontsulta egin db
    $result = $mysqli->query($sql);

    if ($result && $result->num_rows > 0) {
        // Iniciar sesión y redirigir al usuario a la página de inicio
        $row = mysqli_fetch_assoc($result);
        $rowstr = strval($row[0]);
        if(password_verify($pwd, $rowstr)){
            echo"Login bien";
        $_SESSION['erabiltzailea'] =  $erabiltzailea;
        header("Location: /Html/menu.html");
        exit;
    }
    
    } else {
        // Mostrar un mensaje de error si la autenticación falla
        $error_message = "Pasahitza edo erabiltzailea ez dira zuzenak";
    }

    // Konexioa itxi
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Style/login.css">
    <link rel="shortcut icon" href="/IMG/logo/Logo.PNG">
    <title>PHIM Zinemak</title>
</head>
<body>
<main>
    <div class="kutxa">
        <h1>Login</h1>
        <form id="userform" action="index.php" method="POST">
            <div class="userkutxa">
                <img src="/IMG/login/profile-svgrepo-com.svg" alt="erabiltzailea">
                <label for="erabiltzailea">Erabiltzailea</label> <br>
            </div>
            <input type="text" id="erabiltzailea" name="erabiltzailea"> <br>
            <div class="userkutxa">
                <img src="/IMG/login/padlock-svgrepo-com.svg" alt="pasahitza">
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
