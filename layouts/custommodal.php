<?php if($page == 'login') { ?>

<script>
$(function() {
    var alert = $('.alert-success');

    alert.hide().fadeIn(500);

    setTimeout(function() {
        alert.fadeOut(500, function() {
            $(this).remove();
        });
    }, 8000);
});
</script>

<?php } ?>

<!-- login.php -->
<?php 

if($page == 'login'){

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($err)){
?>

<script>$('#warningModal').modal('show')</script>

<?php }} ?>

<!-- register.php -->

<!-- Show Modal kalo kolom belum terisi -->
<?php 

if($page == 'register'){ 

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if($fullname == "" || $username == "" || $email == "" || $password == "" || $confirm == ""){

?> 

<script> $('#warningModal').modal('show') </script>

<?php 
 
        } //cek empty field
    } // cek apakah ada action post dari form

// parent if $page belum ditutup
?>
<!-- End Modal -->

<!-- Show Modal kalo kolom input password terisi dengan spasi -->
<?php if( isset($password) && preg_match('/^\s|\s$/', $password)){  ?>

<script> $('#warningModal').modal('show') </script>

<?php } ?>
<!-- End Modal -->

<?php if(isset($_POST['daftar']) && $password != $confirm) { ?>

<script> $('#warningModal').modal('show') </script>

<?php
    }
} // nah ini parent if nya $page == 'register'
?>

<!-- Show Modal kalo akun sudah terdaftar -->

<?php if( $_SERVER['REQUEST_METHOD'] == 'POST' && !empty($errors)){  ?>

<script> $('#warningModal').modal('show') </script>

<?php } ?>

<!-- End Modal -->

<!-- end of register.php -->

<?php if($page == 'products'){ ?>

<script>
$(document).ready(function() {
    $('#btnAddProd').click(function() {

        <?php if ($category_count == 0) { ?>

        $('#categoryWarning').modal('show');

        <?php } else { ?>

        $('#addProd').modal('show');

        <?php } ?>
    });
});
</script>

<script>
$('#delProduct').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var id = button.data('id');
    var code = button.data('code');

    $('#delete_id').val(id);

    $('#delete_msg').text(
        'Apakah anda ingin menghapus produk ' + code + '?'
    );

});
</script>

    <!-- kalo error modal tetep di show -->
    <?php if ($has_errors) { ?>

    <script type="text/javascript">
    $(document).ready(function () {
        $('#addProd').modal('show');
    });
    </script>

    <?php } ?>

<?php } ?>  <!-- endif page == 'product' -->

<!-- halaman categories -->

<?php if($page == 'categories' && isset($error)) { ?>

<script>
$(document).ready(function(){
    $('#addCategory').modal('show');
});
</script>

<?php } ?>

<?php if($page = 'categories') {?>

<script>

$('#editCategory').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var id = button.data('id');
    var name = button.data('name');

    $('#edit_id').val(id);
    $('#edit_name').val(name);

});

$('#delCategory').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);

    var id = button.data('id');
    var name = button.data('name');

    $('#delete_id').val(id);

    $('#delete_msg').text(
        'Apakah anda ingin menghapus kategori ' + name + '?'
    );

});
</script>

<?php } ?>



