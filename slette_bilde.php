<?php

  /* Det er i bildetabellen hovednøkkelen for bilde er, men den blir også brukt som
  fremmednøkkel (FK) i student-tabellen. Dermed vil det være logisk å sjekke først om det
  tilhører noen studenter til bildet.

  IMO burde bare EN student få bruke ett bilde, men det er en annen sak, som vi kan se litt på etter vi
  har basisen på plass.
  */
  include_once("loginFunksjoner.php");

  if (ikkeInnlogget()) {
    echo '<META HTTP-EQUIV=REFRESH CONTENT="3; innlogging.php">';
    die("<div class=\"alert alert-danger\">Du må være logget inn for å bruke denne siden, <a href=\"innlogging.php\">vennligst trykk her om du ikke blir videresendt.</a></div>");
  }

  $sql = "SELECT * FROM bilde ORDER BY bildenr;";

  $sqlObjekt = $dbLink->query($sql);

  if ($sqlObjekt->num_rows == "0") { // Finnes ingen bilder dør vi med passende feilmld
    die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Finner ingen bilder.</div>");
  }

  print("<h3>Slett bilder</h3>");
  print('<form method="POST" id="slettKlasseSkjema" name="slettKlasseSkjema" onsubmit="return confirm(\'Er du sikker på at du vil utføre valgt sletting?\n\nHandlingen kan ikke angres!\');">');

  while ($rad = $sqlObjekt->fetch_assoc()) {
    // Hent ut første raden fra SQL og loop videre til den ikke får flere
    print('<input type="checkbox" name="bilder[]" value="' . $rad["bildenr"] . '"> ' . $rad["bildenr"] . " - ". $rad["filnavn"] . "<br>\n");
  }

  print("<br>\n");
  print('<input type="submit" id="slettBilder" name="slettBilder" value="Slett bilde(r)" class="btn btn-danger">'."\n");
    // Legg merke til forskjellen på bruken av dobbel- og singelapostrof over
  print('<input type="reset" id="resetKnapp" name="nullstillSkjema" value="Nullstill valgt(e) bokse(r)" class="btn btn-warning">'."\n");
  print("</form><br>\n");


if (isset($_POST["slettBilder"])) {
  if (!isset($_POST["bilder"])) {
      die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Du må velge i listen over for å fortsette.");
    } else {

      $bildeArray = $_POST["bilder"];

      foreach ($bildeArray as $verdi) {
        $sql = "DELETE FROM bilde WHERE bildenr='$verdi'";

              if ($sqlObjekt = $dbLink->query($sql)) {
                print("<div class=\"alert alert-success\">Bilde med bildenr \"". $verdi . "\" er nå slettet.<br></div>"); // erstattes med spørringsutføring
              } else {
                die("<div class=\"alert alert-danger\" role=\"alert\"> Feil! Du må mest sannsynlig slette tilhørende student før du kan slette bilde. </div>");
              }
      }
      
    }
  }
?>
