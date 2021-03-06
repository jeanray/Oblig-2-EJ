<?php
include_once("loginFunksjoner.php");

if (ikkeInnlogget()) {
  echo '<META HTTP-EQUIV=REFRESH CONTENT="3; innlogging.php">';
  die("<div class=\"alert alert-danger\">Du må være logget inn for å bruke denne siden, <a href=\"innlogging.php\">vennligst trykk her om du ikke blir videresendt.</a></div>");
}

$sql = "SELECT * FROM klasse;";
$sqlSvar = $dbLink->query($sql);

print("<h3>Klasser</h3>");

print("<table  class=\"table table-striped\" id=\"klassetabell\">\n");
  // Start html-tabellen med ny linje for ryddig kode
print("<tr>\n<th>Klassekode:</th>\n<th>Klassenavn:</th>\n</tr>\n");
  // Skriver første rad i tabellen, som er innholdsforklaring
while ($rad = $sqlSvar->fetch_array(MYSQLI_ASSOC)) {
  //
  print("<tr>\n");
    // Start ny tabell-rad
  foreach ($rad as $verdi) {
    print("<td>" . $verdi . "</td>\n");
      // Lag en ny celle (td) for hvert element vi finner i $rad-arrayet
  }

  print("</tr>\n");
    // Avslutt tabell-raden (tr-tag)

}

print("</table>\n");
  // Avslutt html-tabellen

mysqli_free_result($sqlSvar);

?>
