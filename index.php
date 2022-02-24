<?php
	// error_reporting(E_ALL^ (E_NOTICE | E_WARNING));
    session_start(); 
    date_default_timezone_set('Asia/Singapore');

	// print $user =$_SESSION['User'];
	// print $user =$_SESSION['Admin'];

    if(isset($_SESSION['login'])){
        header("Location: admin/index.php");
        exit;
    }

    require 'koneksi.php';

    if(isset($_POST["login"])){
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $login_terakhir = date('Y-m-d H:i:s');
    
        $result = mysqli_query($conn,"SELECT * FROM pengguna WHERE username ='$username' ");
    
        if(mysqli_num_rows($result) === 1){

            $row = mysqli_fetch_assoc($result);

            if(password_verify($password, $row["password"])){
                $_SESSION['login'] = true;
                $_SESSION['peran'] = $row["peran"];
                $_SESSION['username'] = $row["username"];
                $_SESSION['id'] = $row["id"];

                if($row["peran"] == "ADMIN"){
                    //mengupdate data ke database
                    $update = mysqli_query($conn, "UPDATE pengguna SET login_terakhir = '$loginterakhir' WHERE username='$username' ");
                    header("Location: admin/index.php");
                }   elseif ($row["peran"] == "USER"){
                    //mengupdate data ke database
                    $update = mysqli_query($conn, "UPDATE pengguna SET login_terakhir = '$loginterakhir' WHERE username='$username' ");
                    header("Location: user/index.php");
                }   

                exit;
            }
        }

        $error = true;
    
    }


	// if ($_SESSION['Admin'] or $_SESSION['User']){
	// 	if ($_SESSION['Admin']){
	// 		$user =$_SESSION['Admin'];
	// 	}	else{
	// 		$user =$_SESSION['User'];
	// 	}
    //     $sql = mysqli_query($connection,"SELECT * FROM USER, karyawan
	// 	WHERE karyawan.nrp = USER.nrp and karyawan.nrp='$user'");

    //     $sesyen = mysqli_fetch_assoc($sql);
            
    
    ?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>APPGaji | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h1><b>APP</b>GAJI</h1>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Masukkan username dan password anda</p>
                <?php if(isset($error)){?>
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        Username atau Password salah...!
                    </div>
                    <?php } ?>
                    
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col">
                            <button type="submit" class="btn btn-block btn-primary" name="login">Masuk</button>
                            <a href="register.php" class="btn btn-block btn-danger">Buat Akun</a>
                        </div>
                    </div>
                </form>

                <!-- /.social-auth-links -->

                <p class="mt-3">
                    <a href="lupa-password.php">Lupa Password?</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
