<?php

include_once("dbTilkoblingOOP.php");

if(isset($_GET["sokeStreng"])) {
  $sok = htmlspecialchars($_GET["sokeStreng"]);

  $sql = "SELECT * FROM klasse WHERE klassekode LIKE '%$sok%' OR klassenavn LIKE '%$sok%';";
  // Vi søker igjennom klassedatabasen først og lagrer resultatene i en Array

  $sqlObjekt = $dbLink->query($sql);
  // Vi kjører så spørringen mot databasen, før vi looper igjennom svarene
  if ($sqlObjekt->num_rows == 0) {
    $treff = "0";
  } else {
    print('<div class="alert alert-success" role="alert">Det er funnet følgende treff i registeret:</div>');
    print("Funnet i listen over klasser:<br>\n");
    print('<table id="klasseSvar" name="klasseSvar" class="table table-striped">');
    print("<tr>\n<th>Klassekode:</th>\n<th>Klassenavn:</th></tr>\n");
    while($rad = $sqlObjekt->fetch_array(MYSQLI_ASSOC)) {
      print("<tr>\n");

      foreach ($rad as $celle) {
        print("<td>" . $celle . "</td>\n");
      }
      print("</tr>\n");
    }
    print("</table>\n");
  }
  mysqli_free_result($sqlObjekt);

  $sql = "SELECT * FROM student WHERE klassekode LIKE '%$sok%' OR fornavn LIKE '%$sok%' OR etternavn LIKE '%$sok%' OR brukernavn LIKE '%$sok%';";
  // Vi søker igjennom klassedatabasen først og lagrer resultatene i en Array

  $sqlObjekt = $dbLink->query($sql);
  // Vi kjører så spørringen mot databasen, før vi looper igjennom svarene

  if ($sqlObjekt->num_rows == 0 && isset($treff) && $treff == "0") {
    print("<div class=\"alert alert-warning\" role=\"alert\">Ingen treff funnet i registeret.</div>");
  } elseif ($sqlObjekt->num_rows == 0) {
  } else {
    if (isset($treff) && $treff == "0") {
      print('<div class="alert alert-success" role="alert">Det er funnet følgende treff i registeret:</div>');
    }
    print("<br>Funnet i listen over studenter:<br>\n");
    print('<table id="studentSvar" name="studentSvar" class="table table-striped">');
    print("<tr>\n<th>Brukernavn:</th>\n<th>Fornavn:</th>\n<th>Etternavn:</th>\n<th>Klassekode:</th>\n</tr>\n");

    while($rad = $sqlObjekt->fetch_array(MYSQLI_ASSOC)) {
      print("<tr>\n"); // ny rad i tabellen
      foreach ($rad as $celle) { // For hver verdi vi får lager vi en celle.
        print("<td>" . $celle . "</td>\n");
      }
      print("</tr>\n");
    }
    print("</table>\n");
  }
  mysqli_free_result($sqlObjekt);
}
?>
