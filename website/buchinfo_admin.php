<?php
session_start();
if(!isset($_SESSION["loginuser"])){
  header("Location: anmelden.php");
  exit;
}

if($_SESSION["loginuser"] != 'admin@bib.de'){
  header("Location: buchinfo.php");
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

    //Buchdatens laden
    $titelinput = $_GET["titel"];


    $sql = "SELECT id, titel, autor, erscheinungsjahr, beschreibung FROM books WHERE titel = '$titelinput'";
    $result = $conn -> query($sql);

    while($row = mysqli_fetch_assoc($result)){
      $id = $row['id'];
      $titel = $row['titel'];
      $autor = $row['autor'];
      $erscheinungsjahr = $row['erscheinungsjahr'];
      $beschreibung = $row['beschreibung'];
    }

      //Laden aller Buchtitel außer des aktuellen für spätere Überschreibung
      $sql2 = "SELECT titel FROM books WHERE titel NOT LIKE ('$titelinput')";
      $result = $conn -> query($sql2);
      $bookdata = array();

      while($row = mysqli_fetch_assoc($result)){
        $bookdata[] = $row;
      }

      $bookselect = "SELECT id FROM books WHERE titel = '$titelinput'";
      $bookresult = $conn -> query ($bookselect);
      $bookid = $bookresult->fetch_array()[0] ?? '';

      $sqlavg = "SELECT AVG(bewertung) FROM ratings WHERE buchid = '$bookid'";
      $avgresult = $conn -> query ($sqlavg);
      if($avgresult){
      $avg = $avgresult->fetch_array()[0] ?? '';
    }


//Beenden der Verbindung
$conn -> close();

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
             <a href="benutzer_admin.php">BENUTZER</a>
         </li>

         <li class="dropdown">
             <a href="meinkonto.php">MEIN KONTO</a>
         </li>


        </ul>
    </nav>

<body a link="#995a39" vlink="#995a39">


  <header>

<!--Einbindung des Hintergrundbildes unter der Menü Leiste-->
      <div class="bildhintergrund"><img src="Bilder/Bibliothek.jpg" width="100%"></div>

  </header>


  <script>

      window.onload = function(){

      /*Laden der existierenden Buchtitel der Datenbank*/
      var dbtitels = "";
      var bookdata = <?php echo json_encode($bookdata); ?>;


      for(var a = 0; a < bookdata.length; a++){

        dbtitels = dbtitels + " " + bookdata[a].titel;

      }

      var id = <?php echo json_encode($id); ?>;
      var titel = <?php echo json_encode($titel); ?>;
      var autor = <?php echo json_encode($autor); ?>;
      var erscheinungsjahr = <?php echo json_encode($erscheinungsjahr); ?>;
      var beschreibung = <?php echo json_encode($beschreibung); ?>;

      var avg = <?php echo json_encode($avg); ?>;

      /*Übergeben der Variablen für spätere Verwendung*/
      document.getElementById("id").value = id;
      document.getElementById("id2").value = id;
      document.getElementById("titel2").value = titel;


      document.getElementById("headline").innerHTML = titel;

      document.getElementById("avgrating").innerHTML = avg;

      document.getElementById("id_db").innerHTML = id;
      document.getElementById("titel_db").innerHTML = titel;
      document.getElementById("autor_db").innerHTML = autor;
      document.getElementById("erscheinungsjahr_db").innerHTML = erscheinungsjahr;
      document.getElementById("beschreibung_db").innerHTML = beschreibung;


}

  /*Funktion zur Eingabenüberprüfung*/
function valuesCheck() {

  var titel = document.getElementById("titel").value;
  var autor = document.getElementById("autor").value;
  var erscheinungsjahr = document.getElementById("erscheinungsjahr").value;
  var beschreibung = document.getElementById("beschreibung").value;


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
  if(erscheinungsjahr =="" || !erscheinungsjahr.match(/^[0-9]{1,}$/)){
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

}

</script>

<!--Bereich für die Buchinformationen-->
  <h1 id = "headline" style="text-transform: uppercase;"></h1>

      <fieldset>

        <legend>Informationen</legend>

        <br>
        Um die Buchinformationen zu ändern müssen Sie die Felder neu ausfüllen und anschließend mit "Daten ändern" bestätigen!
        <br><br>


    <form action="buchinfo_aendern_db.php" method="POST" onsubmit="return valuesCheck()">

      <input type ="hidden" id="id" name="id" style="font-size:15pt;">


      <div class="feldschrift">

      <label for="id">Buch ID</label>
      <br>
      <span id="id_db" style="color:black; font-size:32pt;"> </span>
      <br>
    </p>

      <label for="titel">Titel</label>
      <br>
      <span id="titel_db" style="color:black; font-size:32pt;"> </span>
      <br>
      <input id ="titel" name="titel" size="60" style="font-size:15pt;" value="">
      <span id="error1" style="color:red; font-size:13pt;"> </span>
    </p>


    <p>
      <label for="autor">Autor</label>
      <br>
      <span id="autor_db" style="color:black; font-size:32pt;"> </span>
      <br>
      <input id ="autor" name="autor" size="60" style="font-size:15pt;" value="">
      <span id="error2" style="color:red; font-size:13pt;"> </span>
    </p>


    <p>
      <label for="erscheinungsjahr">Erscheinungsjahr</label>
      <br>
      <span id="erscheinungsjahr_db" style="color:black; font-size:32pt;"> </span>
      <br>
      <input id ="erscheinungsjahr" name="erscheinungsjahr" size="60" style="font-size:15pt;" value="">
      <span id="error3" style="color:red; font-size:13pt;"> </span>
    </p>


    <p>
      <label for="beschreibung">Beschreibung</label>
      <br>
      <span id="beschreibung_db" style="color:black; font-size:32pt;"> </span>
      <br>
      <textarea id ="beschreibung" name="beschreibung" style="height: 250px; width: 574px; font-size: 22px"></textarea>
      <span id="error4" style="color:red; font-size:13pt;"> </span>
    </p>

    <label for="avgrating">Ø-Bewertung</label>
    <br>
    <span id="avgrating" style="color:black; font-size:32pt;"> </span>
    <br><br>

      </div>


        <input type="submit"
        style="height: 50px; width: 260px; font-size: 25px;"
        value="Daten ändern" >
      </form>


      <form action="buchinfo_loeschen_db.php" method="POST">
        <input type ="hidden" id="id2" name="id2" style="font-size:15pt;">
        <input type="submit"
        style="height: 50px; width: 260px; font-size: 25px;"
        value="Buch löschen" >
      </form>

        <input type ="hidden" id="titel2" name="titel2" style="font-size:15pt;">


    </fieldset>



<!--Fußleiste-->
  <footer>

  </footer>


</body>

</html>
