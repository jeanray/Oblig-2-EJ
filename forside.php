<?php
echo<<<'SLUTT'
<h2>skoleAdmin v1.0</h2>
<h4>Velkommen til administratorpanelet!</h4>
Vennligst velg funksjon i menyen på toppen.<br><br>
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

print("Du er logget inn som <b>" . $_SESSION["brukernavn"] . "</b>.");
?>
