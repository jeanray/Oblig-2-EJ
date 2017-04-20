### Notater vedr. oblig2 i hovedsak  

Lage en funksjon som sjekker om brukeren er logget inn eller ikke virker å være den mest brukte metoden på phpsider.
Da kan vi kjøre funksjonen, er den true er brukeren logget inn, er den false så er brukeren ikke logget inn, og vi må
si ifra, og ev. redirecte til et annet sted.
  


Registrering: Skal vi sjekke at brukeren lager et passord på minst seks tegn elns?  

Skal vi sjekke at det ikke er annet enn bokstaver og tall i brukernavnet, kanskje bindestrek? (enkel regex)  

Når man registrerer en bruker, så synes jeg det er kult om man også logger brukeren rett inn for enkelhetsskyld.  
- Med andre ord, brukeren blir redirected til forsiden igjen, men denne gangen står det "velkommen <brukernavn>", og
tilgang til alle sidene er selvfølgelig på plass.  

Admintabellen i SQL (adminbrukere) kan ha en primary key som kun er int og auto_increment, enkelt og greit.  
Det står i teksten at bruker-registrering skal være "brukernavn og passord" - dermed er epost osv utelukket.
  
Glemt brukernavn/passord tar vi ikke høyde for i denne oppgaven, men derimot på eksamen har vi dette.
  
http://php.net/manual/en/function.filter-input.php <- kjekk for å for eks FILTER_SANITIZE_STRING og litt diverse for å beskytte programmet.

En måte man kan beskytte siden på er å skrive printe all HTML med funksjoner fra PHP, og dette gjør man naturlig nok ikke før etter  
at brukeren er sjekket om er innlogget eller ei.  

En annen måte vil være å dø ved innloggingssjekken hvis brukeren ikke er logget inn, og i die-meldingen kan det være en link til "logg inn her".  


Logout:
<?php
session_start();
session_destroy();
redirect her til hovedside
?>


Beskyttelse mot injection:

stripslashes()
mysql_real_escape_string()



Brainstorming:
Kunne vi inkludert session_start og sjekking av om bruker er logget inn på samtlige sider helt øverst? På index.php er systemet
helt og redirecter som det skal til registrering osv.
Hvis man forsøker å nå enkeltsidene direkte ved å skrive inn /reg_student.php for eks, så sjekker den etter session, som da aldri vil være startet,  
fordi den kun blir startet ifra index.php - dermed kan vi enkelt bare drepe alle forsøk på å nå filer direkte pga mangel på $_SESSION med et par enkle setninger.

Noen tanker om dette? Var bare et innfall, tror det kan gjøre verden enkel for oss. Da kan vi faktisk også redirecte med header()  


Boostrap-signin
<div class="signin-form">
<form class="form-signin" ...
<h2 class="form-signin-heading">



Hvis denne står i hver enkelt fil som blir gått til UTEN å gå via index.php (som sjekker innlogget bruker og setter session-variabler)  
så vil det fungere ganske greit tror jeg!  
Dette fordi hvis de blir inkludert via index.php sin switch, så har de også session-sjekken passert, og dermed vil if-setningen under være false.  
Derimot hvis de prøver å gå på URL-en direkte til undersiden, så blir de hindret.

if (!isset($_SESSION['brukerId'])) {
 header("Location: index.php"); // En måte
 die("Du må være logget inn for å få tilgang til denne siden. Logg inn<a href="index.php" .. osv> her</a>");
}  

Hvis dette skal skje for hver eneste underside, er det mye raskere å inkludere en fil der disse setningene og kanskje mer utfyllende info  
står. Type at hver underside starter med å "include(sjekkLogin.php);" Denne sjekkLogin kan inneholde flere funksjoner, blant annet en funksjon som raskt  
og enkelt sjekker om session er satt som over, bare i en funksjon. Da vil det bli 

if (!loggetInn()) { 
    die("Bitch") 
} else { 
    Forsett med å printe siden til browseren
}