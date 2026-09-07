<?php $stmt = mysqli_query($conn, "SELECT * FROM categories"); ?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div style="margin-bottom: 16px;" class="col-lg-12">
                <h1 class="page-header">List Kategori</h1>
                <a style="font-size: 16px;" href="?page=home"><span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;&nbsp;Kembali</a>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12">
            	<div class="panel panel-default">
            		<div class="panel-heading">
            			<button class="btn btn-primary" data-toggle="modal" data-target="#addCategory"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add New</button>
            		</div>
            		<div class="panel-body">
            			<div class="table-responsive">

            				<table class="table table-bordered <?php if(mysqli_num_rows($stmt) != 0) { echo 'table-striped table-hover'; }?>">
            					<thead>
            						<tr>
            							<th>No</th>
            							<th>Kategori</th>
                                        <th>Aksi</th>
            						</tr>
            					</thead>
            					<tbody>
  
                        <?php if(mysqli_num_rows($stmt) == 0) { ?>

                        <tr>
                            <td colspan="8" style="vertical-align: middle;">
                                <div class="alert alert-warning text-center" style="margin-bottom: 0;"><strong class="text-capitalize">data kategori masih kosong!</strong></div>
                            </td>
                        </tr>

                        <?php } else { ?>

                            <?php
                            $no = 1;
                            while($row = mysqli_fetch_assoc($stmt)) {
                            ?>

                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['name'])?></td>
                                <td>
                                    <button class="btn btn-warning"
                                            data-toggle="modal"
                                            data-target="#editCategory"
                                            data-id="<?= $row['id'] ?>"
                                            data-name="<?= htmlspecialchars($row['name']) ?>" ><span class="glyphicon glyphicon-edit"></span></button>
                                    <button class="btn btn-danger"
                                            data-toggle="modal"
                                            data-target="#delCategory"
                                            data-id="<?= $row['id']?>"
                                            data-name="<?= htmlspecialchars($row['name']) ?>"><span class="glyphicon glyphicon-trash"></span></button>
                                </td>
                            </tr>

                            <?php } ?>

                        <?php } ?>

            					</tbody>
            				</table>
            			</div>
            		</div>
            	</div>
            </div>
        </div>
        
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<!-- Add Modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="addCategory">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Kategori Produk</h4>
      </div>
      <div class="modal-body">
        <form id="formCategory" action="" method="POST">
          <div class="form-group <?= isset($error) ? 'has-error' : '';?>">
            <label for="add_name">Kategori</label>
            <input type="text" name="name" class="form-control" id="add_name" placeholder="Kategori" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';?>">
            <?php if(isset($error)) {?>
            <span class="help-block">
                <strong>*<?= $error; ?></strong>
            </span>
            <?php } ?>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="add_category" form="formCategory">Submit</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<!-- Edit Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editCategory">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Kategori Produk</h4>
      </div>
      <div class="modal-body">
        
        <form id="formEditCategory" action="" method="POST">
            
          <input type="hidden" name="id" id="edit_id">

          <div class="form-group <?= isset($error) ? 'has-error' : '';?>">
            <!-- <label for="edit_name">Kategori</label> -->
            <input type="text" name="name" class="form-control" id="edit_name" placeholder="Kategori">
            <?php if(isset($error)) {?>
            <span class="help-block">
                <strong>*<?= $error; ?></strong>
            </span>
            <?php } ?>
          </div>
        </form>
      
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-warning" name="edit_category" form="formEditCategory">Edit</button>
      </div>
    
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<!-- Delete Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="delCategory">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Hapus Kategori</h4>
      </div>
      <div class="modal-body">
        <p id="delete_msg"></p>
        
        <form id="formDelCategory" method="POST" action="">
            <input type="hidden" name="id" id="delete_id">
        </form>       
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger" name="delete_category" form="formDelCategory">Hapus</button>
      </div>
    
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>