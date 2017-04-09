<?php
// Denne filen inkluderes på begynnelsen av alle .php-filer som skal ha databasetilkobling

$tjener = "localhost";
$brukernavn = "ej";
$passord = "Vetle321";
$database = "oblig2ej";
  // Over definerer vi variabler vi trenger for å koble til databasen

$dbLink = new mysqli($tjener, $brukernavn, $passord, $database);

if ($dbLink->connect_error) {
  die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil, kunne ikke koble til databasen: " . $dbLink->connect_error . "</div>");
    // Over sjekker vi om tilkoblingen til databasen er opprettet. Er den ikke det,
    // dør scriptet, og mysql skriver ut feilmelding.
}
$dbLink->set_charset("utf8");

?>
