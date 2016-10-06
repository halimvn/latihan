<?php
 include("../data/connect.php");

$nama = $_POST['nama'];
$mail = $_POST['mail'];
$div = $_POST['div'];
$id = $_POST['user'];
$telepon = $_POST['telepon'];


  $sSQL = "UPDATE tbluser SET nama='$nama', email='$mail', fkdivisi='$div', telepon='$telepon' WHERE id=$id";

  mysql_query($sSQL);
  if(mysql_affected_rows() > 0){
      echo "Data berhasil di update, menunggu moderasi admin untuk ditampilkan";
      }else{
      echo "Terjadi kesalahan koneksi sehingga data belum tersimpan, silahkan coba lagi";
    }
  


?>
