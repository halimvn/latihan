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
                        if (!empty($_POST["namabiro"])){
                            if(isset($_POST["namabiro"]) )
                                {
                                    $namabiro = $_POST["namabiro"];
                                    insertbiro($namabiro);
                                }
                            }
                            header ("location:biro.php");

 ?>
</html>
</html>