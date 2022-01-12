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
    <title>Startseite</title>
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
                <a class="aktuelleseite" href="startseite.php">STARTSEITE</a>
            </li>

            <li class="dropdown">
                <a href="bibliothek.php">BIBLIOTHEK</a>
            </li>

            <li class="dropdown">
                <a href="meinkonto.php">MEIN KONTO</a>
            </li>



        </ul>
    </nav>

<body <body a link="black" vlink="black">

    <header>

<!--Einbindung des Hintergrundbildes unter der Menü Leiste-->
        <div class="bildhintergrund"><img src="Bilder/Bibliothek.jpg" width="100%"></div>

    </header>


<!--Bereich zum Einloggen-->
        <h1>HERZLICH WILLKOMMEN!</h1>

        Auf dieser Internetseite finden Sie alles Rund um das Thema Bücher.
        <br><br>
        Viel Spaß!
        <br><br>
        <br><br>

<!--Fußleiste-->
            <footer>

            </footer>
</body>

</html>
