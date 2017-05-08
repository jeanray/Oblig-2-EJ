<?php
function startStSkjema() {
echo <<<'ECHOSLUTT'
<script src="js/validerStudentRegSkjema.js"></script>
<h3>Registrer ny student</h3>
<form method="post" name="registrerStudentSkjema" id="registrerStudentSkjema" onsubmit="return valStudentRegSkjema()" action="">
    Brukernavn (to karakterer):<br>
    <input type="text" name="brukernavn" id="brukernavn" placeholder="on - Kun to bokstaver" required><br>
    Fornavn:<br>
    <input type="text" name="fornavn" id="fornavn" placeholder="Ola" required><br>
    Etternavn:<br>
    <input type="text" name="etternavn" id="etternavn" placeholder="Nordmann" required><br>
    Neste leveringsfrist:<br>
    <input type="text" name="nesteFrist" id="nesteFrist" placeholder="ÅÅÅÅ-MM-DD"><br>
    Klassekode:<br>
    <select id="klassekodeFK" name="klassekodeFK">
ECHOSLUTT;
} // Kjører så spørringer for å sette inn i option-tagger

function forsettStSkjema() { // Avslutter forrige select og starter en ny
echo <<<'STOPPHER'
    </select>
    <br>
    Bildenr:<br>
    <select id="bildenrFK" name="bildenrFK">
STOPPHER;
} // Kjør php for å legge til option-tagger

function avsluttStSkjema() {
echo <<<'STOPPHER'
    </select>
    <br><br>
    <input type="submit" name="registrer" class="btn btn-primary" value="Registrer" id="registrerKnapp">
    <input type="reset" name="nullstill" class="btn btn-warning" value="Nullstill skjema" id="resetKnapp">
    <br>
</form>
<br>
<span id="jsFeil" class="alert alert-danger" role="alert"></span>
STOPPHER;
}
?>
