<?php

include("html/registrer_klasse_skjema.html");

if (isset($_POST["registrer"])) {

  if (empty($_POST["klassekode"]) || empty($_POST["klassenavn"])) {
    die("<div class=\"alert alert-danger\" role=\"alert\">Alle felter må fylles ut.</div>");
    // Sjekk om alle felter i skjemaet er fylt ut, dø om ikke de er det.
  }

  $klassekode = htmlspecialchars($_POST["klassekode"]);
  $klassenavn = htmlspecialchars($_POST["klassenavn"]);
  // Vi kopierer variabler fra superglobalen over i egne PHP-variabler,
  // samt vi konverterer visse karakterer over til HTML-entity-koden for å sikre mot bl.a. sql-injection

  if (!preg_match('/^[A-Z]{2,}\d$/', $klassekode)) { // Validere klassekode,
    die("<div class=\"alert alert-danger\" role=\"alert\">Klassekoden er ikke i korrekt format. Bruk store bokstaver og et siffer til slutt.</div>");
  }
  // Kunne lagt inn en sjekk på forhånd for å se om klassekoden er brukt som FK i student.tabell

  $sql = "SELECT klassekode FROM klasse;";

if (@$sqlObjekt = $dbLink->query($sql)) {

  while ($rad = $sqlObjekt->fetch_assoc()) {
    if($rad["klassekode"] == $klassekode) {
      die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Klassekoden er allerede tatt i bruk, vennligst forsøk med en annen.</div>");
    }
  }
}
  $sql = "INSERT INTO klasse VALUES ('$klassekode','$klassenavn');";
    // Definer sql-spørringen og sett den til variabelen $sql

  if ($dbLink->query($sql) === TRUE) {  // Kjør spørringen mot databasen
    print("<div class=\"alert alert-success\" role=\"alert\">Klasse med navn \"$klassenavn\" ble lagt til.</div>");
  } else { // Hvis ikke spørringen blir utført som forventet dør scriptet med feilmelding fra RDBHS-et
    die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Spørringen ble ikke utført som forventet. Feil fra MySQL: " . $dbLink->error .  "</div>");
  }
}
if ( isset($sqlObjekt) ) {
  mysqli_free_result($sqlObjekt);
}
?>
