<?php
session_start();
include("loginFunksjoner.php");
include("dbTilkoblingOOP.php");

?>
<!DOCTYPE html>
<html lang="no">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>skoleAdmin v1.0</title>
  <!-- CSS-filer -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">

  <!-- jQuery må være med av diverse grunner (BS++) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <link href="css/jquery-ui.css" rel="stylesheet">
  <link href="css/jquery-ui.theme.css" rel="stylesheet">

  <!-- JS-scripts skal egentlig bli lagt inn til slutt for å sikre raskest mulig sidelasting... -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/confirm.js"></script>
  <script src="js/norskdp.js"></script>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Vi har byttet fra lokale filer til CDN-utgaver alle steder hvor det er mulig, av flere gode grunner (effektivt,oppdatert,osv)-->
  <!-- De lokale filene er i hovedsak kun for tilpassinger av plugins vi henter via CDN-utgavene.-->

  <!-- Her er datepickeren -->
  <script src="js/datepicker.js"></script>

  <!-- Lightbox for bildevisning -->
  <link href="css/lightbox.css" rel="stylesheet">


</head>
<body>
<?php
if (ikkeInnlogget()) {
  echo '<META HTTP-EQUIV=REFRESH CONTENT="3; innlogging.php">';
  die("<div class=\"alert alert-danger\">Du må være logget inn for å bruke denne siden, <a href=\"innlogging.php\">vennligst trykk her om du ikke blir videresendt.</a></div>");
}
?>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span> <!-- Alle disse span-taggene, er de egentlig i bruk?-->
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">skoleAdmin v1.0</a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Hjem</a></li>

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Registrering <span class="caret"></span></a>
            <ul class="dropdown-menu">

              <li><a href="index.php?funksjon=registrer_klasse">Klasse</a></li>
              <li role="separator" class="divider"></li>

              <li><a href="?funksjon=registrer_bilde">Bilde</a></li>
              <li role="separator" class="divider"></li>

              <li><a href="index.php?funksjon=registrer_student">Student</a></li>
            </ul>
          </li>

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Vis <span class="caret"></span></a>
            <ul class="dropdown-menu">

              <li><a href="?funksjon=vis_alle_klasser">Klasser</a></li>
              <li role="separator" class="divider"></li>

              <li><a href="?funksjon=vis_alle_bilder">Bilder</a></li>
              <li role="separator" class="divider"></li>

              <li><a href="?funksjon=vis_alle_studenter">Studenter</a></li>

            </ul>
          </li>

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Endre <span class="caret"></span></a>
            <ul class="dropdown-menu">

              <li><a href="?funksjon=endre_klasser">Klasse</a></li>
              <li role="separator" class="divider"></li>

              <li><a href="?funksjon=endre_bilder">Bilde</a></li>
              <li role="separator" class="divider"></li>

              <li><a href="?funksjon=endre_studenter">Student</a></li>
            </ul>
          </li>

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Slett <span class="caret"></span></a>
            <ul class="dropdown-menu">

              <li><a href="?funksjon=slette_klasse">Klasse</a></li>
              <li role="separator" class="divider"></li>

              <li><a href="?funksjon=slette_bilde">Bilde</a></li>
              <li role="separator" class="divider"></li>

              <li><a href="?funksjon=slette_student">Student</a></li>
            </ul>
          </li>
            <!-- Søkefunksjon og utlogging som enkeltknapper -->
          <li><a href="index.php?funksjon=sok">Søk</a></li>
          <li><a href="index.php?funksjon=logg_ut">Logg ut</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>

  <div class="container">
    <?php

      include("switchFunksjon.php");  // switch fil som inkluderer rette php i forhold til valgt funksjon

      $dbLink->close();
        // Over lukker vi tilkoblingen til databasen som vi har jobbet med hele veien via "switch-includes".
    ?>
  </div>

  <!-- Lightbox js for visning av bilder -->
  <script src="js/lightbox.js"></script>
</body>
</html>
