### Du skal i denne oppgaven ta utgangspunkt i obligatorisk oppgave 1 i PRG1100 og i den endrete
### tabellstrukturen nedenfor. Oppgaven går ut på å videreutvikle vedlikeholdsapplikasjonen.

#### KLASSE
| klassekode | klassenavn |
| --- | --- |
IT1 | IT og informasjonsystemer 1. år
IT2 | IT og informasjonsystemer 2. år
IT3 | IT og informasjonsystemer 3. år

**primærnøkkel:**  
*klassekode*  

#### STUDENT
brukernavn | fornavn | etternavn | klassekode | neste leveringsfrist | bildenr
--- | --- | --- | --- | --- | ---
gb | Geir | Bjarvin | IT1 | 2016-03-01 | 002
mj | Marius | Johannessen | IT1 | 2016-03-01 | 003
sm | Shegaw | Mengiste | IT2 | 2016-05-01 | 001

**primærnøkkel:**  
*brukernavn*  
**fremmednøkkel:**  
*klassekode*  
**fremmednøkkel:**  
*bildenr*  

#### BILDE
bildenr | opplastingsdato | filnavn | beskrivelse
--- | --- | --- | ---
001 | 2016-03-01 | sm.jpg | flott bilde av Shegaw
002 | 2016-04-01 | gb.jpg | grusomt bilde av Geir
003 | 2016-04-15 | mj.jpg | Marius i solnedgang

**primærnøkkel:**
*bildenr*

Vedlikeholdsapplikasjonen skal inneholde følgende nye brukerfunksjoner (i tillegg til de
brukerfunksjoner som ble laget i obligatorisk oppgave 3) *regner med det menes oppgave 1*:  

Registrere et bilde i bildetabellen og laste opp et bilde til serveren (opplastingsdato skal ikke
angis av bruker, men **lages automatisk av php-programmet**)  

Vis alle bilder  
(skriver ut en oversikt over alle registrerte bilder med bildenr, opplastingsdato, filnavn og beskrivelse)

Endre beskrivelsen av et bilde

Slette et bilde i bildetabellen og slette bildet fra serveren

Vis klasseliste med bilde (skriver ut en klasseliste med *fornavn, etternavn og bilde* for alle studenter i **en angitt klasse**)

Brukerfunksjonen for å registrere student må endres slik at neste leveringsfrist velges fra en kalende
og slik at bildenr også registeres.  

Brukerfunksjonen for å vise alle studenter må endres slik at neste
leveringsfrist og bildenr også vises.  

Brukerfunksjonen for å endre student må endres slik at det også  
er mulig å endre neste leveringsfrist og bildenr.  

**Brukerefunksjonene for å registrere bilde og for å
registrere student skal være helt separete brukerfunksjoner (ikke integreres i én brukerfunksjon).**

Det skal lages en funksjon for registrering av bruker (med brukernavn og passord).  

Vedlikeholdsapplikasjonen skal endres slik at det kreves innlogging (med brukernavn og passord) for
å få tilgang til denne applikasjonen.  


*Besvarelsen av oppgaven skal ligge i følgende mappe på studentserveren: https://home.hbv.no
/BRUKERNAVN/prg1100/innlevering2*
