<?php

// FIL SOM LITE SANNSYNLIG BLIR BRUKT I DENNE OMGANGEN, MER EN IDE OG EN TESTING

/* Tanken bak å lage disse (og det er bare en ide enn så lenge) er at vi kan bygge opp HTML frem til punktet hvor vi trenger
noe dynamisk, som en listeboks. Da kjører man i så fall den tilhørende funksjonen i <?php skjemaListKlKoder(); ?>, og fortsetter med HTMLen, i dette tilfellet da med </select> osv osv. */
$errorArray = array();
  // For å få globalt scope på error-arrayet så må den defineres utenfor funksjonene

function skjemaListKlkoder() {
  $sql = "SELECT klassekode FROM klasse;"; // Hent ut klassekodene fra klasse-tabellen

  $sqlObjekt = $dbLink->query($sql);  // Utfører spørringen

  if ($sqlObjekt->num_rows == "0") {  // Hvis vi ikke får noen rader fra DBHS-et
      die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Det eksisterer ikke noen klasser. Registrer en klasse.</div>");
  }

  while ($rad = $sqlObjekt->fetch_assoc()) { // Mens vi får rader fra sql skal vi printe klassekode i <option>-tagger
    print ("<option>" . $rad["klassekode"] . "</option>");
  }

  if ( isset($sqlObjekt) ) {  // En if-setning her fordi vi ikke dreper scriptet, men samler opp feilmeldinger i stedet.
    mysqli_free_result($sqlObjekt); // Frigjør sql-objektet
  }

} // Funksjon for å skrive ut klassekoder avsluttes her

function skjemaListBildenr() {
  $sql = "SELECT bildenr FROM bilde;";  // Hent ut bildenr fra tabellen bilde

  $sqlObjekt = $dbLink->query($sql);  // Utfører spørringen

  if ($sqlObjekt->num_rows == "0") {  // Hvis vi ikke får noen rader fra DBHS-et
    $errorArray[] = "<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Du må først registrere et bilde!";
    return;
  }

  while ($rad = $sqlObjekt->fetch_assoc()) { // Så lenge vi får bilder fra sql skal vi printe bildenr med option-tagger rundt
    print ("<option>" . $rad["bildenr"] . "</option>");
  }

  if ( isset($sqlObjekt) ) {  // En if-setning her fordi vi ikke dreper scriptet, men samler opp feilmeldinger i stedet.
    mysqli_free_result($sqlObjekt); // Frigjør sql-objektet
  }
} // Funksjon for å skrive ut bildenr ender her

?>
