<div id="regModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Registrer ny bruker:</h4>
      </div>
      <div class="modal-body">
        <form> <!-- Start form-tag her -->
          <div class="form-group">
            <label for="nyttBrukernavn" class="form-control-label">Ønsket brukernavn:</label>
            <input type="text" class="form-control" id="bruker" name="bruker" placeholder="Brukernavn">
          </div>
          <div class="form-group">
            <label for="passord" class="form-control-label">Passord:</label>
            <input type="password" class="form-control" name="nyHemmelighet" id="nyHemmelighet" placeholder="Passord">
          </div>
          <div class="form-group"> <!-- Burde legge til en dobbelsjekk av passord, men må blande inn php eller js -->
            <label for="passord" class="form-control-label">Vennligst gjenta passordet:</label>
            <input type="password" class="form-control" name="hemmelig2" id="hemmelig2" placeholder="Passord">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Lukk vinduet</button>
            <button type="submit" class="btn btn-success" data-dismiss="modal">Registrer</button>
          </div>
        </form> <!-- Avslutter form-taggen her -->
      </div>
    </div>
  </div>
</div>
<!-- Vil særdeles gjerne ha captcha her! -->
