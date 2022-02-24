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
$query_jabatan_ambil ="SELECT * FROM penggajian WHERE id='$id' ";
$result_jabatan_ambil = mysqli_query($conn,$query_jabatan_ambil);
$row_jabatan_ambil = mysqli_fetch_assoc($result_jabatan_ambil);

if(isset($_POST["submit"])){    
    $karyawan_id = htmlspecialchars($_POST["karyawan_id"]);
    $tahun = htmlspecialchars($_POST["tahun"]);
    $bulan = htmlspecialchars($_POST["bulan"]);
    $jabatan_id = htmlspecialchars($_POST["jabatan_id"]);
    
    $query_jabatan_pilih ="SELECT * FROM jabatan WHERE id='$jabatan_id' ";
    $result_jabatan_pilih = mysqli_query($conn,$query_jabatan_pilih);
    $row_jabatan_pilih = mysqli_fetch_assoc($result_jabatan_pilih);

    $gapok_jabatan = $row_jabatan_pilih["gapok_jabatan"];
    $tunjangan_jabatan = $row_jabatan_pilih["tunjangan_jabatan"];
    $uang_makan = ($row_jabatan_pilih["uang_makan_perhari"] * 30);

    $query ="UPDATE penggajian 
    SET karyawan_id='$karyawan_id', tahun='$tahun', bulan='$bulan', gapok='$gapok_jabatan', tunjangan='$tunjangan_jabatan', uang_makan='$uang_makan'
    WHERE id='$id'
    ";
    $edit = mysqli_query($conn,$query);

    if($edit){
        echo "  <script type='text/javascript'>
                    alert ('Data Berhasil disimpan...!')
                    window.location.href= 'gaji.php';
                </script>";
    } else {
        echo "  <script type='text/javascript'>
                    alert ('Data GAGAL disimpan...!')
                    window.location.href= 'gaji-edit.php?id=$id';
                </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Gaji | APPGAJI</title>
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
                            <h1>Data Gaji</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="gaji.php">Gaji</a></li>
                                <li class="breadcrumb-item active">Update Gaji</li>
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
                                            <label for="tahun">Tahun</label>
                                            <input type="text" class="form-control" id="tahun" name="tahun" value="<?= $row_jabatan_ambil["tahun"]; ?>" placeholder="Tahun" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="bulan">Bulan :</label>
                                            <select class="form-control" name="bulan" id="bulan" required>
                                                <option value="01" <?php if ($row_jabatan_ambil["bulan"] == "01") {
                                                    echo "selected";
                                                }?>>Januari</option>
                                                <option value="02" <?php if ($row_jabatan_ambil["bulan"] == "02") {
                                                    echo "selected";
                                                }?>>Februari</option>
                                                <option value="03" <?php if ($row_jabatan_ambil["bulan"] == "03") {
                                                    echo "selected";
                                                }?>>Maret</option>
                                                <option value="04" <?php if ($row_jabatan_ambil["bulan"] == "04") {
                                                    echo "selected";
                                                }?>>April</option>
                                                <option value="05" <?php if ($row_jabatan_ambil["bulan"] == "05") {
                                                    echo "selected";
                                                }?>>Mei</option>
                                                <option value="06" <?php if ($row_jabatan_ambil["bulan"] == "06") {
                                                    echo "selected";
                                                }?>>Juni</option>
                                                <option value="07" <?php if ($row_jabatan_ambil["bulan"] == "07") {
                                                    echo "selected";
                                                }?>>Juli</option>
                                                <option value="08" <?php if ($row_jabatan_ambil["bulan"] == "08") {
                                                    echo "selected";
                                                }?>>Agustus</option>
                                                <option value="09" <?php if ($row_jabatan_ambil["bulan"] == "09") {
                                                    echo "selected";
                                                }?>>September</option>
                                                <option value="10" <?php if ($row_jabatan_ambil["bulan"] == "10") {
                                                    echo "selected";
                                                }?>>Oktober</option>
                                                <option value="11" <?php if ($row_jabatan_ambil["bulan"] == "11") {
                                                    echo "selected";
                                                }?>>November</option>
                                                <option value="12" <?php if ($row_jabatan_ambil["bulan"] == "12") {
                                                    echo "selected";
                                                }?>>Desember</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="karyawan_id">Karyawan</label>
                                            <select class="form-control" name="karyawan_id" id="karyawan_id" required>
                                                <option value="">-- Pilih Karyawan --</option>
                                                <?php
                                                $query_karyawan="SELECT * FROM karyawan";
                                                $result_karyawan=mysqli_query($conn,$query_karyawan);
                                                while($row_karyawan=mysqli_fetch_assoc($result_karyawan)){?>
                                                    <option value="<?php echo $row_karyawan['id'];?>"
                                                    <?php if(!(strcmp($row_karyawan['id'],htmlentities($row_jabatan_ambil['karyawan_id'],ENT_COMPAT,'UTF-8')))){
                                                        echo "SELECTED";
                                                    }?>><?= $row_karyawan['nama_lengkap']; ?>
                                                    </option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="jabatan_id">Jabatan Terakhir</label>
                                            <select class="form-control" name="jabatan_id" id="jabatan_id" required>
                                                <option value="">-- Pilih Kembali Jabatan --</option>
                                                <?php
                                                $query_jabatan="SELECT * FROM jabatan";
                                                $result_jabatan=mysqli_query($conn,$query_jabatan);
                                                while($row_jabatan=mysqli_fetch_assoc($result_jabatan)){?>
                                                    <option value="<?php echo $row_jabatan['id'];?>"><?= $row_jabatan['nama_jabatan']; ?>
                                                    </option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary mr-1" name="submit">Simpan</button>
                                        <a href="gaji.php" class="btn btn-secondary">Cancel</a>
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