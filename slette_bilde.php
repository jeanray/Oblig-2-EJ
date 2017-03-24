<?php
  print("<h3>Slett bilder</h3>");
  /* Det er i bildetabellen hovednøkkelen for bilde er, men den blir også brukt som
  fremmednøkkel (FK) i student-tabellen. Dermed vil det være logisk å sjekke først om det
  tilhører noen studenter til bildet.

  IMO burde bare EN student få bruke ett bilde, men det er en annen sak, som vi kan se litt på etter vi
  har basisen på plass.
  */

  $sql = "SELECT * FROM bilde ORDER BY bildenr;";

  $sqlObjekt = $dbLink->query($sql);

  if ($sqlObjekt->num_rows == "0") {
    die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Finner ingen bilder.</div>");
  }

  print("<h3>Slett bilder</h3>");
  print('<form method="POST" id="slettKlasseSkjema" name="slettKlasseSkjema" onsubmit="return confirm(\'Er du sikker på at du vil utføre valgt sletting?\n\nHandlingen kan ikke angres!\');">');

  while ($rad = $sqlObjekt->fetch_assoc()) {
    // Hent ut første raden fra SQL og loop videre til den ikke får flere
    print('<input type="checkbox" name="bilder[]" value="' . $rad["bildenr"] . '"> ' . $rad["bildenr"] . " - ". $rad["bildenr"] . "<br>\n");
  }

  print("<br>\n");
  print('<input type="submit" id="slettBilder" name="slettBilder" value="Slett bilde(r)" class="btn btn-danger">'."\n");
    // Legg merke til forskjellen på bruken av dobbel- og singelapostrof over
  print('<input type="reset" id="resetKnapp" name="nullstillSkjema" value="Nullstill valgt(e) bokse(r)" class="btn btn-warning">'."\n");
  print("</form><br>\n");
?>
