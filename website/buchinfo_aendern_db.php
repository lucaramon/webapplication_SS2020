
<?php

//Variablen
 $servername = 'localhost';
 $user = 'root';
 $pw = '';
 $db = 'mybib';

 $id = $_POST["id"];
 $titel = $_POST["titel"];
 $autor = $_POST["autor"];
 $erscheinungsjahr = $_POST["erscheinungsjahr"];
 $beschreibung = $_POST["beschreibung"];

//Verbindungsaufbau
 $conn = new mysqli($servername, $user, $pw, $db);
 if($conn -> connect_error){
   die('Error while connecting' . $conn -> connect_error);
 }

//Änderung der Nutzerdaten

    //Update des Datensatzes
    $sql = "UPDATE books SET titel = '$titel', autor = '$autor', erscheinungsjahr = '$erscheinungsjahr',
            beschreibung = '$beschreibung' WHERE id = '$id'";
            $conn -> query($sql) or die('Error while update data' . $conn -> error);

    header("Location: bibliothek_admin.php");

//Beenden der Verbindung
$conn -> close();

?>
