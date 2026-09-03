<?php

/*
 * Process tambah produk harus dijalankan sebelum HTML,
 * supaya redirect dan validation berjalan dengan benar.
 */

include_once "./process/products/add_product.php";
include_once "./process/products/get_prodcode_dat.php";

$stmt = mysqli_query($conn,
        "SELECT p.*, c.name AS category_name
         FROM products p
         LEFT JOIN categories c ON p.category_id = c.id
         ORDER BY p.id DESC");

$category_query = mysqli_query($conn, "SELECT id, name FROM categories ORDER BY name ASC");

$category_count = mysqli_num_rows($category_query);
$has_errors = isset($errors) && !empty($errors);

?>

<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div style="margin-bottom: 16px;" class="col-lg-12">
        <h1 class="page-header">List Produk</h1>
        <a style="font-size: 16px;" href="?page=home">
            <span class="glyphicon glyphicon-circle-arrow-left"></span>
            &nbsp;&nbsp;Kembali
        </a>
      </div>

      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <button class="btn btn-primary" data-toggle="modal" id="btnAddProd">
              <span class="fa fa-plus"></span>&nbsp;&nbsp;Add New
            </button>
          </div>

          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-bordered <?php if (mysqli_num_rows($stmt) != 0) { echo 'table-striped table-hover'; } ?>">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Prod</th>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Unit</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                  </tr>
                </thead>

                <tbody>

                <?php if (mysqli_num_rows($stmt) == 0) { ?>

                  <tr>
                    <td colspan="9" style="vertical-align: middle;">
                      <div class="alert alert-warning text-center" style="margin-bottom: 0;">
                        <strong>Data produk masih kosong!</strong>
                      </div>
                    </td>
                  </tr>

                <?php } else { ?>

                  <?php
                            
                    $no = 1;

                    while ($row = mysqli_fetch_assoc($stmt)) {

                      $prod_id = isset($row['id']) ? $row['id'] : '';
                      $prod_code = isset($row['prod_code']) ? $row['prod_code'] : '';
                      $prod_name = isset($row['name']) ? $row['name'] : '';

                      $category = isset($row['category_name']) ? $row['category_name'] : '-';
                      $unit = isset($row['satuan']) ? $row['satuan'] : '-';
                      $selling_price = isset($row['selling_price']) ? $row['selling_price'] : 0;
                      $stok = isset($row['qty']) ? $row['qty'] : 0;
                      $img_prod = isset($row['img_prod']) ? $row['img_prod'] : '';
                  ?>

                  <tr>
                      <td><?= $no++; ?></td>
                      <td><?= htmlspecialchars($prod_code); ?></td>
                      <td><?= htmlspecialchars($prod_name); ?></td>
                      <td><?= htmlspecialchars($category); ?></td>
                      <td><?= htmlspecialchars($unit); ?></td>
                      
                      <td>Rp <?= number_format($selling_price, 0, ',', '.'); ?></td>

                      <td><?= htmlspecialchars($stok); ?></td>

                      <td>
                          <?php if ($img_prod != '') { ?>
                          
                          <img src="uploads/products/<?= htmlspecialchars($img_prod); ?>" alt="<?= htmlspecialchars($prod_name); ?>" style="width: 45px; height: 45px; object-fit: cover;">
                          
                          <?php } else { ?>
                              - <!-- kalo ga ada cetak "-" -->
                          <?php } ?>
                      </td>

                      <td>
                          <!-- Edit/Delete dikerjakan nanti -->
                          <button type="button" class="btn btn-info btn-xs" title="View">
                              <span class="glyphicon glyphicon-eye-open"></span>
                          </button>

                          <button type="button" class="btn btn-warning btn-xs" title="Edit" disabled>
                              <span class="glyphicon glyphicon-edit"></span>
                          </button>

                          <button type="button" class="btn btn-danger btn-xs" title="Delete" disabled>
                              <span class="glyphicon glyphicon-trash"></span>
                          </button>
                      </td>
                  </tr>

                  <?php } ?>

                <?php } ?>

                </tbody>
              </table>

            </div> <!-- /.table-responsive -->
          </div> <!-- /.panel-body -->
        </div> <!-- /.panel -->
      </div> <!-- /.col-lg-12 -->

    </div> <!-- /.row -->
  </div> <!-- /.container-fluid -->
</div> <!-- /.page-wrapper -->


<!-- modal warning kategori -->
<div class="modal fade" id="categoryWarning" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning text-warning" style="border-top-left-radius: 6px; border-top-right-radius: 6px;">
        <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
        </button>
        <h4 class="modal-title">
            <strong>Perhatian</strong>
        </h4>
      </div>

      <div class="modal-body">
          <p>Sebelum menambahkan produk, silakan tambahkan data kategori terlebih dahulu.</p>
      </div>

      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <a href="?page=categories" class="btn btn-warning">Kelola Kategori</a>
      </div>
    </div> <!-- /.modal-content -->
  </div> <!-- /.modal-dialog -->
</div> <!-- /.modal || Parent Modal -->


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
