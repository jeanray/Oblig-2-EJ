
function valStudentRegSkjema() {
	// Funksjon for å sjekke at studentregistreringsskjemaet er fylt ut

	var uNavnFraSkjema = document.forms["registrerStudentSkjema"]["brukernavn"].value;
	var fNavnFraSkjema = document.forms["registrerStudentSkjema"]["fornavn"].value;
	var eNavnFraSkjema = document.forms["registrerStudentSkjema"]["etternavn"].value;
	var klKodeFraStSkjema = document.forms["registrerStudentSkjema"]["klassekodeFK"].value;
		// Kopiere input fra HTML-skjemaet over i egne JS-variabler

	if (uNavnFraSkjema == null || uNavnFraSkjema == "") {
		visJsFeilBoks();
		document.getElementById("jsFeil").innerHTML = "Feil: Feltet brukernavn må fylles ut.<br>";
			// Endre elementet "jsFeil" med feilbeskrivelse
		return false;
			// Funksjonen sender false tilbake hvis skjemaet ikke er fylt ut
	} else if (uNavnFraSkjema.length > 2) {
		visJsFeilBoks();
		document.getElementById("jsFeil").innerHTML = "Feil: Brukernavnet kan kun bestå av to karakterer.<br>";
		return false;
	}
		// repeter for de tre resterende feltene i skjemaet
	if (fNavnFraSkjema == null || fNavnFraSkjema == "") {
		visJsFeilBoks();
		document.getElementById("jsFeil").innerHTML = "Feil: Feltet fornavn må fylles ut.<br>";
		return false;
	}
	if (eNavnFraSkjema == null || eNavnFraSkjema == "") {
		document.getElementById("jsFeil").innerHTML = "Feil: Feltet etternavn må fylles ut!<br>";
		return false;
	}
	if (klKodeFraSkjema == null || klKodeFraStSkjema == "") {
		visJsFeilBoks();
		document.getElementById("jsFeil").innerHTML = "Feil: Feltet klassekode må fylles ut!<br>";
		return false;
	}
	// Lukk definering av funksjonen valStSkjema (valider Student-Skjema)
}

function visJsFeilBoks() {
    document.getElementById("jsFeil").style.display = 'block';
}
