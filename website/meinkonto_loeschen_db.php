
<?php

//Variablen
 $servername = 'localhost';
 $user = 'root';
 $pw = '';
 $db = 'mybib';

//Verbindungsaufbau
 $conn = new mysqli($servername, $user, $pw, $db);
 if($conn -> connect_error){
   die('Error while connecting' . $conn -> connect_error);
 }

 //Löschen des angemeldeten Nutzers
    session_start();

    $email = $_SESSION["loginuser"];
    $sql = "DELETE FROM users WHERE email = '$email'";
    $conn -> query($sql) or die('Error while delete data' . $conn -> error);

    session_destroy();
    header("Location: index.html");


//Beenden der Verbindung
$conn -> close();

?>
