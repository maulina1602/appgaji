<?php
session_start();
if ($_SESSION["peran"] == "USER") {
    header("Location: ../index.php");
    exit;
}
if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

include '../koneksi.php';

$id = $_GET["id"];
$query_jabkar = "SELECT
jabatan_karyawan.id,
jabatan_karyawan.karyawan_id,
karyawan.nama_lengkap,
jabatan.nama_jabatan,
jabatan_karyawan.tanggal_mulai
FROM
jabatan_karyawan, karyawan, jabatan
WHERE
karyawan.id = jabatan_karyawan.karyawan_id AND
jabatan.id = jabatan_karyawan.jabatan_id AND
jabatan_karyawan.karyawan_id = $id";
$result_jabkar = mysqli_query($conn, $query_jabkar);

$query_karyawan = "SELECT * FROM karyawan WHERE id = $id";
$result_karyawan = mysqli_query($conn, $query_karyawan);
$row_karyawan = mysqli_fetch_assoc($result_karyawan);

if (isset($_POST["submit"])) {
    $karyawan_id = htmlspecialchars($_POST["karyawan_id"]);
    $jabatan_id = htmlspecialchars($_POST["jabatan_id"]);
    $tanggal_mulai = htmlspecialchars($_POST["tanggal_mulai"]);

    $query = "INSERT INTO jabatan_karyawan VALUES ('', '$jabatan_id', '$tanggal_mulai')";
    $simpan = mysqli_query($conn, $query);

    if ($simpan) {
        echo "<script type='text/javascript'>
                alert('Data berhasil disimpan..!');
                 document.location.href = 'karyawan-jabatan.php?id=$id';
            </script>";
    }else{
        echo "<script type='text/javascript'>
                alert('Data GAGAL disimpan..!');
                 document.location.href = 'karyawan-jabatan.php?id=$id';
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
                            <h1>Data Jabatan Karyawan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="lokasi.php">Karyawan</a></li>
                                <li class="breadcrumb-item active">Jabatan Karyawan</li>
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
                                            <label for="nama">Nomor Induk Karyawan :</label>
                                            <input type="text" class="form-control" id="nik" name="nik"
                                            value="<?php echo $row_karyawan["nik"]; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nsma Karyawan :</label>
                                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                            value="<?php echo $row_karyawan["nama_lengkap"]; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="select">Pilih Jabatan :</label>
                                            <select class="form-control" id="jabatan_id" name="jabatan_id" required>
                                                <option value="">-- Pilih Jabatan --</option>
                                                <?php
                                                $query_jabatan ="SELECT * FROM jabatan";
                                                $reult_jabatan = mysqli_query($conn, $query_jabatan);
                                                while ($row_jabatan = mysqli_fetch_assoc($result_jabatan)) {
                                                ?>
                                                    <option value="<? echo $row_jabatan["id"]; ?>>
                                                    <?php echo $row_jabatan["nama_jabatan"]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Tanggal Mulai :</label>
                                            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" placeholder="hh-bb-tttt" require>
                                        </div>
                                        <input type="hidden" name="karyawan_id" value="<?php echo $id; ?>">
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