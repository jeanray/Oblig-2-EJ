
function valKlasseRegSkjema() {
	// Funksjon for å sjekke at studentregistreringsskjemaet er fylt ut

	var klKodeFraSkjema = document.forms["registrerKlasseSkjema"]["klassekode"].value;
	var klNavnFraSkjema = document.forms["registrerKlasseSkjema"]["klassenavn"].value;
		// Kopiere input fra HTML-skjemaet over i egne JS-variabler

	if (klKodeFraSkjema == null || klKodeFraSkjema == "") {
		visJsFeilBoks();
		document.getElementById("jsFeil").innerHTML = "Feltet for klassekode må fylles ut!<br>";
			// Endre elementet "jsFeil" med feilbeskrivelse
		return false;
			// Funksjonen sender false tilbake hvis skjemaet ikke er fylt ut
	}

	if (klNavnFraSkjema == null || klNavnFraSkjema == "") {
		visJsFeilBoks();
		document.getElementById("jsFeil").innerHTML = "Feltet for klassenavn må fylles ut!<br>";
		return false;
	}
	// Lukk definering av funksjonen valStSkjema (valider Student-Skjema)
}
function visJsFeilBoks() {
    document.getElementById("jsFeil").style.display = 'block';
}
