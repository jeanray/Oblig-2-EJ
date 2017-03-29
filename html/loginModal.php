<!-- Får finne en bedre løsning, mulig med javascript ev. at php-innloggingssjekken feiler så kommer denne opp -->
<br>
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#loginModal">Logg inn</button>

<div id="loginModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Vennligst logg inn for å bruke skoleAdmin:</h4>
      </div>
      <div class="modal-body">
        <form> <!-- Start form-tag her -->
          <div class="form-group">
            <label for="brukernavn" class="form-control-label">Brukernavn:</label>
            <input type="text" class="form-control" id="bruker" name="bruker" placeholder="Brukernavn">
          </div>
          <div class="form-group">
            <label for="passord" class="form-control-label">Passord:</label>
            <input type="password" class="form-control" name="hemmelig" id="hemmelig" placeholder="Passord">
          </div>
          <div class="modal-footer">
            <a href="index.php" class="btn btn-info pull-left" role="button">Forsiden</a>
            <button type="button" class="btn btn-info" data-dismiss="modal">Lukk vinduet</button>
            <button type="submit" class="btn btn-success" data-dismiss="modal">Logg inn</button>
          </div>
        </form> <!-- Avslutter form her -->
      </div>
    </div>
  </div>
</div>
