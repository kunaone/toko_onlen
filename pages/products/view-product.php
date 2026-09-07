<?php

/*
 * Process tambah produk harus dijalankan sebelum HTML,
 * supaya redirect dan validation berjalan dengan benar.
 */

include_once "./process/products/get_prodcode_dat.php";

$stmt = mysqli_query($conn,
        "SELECT p.*, c.name AS category_name
         FROM products p
         LEFT JOIN categories c ON p.category_id = c.id
         ORDER BY p.id DESC");

$category_query = mysqli_query($conn, "SELECT id, name FROM categories ORDER BY name ASC");

$category_count = mysqli_num_rows($category_query);
$has_errors = isset($errors) && !empty($errors);

// if(isset($_POST['add_product'])){
  
//   echo "<pre class='col-md-4 col-md-offset-4'; style='margin-top: 12%;'>";
//   print_r($_POST);
//   echo "</pre>";
// }

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

                          <button type="button" class="btn btn-warning btn-xs btn-edit-product" title="Edit"  onclick="window.location.href='?page=edit-product&id=<?= $prod_id ?>'">
                              <span class="glyphicon glyphicon-edit"></span>
                          </button>

                          <button type="button" class="btn btn-danger btn-xs" title="Delete" data-toggle="modal" data-target="#delProduct" data-id="<?= htmlspecialchars($prod_id) ?>" data-code="<?= htmlspecialchars($prod_code); ?>">
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

<?php include_once "./pages/products/add-modal-product.php" ?>


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

<!-- val modal delete product -->
<div class="modal fade" tabindex="-1" role="dialog" id="delProduct">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Hapus Produk</h4>
      </div>
      <div class="modal-body">
        <p id="delete_msg"></p>
        
        <form id="formDelProduct" method="POST" action="">
            <input type="hidden" name="id" id="delete_id">
        </form>       
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger" name="delete_product" form="formDelProduct">Hapus</button>
      </div>
    
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>