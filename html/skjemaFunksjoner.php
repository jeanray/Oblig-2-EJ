<?php
/*
Siden forsiden kommer til å endres utifra om man er logget inn eller ikke, så er det en grei måte å håndtere det på, ved å lage funksjoner som printer ut den korrekte HTML-en basert på dette.

På sikt ønsker jeg meg at denne forsiden blir et slags "dashboard" der det blant annet står når man sist logget inn, tilgang til logger over mislykkede innlogginger og lignende, bare for bonus (eksamen)

For nå så holder det å variere med å gi en velkomstmelding før man ber brukeren logge inn,
ev. ved å inkludere eller lage en funksjon for det relativt enkle login-skjemaet, hvis man ikke er logget inn.
På eksamen hadde dette vært artig å fått til i en modal of course ("hadde dette vært == kommer det til å bli")

Er man derimot logget inn, altså at rette session-variabler er satt, så kan man hoppe over dette, og gå videre og vise noe annet innhold til brukeren, som for eks dagens dato og hvilket brukernavn som er innlogget elns.

Jeg tror man kan oppnå detta ved å bare rett og slett skrive if !innlogget (og alt det innebærer), så kjør disse funksjonene for innlogging, og kjører en die, med ev. en refresh-knapp om det ikke fungerer å bare skrive inn og trykke "Logg inn" på nytt. Velger man denne tilnærmingen, så slipper man å tenke på at man skal refreshe siden hvis brukeren er logget inn, fordi siden kun fortsetter å laste hvis brukeren nettopp er det - innlogget.

Hvis man deler dette opp i litt forskjellige funksjoner så vil dette naturlig kunne brukes både på alle undersider.
*/

lagLoginSkjema() {
echo<<<'HTML'
  <form method="post" id="loginSkjema" action="">
  Brukernavn:<br>
  <input type="text" name="brukernavn" id="brukernavnFelt"><br>
  Passord:<br>
  <input type="password" name="passord" id="passordFelt"><br><br>
  <input type="submit" name="loginKnapp" id="loginKnapp" value="Logg på systemet"><br>
</form>
'HTML';
}

lagRegSkjema() {
echo<<<'HTML'
<form method="post" id="regAdmBrukerSkjema" name="regAdmBrukerSkjema" action="">
  Brukernavn:<br>
  <input type="text" name="brukernavn" id="brukernavnFelt">
  <br>
  Passord:<br>
  <input type="password" name="passord" id="brukernavnFelt"><br><br>
  <input type="submit" id="registrerKnapp" name="registrer" value="Registrer">
  <br>
</form>
'HTML';

}
?>
