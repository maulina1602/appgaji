<?php

session_start();
if($_SESSION["peran"] == "USER"){
    header("Location: logout.php");
    exit;
}
if(!isset($_SESSION["login"])){
    header("Location: ../index.php");
    exit;
}

include '../koneksi.php';

date_default_timezone_set('Asia/Singapore');

$id = $_GET["id"];
$query_karyawan ="SELECT * FROM karyawan WHERE id='$id' ";
$result_karyawan = mysqli_query($conn,$query_karyawan);
$row_karyawan = mysqli_fetch_assoc($result_karyawan);

if(isset($_POST["submit"])){    
    $nik = htmlspecialchars($_POST["nik"]);
    $nama_lengkap = htmlspecialchars($_POST["nama_lengkap"]);
    $handphone = htmlspecialchars($_POST["handphone"]);
    $email = htmlspecialchars($_POST["email"]);
    $pengguna_id = htmlspecialchars($_POST["pengguna_id"]);

    $query ="UPDATE karyawan 
    SET nik='$nik', nama_lengkap='$nama_lengkap', handphone='$handphone', email='$email', pengguna_id='$pengguna_id'
    WHERE id='$id'
    ";
    $edit = mysqli_query($conn,$query);

    if($edit){
        echo "  <script type='text/javascript'>
                    alert ('Data Berhasil disimpan...!')
                    window.location.href= 'karyawan.php';
                </script>";
    } else {
        echo "  <script type='text/javascript'>
                    alert ('Data GAGAL disimpan...!')
                    window.location.href= 'karyawan-edit.php?id=$id';
                </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data karyawan | APPGAJI</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include "theme-header.php"; ?>

        <?php include "theme-sidebar.php"; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Data Karyawan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="karyawan.php">Karyawan</a></li>
                                <li class="breadcrumb-item active">Update Karyawan</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Update Data</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="" method="post">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nik">NIK</label>
                                            <input type="number" class="form-control" id="nik" name="nik" placeholder="Nomor Induk Kependudukan" value="<?= $row_karyawan['nik'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_lengkap">Nama Lengkap</label>
                                            <input type="text" class="form-control" value="<?= $row_karyawan['nama_lengkap'] ?>" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap tanpa title" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="handphone">Handphone</label>
                                            <input type="text" class="form-control" id="handphone" name="handphone" placeholder="Nomor Handphone Aktif" value="<?= $row_karyawan['handphone'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" value="<?= $row_karyawan['email'] ?>" name="email" placeholder="Email Aktif" required>
                                        </div>
                                            <input type="hidden" name="pengguna_id" value="<?= $_SESSION["id"]; ?>">
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary mr-1" name="submit">Simpan</button>
                                        <a href="karyawan.php" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php include "theme-footer.php"; ?>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
</body>

</html>