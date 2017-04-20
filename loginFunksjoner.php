<?php

function korrektPassord($brukernavn, $hashetPass) {

  // Siden vi kun henter ut en kolonne fra en tabell, gir denne sql-spørringen kun en rad som svar.
  // Dermed blir dette [0], som vi ser når vi bruker den etter å ha utført spørringen. Dermed nøyer vi oss
  // også med å bare hente ut en numerisk array, da vi utifra den veldig spesifiserte spørringen ikke trenger noe annet.

  $sql = "SELECT kjenneord FROM brukarar WHERE brukarnamn='$brukernavn';";

  $sqlObjekt = $dbLink->query($sql);

  $hashPassordArray = $sqlObjekt->fetch_array(MYSQLI_NUM);

  if (password_verify($hashetPass, $hashPassordArray[0])) {
    // Her kan vi sette inn våre session-variabler som viser at brukeren er logget inn.
    // På sikt kan vi også satse på å få inn flere andre variabler her, flere detaljer om brukeren
    // ville vært normalt å ha, blant annet, sannsynlig utføre logging til database.
  } else {
    return false;
    // Return false innebærer at vi kan ta en if (!korrektPassord) {Dø!}
  }

  $sqlObjekt->free();
}

function innloggetBruker() {
  // Funksjon som kan kjøres etter man har fått et korrekt passord.
  // Her kan det ligge diverse $_SESSION-variabler, og mulig også en
  // registrering til databasen med timestamp og annen info.
}
/*
Må lages en funksjon som kan kjøres på hver eneste underside for å sjekke om session-variablene vi forventer er satt, redirecte eller dø med link til reg.
Elns.

Denne funksjonen må jo starte session med en gang, for å sjekke om variabelen(e)
for å vise om du er logget inn eller ikke er satt. Er de ikke satt, så kanskje vi skal dø,
eller kanskje vi bare skal redirecte til index-siden med funksjonen login.

Forsiden må i hvert fall formes utifra om man er logget inn eller ikke, funksjoner
kan passe fint for dette. Velkommen $_SESSION["brukernavn"].<br>
Vennligst benytt nedtrekksmenyene øverst for å bruke systemet.

Husk at hvis du skal registrere en student, så er du nødt til å [registrere bilde] først.

På eksamen kan vi ved noe lignende huske på bildenummeret i session, noe som vil forenkle
reg_student-aktige funksjonen ved å allerede fylle ut/preselecte bildenummeret.
*/
?>
