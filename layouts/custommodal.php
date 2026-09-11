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

<?php
if($page == 'login') {
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($err)) {
?>

<script>
$('#warningModal').modal('show');
</script>

<?php }} ?>

<?php
if($page == 'register') {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($fullname == "" || $username == "" || $email == "" || $password == "" || $confirm == "") {
?>
<script>
    $('#warningModal').modal('show');
</script>

<?php }} ?>

<?php if(isset($password) && preg_match('/^\s|\s$/', $password)) { ?>
<script>
    $('#warningModal').modal('show');
</script>
<?php } ?>

<?php if(isset($_POST['daftar']) && $password != $confirm) { ?>
<script>
    $('#warningModal').modal('show');
</script>

<?php }} ?>

<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($errors)) { ?>
<script>
    $('#warningModal').modal('show');
</script>
<?php } ?>

<!-- INI PAGE PRODUCT -->

<?php if($page == 'products') { ?>
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
$('#delProduct').on('show.bs.modal', function(event){
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var code = button.data('code');

    $('#delete_id').val(id);
    $('#delete_msg').text('Apakah anda ingin menghapus produk ' + code + '?');
});
</script>

<script>

var currentProduct = '';

$('#detailProduct').on('show.bs.modal', function(event){
    var button = $(event.relatedTarget);
    var id = button.data('id');

    // console.log('Button:', button);
    // console.log('Product ID:', id);

    history.pushState(
        null,
        '',
        '?product-id='+id
    );

    $.ajax({
        url: './process/products/get_product_ajax.php',
        type: 'GET',
        data: {
            id: id
        },
        dataType: 'json',
        // success: function(product) {

        //     console.log('AJAX response:', product);
        // },
        // error: function(xhr, status, error) {

        //     console.log('AJAX ERROR');
        //     console.log('Status:', status);
        //     console.log('Error:', error);
        //     console.log('Response:', xhr.responseText);
        // }
        success: function(product){
            // console.log('AJAX Res :', product);

            currentProduct = product;

            $('#edit_product_id').val(product.id);

            $('#prod_code').val(product.prod_code);
            $('#product_name').val(product.name);
            $('#prod_category').val(product.category_name);
            $('#prod_stock').val(product.qty);
            $('#prod_satuan').val(product.satuan);

            $('#buy_price').val(parseFloat(product.purchase_selling));
            $('#sell_price').val(parseFloat(product.selling_price));

            $('#btnEditProd').data('id', product.id);

            if(product.img_prod){
              
              $('#product-preview').attr('src', './uploads/products/' + product.img_prod);
            
            }else{

              $('#product-preview').attr('src', './assets/img/no-img.png');
            }

            $('#product-preview').on('error', function() {
              
              $(this).attr('src', './assets/img/no-img.png');
            
            });
        }
    });

});

$('#detailProduct').on('hidden.bs.modal', function(){
    
    history.pushState(null, '', '?page=products');
});

function fillEditProd(product){

    $('#ed_prod_code').val(product.prod_code);
    $('#ed_product_name').val(product.name);
    $('#ed_prod_category').val(product.category_name);
    $('#ed_prod_stock').val(product.qty);
    $('#ed_prod_satuan').val(product.satuan);

    $('#ed_buy_price').val(parseFloat(product.purchase_selling));
    $('#ed_sell_price').val(parseFloat(product.selling_price));

    $('#btnEditProd').data('id', product.id);

    if(product.img_prod){
      
      $('#ed-product-preview').attr('src', './uploads/products/' + product.img_prod);
    
    }else{

      $('#ed-product-preview').attr('src', './assets/img/no-img.png');
    }

    $('#ed-product-preview').on('error', function() {
      
      $(this).attr('src', './assets/img/no-img.png');
    
    });
}

$('#btnEditProd').click(function() {

    var id = $(this).data('id');
    // console.log('Edit product id : ', id);

    fillEditProd(currentProduct);

    $('#detailProduct').modal('hide');
    $('#detailProduct').on('hidden.bs.modal.edit', function(){

        history.pushState(
            null,
            '',
            '?edit-product&id='+id
        );

        $('#detailProduct').off('hidden.bs.modal.edit');
        $('#editProduct').modal('show');
    });
});

$('#editProduct').on('hidden.bs.modal', function(){

        history.pushState(null, '', '?page=products');
})

</script>

<?php if($has_errors) { ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#addProd').modal('show');
    });
</script>;

<?php }} ?>

<?php if ($page == 'categories' && isset($error)) { ?>
<script>
    $(document).ready(function() {
        $('#addCategory').modal('show');
    });
</script>
<?php } ?>

<!-- INI PAGE CATEGORY -->

<?php if ($page == 'categories') { ?>
<script>
    $('#editCategory').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var name = button.data('name');

        $('#edit_id').val(id);
        $('#edit_name').val(name);
    });

    $('#delCategory').on('show.bs.modal', function(event) {
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
