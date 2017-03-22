<?php

/* Tanken bak å lage disse (og det er bare en ide enn så lenge) er at vi kan bygge opp HTML frem til punktet hvor vi trenger
noe dynamisk, som en listeboks. Da kjører man i så fall den tilhørende funksjonen i <?php skjemaListKlKoder(); ?>, og fortsetter med HTMLen,
i dette tilfellet da med </select> osv osv. */

function skjemaListKlkoder {
  $sql = "SELECT klassekode FROM klasse;";

  $sqlObjekt = $dbLink->query($sql);

  if ($sqlObjekt->num_rows == "0") {
      $errorArray[] = "<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Du må først registrere en klasse før du kan registrere en student!";
  }

  while ($rad = $sqlObjekt->fetch_assoc()) {
    print ("<option>" . $rad["klassekode"] . "</option>");
  }

  if ( isset($sqlObjekt) ) {  // En if-setning her fordi vi ikke dreper scriptet, men samler opp feilmeldinger i stedet.
    mysqli_free_result($sqlObjekt);
  }

} // Funksjon for å skrive ut klassekoder avsluttes her

function skjemaListBildenr {
  $sql = "SELECT bildenr FROM bilde;";

  if ($sqlObjekt->num_rows == "0") {
    $errorArray[] = "<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Du må først registrere et bilde!";
  }

  while ($rad = $sqlObjekt->fetch_assoc()) {
    print ("<option>" . $rad["bildenr"] . "</option>");
  }

  if ( isset($sqlObjekt) ) {  // En if-setning her fordi vi ikke dreper scriptet, men samler opp feilmeldinger i stedet.
    mysqli_free_result($sqlObjekt);
  }
} // Funksjon for å skrive ut bildenr ender her

?>
