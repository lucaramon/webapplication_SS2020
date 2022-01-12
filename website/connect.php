
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


//Hinzufügen eines Benutzers
  $emailselect = "SELECT * FROM users WHERE email = '$email'";
  $result = $conn -> query ($emailselect);
  if($result->num_rows == 0){

  $sql3 = "INSERT INTO users (name, vorname, email, passwort)
          VALUES('$name', '$vorname', '$email', '$passwort')";
          $conn -> query($sql3) or die('Error while insert data' . $conn -> error);

          header("Location: anmelden.php");

        }else{
          die('Diese E-Mail existiert bereits! Bitte gehen Sie zurück und wählen eine andere' . $conn -> connect_error);
        }


//Beenden der Verbindung
$conn -> close();

?>
