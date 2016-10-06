<?php
include("../data/connect.php");
$tgl     = $_POST["txttgl"];//$tgl = date("Y-m-d", strtotime($tgl));
$detail  = $_POST["txtdetail"];
$waktu   = $_POST["txtwaktu"];
$idReq   = $_GET["reg"];
$iduser  = $_GET["iduser"];



$sSQL = "INSERT INTO tblrequestdetail (fkrequest, fkstatus, pesan, tanggal, waktu, fkmanager) VALUES ('$idReq', 4, '$detail', '$tgl', '$waktu', '$iduser')";
mysql_query($sSQL);

header("Location: request.php");

?>
