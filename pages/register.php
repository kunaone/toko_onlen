<?php

$errors = array();

if(isset($_POST['daftar'])){

    $fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : '';
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm = isset($_POST['confirm']) ? $_POST['confirm'] : '';

    // Validate fullname
    if ($fullname == '') {
        $errors['fullname'] = 'Nama lengkap wajib diisi!';
    }


    // Validate username
    if ($username == '') {
        $errors['username'] = 'Username wajib diisi!';
    }


    // Validate email
    if ($email == '') {
        $errors['email'] = 'Email wajib diisi!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Mohon isi kolom email dengan benar';
    }


    // Validate password
    if ($password == '') {
        $errors['password'] = 'Password wajib diisi!';
    } elseif (preg_match('/^\s|\s$/', $password)) {
        $errors['password'] = 'Password tidak boleh diawali atau diakhiri spasi.';
    }


    // Validate confirmation
    if ($confirm == '') {
        $errors['confirm'] = 'Konfirmasi Password wajib diisi!';
    } elseif ($password != $confirm) {
        $errors['confirm'] = 'Konfirmasi Password tidak sama!';
    }

    if(empty($errors)){

        $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE username = ? OR email = ?");

        mysqli_stmt_bind_param($stmt, 'ss', $username, $email);

        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if(mysqli_stmt_num_rows($stmt) > 0){

            $errors['database'] = 'Username atau Email sudah terdaftar';
        
        } else {

            $password = md5($password);

            // ketika user melakukan pendaftaran secara default ada di level 3 (User)
            $stmt = mysqli_prepare($conn, "INSERT INTO users (fullname, username, email, password, lvl_id) VALUES (?, ?, ?, ?, 3)");

            mysqli_stmt_bind_param($stmt, 'ssss', $fullname, strtolower($username), strtolower($email), $password);

            if(mysqli_stmt_execute($stmt)){

                $_SESSION['success'] = 'Pendaftaran akun telah berhasil dibuat!';
                $_SESSION['registered_email'] = strtolower($email);

                header('Location: ?page=login');

                exit;
            }

            $errors['database'] = 'Registrasi Gagal!';
        }

        mysqli_stmt_close($stmt);
    }

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    // if(!empty($errors)){

    //     echo "<pre>";
    //     print_r($errors);
    //     echo "</pre>";
    // }
}

?>
<div class="container">
    <div class="row">
        <h2 class="text-muted text-center" style="transform: translateY(100%);"><strong>Login</strong>Sys</h2>
        <div class="col-md-4 col-md-offset-4" >
            <div class="login-panel panel panel-default" style="margin-top: 15% !important;">
                <div class="panel-body">
                    <h4 class="text-muted" style="margin-bottom: 32px;"><span class="fa fa-user"></span>&nbsp;<strong>Form Pendaftaran</strong></h4>
                    <form role="form" method="POST">
                        <fieldset>
                            <div class="form-group <?= isset($errors['fullname']) ? "has-error" : null; ?>"> 
                                <input class="form-control" placeholder="Nama lengkap" name="fullname" type="text" value="<?= isset($fullname) ? htmlspecialchars($fullname) : ''; ?>" autofocus>
                                <?php if (isset($errors['fullname'])): ?>
                                    <small class="help-block">
                                        <strong>*<?= $errors['fullname']; ?></strong>
                                    </small>
                                <?php endif; ?> 
                            </div>

                            <div class="form-group <?= isset($errors['username']) ? "has-error" : null; ?>"> 
                                <input class="form-control" placeholder="Username" name="username" type="text" value="<?= isset($username) ? htmlspecialchars($username) : ''; ?>">
                                <?php if (isset($errors['username'])): ?>
                                    <small class="help-block">
                                        <strong>*<?= $errors['username']; ?></strong>
                                    </small>
                                <?php endif; ?> 
                            </div>

                            <div class="form-group <?= isset($errors['email']) ? "has-error" : null; ?>"> 
                                <input class="form-control" placeholder="Email" name="email" type="email" value="<?= isset($email) ? htmlspecialchars($email) : ''; ?>">
                                <?php if (isset($errors['email'])): ?>
                                    <small class="help-block">
                                        <strong>*<?= $errors['email']; ?></strong>
                                    </small>
                                <?php endif; ?> 
                            </div>

                            <div class="form-group <?= isset($errors['password']) ? "has-error" : null; ?>"> 
                                <input class="form-control" placeholder="Password" name="password" type="password">
                                <?php if (isset($errors['password'])): ?>
                                    <small class="help-block">
                                        <strong>*<?= $errors['password']; ?></strong>
                                    </small>
                                <?php endif; ?> 
                            </div>
                            
                            <div class="form-group <?= isset($errors['confirm']) ? "has-error" : null; ?>"> 
                                <input class="form-control" placeholder="Konfirmasi Password" name="confirm" type="password">
                                <?php if (isset($errors['confirm'])): ?>
                                    <small class="help-block">
                                        <strong>*<?= $errors['confirm']; ?></strong>
                                    </small>
                                <?php endif; ?> 
                            </div>

                            <div style="padding-bottom: 12px;">
                                
                                <small class="text-muted">Sudah punya akun? <a href="?page=login">Login</a></small>
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <button class="btn btn-lg btn-primary btn-block" name="daftar" type="submit">Daftar</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <p class="text-center text-muted"><small>&copy; <?= date("Y") ?> LoginSys</small></p>
    </div>
</div>

<!-- DARI SINI CUMAN ADA BOOTSTRAP MODAL  -->

<?php 

$registerAlert = array(1 => ["className" => "bg-danger text-danger", "bodyText" => "Username atau Email sudah terdaftar"],
                       2 => ["className" => "bg-danger text-danger", "bodyText" => "Pastikan kolom pendaftaran terisi & benar!"],
                       3 => ["className" => "bg-warning text-warning", "bodyText" => "Password tidak boleh pake spasi!"],
                       4 => ["className" => "bg-warning text-warning", "bodyText" => "Pastikan kolom <strong>Password</strong> dan <strong>Konfirmasi Password</strong> yang diisikan sama!</p>"]);


// echo "<pre>";
// print_r($registerAlert[1]['className']);
// echo "</pre>"; 

// function testA($a){

//     return [$a];
// }

// function testB($a, $b){

//     return [$a, $b];
// }

// echo "<pre>";
// print_r(array_map('testA', $registerAlert));
// echo "</pre>";
?>

<!-- Modal Validation -->

<div class="modal fade" id="warningModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header 
                <?php

                if($_SERVER['REQUEST_METHOD'] == 'POST'){

                    if($fullname == "" || $username == "" || $email == "" || $password == "" || $confirm == ""){

                        echo $registerAlert[2]['className'];
                    
                    } elseif(preg_match('/^\s|\s$/', $password) || preg_match('/^\s|\s$/', $confirm)){

                        echo $registerAlert[3]['className'];
                    
                    } elseif($password != $confirm){

                        echo $registerAlert[4]['className'];
                    
                    } else {

                        echo $registerAlert[1]['className'];
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

                    if($fullname == "" || $username == "" || $email == "" || $password == "" || $confirm == ""){

                        echo $registerAlert[2]['bodyText'];
                    
                    } elseif(preg_match('/^\s|\s$/', $password) || preg_match('/^\s|\s$/', $confirm)){

                        echo $registerAlert[3]['bodyText'];
                    
                    } elseif($password != $confirm){

                        echo $registerAlert[4]['bodyText'];
                    
                    } else {

                        echo $errors['database'];
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

<!-- End Modal -->