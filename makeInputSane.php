<?php

function inputSanitize($input) {
  htmlspecialchars($input);
  if preg_match=("'^[/|;]$'") {
    die("<div class="alert alert-danger" role="alert">Forsøker du å injecte SQL? Nei og nei..</div>)
  }
  return $input;
}

?>
