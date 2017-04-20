<?php
  print("Funksjon for å registrere bilde, som så må lede til registrering av student.<br>");
  print("<h3>Hvis alle studenter skal ha bilde, så bør man opplyse om det på regStudent!</h3>");

  /*
  opplastingsdato skal hentes ut og lagres automatisk ved submit av form hvis alle sjekker passerer og
  vi ønsker å kjøre spørringen (etter at vi har valgt å laste opp bildet, om vi velger det. Feiler opplasting
  av bildet, ønsker vi _ikke_ å skrive til bildetabellen).
  */

  print(date(y-m-d));
?>
