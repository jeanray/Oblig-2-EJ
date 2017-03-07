<?php
include("dbTilkoblingOOP.php");

include("lag_studentSkjema.php"); // Inkluderer funksjoner for opprettelse av skjemaet

startStSkjema(); // Starter en HTML-form for registrering av student (StudentSkjema)

$sql = "SELECT klassekode FROM klasse;";

$sqlObjekt = $dbLink->query($sql);

while ($rad = $sqlObjekt->fetch_assoc()) {
  print ("<option>" . $rad["klassekode"] . "</option>");
}

avsluttSkjema(); // Avslutter skjemaet

if ($sqlObjekt->num_rows == "0") {
  die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Du må først registrere en klasse før du kan registrere en student.");
}

if (isset($_POST["registrer"])) { // Hvis skjemaet er submitted kjører vi koden nedenfor

  if (empty($_POST["brukernavn"]) || empty($_POST["fornavn"]) || empty($_POST["etternavn"]) ) {
    die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Alle felter må fylles ut.");
      // Sjekk om alle felter i skjemaet er fylt ut, dø om ikke de er det.
  }

  $brukernavn = htmlspecialchars($_POST["brukernavn"]);
  $fornavn = htmlspecialchars($_POST["fornavn"]);
  $etternavn = htmlspecialchars($_POST["etternavn"]);
  $klassekodeFK = $_POST["klassekodeFK"];


// Er det kanskje bedre å lage en egen variabel for strlen i denne if-setningen? I forhold til lesbarhet?
// Eller fuck it? -Emil

// Jeg mener det er helt unødvendig bruk av minnebruk da vi kun har brukt for det tallet en gang. Hadde det vært
// brukt for det flere ganger er jeg enig, men for lesbarhetens del er det absolutt ikke vanlig praksis å lage
// egen variabel her. Særlig i andre språk som er strict mtp definering av variabler (!) -Jean

// PS: oversett til pseudokode og det blir noe ala "hvis (lengdepåstring($brukernavn) er over 2) så dø med feilmld.

  if (strlen($brukernavn) > "2") {
    die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Brukernavnet kan ikke inneholde flere enn to karakterer, vennligst forsøk på nytt.</div>");
  }

  $sql = "SELECT brukernavn FROM student;";
  $sqlObjekt = $dbLink->query($sql);

  while ($rad = $sqlObjekt->fetch_assoc()) {
    if($rad["brukernavn"] == $brukernavn) {
      die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Brukernavnet er allerede tatt i bruk, forsøk et annet.</div>");
    }
  }

  $sql = "INSERT INTO student VALUES ('$brukernavn','$fornavn','$etternavn','$klassekodeFK');";

  if ($dbLink->query($sql) === TRUE) {
    print("<div class=\"alert alert-success\">Student \"$fornavn $etternavn\" ble lagt til.</div><br>");
  } else {
    die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Spørringen ble ikke utført som forventet. Feil fra MySQL: " . $dbLink->error .  "</div>");
  }
}
  if ( isset($sqlObjekt) ) {
    mysqli_free_result($sqlObjekt);
  }
// Vi må ha en foreign key sjekk, hvis ikke gir man en stygg feilmelding til brukeren
// hvis man prøver å registrere en klassekode som ikke eksisterer i klasse.
?>
