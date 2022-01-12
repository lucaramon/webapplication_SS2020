
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

    $sql = "SELECT email FROM users WHERE email NOT LIKE ('$email')";
    $result = $conn -> query($sql);
    $emaildata = array();

    while($row = mysqli_fetch_assoc($result)){
      $emaildata[] = $row;
}

    echo json_encode($emaildata, JSON_UNESCAPED_UNICODE);

    //header("Location: meinkonto.php");


//Beenden der Verbindung
$conn -> close();

?>
