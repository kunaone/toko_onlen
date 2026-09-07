<!-- modal form tambah data -->
<div class="modal fade" tabindex="-1" role="dialog" id="addProd">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title"><strong>Tambah Produk</strong></h4>
      </div>

      <div class="modal-body">

        <!-- Jika ada error -->
        <?php if ($has_errors) { ?>
        <div class="alert alert-danger"><strong>Periksa kembali data produk.</strong></div>
        <?php } ?>

        <form id="formProd" action="" method="POST" enctype="multipart/form-data">
          
          <fieldset>
            <!-- SKU || Kode Produk -->
            <div class="form-group <?= isset($errors['code_prod']) ? 'has-error' : '';?>" style="padding-left: 0; width: 30%;">
              <label for="code_prod">Kode Produk</label>
              <input type="text" name="code_prod" class="form-control" id="code_prod" 
                     value="<?= htmlspecialchars(isset($_POST['code_prod']) ? $_POST['code_prod'] : $product_code); ?>">

              <?php if (isset($errors['code_prod'])) { ?>
              
              <span class="help-block">
                <?= htmlspecialchars($errors['code_prod']); ?>
              </span>
              
              <?php } ?>
            </div>

            <!-- Nama Produk -->
            <div class="form-group <?= isset($errors['prod_name']) ? 'has-error' : ''; ?>">
              <label for="prod_name">Nama Produk</label>
              <input type="text" name="prod_name" class="form-control" id="prod_name"
                     value="<?= htmlspecialchars(isset($_POST['prod_name']) ? $_POST['prod_name'] : ''); ?>">

              <?php if (isset($errors['prod_name'])) { ?>
              
              <span class="help-block">
                <strong><?= htmlspecialchars($errors['prod_name']); ?></strong>
              </span>
              
              <?php } ?>
            </div>

            <!-- Kategori Produk -->
            <div class="form-group <?= isset($errors['category_id']) ? 'has-error' : ''; ?>">
              <label for="category_id">Kategori</label>
              <select name="category_id" id="category_id" class="form-control">
                <option value="">-- Pilih Kategori --</option>
                  
                <?php while ($category = mysqli_fetch_assoc($category_query)) { ?>
                <option value="<?= $category['id']; ?>"
                    
                <?php
                    if(isset($_POST['category_id']) && $_POST['category_id'] == $category['id']){
                        echo 'selected';
                    }
                ?>> <!-- siku pertama penutup php, siku terakhir tag pembuka option -->
                
                <?= htmlspecialchars($category['name']); ?>
                </option>

                <?php } ?>
              </select>

              <?php if (isset($errors['category_id'])) { ?>
              <span class="help-block">
                <strong><?= htmlspecialchars($errors['category_id']); ?></strong>
              </span>
              <?php } ?>

            </div>

            <!-- Stok Produk -->
            <div class="row">
              <div class="form-group col-md-6 <?= isset($errors['stok']) ? 'has-error' : ''; ?>">
                <label for="stok">Stok</label>
                <input name="stok"type="number" min="0" class="form-control" id="stok"
                       value="<?= htmlspecialchars(isset($_POST['stok']) ? $_POST['stok'] : ''); ?>">

                <span class="help-block" style="margin: 0;">Boleh diisi 0 jika barang belum tersedia.</span>

                <?php if (isset($errors['stok'])) { ?>
                <span class="help-block">
                  <strong><?= htmlspecialchars($errors['stok']); ?></strong>
                </span>
                <?php } ?>
              </div>

              <!-- Satuan Produk -->
              <div class="form-group col-md-2 <?= isset($errors['satuan']) ? 'has-error' : ''; ?>">
                <label for="satuan">Satuan</label>
                <input name="satuan" type="text" class="form-control" id="satuan"
                       value="<?= htmlspecialchars(isset($_POST['satuan']) ? $_POST['satuan'] : ''); ?>">

                <?php if (isset($errors['satuan'])) { ?>
                <small class="help-block">
                  <strong><?= htmlspecialchars($errors['satuan']); ?></strong>
                </small>
                <?php } ?>

              </div>
              <div class="col-md-offset-4"></div>

            </div>

            <!-- Selling Price Product -->
            <div class="form-group <?= isset($errors['selling_price']) ? 'has-error' : ''; ?>">
              <label for="selling_price">Harga Jual</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <strong>Rp.</strong>
                </div>
                <input name="selling_price" type="number" min="1" class="form-control" id="selling_price"
                       value="<?= htmlspecialchars(isset($_POST['selling_price']) ? $_POST['selling_price'] : ''); ?>">
              </div>

                <span class="help-block" style="margin: 0;">*Harga jual untuk satuan barang</span>

                <?php if (isset($errors['selling_price'])) { ?>
                <span class="help-block">
                  <strong><?= htmlspecialchars($errors['selling_price']); ?></strong>
                </span>
                <?php } ?>

            </div>

            <!-- Upload File Gambar Produk -->
            <div class="form-group">
              <label for="img_prod">Gambar Produk</label>
              <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-file-image-o"></i>
                </div>
                <input type="file" class="form-control" name="img_prod" id="img_prod" accept="image/jpeg,image/png">
              </div>
              <span class="help-block">*Opsional</span>
            </div>

          </fieldset>

        </form>

      </div>

      <!-- Modal Footer -->
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="add_product" form="formProd">Submit</button>
      </div>
    </div> <!-- /.modal-content -->
  </div> <!-- /.modal-dialog -->
</div> <!-- /.modal || Parent Modal -->