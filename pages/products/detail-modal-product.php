<!-- val modal detail product -->
<div class="modal fade" tabindex="-1" role="dialog" id="detailProduct" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detail Produk</h4>
      </div>
      <div class="modal-body">
				<button class="btn btn-success" style="float: right;"><i class="fa fa-print fa-fw"></i></button>
      	<img src="" class="img-rounded" style="display: block; margin: 0 auto; max-width: 300px;" alt="img-detail-prod" id="product-preview">
        
        <form id="formDetailProd" action="" method="" style="margin-top: 16px;">
	        <fieldset>
	          
	          <input type="hidden" name="product_id" id="edit_product_id" value="">
	          
	          <div class="form-group">
	          	<label>Kode Produk</label>
		          <div class="input-group">
							  <span class="input-group-addon"><i class="fa fa-barcode fa-fw"></i></span>
							  <input type="text" class="form-control" id="prod_code">
							</div>
	          </div>

	          <div class="form-group">
	            <label>Nama Produk</label>
	            <input type="text" name="name" class="form-control" id="product_name">
	          </div>

	          <div class="form-group">
	            <label>Kategori Produk</label>
	            <div class="input-group">
	            	<span class="input-group-addon"><i class="fa fa-tags fa-fw"></i></span>
		            <input type="text" name="category" class="form-control" id="prod_category">
	            </div>
	          </div>

	          <div class="form-group">
	            <label>Stok</label>
	            <input type="number" name="stok" class="form-control" id="prod_stock">
	          </div>

	          <div class="form-group">
	            <label for="prod_satuan">Satuan</label>
	            <input type="text" name="satuan" class="form-control" id="prod_satuan">
	          </div>
	          
	          <div class="form-group">
	            <label for="buy_price">Harga Beli</label>
	            <div class="input-group">
	            	<span class="input-group-addon"><strong>Rp.</strong></span>

	              <input type="number" class="form-control" id="buy_price" name="purchase_price">
	            </div>
	          </div>

			  <div class="form-group">
	            <label for="sell_price">Harga Jual</label>
	            <div class="input-group">
	            	<span class="input-group-addon"><strong>Rp.</strong></span>
	              <input type="number" class="form-control" id="sell_price" name="selling_price">
	            </div>
	          </div>

	        </fieldset>
	      </form>      
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="delete_product" id="btnEditProd">Edit Produk</button>
      </div>
    
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->