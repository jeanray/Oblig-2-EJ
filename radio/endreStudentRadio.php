<?php

include("dbTilkoblingOOP.php");

$sql="SELECT * FROM student ORDER BY etternavn;";

$sqlObjekt = $dbLink->query($sql) or
  die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Det er ikke mulig å hente data fra databasen.<br></div>");

if ($sqlObjekt->num_rows == "0") { // Hvis vi ikke får tilbake noen studenter, skriv ut feil.
  die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Det ser ikke ut til å være registrert noen studenter i databasen!</div>");
}

print("<h3>Velg student du ønsker å endre:</h3>\n");
print('<form action="" name="velgStudentRadio" id="velgStudentRadio" method="POST">');

while ($rad = $sqlObjekt->fetch_assoc()) {

  $brukernavn=$rad["brukernavn"];
  $fornavn=$rad["fornavn"];
  $etternavn=$rad["etternavn"];

  print("<input type='radio' name='brukernavn' value='$brukernavn' required> $etternavn, $fornavn<br>");
    // Over printer vi ut alle radioboksene med resultater fra SQL
}
  print('<br><input type="submit" name="velgStudentKnapp" id="velgStudentKnapp" class="btn btn-primary" value="Velg student">');
  print("</form>\n<br>\n");

?>
