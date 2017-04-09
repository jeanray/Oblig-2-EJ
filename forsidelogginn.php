<?php
session_start();
echo<<<'SLUTTHTML'
<h2>skoleAdmin v1.0</h2>
Velkommen til administratorpanelet!<br><br>
<b>Før du kan benytte menyen, må du logge deg inn ved hjelp av skjemaet under.</b><br><br>
SLUTTHTML;

include("html/logginn.html");

echo<<<'SLUTTHTML2'
<br>
<p>Har du ikke bruker? Registrer deg <a href="index.php?funksjon=registrer">ved å trykke på denne lenken.</a></p>
<noscript>
    <style type="text/css">
        .pagecontainer {display:none;}
    </style>
    <div class="noscriptmsg">
    <br><h4>Du trenger JavaScript påskrudd for å få den beste opplevelsen av siden.<br>
    JavaScript kreves også for å utnytte all funksjonalitet på nettstedet.</h4><br>
    </div>
</noscript>
SLUTTHTML2;
if(isset($_POST['logginn'])) {

  $bruker = $_POST['brukernavn'];
  $pass = $_POST['passord'];

    // Definerer spørringen
  $sql = "SELECT kjenneord FROM brukarar WHERE brukarnamn='$bruker';";
    // Utfører spørringen og oppretter dermed objektet
  $sqlObjekt = $dbLink->query($sql);
    // Henter ut hashet passord, vi forventer bare en rad, da brukernavn må være unikt.
    // hashPassord[0] tilsvarer alltid passordet.
  $hashPassord = $sqlObjekt->fetch_row();

  if (password_verify($pass, $hashPassord[0])) {
    print("<h4>Yes! Logget inn! </h4>");
  } else {
    print("<h4>Åneida, denna gikk ikke helt gitt!</h4>");
  }

/*
  $sql="SELECT * FROM brukarar WHERE brukarnamn='$bruker' AND kjenneord='$phash';";
  $resultat=mysqli_query($dbLink,$sql);
  $telling=mysqli_num_rows($resultat);

  if($telling == 1) {
    $_SESSION['bruker'] = $bruker;
    header("Location: index.php?funksjon=forside");
*/
}
?>
