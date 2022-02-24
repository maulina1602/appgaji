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

$id = $_GET["id"];
$query_penggajian ="DELETE FROM penggajian WHERE id='$id' ";
$delete = mysqli_query($conn,$query_penggajian);
    if($delete){
        echo "  <script type='text/javascript'>
                    alert ('Data Berhasil dihapus...!')
                    window.location.href= 'gaji.php';
                </script>";
    }
?>
