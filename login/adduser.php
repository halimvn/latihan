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
                       
            if(isset($_POST["nama"] ,$_POST["email"]) )                              
            {
                 $nama = $_POST["nama"];
                    $email = $_POST["email"];
                    $result = adduser($nama,$email);
            
        }
                       
                            header ("location:user.php");

  ?>
</html>
</html>