<?php

$sql = "SELECT * FROM student;";
$sqlSvar = $dbLink->query($sql);

/*
print("<table class=\"table table-striped\"><thead><tr><th>Klassekode</th><th>Klassenavn</th></tr></thead>");

while ($rad = $sqlSvar->fetch_array(MYSQLI_ASSOC)) {
  foreach ($rad as $verdi) {
    printf("Kode: %s, Navn: %s<br>", $verdi["klassekode"],$verdi["klassenavn"]);
  }   // printf, hvor %s er string-placeholder, etterfulgt av variabel for å fylle %s-placeholderen'
  //print ($rad["klassekode"], $rad["klassenavn"]<br>'); // element 0 er klassekoden, 1 er klassenavnet
} */

print("<h3>Studenter</h3>");
// Overskrift
print("<table  class=\"table table-striped\" id=\"studenttabell\">\n");
  // Start html-tabellen med ny linje(\n) for ryddig kildekode i nettleseren
print("<tr>\n<th>Brukernavn:</th>\n<th>Fornavn:</th>\n<th>Etternavn:</th>\n<th>Klassekode:</th>\n<th>Neste frist:</th>\n<th>Bildenummer:</th></tr>\n");
  // Skriver første rad i tabellen, som er innholdsforklaring
while ($rad = $sqlSvar->fetch_array(MYSQLI_ASSOC)) {
  // Kjører while sålenge vi får rader fra DBHSet som en assoc_array
  print("<tr>\n");
    // Start ny tabell-rad
  foreach ($rad as $verdi) {
    // Interer arrayen med en foreach-løkke
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
