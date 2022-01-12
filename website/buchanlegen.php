<?php
session_start();
if(!isset($_SESSION["loginuser"])){
  header("Location: anmelden.php");
  exit;
}

if($_SESSION["loginuser"] != 'admin@bib.de'){
  header("Location: bibliothek.php");
  exit;
}

$timestamp = time();
$datum = date("Y", $timestamp);

 ?>

<!DOCYTYPE html>

<html>

<head>

<!--Einbindungen-->
    <meta charset="UTF-8" content="width=device-width, initial-scale=1.0">
    <title>Bibliothek</title>
    <link href="sytle.css" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <style>@import url('https://fonts.googleapis.com/css?family=Oswald');</style>
    <link rel="shortcut icon" type="image/x-icon" href="Bilder/buch.png">


</head>

<!--Navigationsleite für das Menü-->
    <nav>
       <ul>

         <li class="dropdown">
             <a href="startseite_admin.php">STARTSEITE</a>
         </li>

         <li class="dropdown">
             <a class="aktuelleseite" href="bibliothek_admin.php">BIBLIOTHEK</a>
         </li>

         <li class="dropdown">
             <a href="benutzer_admin.php">BENUTZER</a>
         </li>

         <li class="dropdown">
             <a href="meinkonto_admin.php">MEIN KONTO</a>
         </li>


        </ul>
    </nav>

<body a link="black" vlink="black">


  <header>

<!--Einbindung des Hintergrundbildes unter der Menü Leiste-->
      <div class="bildhintergrund"><img src="Bilder/Bibliothek.jpg" width="100%"></div>



  </header>


  <script>

  /*Laden der existierenden Buchtitel der Datenbank*/
  var dbtitels = ""

  var ajax = new XMLHttpRequest();
  ajax.open("GET", "buchanlegen_db2.php", true);
  ajax.send();

  ajax.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){

      var titeldata = JSON.parse(this.responseText);


      for(var a = 0; a < titeldata.length; a++){

        dbtitels = dbtitels + " " + titeldata[a].titel;

          }
        }
      }


    /*Funktion zur Eingabenüberprüfung*/
  function valuesCheck() {

    var titel = document.getElementById("titel").value;
    var autor = document.getElementById("autor").value;
    var erscheinungsjahr = document.getElementById("erscheinungsjahr").value;
    var beschreibung = document.getElementById("beschreibung").value;
    var bewertung = document.getElementById("bewertung").value;

    var datum = <?php echo json_encode($datum); ?>


    /*Überprüfung ob Titelfeld korrekt ist*/
    if(titel==""){
      document.getElementById("error1").innerHTML="Bitte korrekten Buchtitel eingeben!";
      return false;
    }else{
      document.getElementById("error1").innerHTML="";
    }

    /*Überprüfung ob der Titel bereits vorhanden ist*/
    if(dbtitels.indexOf(titel) > -1){
      document.getElementById("error1").innerHTML="Dieser Buchtitel ist bereis vergeben!";
      return false;
    }else{
      document.getElementById("error1").innerHTML="";
    }

    /*Überprüfung ob Autorfeld korrekt ist*/
    if(autor==""  || autor.match(/^[0-9]{1,}$/)){
      document.getElementById("error2").innerHTML="Bitte korrekten Autor eingeben!";
      return false;
    }else{
      document.getElementById("error2").innerHTML="";
    }

    /*Überprüfung ob Erscheinungsjahrfeld korrekt ist*/
    if(erscheinungsjahr =="" || !erscheinungsjahr.match(/^[0-9]{1,}$/) || erscheinungsjahr > datum){
      document.getElementById("error3").innerHTML="Bitte korrektes Jahr eingeben!";
      return false;
    }else{
      document.getElementById("error3").innerHTML="";
    }


    /*Überprüfung ob Beschreibungfeld leer ist*/
    if(beschreibung==""){
      document.getElementById("error4").innerHTML="Bitte korrekte Beschreibung eingeben!";
      return false;
    }else{
      document.getElementById("error4").innerHTML="";
    }


    /*Überprüfung ob Erscheinungsjahrfeld korrekt ist*/
    if(bewertung =="" || !bewertung.match(/^[0-9]{1,}$/) || bewertung == 0 || bewertung > 10){
      document.getElementById("error6").innerHTML="Bitte korrekte Bewertung abgeben!";
      return false;
    }else{
      document.getElementById("error6").innerHTML="";
    }

}

  </script>



    <form action="buchanlegen_db.php" method="POST" onsubmit="return valuesCheck()">

  <!--Bereich zum Anlegen eines Buches-->
            <h1>BUCH ANLEGEN</h1>

            <fieldset>

              <legend>Buchinformationen eingeben</legend>
              <p>

                <div class="feldschrift">

                <label for="titel">Titel</label>
                <br>
                <input id ="titel" name="titel" size="60" style="font-size:15pt;">
                <span id="error1" style="color:red; font-size:13pt;"> </span>
              </p>


              <p>
                <label for="autor">Autor</label>
                <br>
                <input id ="autor" name="autor" size="60" style="font-size:15pt;">
                <span id="error2" style="color:red; font-size:13pt;"> </span>
              </p>


              <p>
                <label for="erscheinungsjahr">Erscheinungsjahr</label>
                <br>
                <input id ="erscheinungsjahr" name="erscheinungsjahr" size="60" style="font-size:15pt;">
                <span id="error3" style="color:red; font-size:13pt;"> </span>
              </p>


              <p>
                <label for="beschreibung">Beschreibung</label>
                <br>
                <textarea id ="beschreibung" name="beschreibung" style="height: 220px; width: 574px; font-size: 22px"></textarea>
                <span id="error4" style="color:red; font-size:13pt;"> </span>
              </p>


              <p>
                <label for="titelbild">Titelbild</label>
                <br>
                <input type="file" id ="titelbild" name="titelbild" size="60" style="font-size:15pt;">
                <span id="error5" style="color:red; font-size:13pt;"> </span>
              </p>


              <p>
                <label for="bewertung">Erste Bewertung (1-10)</label>
                <br>
                <input id ="bewertung" name="bewertung" size="60" style="font-size:15pt;">
                <span id="error6" style="color:red; font-size:13pt;"> </span>
              </p>



            </div>
                <br>
              <p>
                <input type="submit" style="height: 55px; width: 210px; font-size: 25px"
                value="Buch hinzufügen">
              </p>


            </fieldset>


          </form>

        <!--Fußleiste-->
              <footer>

              </footer>
        </body>

        </html>
