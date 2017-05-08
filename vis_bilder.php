<?php
include_once("loginFunksjoner.php");

if (ikkeInnlogget()) {
  echo '<META HTTP-EQUIV=REFRESH CONTENT="3; innlogging.php">';
  die("<div class=\"alert alert-danger\">Du må være logget inn for å bruke denne siden, <a href=\"innlogging.php\">vennligst trykk her om du ikke blir videresendt.</a></div>");
}

// include(".php"); -- Innloggingssjekken deres
include("dbTilkoblingOOP.php");

print("<h3>Vis alle bilder</h3>");

$sqlSpørring = "SELECT * FROM bilde;";
$sqlResultat = mysqli_query($dbLink, $sqlSpørring) or die ("Det skjedde en feil med databasetilkoblingen.");

print('<table class="table table-striped">');
print('<thead> <tr> <th>Bildenummer</th> <th>opplastingsdato</th> <th>Filnavn</th> <th>Bildebeskrivelse</th> <th>Visning</th> </tr> </thead>');

foreach ($sqlResultat as $verdi) {
  $bildenr = $verdi["bildenr"];
  $opplastingsdato = $verdi["opplastingsdato"];
  $filnavn = $verdi["filnavn"];
  $beskrivelse = $verdi["beskrivelse"];
  $bildebane = "/bilder";

  print("<tbody> <tr> <td>$bildenr</td> <td>$opplastingsdato</td> <td>$filnavn</td> <td>$beskrivelse</td> <td><a href='$bildebane/$filnavn' data-lightbox='$filnavn' data-title='$beskrivelse'><img src='$bildebane/$filnavn' height=100 width=100></a></td> </tr> </tbody>");
}

print('</table>');

/* Litt usikker på hva han ønsker her. En liste over alle bilder, med tilhørende beskrivelse osv virker logisk,
og det kunne vært litt artig å hatt det slik at når man trykket på filnavnet så poppet bildet opp, men ikke på
en egen side som om du hadde trykket på linken til bildet (site/bilder/filnavn), men heller i form av en fancy
jquery-boks eller bildekarusell eller noe i den duren.*/

?>
