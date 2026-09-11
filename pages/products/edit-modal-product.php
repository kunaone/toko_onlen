<!-- val modal detail product -->
<div class="modal fade" tabindex="-1" role="dialog" id="editProduct">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Produk</h4>
      </div>

      <div class="modal-body">
      	<img src="" class="img-rounded" style="display: block; margin: 0 auto; max-width: 300px;" alt="img-detail-prod" id="ed-product-preview">
        
        <form id="formDetailProd" action="?page=products" enctype="multipart/form-data" method="" style="margin-top: 16px;">
	        <fieldset>
	          
	          <input type="hidden" name="product_id" id="edit_product_id" value="">
	          
	          <div class="form-group">
	          	<label>Kode Produk</label>
		          <div class="input-group">
							  <span class="input-group-addon"><i class="fa fa-barcode fa-fw"></i></span>
							  <input type="text" class="form-control" id="ed_prod_code" disabled>
							</div>
	          </div>

	          <div class="form-group">
	            <label>Nama Produk</label>
	            <input type="text" name="name" class="form-control" id="ed_product_name" disabled>
	          </div>

	          <div class="form-group">
	            <label>Kategori Produk</label>
	            <div class="input-group">
	            	<span class="input-group-addon"><i class="fa fa-tags fa-fw"></i></span>
		            <input type="text" name="category" class="form-control" id="ed_prod_category" disabled>
	            </div>
	          </div>

	          <div class="form-group">
	            <label>Stok</label>
	            <input type="number" name="stok" class="form-control" id="ed_prod_stock" disabled>
	          </div>

	          <div class="form-group">
	            <label for="prod_satuan">Satuan</label>
	            <input type="text" name="satuan" class="form-control" id="ed_prod_satuan" disabled>
	          </div>
	          
	          <div class="form-group">
	            <label for="buy_price">Harga Beli</label>
	            <div class="input-group">
	            	<span class="input-group-addon"><strong>Rp.</strong></span>

	              <input type="number" class="form-control" id="ed_buy_price" name="purchase_price" disabled>
	            </div>
	          </div>

						<!-- selling price -->
						<div class="form-group">
	            <label for="sell_price">Harga Jual</label>
	            <div class="input-group">
	            	<span class="input-group-addon"><strong>Rp.</strong></span>
	              <input type="number" class="form-control" id="ed_sell_price" name="selling_price" disabled>
	            </div>
	          </div>

	        </fieldset>
	      </form>      
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="delete_product" form="formDetailProd">Edit Produk</button>
      </div>
    
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->