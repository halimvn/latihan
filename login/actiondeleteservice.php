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
                                    $sDelete = deleteservice ($nama);
       
                            header ("location:addservice.php");

 ?>
</html>
</html>