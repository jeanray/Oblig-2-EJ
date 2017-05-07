<?php
  session_start();
  include("dbTilkoblingOOP.php");
  include("loginFunksjoner.php");
?>
<!DOCTYPE html>
<html lang="no">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Innloggingsside for skoleAdmin v1.0</title>
  <!-- CSS-filer -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">

  <!-- jQuery må være med av diverse grunner (BS++) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

  <!-- JS-scripts skal egentlig bli lagt inn til slutt for å sikre raskest mulig sidelasting... -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/confirm.js"></script>

</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-8 col-sm-6 col-md-6" id="innlogging">
        <div class="form-group form-login">
          <div class="col-xs-5">
            <h3>skoleAdmin v1.0</h3>
            <div class="alert alert-info" role="alert">
              <b>Du må logge inn for å bruke disse sidene.</b>
            </div>
            <h4>Logg inn:</h4>
            <form id="loginSkjema" name="loginSkjema" method="POST">

              <input type="text" id="brukernavn" name="brukernavn" class="form-control input-group" placeholder="Brukernavn" />
              </br>
              <input type="password" id="passord" name="passord" class="form-control input-group" placeholder="Passord" />
              </br>
          <div class="wrapper">
            <span class="group-btn">
              <button type="submit" name="sendLogin" id="sendLogin" class="btn btn-success btn-md">Logg inn</button>
            </span>
            <span class="group-btn">
              <a href="registrer.php" class="btn btn-info btn-md pull-right" role="button">Registrer bruker</a>
            </span>
          </div>
          <br><b>Du må ha en eksisterende bruker eller opprette en ny for å logge inn her.</b>
        </form>
        <br>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<?php
if (isset($_POST["sendLogin"])) {
  $bNavnFraSkjema = $_POST["brukernavn"];
  $passFraSkjema = $_POST["passord"];

  $sql = "SELECT kjenneord FROM brukarar WHERE brukarnamn='$bNavnFraSkjema';";

  $sqlObjekt = $dbLink->query($sql);

  $hashPassordArray = $sqlObjekt->fetch_array(MYSQLI_NUM);

  if (password_verify($passFraSkjema, $hashPassordArray[0])) {
    $_SESSION["brukernavn"] = "$bNavnFraSkjema";
    $_SESSION["innlogget"] = "1";
    print("<div class=\"alert alert-success\" role=\"alert\">Innlogging vellykket, du blir nå videresendt til <a href=\"index.php\">hovedsiden.</a></div>");
    echo '<META HTTP-EQUIV=REFRESH CONTENT="2; index.php">';
  } else {
    die("<div class=\"alert alert-danger\" role=\"alert\">Feil passord eller brukernavn, vennligst <a href=\"innlogging.php\">forsøk på nytt.</a></div>");
  }

  $sqlObjekt->free();
}
?>
