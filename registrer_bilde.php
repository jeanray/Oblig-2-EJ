<?php

  include("html/lagRegBildeSkjema.php");

  regBildeSkjema();

if (isset($_POST["skjemaRegBilde"])) {

  var_dump($_POST);
  print("<br>");
  var_dump($_SESSION);
  print("<br>");
  var_dump($_FILES);
  print("<br><b>STOPP VAR_DUMP HER</b><br>");

  if ( ($_FILES["skjemaBildefil"]["name"] == "") || ($_POST["skjemaBildeBeskrivelse"] == "") || ($_POST["skjemaBildenummer"] == "") ) {
    die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Det ser ikke ut til at du har fylt ut alle feltene. Vennligst forsøk på nytt.</div>");
    // Her sjekker vi om superglobalen $_FILES ikke inneholder det vi forventer, eller (||) det samme med to
    // forskjellige $_POST-variabler. Den ene ser vi etter om består av blank space "", den andre sjekker vi om eksisterer.
  }

  if (isset($_FILES)) {
    $storrelse = $_FILES["skjemaBildefil"]["size"];

    if($storrelse /1024/1024 > 5) {
      // Deler på 1024 to ganger for å få megabyte, og sjekker om filen er større enn 5 MB
      die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: $storrelse bytes er over fem megabyte, vennligst forsøk med en mindre fil.<div>");
    }
  }


// Sette opp slik at du renamer tmp-bildet til studentnr+bildenr+timestamp. Bildenavn kan ikke endres i applikasjonen,
// dermed kan vi gjøre det slik vi ønsker. Det ville vært en fin finesse å ha bildesti unik.
// Vis klasseliste skal være en lenke til bildet, som viser det med jquery eller en liten thumbnail.

/*

  $bildenrFraSkjema = htmlspecialchars($_POST["skjemaBildenummer"]);

  // Kjøre en regex for å se at bildenr består av tre siffer og kun tre siffer, før vi sjekker om nummeret eksisterer i databasen.

  $sql = "SELECT bildenr FROM bilde WHERE bildenr='$bildenrFraSkjema';";

  $sqlObjekt = $dbLink->query($sql);

  while ($bildeSQL = $sqlObjekt->fetch_assoc()) {
    if($bildeSQL["skjemaBildenummer"] == $bildenrFraSkjema) {
      die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Bildenummeret er allerede brukt, vennligst forsøk med et annet.</div>");
    }
  }
*/
}

  /*
  opplastingsdato skal hentes ut og lagres automatisk ved submit av form hvis alle sjekker passerer og
  vi ønsker å kjøre spørringen (etter at vi har valgt å laste opp bildet, om vi velger det. Feiler opplasting
  av bildet, ønsker vi _ikke_ å skrive til bildetabellen).
  */

?>
