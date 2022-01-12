<?php
session_start();
if(!isset($_SESSION["loginuser"])){
  header("Location: anmelden.php");
  exit;
}

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


//Laden aller durchschnittlichen Bewertungen der Bücher aus der Datenbank
$sql = "SELECT AVG(bewertung) AS 'avgbewertung' FROM ratings GROUP BY (buchid) ";
$result = $conn -> query($sql);
$avgdata = array();

if($result){
while($row = mysqli_fetch_assoc($result)){
  $avgdata[] = $row;
}
}else{
  $avgdata[] = '0';
}

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
             <a href="startseite.php">STARTSEITE</a>
         </li>

         <li class="dropdown">
             <a class="aktuelleseite" href="bibliothek.php">BIBLIOTHEK</a>
         </li>

         <li class="dropdown">
             <a href="meinkonto.php">MEIN KONTO</a>
         </li>


        </ul>
    </nav>

<body a link="black" vlink="black">


  <header>

<!--Einbindung des Hintergrundbildes unter der Menü Leiste-->
      <div class="bildhintergrund"><img src="Bilder/Bibliothek.jpg" width="100%"></div>



  </header>


  <script>

  //Variable mit allen Titeln zur Prüfung ob Titel bereits vergeben ist
  var dbtitels = ""

  /*Laden der existierenden Buchinformationen der Datenbank*/
  var ajax = new XMLHttpRequest();

  ajax.open("GET", "bibliothek_db.php", true);
  ajax.send();

  ajax.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){

      var data = JSON.parse(this.responseText);

      var avgdata = <?php echo json_encode($avgdata); ?>

      var html = "";


      for(var a = 0; a < data.length; a++){

        //Prüfung ob Bewertung vorhanden ist
        if(avgdata[a].avgbewertung > 0){
          avg = avgdata[a].avgbewertung;
        }else{
          avg = "---";
        }

        //Füllen der restlichen Variablen mit den Datenbankwerten
        var id = data[a].id;
        var titel = data[a].titel;
        var autor = data[a].autor;
        var erscheinungsjahr = data[a].erscheinungsjahr;
        var beschreibung = data[a].beschreibung;

        dbtitels = dbtitels + " " + data[a].titel;

        html += "<tr>";
          html += "<td>" + titel + "</td";
        html += "<tr>";
          html += "<td>" + autor + "</td";
        html += "<tr>";
          html += "<td>" + erscheinungsjahr + "</td";
        html += "<tr>";
          html += "<td>" + avg + "</td";
        html += "</tr>";

      }

      document.getElementById("bookdata").innerHTML = html;

    }
  }

    /*Funktion zur Eingabenüberprüfung*/
  function valuesCheck() {

    var titel = document.getElementById("titel").value;


    /*Überprüfung ob Titelfeld korrekt ist*/
    if(titel==""){
      document.getElementById("error1").innerHTML="Bitte korrekten Buchtitel eingeben!";
      return false;
    }else{
      document.getElementById("error1").innerHTML="";
    }

    /*Überprüfung ob der Titel bereits vorhanden ist*/
    if(dbtitels.indexOf(titel) > -1){
      document.getElementById("error1").innerHTML="";
    }else{
      document.getElementById("error1").innerHTML="Dieses Buch existiert nicht!";
      return false;
    }

  }

  </script>



<!--Bereich für die Büchertabelle-->
  <h1>BIBLIOTHEK</h1>


    <fieldset>


      <legend>Bücher finden</legend>
      <p>

        <!--div Container für die Büchertabelle-->
        <div class="tablebuch">
        <table>
          <thead>

            <td>Titel</td>
            <td>Autor</td>
            <td>Erscheinungsjahr</td>
            <td>Ø Bewertung</td>

          </thead>

          <tr>

            <tbody id="bookdata"></tbody>

          </tr>

        </table>

        <br>

      </div>


        Geben Sie im Feld den Buchtitel ein über den Sie mehr erfahren möchten!
        <br><br>

      <form action="buchinfo.php" method="GET" onsubmit="return valuesCheck()">
        <label for="titel">Buchtitel</label>
        <br>
        <input id ="titel" name="titel" size="60" style="font-size:15pt;" value="">
        <br>
        <span id="error1" style="color:red; font-size:13pt;"> </span>
        </p>

        <input type="submit"
        style="height: 50px; width: 260px; font-size: 25px;"
        value="Mehr Infos zum Buch" >
      </form>


      </fieldset>


<!--Fußleiste-->
          <footer>

          </footer>
</body>

</html>
