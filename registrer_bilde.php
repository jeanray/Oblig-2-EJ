<?php
include_once("loginFunksjoner.php");

if (ikkeInnlogget()) {
  echo '<META HTTP-EQUIV=REFRESH CONTENT="3; innlogging.php">';
  die("<div class=\"alert alert-danger\">Du må være logget inn for å bruke denne siden, <a href=\"innlogging.php\">vennligst trykk her om du ikke blir videresendt.</a></div>");
}

include("html/lagRegBildeSkjema.php");

regBildeSkjema();

if (isset($_POST["skjemaRegBilde"])) {

  if ( ($_FILES["skjemaBildefil"]["name"] == "") || ($_POST["skjemaBildeBeskrivelse"] == "") || ($_POST["skjemaBildenummer"] == "") ) {
    die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Det ser ikke ut til at du har fylt ut alle feltene. Vennligst forsøk på nytt.</div>");
    // Her sjekker vi om superglobalen $_FILES ikke inneholder det vi forventer, ved å se etter "tomme" felter (== "")
  }

  $bildenrFraSkjema = htmlspecialchars($_POST["skjemaBildenummer"]);
  $bildeBeskrivFraSkjema = htmlspecialchars($_POST["skjemaBildeBeskrivelse"]);

  if (!preg_match('/^\d{3}$/', $bildenrFraSkjema)) {
      die("<div class=\"alert alert-danger\" role=\"alert\">Bildenummeret består ikke av tre siffer. Det skal være i formatet av tre siffer, for eksempel 123, 555, 757 ol.</div>");
  }  // Enkelt regulært uttrykk som sjekker om variabelen kun inneholder tre siffer.

  $sql = "SELECT bildenr FROM bilde WHERE bildenr='$bildenrFraSkjema';";

  $sqlObjekt = $dbLink->query($sql);

  while ($bildeSQL = $sqlObjekt->fetch_assoc()) {
    if($bildeSQL["bildenr"] == $bildenrFraSkjema) {
      die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Bildenummeret er allerede brukt, vennligst forsøk med et annet.</div>");
    }
  }

  if (isset($_FILES)) {
    $storrelse = $_FILES["skjemaBildefil"]["size"];
    $fil = $_FILES["skjemaBildefil"]["name"];
    $tmpBildefil = $_FILES["skjemaBildefil"]["tmp_name"];

    $filInfo = new SplFileInfo($fil);
      // Lager nytt objekt fra klassen SplFileInfo (PHP-klasse)

    if($storrelse /1024/1024 > 4) {
      // Deler på 1024 to ganger for å få megabyte, og sjekker om filen er større enn 4 MB
      die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: $storrelse bytes er over grensen på <b>fire megabyte</b>, vennligst forsøk med en mindre fil.<div>");
    }

//    $ext = pathinfo($fil, PATHINFO_EXTENSION);
//    print("<br>Fileext: $ext.<br>");
//    Over er alternativ måte å hente ut fil-extension på.

    $filExt = $filInfo->getExtension();
      // Henter filinfo via kommando fra SplFileInfo-klassen

    $filType = strtok($_FILES["skjemaBildefil"]["type"] ,'/');
      // For å dra ut kun delen før / i MIME-typen bruker vi strtok, som er den mest passende kommandoen da vi kan møte flere filtyper.
      // Dra kun ut "image"-delen. Filens extension bestemmer også om den får lov til å lastes opp eller ikke, så vi nøyer oss med "bilde".

      // MIME-typen som finnes i $_FILES..[type] blir sendt fra browseren, og ikke sjekket av php selv, og kan dermed ikke regnes med noe mer
      // enn hva fil-extension kan. http://php.net/manual/en/features.file-upload.post-method.php
    if ($filExt != "png" && $filExt != "gif" && $filExt != "jpeg" && $filExt != "jpg" && $filType != "image") {
      die("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Filtypen må være et bilde med extension .png, .jpg/.jpeg eller .gif.</div>");
    }

    $opplastingsmappe = "bilder/";
    // $fil er det originale navnet. Vi kan lage en kolonne til i bilde, og sette inn det nye navnet der, og vise begge to.

    $filNavn = $filInfo->getFilename();

    $nyttFilnavn = $_SESSION["brukernavn"] . "_" . $bildenrFraSkjema . "." . $filExt;

    $fullFilsti = $opplastingsmappe . $nyttFilnavn;

    $opplastingsDato = date("Y-m-d");

    if (move_uploaded_file($tmpBildefil,$fullFilsti)) {

      $sql = "INSERT INTO bilde VALUES('$bildenrFraSkjema','$opplastingsDato','$nyttFilnavn','$bildeBeskrivFraSkjema','$filNavn');";
      $sqlObjekt = $dbLink->query($sql);
      print("<div class=\"alert alert-success\" role=\"alert\">Opplasting av nytt bilde med nr $bildenrFraSkjema er vellykket utført.<br>Du kan nå <a href=\"index.php?registrer_student\">registrere student tilhørende bildet.</a></div>");
      $_SESSION["sisteBildeRegBruker"] = $_SESSION["brukernavn"];
      $_SESSION["sisteBildenr"] = "$bildenrFraSkjema";

    } else {

      print("<div class=\"alert alert-danger\" role=\"alert\">Fatal feil: Filtypen må være et bilde med extension .png, .jpg/.jpeg eller .gif.</div>");
      // Noe gikk galt under flyttingen av filen.
    } // Avslutter if (flytting av fil)
  } // Avslutter if (isset($_FILES))
} // Avslutter if (isset($_POST["skjemaRegBilde"])) (submit av form)

  /*
  opplastingsdato skal hentes ut og lagres automatisk ved submit av form hvis alle sjekker passerer og
  vi ønsker å kjøre spørringen
  */

?>
