<?php
// Denne filen inkluderes på begynnelsen av alle .php-filer som skal ha databasetilkobling

$tjener = "localhost";
$brukernavn = "ej";
$passord = "Vetle321";
$database = "oblig1ej";
  // Over definerer vi variabler vi trenger for å koble til databasen

$dbLink = new mysqli($tjener, $brukernavn, $passord, $database);

if ($dbLink->connect_error) {
  die("Fatal feil, kunne ikke koble til databasen: " . $dbLink->connect_error);
    // Over sjekker vi om tilkoblingen til databasen er opprettet. Er den ikke det,
    // dør scriptet, og mysql skriver ut feilmelding.
}
mysqli_set_charset($dbLink,"utf8");
?>
