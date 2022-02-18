<?php
session_start();
if ($_SESSION["peran"] == "USER") {
    header("Location: ../logout.php");
    exit;
}
if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

include '../koneksi.php';

$id = $_GET["id"];
$query_jabkar = "SELECT
bagian_karyawan.id,
bagian_karyawan.karyawan_id,
karyawan.nama_lengkap,
bagian.nama_bagian,
bagian_karyawan.tanggal_mulai
FROM
bagian_karyawan, karyawan, bagian
WHERE
karyawan.id = bagian_karyawan.karyawan_id AND
bagian.id = bagian_karyawan.bagian_id AND
bagian_karyawan.karyawan_id = $id";
$result_jabkar = mysqli_query($conn, $query_jabkar);

$query_karyawan = "SELECT * FROM karyawan WHERE id = $id";
$result_karyawan = mysqli_query($conn, $query_karyawan);
$row_karyawan = mysqli_fetch_assoc($result_karyawan);

if (isset($_POST["submit"])) {

    $karyawan_id = htmlspecialchars($_POST["karyawan_id"]);
    $bagian_id = htmlspecialchars($_POST["bagian_id"]);
    $tanggal_mulai = htmlspecialchars($_POST["tanggal_mulai"]);

    $query = "INSERT INTO bagian_karyawan VALUES ('', '$karyawan_id', '$bagian_id', '$tanggal_mulai')";
    $simpan = mysqli_query($conn, $query);

    if ($simpan) {
        echo "<script type='text/javascript'>
                alert('Data berhasil disimpan..!');
                 document.location.href = 'karyawan-bagian.php?id=$id';
            </script>";
    }else{
        echo "<script type='text/javascript'>
                alert('Data GAGAL disimpan..!');
                 document.location.href = 'karyawan-bagian.php?id=$id';
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
                            <h1>Data bagian Karyawan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="lokasi.php">Karyawan</a></li>
                                <li class="breadcrumb-item active">Bagian Karyawan</li>
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
                                            <label for="nik">Nomor Induk Karyawan :</label>
                                            <input type="text" class="form-control" id="nik" name="nik"
                                            value="<?php echo $row_karyawan["nik"]; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_lengkap">Nama Karyawan :</label>
                                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                            value="<?php echo $row_karyawan["nama_lengkap"]; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="bagian_id">Pilih Bagian :</label>
                                            <select class="form-control" id="bagian_id" name="bagian_id" required>
                                                <option value="">-- Pilih Bagian --</option>
                                                <?php
                                                $query_bagian ="SELECT * FROM bagian";
                                                $result_bagian = mysqli_query($conn, $query_bagian);
                                                while ($row_bagian = mysqli_fetch_assoc($result_bagian)) {
                                                ?>
                                                    <option value="<?php echo $row_bagian["id"]; ?>">
                                                    <?php echo $row_bagian["nama_bagian"]; ?>
                                                    </option>
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
                        <!-- <section class="content"> -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                        <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Riwayat bagian</h3>
                                </div>
                                
                                <!-- <form action="" method="post"> -->
                        <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Action</th>
                                        <th>Nama Bagian</th>
                                        <th>Tanggal Mulai</th>
                                    </tr>
                            </thead>
                            <tbody>
                                    <?php $no = 1;
                                    while ($row_jabkar = mysqli_fetch_assoc($result_jabkar)) { ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td>
                                            <a href="karyawan-bagian-hapus.php?id=<?php echo $row_jabkar["id"] ?>"
                                            class="btn btn-danger btn xs text-light"
                                            onclick="javascript : return confirm('Apakah yakin ingin menghapus data ini....?');">
                                            <i class="fa fa-trash"></i>Haputs</a>
                                        </td>
                                        <td><?php echo $row_jabkar["nama_bagian"]; ?></td>
                                        <td><?php echo $row_jabkar["tanggal_mulai"]; ?></td>
                                    </tr>
                                    <?php $no++;
                                    } ?>
                            </tbody>
                            <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Action</th>
                                        <th>Nama bagian</th>
                                        <th>Tanggal Mulai</th>
                                    </tr>
                            </tfoot>
                            </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
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
    <!-- DataTables  & Plugins -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"],
                "order": [
                    [2, "asc"]
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
</body>

</html>