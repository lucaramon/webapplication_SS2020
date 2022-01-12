
<?php

//Variablen
 $servername = 'localhost';
 $user = 'root';
 $pw = '';
 $db = 'mybib';

 $email = $_POST["email"];

//Verbindungsaufbau
 $conn = new mysqli($servername, $user, $pw, $db);
 if($conn -> connect_error){
   die('Error while connecting' . $conn -> connect_error);
 }

    session_start();
    $_SESSION["loginuser"] = $email;

    header("Location:startseite_admin.php");

//Beenden der Verbindung
$conn -> close();

?>
