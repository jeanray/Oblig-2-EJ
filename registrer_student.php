<?php

/*
Alle filer må nå ha en innlogget-sjekk. Hvis ikke innlogget, så inkluderer vi modalen for å registrere,
men dreper så scriptet med die. Jeg TROR (håper) submitknappen i modalen fremdeles vil være aktuell.
Mulig en funksjon for å sjekke om innlogget, for å så enten stoppe utføring av scriptet med tilhørende feilmld,
eller hvis vellykket innlogging, kjøre session_start() - blir i så fall en funksjon vi inkluderer i en funksjonsfil.
*/

include("lag_studentSkjema.php"); // Inkluderer funksjoner for opprettelse av skjemaet
include_once("loginFunksjoner.php");

if (ikkeInnlogget()) {
  echo '<META HTTP-EQUIV=REFRESH CONTENT="3; innlogging.php">';
  die("<div class=\"alert alert-danger\">Du må være logget inn for å bruke denne siden, <a href=\"innlogging.php\">vennligst trykk her om du ikke blir videresendt.</a></div>");
}

startStSkjema(); // Starter en HTML-form for registrering av student (StudentSkjema)

$sql = "SELECT klassekode FROM klasse;";

$sqlObjekt = $dbLink->query($sql);

if ($sqlObjekt->num_rows == "0") {  // Hvis vi ikke får noen rader fra databasen dør vi med feilmld
  die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Det finnes ingen klasser. Registrer en klasse for å fortsette.</div>");
}

while ($rad = $sqlObjekt->fetch_assoc()) {
  print ("<option>" . $rad["klassekode"] . "</option>");
}

if ( isset($sqlObjekt) ) { // Vi sjekker om den er satt, i tilfelle alternativ errorhandling
  $sqlObjekt->free_result;
}

forsettStSkjema(); // Avslutter klassekodehenting, og starter bildenr

$sql = "SELECT bildenr FROM bilde;";

$sqlObjekt = $dbLink->query($sql);

if ($sqlObjekt->num_rows == "0") {  // Hvis vi ikke får noen rader fra databasen dør vi med feilmld
  print("</select>\n</form>\n<br>"); // Avslutt selecten og formen for å vise feilmld

  die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Det finnes ingen bilder. Registrer et bilde for å fortsette.</div>");
  // Scriptet stoppes med passende feilmelding.
}

while ($rad = $sqlObjekt->fetch_assoc()) {
  print ("<option>" . $rad["bildenr"] . "</option>");
}

if ( isset($sqlObjekt) ) {
  $sqlObjekt->free_result;
}

avsluttStSkjema(); // Avslutter skjemaet

if (isset($_POST["registrer"])) { // Hvis skjemaet er submitted kjører vi koden nedenfor

  if (empty($_POST["brukernavn"]) || empty($_POST["fornavn"]) || empty($_POST["etternavn"]) ) {
    die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Alle felter må fylles ut.");
      // Sjekk om alle felter i skjemaet er fylt ut, dø om ikke de er det.
  }

  $brukernavn = htmlspecialchars($_POST["brukernavn"]);
  $fornavn = htmlspecialchars($_POST["fornavn"]);
  $etternavn = htmlspecialchars($_POST["etternavn"]);
  $klassekodeFK = $_POST["klassekodeFK"];
  $nesteLevFrist = $_POST["nesteFrist"];
  $bildenrFK = htmlspecialchars($_POST["bildenrFK"]);

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
      die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Brukernavnet er allerede brukt, forsøk et annet.</div>");
    }
  }

  if ( isset($sqlObjekt) ) {
    $sqlObjekt->free_result();
    unset($sqlObjekt);
  }

  $sql = "INSERT INTO student VALUES ('$brukernavn','$fornavn','$etternavn','$klassekodeFK','$nesteLevFrist','$bildenrFK');";

  if ($dbLink->query($sql)) {
    print("<div class=\"alert alert-success\">Studenten \"$fornavn $etternavn\" ble lagt til.</div><br>");
  } else {
    die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Spørringen ble ikke utført som forventet. Feil fra MySQL: " . $dbLink->error .  "</div>");
  }
}
if ( isset($sqlObjekt) ) {
  $sqlObjekt->free_result();
}
// Vi må ha en foreign key sjekk, hvis ikke gir man en stygg feilmelding til brukeren
// hvis man prøver å registrere en klassekode som ikke eksisterer i klasse.
?>
