
<?php

//Variablen
 $servername = 'localhost';
 $user = 'root';
 $pw = '';
 $db = 'mybib';

 $titel = $_POST["titel"];
 $autor = $_POST["autor"];
 $erscheinungsjahr = $_POST["erscheinungsjahr"];
 $beschreibung = $_POST["beschreibung"];

 $bewertung = $_POST["bewertung"];

//Verbindungsaufbau
 $conn = new mysqli($servername, $user, $pw, $db);
 if($conn -> connect_error){
   die('Error while connecting' . $conn -> connect_error);
 }

 session_start();
 $email = $_SESSION["loginuser"];

 $timestamp = time();
 $datum = date("Y.m.d", $timestamp);


//SQL Statement zur Erzeugung der Büchertabelle
 $sql1 = "CREATE TABLE IF NOT EXISTS books (id INT PRIMARY KEY AUTO_INCREMENT,
          titel VARCHAR(50), autor VARCHAR(50), erscheinungsjahr INT, beschreibung VARCHAR(255))";
          $conn -> query($sql1) or die('Error while creating the table' . $conn -> error);


//Erzeugung der Ratingtabelle
$sql2 = "CREATE TABLE IF NOT EXISTS ratings
            (bewertung INT, datum DATE, buchid INT, userid INT)";
            $conn -> query($sql2) or die('Error while creating the table' . $conn -> error);


//Einfügen des Datensatzes in die Büchertabelle
$sql3 = "INSERT INTO books (titel, autor, erscheinungsjahr, beschreibung)
        VALUES('$titel', '$autor', '$erscheinungsjahr', '$beschreibung')";
        $conn -> query($sql3) or die('Error while insert data' . $conn -> error);



//Ermittlung der UserID
$userselect = "SELECT userid FROM users WHERE email = '$email'";
$userresult = $conn -> query ($userselect);
$userid = $userresult->fetch_array()[0] ?? '';

//Ermittlung der BuchID
$bookselect = "SELECT id FROM books WHERE titel = '$titel'";
$bookresult = $conn -> query ($bookselect);
$bookid = $bookresult->fetch_array()[0] ?? '';

//Einfügen der ersten Bewertung für das angelegte Buch in die Ratingtabelle
$sql4 = "INSERT INTO ratings (bewertung, datum, buchid, userid)
        VALUES('$bewertung', '$datum', '$bookid', '$userid')";
        $conn -> query($sql4) or die('Error while insert data' . $conn -> error);

header("Location:bibliothek_admin.php");


//Beenden der Verbindung
$conn -> close();

?>
