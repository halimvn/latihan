<?php
include("../data/connect.php");
include("../data/func.php");


session_start();
//DEBUG USER
$iduser = $_SESSION['iduser'];
if($iduser==""){
header("Location: ../index.php");
}
$namauser = cekUser($iduser);
$posisiuser = cekPosisi($iduser);
$divisiuser = cekDivisi($iduser);


?>
