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
                       
            if(isset($_POST["nama"] ,$_POST["desc"]) )                              
            {
                 $nama = $_POST["nama"];
                    $desc = $_POST["desc"];
                    $divisi = $_POST["divisi"];
                    $result = insertService($nama,$desc,$divisi);
            
        }
                       
                            header ("location:addservice.php");

  ?>
</html>
</html>