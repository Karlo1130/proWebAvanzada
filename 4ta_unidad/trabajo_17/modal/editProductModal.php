<div class="modal fade" tabindex="-1" id="editProductModal" aria-labelledby="editProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="p-5 d-flex flex-column gap-3">
            <form method="POST" action="app/authController.php">
                <div>
                    <h5>Email address</h5>
                    <input class="col-md-12 form-control" type="email" required name="correo">
                    <span class="form-text">We'll never share you email with anyone else</span>

                </div>
                <div>
                    <h5>Password</h5>
                    <input class="col-md-12 form-control" type="password" required name="contrasenna">
                </div>

                <input type="hidden" name="access" value="access">
                <div>
                    <input type="checkbox">
                    <label class="form-label">Check me out</label>
                    <br>
                    <button class="col-md-12 form-control btn btn-dark" type="submit">Submit</button>
                </div>
            </form>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>