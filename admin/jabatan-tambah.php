<?php 
session_start();
if ($_SESSION["peran"] == "USER") {
    header("Location: logout.php");
    exit;
}
if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

include '../koneksi.php';

if (isset($_POST["submit"])) {

    $nama_jabatan = htmlspecialchars($_POST["nama_jabatan"]);
    $gapok_jabatan = htmlspecialchars($_POST["gapok_jabatan"]);
    $tunjangan_jabatan = htmlspecialchars($_POST["tunjangan_jabatan"]);
    $uang_makan_perhari = htmlspecialchars($_POST["uang_makan_perhari"]);

    $query = "INSERT INTO jabatan VALUES ('', '$nama_jabatan', '$gapok_jabatan', '$tunjangan_jabatan', '$uang_makan_perhari')";
    $simpan = mysqli_query($conn, $query);

    if ($simpan) {
        echo "<script type ='text/javascript'>
                alert('Data berhasil disimpan...!');
                document.location.href = 'jabatan.php';
                </script>";
    } else {
        echo "<script type ='text/javascript'>
        alert('Data GAGAL disimpan...!');
        document.location.href = 'jabatan-tambah.php';
        </script>";
    }

    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Lokasi | APPGAJI</title>
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
                            <h1>Data Jabatan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="jabatan.php">Jabatan</a></li>
                                <li class="breadcrumb-item active">Tambah Jabatan</li>
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
                                    <h3 class="card-title">Tambah Data</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="" method="post">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nama">Nama Jabatan:</label>
                                            <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" placeholder="Nama Jabatan" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Gapok Jabatan :</label>
                                            <input type="number" class="form-control" id="gapok_jabatan" name="gapok_jabatan" placeholder="Gaji Pokok Jabatan" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Tunjangan Jabatan :</label>
                                            <input type="number" class="form-control" id="tunjangan_jabatan" name="tunjangan_jabatan" placeholder="Tunjangan Jabatan" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Uang Makan Perhari :</label>
                                            <input type="number" class="form-control" id="uang_makan_perhari" name="uang_makan_perhari" placeholder="Uang Makan Perhari" required>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary mr-1" name="submit">Simpan</button>
                                        <a href="jabatan.php" class="btn btn-secondary">Cancel</a>
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