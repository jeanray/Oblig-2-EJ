<?php
include("dbTilkobling.php");
  // Inkluderer tilkoblingsinformasjon

$sql = "CREATE TABLE klasse (
  klassekode VARCHAR(32) PRIMARY KEY, -- Er primary key, dermed automatisk 'not null'
  klassenavn VARCHAR(128) NOT NULL
);";

    // SQL-kode for å opprette en ny tabell som heter fag, med tre forskjellige kolonner.
    // Vi vet at fagkode alltid er 7 tegn, derfor bruker vi char der.
    // Kolonnen fagkode blir satt til å være primærnøkkel.

if (mysqli_query($dbLink, $sql)) { // Vi kjører spørringen mot databasen via $dblink
  print("Tabellen \"klasse\" ble opprettet uten feil.\n<br>");
} else { // Ev. feilmelding blir skrevet ut. Vanlig feil her er at tabellen allerede eksisterer.
  print "Feil ved registrering av tabell, feilmelding fra mysql: \"" . mysqli_error($dbLink) . "\".<br>";
}

$sql = "CREATE TABLE student (
  brukernavn CHAR(2) PRIMARY KEY,
  fornavn VARCHAR(32) NOT NULL,
  etternavn VARCHAR(64) NOT NULL,
  klassekode VARCHAR(32),
  FOREIGN KEY (klassekode) REFERENCES klasse(klassekode)
  );"; // SQL-kode for å opprette en tabell til, oppgave, som har tre kolonner og en primærnøkkel som består
    // av data fra to forskjellige kolonner, fagkode og oppgavenr. I tillegg er det satt en fremmednøkkel, som
    // er en referanse til primørnøkkelen i tabellen fag, som er fagkode-kolonnen.

if (mysqli_query($dbLink, $sql)) { // Vi utfører spørringen, og skriver ut ev. feilmeldinger vi måtte få.
  print("Tabellen \"oppgave\"ble opprettet i databasen \"$database\".\n<br>");
} else { // Ev. feilmelding blir skrevet ut. Vanlig feil her er at tabellen allerede eksisterer.
  print "Feil ved registrering av tabell: " . mysqli_error($dbLink) . "<br>";
}
// Over bruker vi mysqli_multi_query for å utføre flere enn en spørring på en gang, og legger til alle oppføringene
// i tabellen "oppgaver" ved hjelp av en enkelt mysqli-kommando.


/* Nedenfor må tilpasses oblig2, og vi må endre til OOP i hele dokumentet


$sql = "CREATE TABLE student (
  brukernavn CHAR(2) PRIMARY KEY,
  fornavn VARCHAR(32) NOT NULL,
  etternavn VARCHAR(64) NOT NULL,
  klassekode VARCHAR(32),
  FOREIGN KEY (klassekode) REFERENCES klasse(klassekode)
  );"; // SQL-kode for å opprette en tabell til, oppgave, som har tre kolonner og en primærnøkkel som består
    // av data fra to forskjellige kolonner, fagkode og oppgavenr. I tillegg er det satt en fremmednøkkel, som
    // er en referanse til primørnøkkelen i tabellen fag, som er fagkode-kolonnen.

if (mysqli_query($dbLink, $sql)) { // Vi utfører spørringen, og skriver ut ev. feilmeldinger vi måtte få.
  print("Tabellen \"oppgave\"ble opprettet i databasen \"$database\".\n<br>");
} else { // Ev. feilmelding blir skrevet ut. Vanlig feil her er at tabellen allerede eksisterer.
  print "Feil ved registrering av tabell: " . mysqli_error($dbLink) . "<br>";
}

mysqli_close($dbLink);
?>
