
<?php

//Variablen
 $servername = 'localhost';
 $user = 'root';
 $pw = '';
 $db = 'mybib';

 $buchname = $_POST["buchname"];
 $bewertung = $_POST["bewertung"];

 $timestamp = time();
 $datum = date("Y.m.d", $timestamp);

//Verbindungsaufbau
 $conn = new mysqli($servername, $user, $pw, $db);
 if($conn -> connect_error){
   die('Error while connecting' . $conn -> connect_error);
 }


  session_start();
  $email = $_SESSION["loginuser"];

  //Ermittlung der UserID
  $userselect = "SELECT userid FROM users WHERE email = '$email'";
  $result = $conn -> query ($userselect);
  $userid = $result->fetch_array()[0] ?? '';

  //Ermittlung der BuchID
  $bookselect = "SELECT id FROM books WHERE titel = '$buchname'";
  $result = $conn -> query ($bookselect);
  $bookid = $result->fetch_array()[0] ?? '';

  $sql2 = "INSERT INTO ratings (bewertung, datum, buchid, userid)
          VALUES('$bewertung', '$datum', '$bookid', '$userid')";
          $conn -> query($sql2) or die('Error while insert data' . $conn -> error);

  header("Location: bibliothek.php");

//Beenden der Verbindung
$conn -> close();

?>
