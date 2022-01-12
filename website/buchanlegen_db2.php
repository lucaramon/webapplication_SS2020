
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

 $sql = "SELECT titel FROM books";
 $result = $conn -> query($sql);
 $data = array();

 while($row = mysqli_fetch_assoc($result)){
   $data[] = $row;
}

 echo json_encode($data, JSON_UNESCAPED_UNICODE);


//Beenden der Verbindung
$conn -> close();

?>
