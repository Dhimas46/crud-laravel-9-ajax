<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
<form class="" id="add-product-form" action="" method="post">
  @csrf
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="flash" class="mb-3"></div>
        <div class="form-group">
          <label for="name">Product Name</label>
          <input type="text" class="form-control" name="name" placeholder="Product Name" id="name" required autofocus>
        </div>
        <div class="form-group mt-2">
          <label for="name">Product Quantity</label>
          <input type="text" class="form-control" name="quantity" placeholder="Product Quantity" id="quantity" required autofocus>
        </div>
        <div class="form-group mt-2">
          <label for="name">Product Price</label>
          <input type="text" class="form-control" name="harga" placeholder="Product Price" id="harga" required autofocus>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Product</button>
      </div>
    </div>
  </div>
</form>
</div>
