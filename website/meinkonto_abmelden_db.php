
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

 //Beenden der Session -> Ausloggen des Benutzers
    session_start();
    session_destroy();
    header("Location: index.html");

//Beenden der Verbindung
$conn -> close();

?>
