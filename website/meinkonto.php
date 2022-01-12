<?php
session_start();
if(!isset($_SESSION["loginuser"])){
  header("Location: anmelden.php");
  exit;
}
 ?>

<!DOCYTYPE html>

<html>

<head>

<!--Einbindungen-->
    <meta charset="UTF-8" content="width=device-width, initial-scale=1.0">
    <title>Mein Konto</title>
    <link href="sytle.css" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <style>@import url('https://fonts.googleapis.com/css?family=Oswald');</style>
    <link rel="shortcut icon" type="image/x-icon" href="Bilder/buch.png">
    <!--<script src="JavaScript.js"></script>-->


</head>

<!--Navigationsleite für das Menü-->
    <nav>
       <ul>

            <li class="dropdown">
                <a href="startseite.php">STARTSEITE</a>
            </li>

            <li class="dropdown">
                <a href="bibliothek.php">BIBLIOTHEK</a>
            </li>

            <li class="dropdown">
                  <a class="aktuelleseite" href="meinkonto.php">MEIN KONTO</a>
            </li>




        </ul>
    </nav>

<body <body a link="black" vlink="black">

    <header>

<!--Einbindung des Hintergrundbildes unter der Menü Leiste-->
        <div class="bildhintergrund"><img src="Bilder/Bibliothek.jpg" width="100%"></div>

    </header>


    <script>

    var ajax = new XMLHttpRequest();
    ajax.open("GET", "meinkonto_db.php", true);
    ajax.send();

    ajax.onreadystatechange = function(){
      if(this.readyState == 4 && this.status == 200){

        var data = JSON.parse(this.responseText);


        for(var a = 0; a < data.length; a++){

          var name = data[a].name;
          var vorname = data[a].vorname;
          var email = data[a].email;
          var passwort = data[a].passwort;
        }

        document.getElementById("name_db").innerHTML = name;
        document.getElementById("vorname_db").innerHTML = vorname;
        document.getElementById("email_db").innerHTML = email;
        document.getElementById("passwort_db").innerHTML = passwort;

      }
    }

    /*Laden der existierenden E-Mails der Datenbank*/
    var dbemails = ""

    var ajax2 = new XMLHttpRequest();
    ajax2.open("GET", "meinkonto_db2.php", true);
    ajax2.send();

    ajax2.onreadystatechange = function(){
      if(this.readyState == 4 && this.status == 200){

        var emaildata = JSON.parse(this.responseText);


        for(var b = 0; b < emaildata.length; b++){

          dbemails = dbemails + " " + emaildata[b].email;

            }
          }
        }

      /*Funktion zur Passwortüberprüfung*/
    function valuesCheck() {

      var name = document.getElementById("name").value;
      var vorname = document.getElementById("vorname").value;
      var email = document.getElementById("email").value;
      var passwort = document.getElementById("passwort").value;

      /*Überprüfung ob Namefeld korrekt ist*/
      if(name=="" || !name.match(/^[a-zA-z]{1,}$/)){
        document.getElementById("error1").innerHTML="Bitte korrekten Namen eingeben!";
        return false;
      }else{
        document.getElementById("error1").innerHTML="";
      }

      /*Überprüfung ob Vornamefeld korrekt ist*/
      if(vorname=="" || !vorname.match(/^[a-zA-z]{1,}$/)){
        document.getElementById("error2").innerHTML="Bitte korrekten Vornamen eingeben!";
        return false;
      }else{
        document.getElementById("error2").innerHTML="";
      }

      /*Überprüfung ob E-Mailfeld korrekt ist*/
      if(email=="" || !email.match(/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)){
        document.getElementById("error3").innerHTML="Bitte korrekte E-Mail eingeben!";
        return false;
      }else{
        document.getElementById("error3").innerHTML="";
      }

      /*Überprüfung ob die E-Mail bereits vorhanden ist*/
      if(dbemails.indexOf(email) > -1){
        document.getElementById("error3").innerHTML="Diese E-Mail ist bereis vergeben!";
        return false;
      }else{
        document.getElementById("error3").innerHTML="";
      }

      /*Überprüfung ob Passwortfeld leer ist*/
      if(passwort==""){
        document.getElementById("error4").innerHTML="Bitte Passwort eingeben!";
        return false;
      }else{
        document.getElementById("error4").innerHTML="";
      }

      /*Überprüfung ob das Passwort mindestens 5 Zeichen enthält*/
      if(passwort.length < 5){
        document.getElementById("error4").innerHTML="Geben Sie mindestens 5 Zeichen ein!";
        return false;
      }else{
        document.getElementById("error4").innerHTML="";
      }

      /*Überprüfung ob das Passwort mindestens eine Zahl enthält*/
      if(passwort.match(/^[a-zA-z]{1,}$/) && !passwort1.match(/^[0-9]{1,}$/)){
        document.getElementById("error4").innerHTML="Bitte mindestens eine Zahl benutzen!";
        return false;
      }else{
        document.getElementById("error4").innerHTML="";
      }

}

    </script>



<!--Bereich zum Einloggen-->
        <h1>MEIN KONTO</h1>

        <form action="meinkonto_abmelden_db.php" method="POST">
        <input type="submit" style="height: 45px; width: 120px; font-size: 20px;"
        value="Abmelden">
        </form>

        <br>

        <form action="meinkonto_aendern_db.php" method="POST" onsubmit="return valuesCheck()" >

        <fieldset>


          <legend>Aktuelle Kontodaten</legend>
          <p>

        Wenn Sie ihre Daten ändern möchten füllen Sie die Felder bitte neu aus und bestätigen anschließend!
        <br><br>
        Danach müssen Sie sich neu anmelden.

        <br><br>

        <div class="feldschrift">

        <label for="name">Name</label>
        <br>
        <span id="name_db" style="color:black; font-size:32pt;"> </span>
        <br>
        <input id ="name" name="name" size="60" style="font-size:15pt;" value="">
        <span id="error1" style="color:red; font-size:13pt;"> </span>
      </p>


      <p>
        <label for="vorname">Vorname</label>
        <br>
        <span id="vorname_db" style="color:black; font-size:32pt;"> </span>
        <br>
        <input id ="vorname" name="vorname" size="60" style="font-size:15pt;" value="">
        <span id="error2" style="color:red; font-size:13pt;"> </span>
      </p>


      <p>
        <label for="email">E-Mail</label>
        <br>
        <span id="email_db" style="color:black; font-size:32pt;"> </span>
        <br>
        <input id ="email" name="email" size="60" style="font-size:15pt;" value="">
        <span id="error3" style="color:red; font-size:13pt;"> </span>
      </p>


      <p>
        <label for="passwort">Passwort</label>
        <br>
        <span id="passwort_db" style="color:black; font-size:32pt;"> </span>
        <br>
        <input type="password" id ="passwort" name="passwort" size="60" style="font-size:15pt;" value="">
        <span id="error4" style="color:red; font-size:13pt;"> </span>
      </p>

        </div>


          <input type="submit" style="height: 45px; width: 140px; font-size: 20px;"
          value="Daten ändern">
          </form>

          <br><br>

          <form action="meinkonto_loeschen_db.php" method="POST">
          <input type="submit" style="height: 45px; width: 150px; font-size: 20px;"
          value="Konto löschen">
          </form>

</fieldset>

<!--Fußleiste-->
            <footer>

            </footer>
</body>

</html>
