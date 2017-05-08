<?php
include_once("loginFunksjoner.php");

if (ikkeInnlogget()) {
  echo '<META HTTP-EQUIV=REFRESH CONTENT="3; innlogging.php">';
  die("<div class=\"alert alert-danger\">Du må være logget inn for å bruke denne siden, <a href=\"innlogging.php\">vennligst trykk her om du ikke blir videresendt.</a></div>");
}

include ("radio/endreKlasseRadio.php");

if(isset($_POST["velgKlasseKnapp"])) {

  $klassekode=$_POST["klasse"];

  $sql = "SELECT * FROM klasse WHERE klassekode='$klassekode';";

  $sqlObjekt = $dbLink->query($sql) or
  die("<div class=\"alert alert-danger\" role=\"alert\">Ikke mulig å hente informasjon fra databasen.</div>");

  $klasse = $sqlObjekt->fetch_assoc();

  print("<h4>Endre valgt klasse</h4>");
  print('<form method="POST" name="endreValgtKlasse" id="endreValgtKlasse">' . "\n");
  print("Klassekode:<br>\n");
  print('<input type="text" name="klassekode" id="gray" value="' . $klasse["klassekode"] . "\" readonly><br>\n");
  print("Klassenavn:<br>\n");
  print('<input type="text" name="klassenavn" value="' . $klasse["klassenavn"] . "\" required>\n<br><br>\n");
  print("<input type='submit' name='endreKlasseKnapp'class='btn btn-success'' value='Endre klassen'><br>\n");
  print("</form>\n");
  print("<br>\n");
    // Over skriver vi ut skjema for å endre klassenavnet utifra valgt klassekode. Kunne brukt HEREDOC/NOWDOC
}

if(isset($_POST["endreKlasseKnapp"])) {

  $klassekode=$_POST["klassekode"];
  $klassenavn=$_POST["klassenavn"];

  if(!$klassenavn) {
    print("<div class=\"alert alert-danger\" role=\"alert\">Klassenavnet kan dessverre ikke være tomt! Forsøk igjen.</div>");
  } else {
    $sql = "UPDATE klasse SET klassenavn='$klassenavn' WHERE klassekode='$klassekode';";

    if(!$dbLink->query($sql)) {
      die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Ikke mulig å endre klasse.</div>");
    } else {
      print("<div class=\"alert alert-success\" role=\"alert\">Klassen ble endret!</div>");
    }

  }
}
?>
