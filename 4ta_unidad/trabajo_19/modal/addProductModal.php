<div class="modal fade" tabindex="-1" id="addProductModal" aria-labelledby="addProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="p-5 d-flex flex-column gap-3">
          <form method="POST" action="app/productController.php" class="p-3">
            <h5>Name</h5>
            <input type="text" class="form-control" required name="name">
            
            <h5>slug</h5>
            <input type="text" class="form-control" required name="slug">
            
            <h5>Description</h5>
            <input type="text" class="form-control" required name="description">

            <h5>Features</h5>
            <input type="text" class="form-control" required name="features">

            <button class="btn btn-primary mt-3" type="submit">Confirm</a>

            <input type="hidden" name="action" value="addProduct">
          </form>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>