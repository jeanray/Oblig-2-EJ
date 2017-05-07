<?php
session_start();
include("loginFunksjoner.php");
print("hei.<br>");
if (ikkeInnlogget()) {
  echo '<META HTTP-EQUIV=REFRESH CONTENT="3; innlogging.php">';
  die("Du ser ikke ut te å værra logga inn, <a href=\"innlogging.php\">vennligst trykk her om du ikke blir videresendt.");
}
?>
