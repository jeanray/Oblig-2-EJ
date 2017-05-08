<?php
if (isset($_GET["funksjon"])) {

  $valgtFunksjon = $_GET["funksjon"];
  // merk ":" i stedet for curly brackets. Les mer om det i slutten av switchen
  // Motmerk: man blir ser svært mange flere {} og venner seg til betydningen
  // i motsetning til : og "endswitch". Ser argumentet, men er dog uenig da
  // krølleparentes er langt mer "lesbart" for _meg_ (og sannsynlig de fleste programmerere)

  // Kan gjøre et eksperiment og se på eksempler med bruk av switch, og se hva som er mest brukt?

  switch($valgtFunksjon) {

    case "forside":
      include("forside.php");
      break;

    case "registrer_klasse":
      include("registrer_klasse.php");
      break;

    case "registrer_student":
      include("registrer_student.php");
      break;

    case "registrer_bilde":
      include("registrer_bilde.php");
      break;

    case "vis_alle_klasser":
      include("vis_klasser.php");
      break;

    case "vis_alle_studenter":
      include("vis_studenter.php");
      break;

    case "vis_alle_bilder":
      include("vis_bilder.php");
      break;

    case "endre_klasser":
      include("endre_klasser.php");
      break;

    case "endre_studenter":
      include("endre_studenter.php");
      break;

    case "endre_bilder":
      include("endre_bilder.php");
      break;

    case "slette_klasse":
      include("slette_klasse.php");
      break;

    case "slette_student":
      include("slette_student.php");
      break;

    case "slette_bilde":
      include("slette_bilde.php");
      break;

    case "sok":
      include("sok_i_database.php");
      break;

    case "logg_ut":
      include("logg_ut.php");
      break;

    default: // Inntreffer kun hvis man skriver inn URL manuelt og da med ?funksjon=noe_annet_enn_i_switchen
    print("Funksjonen du har valgt er ugyldig, vennligst bruk menyen over for å velge funksjon.");

    // endswitch istede for curly brackets. Gjør koden mer human readable og kalles for syntactic sugar
    // kan ta diskusjonen siden -jean - per nå så fucker det opp editoren min, og jeg velger brackets
  }
  // Her "mangler" det nå en krølleparentes sier magefølelsen min :D Men mange veier til capt. morgan!
} else { // Slutt på $GET_["funksjon"]
  include("forside.php"); // Skriv ut en standard forside siden ingen funksjon er valgt.
}
?>
