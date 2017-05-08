<?php
include_once("loginFunksjoner.php");

if (ikkeInnlogget()) {
  echo '<META HTTP-EQUIV=REFRESH CONTENT="3; innlogging.php">';
  die("<div class=\"alert alert-danger\">Du må være logget inn for å bruke denne siden, <a href=\"innlogging.php\">vennligst trykk her om du ikke blir videresendt.</a></div>");
}

$sql = "SELECT * FROM klasse ORDER BY klassekode;";
$sqlObjekt = $dbLink->query($sql);

if ($sqlObjekt->num_rows == "0") {
  die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Det ser ikke ut til å være registrert noen klasser!</div>");
}

print("<h3>Slett klasser</h3>");
print('<form method="POST" id="slettKlasseSkjema" name="slettKlasseSkjema" onsubmit="return confirm(\'Er du helt sikker på du vil utføre valgte sletting i tabellen over klasser?\n\nHandlingen kan ikke angres!\');">');
  // Legg til onsubmit-sjekk over
while ($rad = $sqlObjekt->fetch_assoc()) {
  // Hent ut første raden fra SQL og loop videre til den ikke får flere
  print('<input type="checkbox" name="klassekode[]" value="' . $rad["klassekode"] . '"> ' . $rad["klassekode"] . " - ". $rad["klassenavn"] . "<br>\n");
}
print("<br>\n");
print('<input type="submit" id="slettKlasse" name="slettKlasse" value="Slett valgt klasse" class="btn btn-danger">'."\n");
  // Legg merke til forskjellen på bruken av dobbel- og singelapostrof over
print('<input type="reset" id="resetKnapp" name="nullstillSkjema" value="Nullstill valgte bokser" class="btn btn-warning">'."\n");
print("</form><br>\n");

if (isset($_POST["slettKlasse"])) {

  if (!isset($_POST["klassekode"])) {
    die("Du må velge i listen over for å fortsette.");
  }

  $klassekodeArray = $_POST["klassekode"];
    // Tell antall slettinger, spør brukeren om han virkelig vil slette n oppføringer.
  foreach ($klassekodeArray as $verdi) {
    $sql = "DELETE FROM klasse WHERE klassekode='$verdi';";
    if ($sqlObjekt = $dbLink->query($sql)) {
      print("<div class=\"alert alert-success\"> Klassen med klassekode \"". $verdi . "\" er nå slettet.<br></div>"); // erstattes med spørringsutføring
    } else {
      die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Du har sannsynligvis studenter tilknyttet klassen \"" . $verdi ."\".<br>Forsøk å slett disse <b>studentene først.</b></div>");
    }
  }
}

?>
