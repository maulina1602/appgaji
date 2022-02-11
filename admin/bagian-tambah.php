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

    $nama_bagian = htmlspecialchars($_POST["nama_bagian"]);
    $karyawan_id = htmlspecialchars($_POST["karyawan_id"]);
    $lokasi_id = htmlspecialchars($_POST["lokasi_id"]);

    $query = "INSERT INTO bagian VALUES ('', '$nama_bagian', '$karyawan_id', '$lokasi_id')";
    $simpan = mysqli_query($conn, $query);

    if ($simpan) {
        echo "<script type ='text/javascript'>
                alert('Data berhasil disimpan...!');
                document.location.href = 'bagian.php';
                </script>";
    } else {
        echo "<script type ='text/javascript'>
        alert('Data GAGAL disimpan...!');
        document.location.href = 'bagian-tambah.php';
        </script>";
    }

    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Bagian | APPGAJI</title>
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
                            <h1>Data Bagian</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="bagian.php">Bagian</a></li>
                                <li class="breadcrumb-item active">Tambah Bagian</li>
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
                                            <label for="nama">Nama Bagian :</label>
                                            <input type="text" class="form-control" id="nama_bagian" name="nama_bagian" placeholder="Nama Bagian/Bidang" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Kepala Bagian</label>
                                            <select class="form-control" id="karyawan_id" name="karyawan_id" required>
                                                <option value="">-- Pilih Kepala Bagian --</option>
                                                <?php 
                                                $query_karyawan = "SELECT * FROM karyawan";
                                                $result_karyawan = mysqli_query($conn, $query_karyawan);
                                                while ($row_karyawan = mysqli_fetch_assoc($result_karyawan)) {
                                                    ?>
                                                <option value="<?php echo $row_karyawan["id"]; ?>"><?php echo $row_karyawan["nama_lengkap"]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Lokasi</label>
                                            <select class="form-control" id="lokasi_id" name="lokasi_id" required>
                                                <option value="">-- Pilih Lokasi --</option>
                                                <?php 
                                                $query_lokasi = "SELECT * FROM lokasi";
                                                $result_lokasi = mysqli_query($conn, $query_lokasi);
                                                while ($row_lokasi = mysqli_fetch_assoc($result_lokasi)) {
                                                    ?>
                                                <option value="<?php echo $row_lokasi["id"]; ?>"><?php echo $row_lokasi["nama_lokasi"]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary mr-1" name="submit">Simpan</button>
                                        <a href="bagian.php" class="btn btn-secondary">Cancel</a>
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