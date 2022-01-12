
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

 //Nutzerdaten laden
    session_start();
    $email = $_SESSION["loginuser"];
    $sql = "SELECT name, vorname, email, passwort FROM users WHERE email = '$email'";
    $result = $conn -> query($sql);
    $data = array();

    while($row = mysqli_fetch_assoc($result)){
      $data[] = $row;
    }

    echo json_encode($data, JSON_UNESCAPED_UNICODE);

    //header("Location: meinkonto.php");


//Beenden der Verbindung
$conn -> close();

?>
