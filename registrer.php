<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="no">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Registrering av bruker for skoleAdmin v1.0</title>
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
      <div class="col-xs-3 col-md-5" id="innlogging">
        <div class="form-group form-login">
          <div class="col-xs-3 col-md-5">
            <h3>Velkommen til skoleAdmin.</h3>
            <h4>Her kan du registrer bruker for systemet.</h4>
            <h5>Du blir automatisk logget inn og videresendt til forsiden etter registrering.</h5>
            <form id="regSkjema" name="regSkjema" method="POST">
              <input type="text" id="brukernavn" name="brukernavn" class="form-control input-group" placeholder="Ønsket brukernavn">
              </br>
              <input type="password" id="passord" name="passord" class="form-control input-group" placeholder="Passord">
              </br>
          <div class="wrapper">
            <span class="group-btn">
              <button type="submit" name="regAdmin" class="btn btn-success btn-md">Registrer bruker</button>
            </span>
          </div>
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

include("dbTilkoblingOOP.php");

if (isset($_POST["regAdmin"])) {
    $brNavnFraSkjema=$_POST["brukernavn"];
    $passFraSkjema=$_POST["passord"];
    // Hash passordet før vi lagrer det i databasen.
    $passordHashet = password_hash($passFraSkjema, PASSWORD_DEFAULT);
      // Best practice OG det Geir lærte bort == rette måten å gjørra no på imo ;D
    print("<br>");

    $sql="SELECT brukarnamn FROM brukarar WHERE brukarnamn='$brNavnFraSkjema'";

    $sqlObjekt = $dbLink->query($sql);

    while ($brukerNamnSQL = $sqlObjekt->fetch_assoc()) {
      if($brukerNamnSQL["brukarnamn"] == $brNavnFraSkjema) {
        die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Brukernavnet er allerede brukt, vennligst forsøk med et annet.</div>");
      }
    }

    $sql="INSERT INTO brukarar(brukarnamn, kjenneord) VALUES ('$brNavnFraSkjema','$passordHashet');";

    if($sqlObjekt = $dbLink->query($sql)) {
      print("<div class=\"alert alert-success\">Brukeren <b>$brNavnFraSkjema</b> ble registrert!<br>\n");
      print("Du blir nå sendt tilbake til hovedsiden. Blir du ikke videresendt <a href="index.php">kan du trykke her</a><br></div>\n");
      $_SESSION["brukernavn"] = "$brNavnFraSkjema";
      $_SESSION["innlogget"] = "1";
    } else {
      die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Noe gikk galt ved opprettelsen av brukeren.<br>Feil fra MySQL: " . $dbLink->error . "</div>");
    }

    echo '<META HTTP-EQUIV=REFRESH CONTENT="3; index.php">';
      // Vent tre sekunder for at brukeren rekker å se meldingen, og redirect
}

?>
