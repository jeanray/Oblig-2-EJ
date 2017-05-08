<?php
include_once("loginFunksjoner.php");

if (ikkeInnlogget()) {
  echo '<META HTTP-EQUIV=REFRESH CONTENT="3; innlogging.php">';
  die("<div class=\"alert alert-danger\">Du må være logget inn for å bruke denne siden, <a href=\"innlogging.php\">vennligst trykk her om du ikke blir videresendt.</a></div>");
}

print("<h2>skoleAdmin v1.0</h2>");
print("<h3>Velkommen til administratorpanelet!</h3>");
print("Du er logget inn som <b>" . $_SESSION["brukernavn"] . "</b>.<br>");

echo<<<'SLUTT'
<h5>Vennligst velg funksjon i menyen på toppen.</h5><br>
<noscript>
    <style type="text/css">
        .pagecontainer {display:none;}
    </style>
    <div class="noscriptmsg">
    <br><h4>Du trenger JavaScript påskrudd for å få den beste opplevelsen av siden.<br>
    JavaScript kreves også for å utnytte all funksjonalitet på nettstedet.</h4><br>
    </div>
</noscript>
SLUTT;


?>
