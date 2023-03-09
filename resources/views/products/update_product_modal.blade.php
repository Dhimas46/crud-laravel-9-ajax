<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
<form class="" id="update-product" action="" method="post">
  @csrf
  <input type="hidden" id="up_id">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Update Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="flash" class="mb-3"></div>
        <div class="form-group">
          <label for="name">Product Name</label>
          <input type="text" class="form-control" name="name" placeholder="Product Name" id="up_name">
        </div>
        <div class="form-group mt-2">
          <label for="name">Product Quantity</label>
          <input type="text" class="form-control" name="quantity" placeholder="Product Quantity" id="up_quantity">
        </div>
        <div class="form-group mt-2">
          <label for="name">Product Price</label>
          <input type="text" class="form-control" name="harga" placeholder="Product Price" id="up_harga">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update Product</button>
      </div>
    </div>
  </div>
</form>
</div>
