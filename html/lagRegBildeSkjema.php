<?php

function regBildeSkjema () {
echo <<<'HTML'
  <div class="row">

      <form class="well" id="regBildeSkjema" name="regBildeSkjema" action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
          <label for="skjemaBildenummer">Bildenr - velg et bildenummer, for eksempel "009".</label>
          <input type="text" class="help-block" name="skjemaBildenummer" id="skjemaBildenummer" placeholder="Eksempel: '505'" class="form-control">
          <span id="bildeNrHjelp" class="help-block"><i>Bildenummeret må være konstruert av tre siffer, for eks 128 og 512.</i></span>
        </div>

        <div class="form-group">
          <label for="skjemaBildeBeskrivelse">Beskrivelse:</label>
          <input type="text" class="form-control" id="skjemaBildeBeskrivelse" name="skjemaBildeBeskrivelse" placeholder="En kort beskrivelse av bildet.">
          <span id="bildeBeskrivHjelp" class="help-block"><i>Maksimalt 255 karakterer.</i></span>
        </div>

        <div class="form-group">
          <label for="skjemaBildefil">Velg et bilde:</label>
          <input type="file" name="skjemaBildefil" id="skjemaBildefil">
          <span id="lastOppHjelp" class="help-block"><i>Kun GIF, JPEG og PNG-bilder er tillatt for opplasting, <br>maks. 5 megabyte per bilde.</i></span>
        </div>

        <input type="submit" name="skjemaRegBilde" id="skjemaRegBilde" class="btn btn-success" value="Registrer bilde" alt="Knapp for å registrere det valgte bildet fra skjemaet">
        <input type="reset" name="skjemaResetKnapp" id="skjemaResetKnapp" class="btn btn-warning" value="Nullstill skjema">
      </form>
  </div>
HTML;
}

?>
