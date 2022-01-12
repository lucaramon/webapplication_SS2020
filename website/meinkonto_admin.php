<?php
session_start();
if(!isset($_SESSION["loginuser"])){
  header("Location: anmelden.php");
  exit;
}

if($_SESSION["loginuser"] != 'admin@bib.de'){
  header("Location: meinkonto.php");
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
                <a href="startseite_admin.php">STARTSEITE</a>
            </li>

            <li class="dropdown">
                <a href="bibliothek_admin.php">BIBLIOTHEK</a>
            </li>

            <li class="dropdown">
                <a href="benutzer_admin.php">BENUTZER</a>
            </li>

            <li class="dropdown">
                  <a class="aktuelleseite" href="meinkonto_admin.php">MEIN KONTO</a>
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

    </script>



<!--Bereich zum Einloggen-->
        <h1>MEIN KONTO</h1>

        <form action="meinkonto_abmelden_db.php" method="POST">
        <input type="submit" style="height: 45px; width: 120px; font-size: 20px;"
        value="Abmelden">
        </form>

        <br>


        <fieldset>


          <legend>Aktuelle Kontodaten</legend>
          <p>





        <label for="name">Name</label>
        <br>
        <span id="name_db" style="color:black; font-size:32pt;"> </span>
        <br>
      </p>


      <p>
        <label for="vorname">Vorname</label>
        <br>
        <span id="vorname_db" style="color:black; font-size:32pt;"> </span>
        <br>
      </p>


      <p>
        <label for="email">E-Mail</label>
        <br>
        <span id="email_db" style="color:black; font-size:32pt;"> </span>
        <br>
      </p>


      <p>
        <label for="passwort">Passwort</label>
        <br>
        <span id="passwort_db" style="color:black; font-size:32pt;"> </span>
        <br>
      </p>

        </div>

          <br>

</fieldset>

<!--Fußleiste-->
            <footer>

            </footer>
</body>

</html>
