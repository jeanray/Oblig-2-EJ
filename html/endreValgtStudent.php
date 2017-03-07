<?php

function startEndreStSkjema() {
echo <<<"ECHOSLUTT"
<h4>Endre valgt student</h4>
<form method="post">
Brukernavn:<br>
<input type="text" name="brukernavn" id="gray" value="{$student['brukernavn']}" readonly><br>
Fornavn:<br>
<input type="text" name="fornavn" value="{$student['fornavn']}" required><br>
Etternavn:<br>
<input type="text" name="etternavn" value="{$student['etternavn']}" required><br>
Klassekode:<br>
<select id="klassekode" name="klassekode" value="{$student['klassekode']}" required><br>
ECHOSLUTT;
}

function avsluttEndreStSkjema() {

echo <<<"STOPPHER"
</select>
<br><br>
<input type="submit" name="endreKlasseKnapp" class="btn btn-success" value="Utfør endring"><br>
</form>
<br>
</div> </div>
STOPPHER;
}

?>
