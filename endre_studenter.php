<?php

include ("radio/endreStudentRadio.php");

if ( isset($_POST["velgStudentKnapp"]) ) {
  
  $valgtBrukernavn=$_POST["brukernavn"];

  $sql = "SELECT * FROM student WHERE brukernavn='$valgtBrukernavn';";
  $sqlObjekt = $dbLink->query($sql);

  $student = $sqlObjekt->fetch_assoc();

  print("<h4>Endre valgt student</h4>\n<form method=\"post\">\nBrukernavn:<br>\n");
  print('<input type="text" name="brukernavn" id="gray" value="' . $student['brukernavn'] . "\" readonly><br>\n");
  print("Fornavn:<br>\n");
  print('<input type="text" name="fornavn" value="' . $student['fornavn'] . "\" required><br>\n");
  print("Etternavn:<br>\n");
  print('<input type="text" name="etternavn" value="' . $student['etternavn'] . "\"required><br>\n");
  print("Klassekode:<br>\n");
  print('<select id="klassekode" name="klassekode" required><br>');

  $sql = "SELECT klassekode FROM klasse;";
    // Vi spør om alle klassekoder slik at vi kan fylle ut dropdown-menyen

  $sqlObjekt = $dbLink->query($sql);
    // Spørringen blir utført

  while ($rad = $sqlObjekt->fetch_assoc()) { // Vi looper igjennom alle radene vi får fra spørringen

    if ($student['klassekode'] == $rad["klassekode"]) {
      print ("<option selected>" . $rad["klassekode"] . "</option>");
        // Hvis klassekoden tilhører valgte student, setter vi den pre-selected i dropdown-menyen
    } else {
    print ("<option>" . $rad["klassekode"] . "</option>");
      // Hvis ikke klassekoden tilhører studenten legger vi den bare til på vanlig måte i dropdown-menyen
    }
  }
  // Under bruker vi et eks. på HEREDOC
echo <<<'STOPPHER'
  </select>
  <br><br>
  <input type="submit" name="endreStudentKnapp" class="btn btn-success" value="Endre student"><br>
  </form>
  <br>
STOPPHER;
}

// En bedre funksjon hadde muligens vært å lage et skjema som tok imot inputs, brukernavn, fornavn osv.

if(isset($_POST['endreStudentKnapp'])) {

  if(!$_POST['fornavn'] || !$_POST['etternavn']) {
    print("<div class=\"alert alert-danger\" role=\"alert\">Feil: Ingen felter kan få stå tomme.</div>");
  } else {

    $brukernavn=$_POST["brukernavn"];
    $fornavn=$_POST["fornavn"];
    $etternavn=$_POST["etternavn"];
    $klassekode=$_POST["klassekode"];

    $sql = "UPDATE student SET fornavn='$fornavn', etternavn='$etternavn', klassekode='$klassekode' WHERE brukernavn='$brukernavn';";

    if(!$dbLink->query($sql)) {
      die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Ikke mulig å endre student.</div>");
    } else {
      print("<div class=\"alert alert-success\" role=\"alert\">Studenten ble endret!</div>");
    }
  }
}

?>
