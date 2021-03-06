<?php
include_once("loginFunksjoner.php");

if (ikkeInnlogget()) {
  echo '<META HTTP-EQUIV=REFRESH CONTENT="3; innlogging.php">';
  die("<div class=\"alert alert-danger\">Du må være logget inn for å bruke denne siden, <a href=\"innlogging.php\">vennligst trykk her om du ikke blir videresendt.</a></div>");
}

echo<<<'SLUTTHTML'
<script src="js/sokeFunksjon.js"></script>
<noscript>
    <style type="text/css">
        .pagecontainer {display:none;}
    </style>
    <div class="noscriptmsg">
    <h5>
    Du har ikke JavaScript skrudd på, dermed fungerer ikke søkefunksjonen.<br>
    Søkefunksjonen bruker AJAX, som er JavaScript-avhengig.<br>
    Beklager ulempen, i fremtiden skal vi forsøke å finne en bedre løsning for mangel på JS i forbindelse med AJAX-funksjoner.
    </h5>
    </div>
</noscript>
<div class="col-lg-5">
<h3>Søk i registeret</h3>
<form method="POST" name="sokeSkjema" id="sokeSkjema"><br>
<input type="text" class="form-control" class="col-lg-4" id="sokeFelt" name="sokeFelt" placeholder="Skriv inn søkeord her" onkeyup="databaseSok(this.value)">
</form><br>
<span id="sokeTreff"></span>
SLUTTHTML;

?>
