<?php
include("dbTilkoblingOOP.php");
  // Inkluderer tilkoblingsinformasjon

$sql = "CREATE TABLE klasse (
  klassekode VARCHAR(32) PRIMARY KEY, -- Er primary key, dermed automatisk 'not null'
  klassenavn VARCHAR(128) NOT NULL
);";

    // SQL-kode for å opprette en ny tabell som heter fag, med tre forskjellige kolonner.
    // Vi vet at fagkode alltid er 7 tegn, derfor bruker vi char der.
    // Kolonnen fagkode blir satt til å være primærnøkkel.

if ($dbLink->query($sql)) { // Vi kjører spørringen mot databasen via $dblink
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

if ($dbLink->query($sql)) { // Vi utfører spørringen, og skriver ut ev. feilmeldinger vi måtte få.
  print("Tabellen \"oppgave\"ble opprettet i databasen \"$database\".\n<br>");
} else { // Ev. feilmelding blir skrevet ut. Vanlig feil her er at tabellen allerede eksisterer.
  print "Feil ved registrering av tabell: " . mysqli_error($dbLink) . "<br>";
}

  // Under lager vi den enkeltstående tabellen uten relasjoner, som kun inneholder brukernavn og passord.
  // Siden vi bruker password_hash må domenet for attributten kjenneord være såpass stor for å ta høyde for både
  // fremtidige nye krypteringsfunksjoner, samt at hashen kan bli over 60 tegn med password_hash per i dag.

$sql = "CREATE TABLE brukarar (
  brukarnamn VARCHAR(64) PRIMARY KEY,
  kjenneord VARCHAR(255)
);";

if ($dbLink->query($sql)) { // Vi utfører spørringen, og skriver ut ev. feilmeldinger vi måtte få.
  print("Tabellen \"brukarar\"ble opprettet i databasen \"$database\".\n<br>");
} else { // Ev. feilmelding blir skrevet ut. Vanlig feil her er at tabellen allerede eksisterer.
  print "Feil ved registrering av tabell: " . mysqli_error($dbLink) . "<br>";
}
