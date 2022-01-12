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

//SQL Statement zur Erzeugung der Benutzertabelle
 $sql1 = "CREATE TABLE IF NOT EXISTS users (userid INT PRIMARY KEY AUTO_INCREMENT,
          name VARCHAR(50), vorname VARCHAR(50), email VARCHAR(50), passwort VARCHAR(50))";
          $conn -> query($sql1) or die('Error while creating the table' . $conn -> error);



//Funktion für das Hinzufügen des Admins
  $emailselect = "SELECT * FROM users WHERE email = 'admin@bib.de'";
  $result = $conn -> query ($emailselect);
  if($result->num_rows == 0){

  $sql2 = "INSERT INTO users (name, vorname, email, passwort)
          VALUES('Admin', 'Baba', 'admin@bib.de', '12345')";
          $conn -> query($sql2) or die('Error while insert data' . $conn -> error);
        }

 ?>

<!DOCYTYPE html>

<html>

<head>

<!--Einbindungen-->
    <meta charset="UTF-8" content="width=device-width, initial-scale=1.0">
    <title>Anmelden</title>
    <link href="sytle.css" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <style>@import url('https://fonts.googleapis.com/css?family=Oswald');</style>
    <link rel="shortcut icon" type="image/x-icon" href="Bilder/buch.png">


</head>

<!--Navigationsleite für das Menü-->
    <nav>
       <ul>

         <li class="dropdown">
             <a  href="index.html">STARTSEITE</a>
         </li>

         <li class="dropdown">
             <a class="aktuelleseite" href="anmelden.php">ANMELDEN</a>
         </li>

         <li class="dropdown">
             <a href="registrieren.php">REGISTRIEREN</a>
         </li>


        </ul>
    </nav>

<body a link="black" vlink="black">


  <header>

<!--Einbindung des Hintergrundbildes unter der Menü Leiste-->
      <div class="bildhintergrund"><img src="Bilder/Bibliothek.jpg" width="100%"></div>



  </header>


  <script>

  /*Laden der existierenden E-Mails der Datenbank*/
  var zugangsdaten = ""

  var ajax = new XMLHttpRequest();
  ajax.open("GET", "anmelden_db2.php", true);
  ajax.send();

  ajax.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){

      var data = JSON.parse(this.responseText);


      for(var a = 0; a < data.length; a++){

        zugangsdaten = zugangsdaten + " " + data[a].email + data[a].passwort;

          }
        }
      }


    /*Funktion zur Passwortüberprüfung*/
  function valuesCheck() {

    var email = document.getElementById("email").value;
    var passwort = document.getElementById("passwort").value;


    /*Überprüfung ob E-Mailfeld korrekt ist*/
    if(email=="" || !email.match(/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)){
      document.getElementById("error1").innerHTML="Bitte Feld korrekt ausfüllen!";
      return false;
    }else{
      document.getElementById("error1").innerHTML="";
    }


    /*Überprüfung ob Passwortfeld leer ist*/
    if(passwort==""){
      document.getElementById("error2").innerHTML="Bitte Feld korrekt ausfüllen!";
      return false;
    }else{
      document.getElementById("error2").innerHTML="";
    }


    /*Überprüfung ob die Anmeldedaten korrekt sind*/
    if(zugangsdaten.indexOf(email+passwort) > -1){
      document.getElementById("error3").innerHTML="";
    }else{
      document.getElementById("error3").innerHTML="Falsche Anmeldedaten!";
      return false;
    }

}

  </script>


    <form action="anmelden_db.php" method="POST" onsubmit="return valuesCheck()">

  <!--Bereich zum Einloggen-->
          <h1>ANMELDEN</h1>


            <fieldset>


              <legend>Logindaten eingeben</legend>
              <p>

              <div class="feldschrift">

              <label for="email">E-Mail</label>
              <br>
              <input id ="email" name="email" size="60" style="font-size:15pt;" value="">
              <span id="error1" style="color:red; font-size:13pt;"> </span>
              </p>

              <p>
                <label for="passwort">Passwort</label>
                <br>
                <input type="password" id ="passwort" name="passwort" size="60" style="font-size:15pt;" value="">
                <span id="error2" style="color:red; font-size:13pt;"> </span>
              </p>

              </div>

              <p>
                <input type="submit" style="height: 35px; width: 100px; font-size: 15px;"
                value="Anmelden">
                <br><br>
                <span id="error3" style="color:red; font-size:13pt;"> </span>
              </p>


            </fieldset>

            <p></p>

            </form>

            <!--Fußleiste-->
            <footer>

            </footer>

</html>
