<?php
session_start();
if(!isset($_SESSION["loginuser"])){
  header("Location: anmelden.php");
  exit;
}

if($_SESSION["loginuser"] != 'admin@bib.de'){
  header("Location: startseite.php");
  exit;
}
 ?>

<!DOCYTYPE html>

<html>

<head>

<!--Einbindungen-->
    <meta charset="UTF-8" content="width=device-width, initial-scale=1.0">
    <title>Benutzer</title>
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
             <a href="bibliothek_admin.php">BIBLIOTHEK</a>
         </li>

         <li class="dropdown">
             <a class="aktuelleseite" href="benutzer_admin.php">BENUTZER</a>
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

  var ajax = new XMLHttpRequest();

  ajax.open("GET", "benutzer_db.php", true);
  ajax.send();

  ajax.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){

      var data = JSON.parse(this.responseText);

      var html = "";

      for(var a = 0; a < data.length; a++){

        var userid = data[a].userid;
        var name = data[a].name;
        var vorname = data[a].vorname;
        var email = data[a].email;
        var passwort = data[a].passwort;

        html += "<tr>";
          html += "<td>" + userid + "</td";
        html += "<tr>";
          html += "<td>" + name + "</td";
        html += "<tr>";
          html += "<td>" + vorname + "</td";
        html += "<tr>";
          html += "<td>" + email + "</td";
        html += "<tr>";
          html += "<td>" + passwort + "</td";
        html += "</tr>";

      }

      document.getElementById("userdata").innerHTML = html;
    }
  }

  </script>



<!--Bereich für die Benutzertabelle-->
        <h1>REGISTRIERTE NUTZER</h1>

        <fieldset>

          <legend>Benutzerinformationen</legend>
          <p>


            <!--div Container für die Benutzertabelle mit manuell gefüllten Datensätzen-->
            <div class="tablenutzer">
            <table>
              <thead>

                <td>ID</td>
                <td>Name</td>
                <td>Vorname</td>
                <td>E-Mail</td>
                <td>Passwort</td>

              </thead>

              <tr>

                <tbody id="userdata"></tbody>

              </tr>


            </table>
          </div>
          </fieldset>


<!--Fußleiste-->
          <footer>

          </footer>
</body>

</html>
