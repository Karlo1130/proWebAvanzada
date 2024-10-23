
<div class="modal fade" tabindex="-1" id="editProductModal" aria-labelledby="editProductModalLabel" aria-hidden="true">
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
            <input type="text" class="form-control name" required name="name">
            
            <h5>slug</h5>
            <input type="text" class="form-control slug" required name="slug">
            
            <h5>Description</h5>
            <textarea type="text" class="form-control description" required name="description"></textarea>

            <h5>Features</h5>
            <textarea type="text" class="form-control features" required name="features"></textarea>

            <h5>Id</h5>
            <input type="text" class="form-control id" required name="id">

            <button class="btn btn-primary mt-3" type="submit">Confirm</a>

            <input type="hidden" name="action" value="editProduct">
          </form>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>