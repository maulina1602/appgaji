<?php

session_start();
if($_SESSION["peran"]== "USER"){
    header("Location: logout.php");
    exit;
}
if(!isset($_SESSION["login"])){
    header("Location: ../index.php");
    exit;
}

include '../koneksi.php';


$bulan = $_GET["bulan"];
$tahun = $_GET["tahun"];
$query ="SELECT 
karyawan.nik,
karyawan.nama_lengkap,
penggajian.gapok gapok,
penggajian.tunjangan tunjangan,
penggajian.uang_makan uang_makan
FROM penggajian, karyawan
WHERE 
penggajian.karyawan_id = karyawan.id AND
bulan = $bulan AND
tahun = $tahun
";
$result = mysqli_query($conn,$query);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Report Gaji | APPGAJI</title>
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
                            <h1>Rekap Gaji Per Karyawan Bulan <?= $bulan; ?> Tahun <?= $tahun; ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="rekap-gaji.php">Gaji Per Tahun</a></li>
                                <li class="breadcrumb-item"><a href="rekap-gaji-bulan.php?tahun=<?= $tahun; ?>">Gaji Per Bulan</a></li>
                                <li class="breadcrumb-item active">Gaji Per Karyawan</li>
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
                                    <button type="button" class="btn btn-primary" onclick="window.location='rekap-gaji-bulan.php?tahun=<?= $tahun; ?>'">Kembali</button>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIK</th>
                                                <th>Karyawan</th>
                                                <th>Gapok</th>
                                                <th>Tunjangan</th>
                                                <th>Uang Makan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1;
                                            $jml_gapok = 0;
                                            $jml_tunjangan = 0;
                                            $jml_uang_makan = 0;
                                            while ($row=mysqli_fetch_assoc($result)){?>                                            
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?php echo $row["nik"]; ?></</td>
                                                    <td><?php echo $row["nama_lengkap"]; ?></</td>
                                                    <td class="text-right"><?php echo 'Rp. ' . number_format($row["gapok"], 0, ',', '.') . ',-'; ?></td>
                                                    <td class="text-right"><?php echo 'Rp. ' . number_format($row["tunjangan"], 0, ',', '.') . ',-'; ?></td>
                                                    <td class="text-right"><?php echo 'Rp. ' . number_format($row["uang_makan"], 0, ',', '.') . ',-'; ?></td>
                                                    </tr>
                                            <?php 
                                            $no++; 
                                            $jml_gapok += $row["gapok"];
                                            $jml_tunjangan += $row["tunjangan"];
                                            $jml_uang_makan += $row["uang_makan"];
                                        } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-right" colspan="3">Total</th>
                                                <th class="text-right"><?php echo 'Rp. ' . number_format($jml_gapok, 0, ',', '.') . ',-'; ?></th>
                                                <th class="text-right"><?php echo 'Rp. ' . number_format($jml_tunjangan, 0, ',', '.') . ',-'; ?></th>
                                                <th class="text-right"><?php echo 'Rp. ' . number_format($jml_uang_makan, 0, ',', '.') . ',-'; ?></th>
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
                    [0, "asc"]
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
</body>

</html>