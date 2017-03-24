<?php

$sql = "SELECT * FROM student ORDER BY etternavn;";
$sqlObjekt = $dbLink->query($sql);

if ($sqlObjekt->num_rows == "0") {
  die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Det ser ikke ut til å eksistere noen studenter!</div>");
}
// $navn = array();
print("<h3>Slett studenter</h3>");
print('<form method="POST" id="slettStudentSkjema" action="index.php?funksjon=slette_student" "name="slettStudentSkjema" onsubmit="return confirm(\'Er du helt sikker på du vil utføre valgte sletting i tabellen over studenter?\n\nHandlingen kan ikke angres!\');">');
  // Legg til onsubmit-sjekk over

while ($rad = $sqlObjekt->fetch_assoc()) {
  // Hent ut første raden fra SQL og loop videre til den ikke får flere
  print('<input type="checkbox" name="student[]" value="' . $rad["brukernavn"] . '" > ' . $rad["fornavn"] . " " . $rad["etternavn"] . " med brukernavn \"". $rad["brukernavn"] . "\" i klasse ". $rad["klassekode"] . "<br>\n");
//  array_push($navn, $rad["etternavn"] . ", " . $rad["fornavn"]);
}

print('<br><input type="submit" id="slettStudent" name="slettStudent" value="Slett valgte studenter" class="btn btn-danger">'."\n");
  // Legg merke til forskjellen på bruken av dobbel- og singelapostrof over
print('<input type="reset" id="resetKnapp" name="nullstillSkjema" value="Nullstill valgte bokser" class="btn btn-warning">'."\n");
print("</form><br>\n");

if (isset($_POST["slettStudent"])) { // Hvis arrayen student er satt

  if (!isset($_POST["student"])) {
    die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Du må velge i listen over for å fortsette.");
  }

  $studentArray = $_POST["student"];

  foreach ($studentArray as $verdi) {
    $sql = "DELETE FROM student WHERE brukernavn='$verdi'";
    if ($sqlObjekt = $dbLink->query($sql)) {
      print("<div class=\"alert alert-success\">Studenten med brukernavn \"". $verdi . "\" er nå slettet.<br></div>"); // erstattes med spørringsutføring
    } else {
      die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Spørringen ble ikke utført som forventet. Feil fra MySQL: " . $dbLink->error .  "</div>");
    }
  }
}

?>
