<?php

$sql="SELECT * FROM klasse ORDER BY klassekode;";

$sqlObjekt = $dbLink->query($sql) or
  die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Det er ikke mulig å hente data fra databasen.<br></div>");

if ($sqlObjekt->num_rows == "0") { // Hvis vi ikke får tilbake noen klasser, skriv ut feil.
  die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Det ser ikke ut til å være registrert noen klasser i databasen!</div>");
}

print("<h3>Velg klasse du ønsker å endre:</h3>\n");
print('<form action="" name="velgKlasseRadio" id="velgKlasseRadio" method="POST">'); // Vi starter formen for radio-knapper

while ($rad = $sqlObjekt->fetch_assoc()) {

  $klkode=$rad["klassekode"];
  $klnavn=$rad["klassenavn"];

  print("<input type='radio' name='klasse' value='$klkode' required> $klkode - \"$klnavn\"<br>");
    // Over printer vi ut alle radioboksene med resultater fra SQL - vi legger "" rundt klassenavnet.
}
  print('<br><input type="submit" name="velgKlasseKnapp" id="velgKlasseKnapp" class="btn btn-primary" value="Velg klasse">');
  print("</form>\n<br>\n");

?>
