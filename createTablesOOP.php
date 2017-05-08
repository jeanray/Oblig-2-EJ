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
  // Vi bruker såpass lang datatype på filnavn for å ta høyde for at den kan inneholde hele filstien og navnet
$sql = "CREATE TABLE bilde (
  bildenr CHAR(3) PRIMARY KEY,
  opplastingsdato DATE NOT NULL,
  filnavn VARCHAR(128) NOT NULL,
  beskrivelse TEXT,
  originaltittel VARCHAR(128) NOT NULL
);";

if ($dbLink->query($sql)) { // Vi utfører spørringen, og skriver ut ev. feilmeldinger vi måtte få.
  print("Tabellen \"bilde\"ble opprettet i databasen \"$database\".\n<br>");
} else { // Ev. feilmelding blir skrevet ut. Vanlig feil her er at tabellen allerede eksisterer.
  print "Feil ved registrering av tabell: " . mysqli_error($dbLink) . "<br>";
}

$sql = "CREATE TABLE student (
  brukernavn CHAR(2) PRIMARY KEY,
  fornavn VARCHAR(32) NOT NULL,
  etternavn VARCHAR(64) NOT NULL,
  klassekode VARCHAR(32),
  nestelevfrist DATE,
  bildenr CHAR(3),
  FOREIGN KEY (klassekode) REFERENCES klasse(klassekode),
  FOREIGN KEY (bildenr) REFERENCES bilde(bildenr)
);"; // SQL-kode for å opprette student-tabllen med tilhørende fremmednøkler slik oblig2 forutsetter

if ($dbLink->query($sql)) { // Vi utfører spørringen, og skriver ut ev. feilmeldinger vi måtte få.
  print("Tabellen \"student\"ble opprettet i databasen \"$database\".\n<br>");
} else { // Ev. feilmelding blir skrevet ut. Vanlig feil her er at tabellen allerede eksisterer.
  print "Feil ved registrering av tabell: " . $dbLink->error . "<br>";
}

  // Under lager vi den enkeltstående tabellen uten relasjoner, som kun inneholder brukernavn og passord.
  // Siden vi bruker password_hash må domenet for attributten kjenneord være såpass stor for å ta høyde for både
  // fremtidige nye krypteringsfunksjoner, samt at hashen kan bli over 60 tegn med password_hash per i dag.

  // Det er satt restriksjoner i php-programmet om at brukernavn må bestå av kun karakterer, og maksimalt bestå
  // av ti tegn. Dermed settes datatypen til varchar(10)
$sql = "CREATE TABLE brukarar (
  brukarnamn VARCHAR(10) PRIMARY KEY,
  kjenneord VARCHAR(255)
);";

if ($dbLink->query($sql)) { // Vi utfører spørringen, og skriver ut ev. feilmeldinger vi måtte få.
  print("Tabellen \"brukarar\"ble opprettet i databasen \"$database\".\n<br>");
} else { // Ev. feilmelding blir skrevet ut. Vanlig feil her er at tabellen allerede eksisterer.
  print "Feil ved registrering av tabell: " . $dbLink->error . "<br>";
}

/* Under kommer ren SQL, som kan kopieres og limes inn i et SQL-interface (MySQL-syntax)

CREATE TABLE klasse (
  klassekode VARCHAR(32) PRIMARY KEY, -- Er primary key, dermed automatisk 'not null'
  klassenavn VARCHAR(128) NOT NULL
);

CREATE TABLE bilde (
  bildenr CHAR(3) PRIMARY KEY,
  opplastingsdato DATE NOT NULL,
  filnavn VARCHAR(128) NOT NULL,
  beskrivelse TEXT,
  originaltittel VARCHAR(128) NOT NULL
);

CREATE TABLE student (
  brukernavn CHAR(2) PRIMARY KEY,
  fornavn VARCHAR(32) NOT NULL,
  etternavn VARCHAR(64) NOT NULL,
  klassekode VARCHAR(32),
  nestelevfrist DATE,
  bildenr CHAR(3),
  FOREIGN KEY (klassekode) REFERENCES klasse(klassekode),
  FOREIGN KEY (bildenr) REFERENCES bilde(bildenr)
);

CREATE TABLE brukarar (
  brukarnamn VARCHAR(64) PRIMARY KEY,
  kjenneord VARCHAR(255)
);

*/
