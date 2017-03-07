<?php
// Denne filen inkluderes på begynnelsen av alle .php-filer som skal ha databasetilkobling

$tjener = "localhost";
$brukernavn = "146795";
$passord = "13115";
$database = "146795";
  // Over definerer vi variabler vi trenger for å koble til databasen

$dbLink = mysqli_connect($tjener, $brukernavn, $passord, $database);

if (!$dbLink) {
  die("Fatal feil, kunne ikke koble til databasen: " . mysqli_connect_error() );
    // Over sjekker vi om tilkoblingen til databasen er opprettet. Er den ikke det,
    // dør scriptet, og mysql skriver ut feilmelding.
}
mysqli_set_charset($dbLink,"utf8");
?>
