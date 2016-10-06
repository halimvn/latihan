<?php
include("../data/connect.php");
$daftar = $_POST["cbodaftar"];
$detail = $_POST["txtdetail"];
$iduser = $_GET["fkuser"];
$att = $_POST["sAtt"];


$tgl    = date("Y-m-d");
$waktu  = date("H:i");
$fnama = $_FILES['sAtt']["name"];

$sSQL = "INSERT INTO tblrequest (fkuser, fkservice, detail, tanggal, waktu, namafile) VALUES ('$iduser','$daftar','$detail','$tgl','$waktu', '$fnama')";
mysql_query($sSQL);
$noid = mysql_insert_id();


//check last id lalu simpan gambar dengan nama idlast.jpg
if (!empty($fnama)){

   include("cAtt.php");


}

header("Location: request.php");

?>
