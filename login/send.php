<?php
include("../data/connect.php");

$staff  = $_POST["cbostaff"];
$detail  = $_POST["txtdetail"];
$idReq   = $_GET["reg"];
$iduser  = $_GET["iduser"];

$tgl = date("Y-m-d");
$waktu = date("H:i");

$sSQL = "INSERT INTO tblrequestdetail (fkrequest, fkstatus, pesan, tanggal, waktu, fkmanager, fkstaff) VALUES ('$idReq', 3, '$detail', '$tgl', '$waktu', '$iduser', '$staff')";
mysql_query($sSQL);

header("Location: service.php");

?>
