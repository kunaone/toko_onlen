<?php

include_once "./process/products/get_product_by_id.php";

$category_query = mysqli_query($conn, "SELECT id, name FROM categories ORDER BY name ASC");

?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div style="margin-bottom: 16px;" class="col-lg-12">
			    <h1 class="page-header">Edit Produk</h1>
			    <a style="font-size: 16px;" href="?page=products">
			        <span class="glyphicon glyphicon-circle-arrow-left"></span>
			        &nbsp;&nbsp;Kembali
			    </a>
		  	</div>
		</div>
		
		<div class="panel panel-default" style="border: solid 1px rgb(36,39,58);">
		  <div class="panel-heading" style="background-color: rgb(36,39,58); color: #ddd;">Edit Produk&nbsp;<strong><?= $product['prod_code'] ?></strong></div>
		  <div class="panel-body">
		    
				<form action="?page=products" enctype="multipart/form-data" method="POST">
	        <fieldset>
	          
	          <input type="hidden" name="product_id" id="edit_product_id" value="<?= htmlspecialchars($product['id']) ?>">
	          <!-- sku / code_prod -->
	          <div class="form-group">
	            <label for="code_prod">Kode Produk</label>
	            <input type="text" name="prod_code" class="form-control" id="code_prod" style="width: 15%;" value="<?= htmlspecialchars($product['prod_code'])?>">
	          </div>

	          <!-- nama produk -->
	          <div class="form-group">
	            <label for="prod_name">Nama Produk</label>
	            <input type="text" name="name" class="form-control" id="prod_name" value="<?= htmlspecialchars($product['name']) ?>">
	          </div>

	          <!-- kategori produk -->
	          <div class="form-group">
	            <label for="prod_name">Kategori Produk</label>
	            <select name="category_id" class="form-control">

			    <?php while ($category = mysqli_fetch_assoc($category_query)) { ?>

			        <option
			            value="<?= $category['id']; ?>"
			            <?= ($category['id'] == $product['category_id']) ? 'selected' : ''; ?>
			        >
			            <?= htmlspecialchars($category['name']); ?>
			        </option>

			    <?php } ?>

				</select>
	          </div>

	          <!-- stok & satuan -->
	          <div class="row">
	            <div class="form-group col-md-6">
	              <label for="stok">Stok</label>
	              <input type="number" class="form-control" id="stok" name="qty" value="<?= htmlspecialchars($product['qty']) ?>">
	            </div>
	            <div class="form-group col-md-2">
	              <label for="satuan">Satuan</label>
	              <input type="text" class="form-control" id="satuan" name="satuan" value="<?= htmlspecialchars($product['satuan']) ?>">
	            </div>
	            <div class="col-md-offset-4"></div>
	          </div>
			
			  <!-- purchase price -->
	          <div class="form-group">
	            <label for="buy_price">Harga Beli</label>
	            <div class="input-group">
	            	<span class="input-group-addon"><strong>Rp.</strong></span>
	              <input type="number" class="form-control" id="buy_price" name="purchase_price" value="<?= !isset($product['purchase_price']) ? '0' : htmlspecialchars($product['purchase_price']); ?>">
	            </div>
	          </div>

				<!-- selling price -->
				<div class="form-group">
	            <label for="sell_price">Harga Jual</label>
	            <div class="input-group">
	            	<span class="input-group-addon"><strong>Rp.</strong></span>
	              <input type="number" class="form-control" id="sell_price" name="selling_price" value="<?= htmlspecialchars($product['selling_price']) ?>">
	            </div>
	          </div>
						
	          <!-- Upload File Gambar Produk -->
	          <div class="form-group">
	            <label for="img_prod">Gambar Produk</label>
	            <input type="file" name="img_prod" id="img_prod" accept="image/jpeg,image/png">
	            <span class="help-block">*Opsional</span>
	          </div>

	        </fieldset>

	        <a class="btn btn-default" href="?page=products">Batal</a>
	        <button type="submit" class="btn btn-primary" name="update_product">Simpan Perubahan</button>
	      </form>
		  </div> <!-- /.panel-body -->
		</div> <!-- /.panel- -->

	</div> <!-- /.container-fluid -->
</div> <!-- /.page-wrapper -->