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

$querry = "SELECT K.*, (
    SELECT J.nama_jabatan
    FROM jabatan_karyawan JK
    INNER JOIN jabatan J ON JK.jabatan_id = J.id
    WHERE karyawan_id = K.id
    ORDER BY JK.tanggal_mulai DESC LIMIT 1
    ) jabatan_terkini FROM karyawan K;";
$result = mysqli_query($conn, $querry);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Lokasi | APPGAJI</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
                                <li class="breadcrumb-item active">Karyawan</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <a href="lokasi-tambah.php" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Data</a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Action</th>
                                                <th>Nama Lengkap</th>
                                                <th>NIK</th>
                                                <th>Jabatan Terkini</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            while ($row = mysqli_fetch_assoc($result)) { ?>                                            
                                                <tr>
                                                    <td><?php echo $no; ?> </td>
                                                    <td>
                                                        <a href="karyawan-jabatan.php?id=<?php echo $row["id"]; ?>"
                                                        class="btn btn-info btn-xs mr-1"><i class="fa fa-edit"></i> Jabatan</a>
                                                        <a href="karyawan-bagian.php?id=<?php echo $row["id"]; ?>"
                                                        class="btn btn-warning btn-xs mr-1"><i class="fa fa-edit"></i> Bagian</a>
                                                        <a href="karyawan-edit.php?id=<?php echo $row["id"]; ?>"
                                                        class="btn btn-success btn-xs mr-1"><i class="fa fa-edit"></i> Ubah</a>
                                                        <a href="karyawan-hapus.php?id=<?php echo $row["id"]; ?>" 
                                                        class="btn btn-danger btn-xs text-light" onClick="javascript: return confirm('Apakah yakin ingin menghapus data ini...?');">
                                                        <i class="fa fa-trash"></i> Hapus</a>
                                                    </td>
                                                    <td><?php echo $row ["nama_lengkap"]; ?></td>
                                                    <td><?php echo $row ["nik"]; ?></td>
                                                    <td><?php echo $row ["jabatan_terkini"]; ?></td>
                                                </tr>
                                            <?php $no++;
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
<<<<<<< HEAD
                                                <th>No</th>
=======
                                            <th>No</th>
>>>>>>> 39cbbb688f3885cc591613a9aee97145a4ae7cee
                                                <th>Action</th>
                                                <th>Nama Lengkap</th>
                                                <th>NIK</th>
                                                <th>Jabatan Terkini</th>
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