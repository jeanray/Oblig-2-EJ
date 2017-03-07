function databaseSok(str) {

	if (str.length == 0) {
		document.getElementById("sokeTreff").innerHTML = "";
		return;

	} else {

		var xmlhttp = new XMLHttpRequest();

		xmlhttp.onreadystatechange = function() {
			// start på funksjonsdekl. når readyState endres

			if (this.readyState == 4 && this.status == 200) { // Forespørsel ferdig og status OK.
				document.getElementById("sokeTreff").innerHTML = this.responseText;
			}

		}; // Slutt på funksjonsdeklarering til objektet

	xmlhttp.open("GET", "sokeFunksjon.php?sokeStreng=" + str, true);
		// Lag forespørsel til php-filen med GET-variabelen "sok" som inneholder inntastet data, asynkront

	xmlhttp.send();
		// Send forespørselen til php-programmet
	}
} // avslutt studentSok-funksjonen
