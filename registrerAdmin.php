<h3>Registrering</h3><br>
<?php
include("html/registrerskjema.html");
print("<br>");

if (isset($_POST["registrer"])) {
    $brNavnFraSkjema=$_POST["brukernavn"];
    $passFraSkjema=trim($_POST["passord"]);
    $passordHashet = password_hash($passFraSkjema, PASSWORD_DEFAULT, array("cost" => 12));
      // Best practice OG det Geir lærte bort == rette måten å gjørra no på imo ;D

    print("<br>");

    $sql="INSERT INTO brukarar(brukarnamn, kjenneord) VALUES ('$brNavnFraSkjema','$passordHashet');";

    $sqlObjekt = $dbLink->query($sql);

    print("Brukeren <b>$brNavnFraSkjema</b> ble registrert!<br>\n");
    print("Du blir nå sendt tilbake til hovedsiden.<br>\n");

    echo '<META HTTP-EQUIV=REFRESH CONTENT="2; index.php">';
      // Vent tre sekunder for at brukeren rekker å se meldingen, og redirect
}

?>
