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
                       
            if(isset($_POST['cbostaff'] ,$_POST['namastaff'] ) )                              
            {
                 $kode = $_POST['cbostaff'];
                  $nama = $_POST['namastaff'];
                   $result = updateuser ($kode,$nama);
        
            
        }
                       
                        header ("location:user.php");    

  ?>
</html>
</html>