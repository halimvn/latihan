<!DOCTYPE html>
<html lang="en">
<?php 
  error_reporting(0);
  include("cekstatus.php");
  $rsstaff = liststaff();
  $maxstaff = mysql_num_rows($rsstaff);
  $navKode = "reports";
?>
 <?php
                        $nama = $_GET['nama'];
                        $deleteuser = deleteUser($nama);
                            header ("location:user.php");

 ?>
</html>
</html>