
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

    $id = $_POST["id2"];

 //Löschen des Buches
    $sql1 = "DELETE FROM books WHERE id = '$id'";
    $conn -> query($sql1) or die('Error while delete data' . $conn -> error);

//Löschen aller Ratings dieses Buches
    $sql2 = "DELETE FROM ratings WHERE buchid = '$id'";
    $conn -> query($sql2) or die('Error while delete data' . $conn -> error);

    header("Location: bibliothek_admin.php");


//Beenden der Verbindung
$conn -> close();

?>
