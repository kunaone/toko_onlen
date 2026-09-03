<?php

if(isset($_POST['masuk'])){

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT id, username, password FROM users WHERE email = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_store_result($stmt);

    if(mysqli_stmt_num_rows($stmt) == 1) {

        mysqli_stmt_bind_result($stmt, $id, $username, $password_stored);

        mysqli_stmt_fetch($stmt);

        if($password === $password_stored){

            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;

            header("Location: ?page=home");
            exit;

        } else {

            $err = "Password Salah";
        }

    } else {

        $err = "Email tidak ditemukan!";
    }

    if($email == "" || $password == ""){

        $err = "Kolom tidak boleh kosong!";
    }

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    // if(isset($err)){
    //     echo "<pre>";
    //     print_r($err);
    //     echo "</pre>";
    // }

       
}

?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center" style="padding-top: 32px;">
            <h1 class="text-muted"><strong>Login</strong>Sys</h1>
        </div>
    </div>
    <div class="row" style="margin-top: 0 !important;">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-body">
                    <h4 class="text-muted" style="margin-bottom: 32px;"><span class="fa fa-sign-in"></span>&nbsp;<strong>Masuk ke Laman Dasbor</strong></h4>
                    <form role="form" method="POST">
                        <fieldset>
                            <div class="form-group <?= isset($_POST['masuk']) && empty($_POST['email']) ? 'has-error' : '' ; ?>">

                                <input class="form-control"
                                       placeholder="E-mail" 
                                       name="email" 
                                       type="email" 
                                       value="<?php

                                              if(!empty($_POST['email'])){
                                                
                                                echo $_POST['email'];

                                              }

                                              if(isset($_SESSION['registered_email'])) {
                                                
                                                echo $_SESSION['registered_email'];
                                              
                                              }

                                              ?>">

                                <?php isset($_POST['masuk']) && empty($_POST['email']) ? print "<small class='help-block'><strong>*Kolom Email wajib diisi!</strong></small> ": null; ?> 

                            </div>
                            <div class="form-group <?= isset($_POST['masuk']) && empty($_POST['password']) ? 'has-error' : '' ; ?>">
                                <input class="form-control" placeholder="Password" name="password" type="password" <?= isset($_SESSION['registered_email']) ? 'autofocus' : '' ; ?>>
                                <?php isset($_POST['masuk']) && empty($_POST['email']) ? print "<small class='help-block'><strong>*Kolom Password wajib diisi!</strong></small> ": null; ?> 
                            </div>
                            <div style="padding-bottom: 12px;">
                                
                                <small class="text-muted">Belum punya akun? <a href="?page=register">Daftar</a></small>
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <button class="btn btn-lg btn-primary btn-block" name="masuk">Login</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="transform: translateY(100px);">
        <p class="text-center text-muted"><small>&copy; <?= date("Y") ?> LoginSys</small></p>
    </div>
</div>

<!-- Notification -->
<?php if (isset($_SESSION['success'])) { ?>

<div class="alert alert-success alert-dismissible pull-right" style="margin-right: 32px;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <span class="fa fa-check-circle" style="margin-right: 8px;"></span>
    <?php echo $_SESSION['success']; ?>
</div>

<?php unset($_SESSION['success']); unset($_SESSION['registered_email']); } ?>

<!-- Modal -->
<div class="modal fade" id="warningModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header 
                <?php

                if($_SERVER['REQUEST_METHOD'] == 'POST'){

                    if($email == "" || $password == ""){

                        echo "bg-danger text-danger";
                    
                    } else {

                        echo "bg-warning text-warning";
                    }  

                }

                ?>" 
           style="border-top-left-radius: 6px; border-top-right-radius: 6px;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><strong><span></span>Peringatan</strong></h4>
      </div>

      <div class="modal-body">
        <table style="width: 100%;">
            <p style="font-size: 15px;">
                <?php

                if($_SERVER['REQUEST_METHOD'] == 'POST'){

                    if(!empty($err)){

                        echo $err;
                    }

                }

                ?>
            </p>
        </table>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->