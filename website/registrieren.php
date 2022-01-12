<!DOCYTYPE html>

<html>

<head>

<!--Einbindungen-->
    <meta charset="UTF-8" content="width=device-width, initial-scale=1.0">
    <title>Registrieren</title>
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
             <a href="index.html">STARTSEITE</a>
         </li>

         <li class="dropdown">
             <a href="anmelden.php">ANMELDEN</a>
         </li>

         <li class="dropdown">
             <a class="aktuelleseite" href="registrieren.php">REGISTRIEREN</a>
         </li>


        </ul>
    </nav>

<body>

    <header>

<!--Einbindung des Hintergrundbildes unter der Menü Leiste-->
        <div class="bildhintergrund"><img src="Bilder/Bibliothek.jpg" width="100%"></div>

    </header>


    <script>

    /*Laden der existierenden E-Mails der Datenbank*/
    var dbemails = ""

    var ajax = new XMLHttpRequest();
    ajax.open("GET", "registrieren_db.php", true);
    ajax.send();

    ajax.onreadystatechange = function(){
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
      var passwort1 = document.getElementById("passwort1").value;
      var passwort2 = document.getElementById("passwort2").value;

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
        document.getElementById("error3").innerHTML="Bitte korrekten E-Mail eingeben!";
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
      if(passwort1==""){
        document.getElementById("error4").innerHTML="Bitte Passwort eingeben!";
        return false;
      }else{
        document.getElementById("error4").innerHTML="";
      }

      /*Überprüfung ob das Passwort mindestens 5 Zeichen enthält*/
      if(passwort1.length < 5){
        document.getElementById("error4").innerHTML="Geben Sie mindestens 5 Zeichen ein!";
        return false;
      }else{
        document.getElementById("error4").innerHTML="";
      }

      /*Überprüfung ob das Passwort mindestens eine Zahl enthält*/
      if(passwort1.match(/^[a-zA-z]{1,}$/) && !passwort1.match(/^[0-9]{1,}$/)){
        document.getElementById("error4").innerHTML="Bitte mindestens eine Zahl benutzen!";
        return false;
      }else{
        document.getElementById("error4").innerHTML="";
      }

      /*Überprüfung ob die Passwortbestätigung korrekt ist*/
      if(passwort1!=passwort2){
        document.getElementById("error5").innerHTML="Passwörter stimmen nicht überein!";
        return false;
    }else{
      document.getElementById("error5").innerHTML="";
    }

}

    </script>


        <form action="connect.php" method="POST" onsubmit="return valuesCheck()">

<!--Bereich zum Registrieren-->
          <h1>REGISTRIEREN</h1>

          <fieldset>


            <legend>Registrierungsdaten eingeben</legend>
            <p>

              <div class="feldschrift">

              <label for="name">Name</label>
              <br>
              <input id ="name" name="name" size="60" style="font-size:15pt;" value="">
              <span id="error1" style="color:red; font-size:13pt;"> </span>
            </p>


            <p>
              <label for="vorname">Vorname</label>
              <br>
              <input id ="vorname" name="vorname" size="60" style="font-size:15pt;" value="">
              <span id="error2" style="color:red; font-size:13pt;"> </span>
            </p>


            <p>
              <label for="email">E-Mail</label>
              <br>
              <input id ="email" name="email" size="60" style="font-size:15pt;" value="">
              <span id="error3" style="color:red; font-size:13pt;"> </span>
            </p>


            <p>
              <label for="passwort">Passwort</label>
              <br>
              <input type="password" id ="passwort1" name="passwort" size="60" style="font-size:15pt;" value="">
              <span id="error4" style="color:red; font-size:13pt;"> </span>
            </p>


            <p>
              <label for="passwort">Passwort bestätigen</label>
              <br>
              <input type= "password" id ="passwort2" size="60" style="font-size:15pt;" value="">
              <span id="error5" style="color:red; font-size:13pt;"> </span>
            </p>

          </div>

            <p>
              <input type="submit" style="height: 35px; width: 100px; font-size: 15px"
              value="Registrieren">
            </p>

          </fieldset>


          <p></p>

        </form>

<!--Fußleiste-->
            <footer>

            </footer>
</body>

</html>
