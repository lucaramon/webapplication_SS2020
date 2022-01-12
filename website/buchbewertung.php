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



    //Buchdaten laden
    $titel = $_GET["titel2"];
    $email = $_SESSION["loginuser"];

    //Ermittlung der UserID
    $userselect = "SELECT userid FROM users WHERE email = '$email'";
    $userresult = $conn -> query ($userselect);
    $userid = $userresult->fetch_array()[0] ?? '';

    //Ermittlung der BuchID
    $bookselect = "SELECT id FROM books WHERE titel = '$titel'";
    $bookresult = $conn -> query ($bookselect);
    $bookid = $bookresult->fetch_array()[0] ?? '';

    //Ermittlung ob User bereits eine Bewertung abgegeben hat
    $sql = "SELECT bewertung FROM ratings WHERE buchid = '$bookid' AND userid = '$userid'";
    $result = $conn -> query($sql);
    if($row = mysqli_fetch_assoc($result)){
      $userrated = true;
    }else if(!$row = mysqli_fetch_assoc($result)){
      $userrated = false;
    }


    //Datenbanksuche für die Summe jeder Bewertungsmöglichkeit
    $sqlrating1 = "SELECT COUNT(bewertung) FROM ratings WHERE bewertung = '1' AND buchid = '$bookid'";
    $rating1result = $conn -> query ($sqlrating1);
    $rating1 = $rating1result->fetch_array()[0] ?? '';

    $sqlrating2 = "SELECT COUNT(bewertung) FROM ratings WHERE bewertung = '2' AND buchid = '$bookid'";
    $rating2result = $conn -> query ($sqlrating2);
    $rating2 = $rating2result->fetch_array()[0] ?? '';

    $sqlrating3 = "SELECT COUNT(bewertung) FROM ratings WHERE bewertung = '3' AND buchid = '$bookid'";
    $rating3result = $conn -> query ($sqlrating3);
    $rating3 = $rating3result->fetch_array()[0] ?? '';

    $sqlrating4 = "SELECT COUNT(bewertung) FROM ratings WHERE bewertung = '4' AND buchid = '$bookid'";
    $rating4result = $conn -> query ($sqlrating4);
    $rating4 = $rating4result->fetch_array()[0] ?? '';

    $sqlrating5 = "SELECT COUNT(bewertung) FROM ratings WHERE bewertung = '5' AND buchid = '$bookid'";
    $rating5result = $conn -> query ($sqlrating5);
    $rating5 = $rating5result->fetch_array()[0] ?? '';

    $sqlrating6 = "SELECT COUNT(bewertung) FROM ratings WHERE bewertung = '6' AND buchid = '$bookid'";
    $rating6result = $conn -> query ($sqlrating6);
    $rating6 = $rating6result->fetch_array()[0] ?? '';

    $sqlrating7 = "SELECT COUNT(bewertung) FROM ratings WHERE bewertung = '7' AND buchid = '$bookid'";
    $rating7result = $conn -> query ($sqlrating7);
    $rating7 = $rating7result->fetch_array()[0] ?? '';

    $sqlrating8 = "SELECT COUNT(bewertung) FROM ratings WHERE bewertung = '8' AND buchid = '$bookid'";
    $rating8result = $conn -> query ($sqlrating8);
    $rating8 = $rating8result->fetch_array()[0] ?? '';

    $sqlrating9 = "SELECT COUNT(bewertung) FROM ratings WHERE bewertung = '9' AND buchid = '$bookid'";;
    $rating9result = $conn -> query ($sqlrating9);
    $rating9 = $rating9result->fetch_array()[0] ?? '';

    $sqlrating10 = "SELECT COUNT(bewertung) FROM ratings WHERE bewertung = '10' AND buchid = '$bookid'";
    $rating10result = $conn -> query ($sqlrating10);
    $rating10 = $rating10result->fetch_array()[0] ?? '';

    $sqlavg = "SELECT AVG(bewertung) FROM ratings WHERE buchid = '$bookid'";
    $avgresult = $conn -> query ($sqlavg);
    $avg = $avgresult->fetch_array()[0] ?? '';


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

    var userrated = "";

  window.onload = function(){

    //Values für die Ratingtabelle mit Übergabe in die Tabelle
    var rating1 = <?php echo json_encode($rating1); ?>;
    var rating2 = <?php echo json_encode($rating2); ?>;
    var rating3 = <?php echo json_encode($rating3); ?>;
    var rating4 = <?php echo json_encode($rating4); ?>;
    var rating5 = <?php echo json_encode($rating5); ?>;
    var rating6 = <?php echo json_encode($rating6); ?>;
    var rating7 = <?php echo json_encode($rating7); ?>;
    var rating8 = <?php echo json_encode($rating8); ?>;
    var rating9 = <?php echo json_encode($rating9); ?>;
    var rating10 = <?php echo json_encode($rating10); ?>;
    var avg = <?php echo json_encode($avg); ?>;

    document.getElementById("sumbewertung1").innerHTML = rating1;
    document.getElementById("sumbewertung2").innerHTML = rating2;
    document.getElementById("sumbewertung3").innerHTML = rating3;
    document.getElementById("sumbewertung4").innerHTML = rating4;
    document.getElementById("sumbewertung5").innerHTML = rating5;
    document.getElementById("sumbewertung6").innerHTML = rating6;
    document.getElementById("sumbewertung7").innerHTML = rating7;
    document.getElementById("sumbewertung8").innerHTML = rating8;
    document.getElementById("sumbewertung9").innerHTML = rating9;
    document.getElementById("sumbewertung10").innerHTML = rating10;
    document.getElementById("avgbewertung").innerHTML = avg;


    //Übergabe des Buchtitels
    var titel = <?php echo json_encode($titel); ?>;
    //Übergabe true or false ob der User dieses Buch schon bewertet hat
    userrated = <?php echo json_encode($userrated); ?>;

    document.getElementById("headline").innerHTML = titel;
    document.getElementById("buchname").value = titel;
  }

    function bewertungCheck(){
      var bewertung = document.getElementById("bewertung").value;

      if(bewertung = ""|| bewertung == 0 || bewertung > 10){
      document.getElementById("error1").innerHTML="Bitte korrekte Bewertung eingeben! (1-10)";
        return false;
      }
      else if(userrated == true){
      document.getElementById("error1").innerHTML="Sie haben dieses Buch bereits bewertet!";
        return false;
      }
      else{
      document.getElementById("success1").innerHTML="Die Bewertung war erfolgreich!";
      document.getElementById("error1").innerHTML="";
        }
  }

</script>


<!--Bereich für die Büchertabelle-->
  <h1>BUCHBEWERTUNG</h1>


    <fieldset>


      <legend>Tragen Sie ihre Bewertung ein</legend>
      <p>

        <h2 id = "headline" style="color:black; font-size:50pt;"></h2>

        <br>

        Sie können mit einer Zahl zwischen 1 und 10 bewerten, wobei 1 die schlechteste und 10 die beste Bewertung ist!

        <br><br>


        <form action="buchbewertung_db.php" method="POST" onsubmit="return bewertungCheck()">

        <div class="feldschriftbewertung">

        <label for="bewertung">Bewertung</label>
        <br>
        <input min="1" max="10" ondrop="return false;" onpaste="return false;" id ="bewertung" name="bewertung"
               style="font-size:180pt; height: 350px; width: 300px; text-align: center;" maxlength="2"
               onkeypress='return event.charCode>=48 && event.charCode<=57'/>

      </p>


        <input type ="hidden" id="buchname" name="buchname" style="font-size:15pt;">
        <input type="submit"
        style="height: 60px; width: 235px; font-size: 30px; position: relative; margin-left:2.5%;"
        value="Buch bewerten" >
      </form>

      </p>

      <span id="error1" style="color:red; font-size:16pt;"> </span>
      <span id="success1" style="color:green; font-size:16pt; position: relative; margin-left: 1.5%;"> </span>

      <br>

    </div>


        <!--div Container für die Büchertabelle mit Textfeldern die aus dem Script gefüllt werden-->
        <div class="tablebuchbewertung">
        <table>
          <thead>

            <td>Bewertung (1-10)</td>
            <td>Häufigkeit</td>

          </thead>

          <tr>
            <td>1</td>
            <td id="sumbewertung1"></td>
          </tr>

          <tr>
            <td>2</td>
            <td id="sumbewertung2"></td>
          </tr>

          <tr>
            <td>3</td>
            <td id="sumbewertung3"></td>
          </tr>

          <tr>
            <td>4</td>
            <td id="sumbewertung4"></td>
          </tr>

          <tr>
            <td>5</td>
            <td id="sumbewertung5"></td>
          </tr>

          <tr>
            <td>6</td>
            <td id="sumbewertung6"></td>
          </tr>

          <tr>
            <td>7</td>
            <td id="sumbewertung7"></td>
          </tr>

          <tr>
            <td>8</td>
            <td id="sumbewertung8"></td>
          </tr>

          <tr>
            <td>9</td>
            <td id="sumbewertung9"></td>
          </tr>

          <tr>
            <td>10</td>
            <td id="sumbewertung10"></td>
          </tr>

          <tr>
            <td>Ø-Bewertung</td>
            <td id="avgbewertung"></td>
          </tr>

        </table>
        <div>

      </fieldset>

      </form>

<!--Fußleiste-->
          <footer>

          </footer>
</body>

</html>
