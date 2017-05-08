<?php
include_once("loginFunksjoner.php");

if (ikkeInnlogget()) {
  echo '<META HTTP-EQUIV=REFRESH CONTENT="3; innlogging.php">';
  die("<div class=\"alert alert-danger\">Du må være logget inn for å bruke denne siden, <a href=\"innlogging.php\">vennligst trykk her om du ikke blir videresendt.</a></div>");
}

print("<h3>Endre bilde</h3>");
print('<form method="POST" action="" id="endreBildeSkjema" name="endreBildeSkjema">');
print("Velg bilde du vil endre: <br>");

print('<select id="skjemaVelgBildenr" name="skjemaVelgBildenr">');

$sql = "SELECT * FROM bilde;";

$sqlObjekt = $dbLink->query($sql);

while ($svar = $sqlObjekt->fetch_assoc()) {
  print ("<option>" . $svar["bildenr"] . "</option>");
}
print("</select><br><br>");
print('<input type="submit" name="skjemaEndreBilSub" id="skjemaEndreBilSub" class="btn btn-primary" value="Endre valgt bilde">');
print("</form>");

$sqlObjekt->free_result();

if (isset($_POST["skjemaEndreBilSub"])) {

  $valgtBildeFraSkjema = $_POST["skjemaVelgBildenr"];

  $sql = "SELECT beskrivelse FROM bilde WHERE bildenr='$valgtBildeFraSkjema';";

  $sqlObjekt = $dbLink->query($sql);

  $svar = $sqlObjekt->fetch_assoc();
    // Vet vi bare får en rad tilbake pga regel for primary key i SQL
  print('<form method="POST" id="skjemaEndreBeskriv" name="skjemaEndreBeskriv" action="">');
  print('<h4>Endre beskrivelse på bildet under:</h4>');
  print("<input type=\"text\" value=\"" . $svar["beskrivelse"] . "\" id=\"skjemaNyBeskriv\" name=\"skjemaNyBeskriv\">");
  print("</form>");
}

?>
