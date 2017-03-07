<?php
function startSkjema() {

    include("dbTilkobling.php");


    $brukernavn=$_POST["brukernavn"];

    $del=explode(";",$brukernavn);
    $brukernavn=$del["0"];
    $fornavn=$del["1"];
    $etternavn=$del["2"];
    $klassekode=$del["3"];


    $sqlSetning="SELECT * FROM student WHERE brukernavn='$brukernavn';";
    $sqlResultat=mysqli_query($dbLink,$sqlSetning) or die("<div class=\"alert alert-danger\" role=\"alert\">Ikke mulig å hente fra database</div>");
    $rad=mysqli_fetch_array($sqlResultat);

    $fornavn=$rad["fornavn"];
    $etternavn=$rad["etternavn"];


echo <<<"ECHOSLUTT"
<h4>Endre valgt student</h4>
<form method="post">
Brukernavn:<br>
<input type="text" name="brukernavn" id="gray" value="$brukernavn" readonly><br>
Fornavn:<br>
<input type="text" name="fornavn" value="$fornavn" required><br>
Etternavn<br>
<input type="text" name="etternavn" value="$etternavn" required><br>
Klassekode:<br>
<select id="klassekode" name="klassekode" value="$klassekode" required><br>
ECHOSLUTT;
}

function avsluttSkjema() {

echo <<<"STOPPHER"
</select>
<br><br>
<input type="submit" name="endreKlasseKnapp" class="btn btn-success" value="Endre"><br>
</form>
<br>
</div> </div>
STOPPHER;
}