
<?php

//Variablen
 $servername = 'localhost';
 $user = 'root';
 $pw = '';
 $db = 'mybib';

 $name = $_POST["name"];
 $vorname = $_POST["vorname"];
 $email = $_POST["email"];
 $passwort = $_POST["passwort"];

//Verbindungsaufbau
 $conn = new mysqli($servername, $user, $pw, $db);
 if($conn -> connect_error){
   die('Error while connecting' . $conn -> connect_error);
 }

//Änderung der Nutzerdaten
    session_start();
    $emailold = $_SESSION["loginuser"];

    //Ermittlung der UserID
    $userselect = "SELECT userid FROM users WHERE email = '$emailold'";
    $result = $conn -> query ($userselect);
    $userid = $result->fetch_array()[0] ?? '';

    //Update des Datensatzes
    $sql2 = "UPDATE users SET name = '$name', vorname = '$vorname', email = '$email', passwort = '$passwort'
            WHERE userid = '$userid'";
            $conn -> query($sql2) or die('Error while update data' . $conn -> error);

    header("Location: anmelden.php");

//Beenden der Verbindung
$conn -> close();

?>
