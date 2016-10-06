<!DOCTYPE html>
<html lang="en">
<?php 
  error_reporting(0);
  include("cekstatus.php");
  $rsstaff = liststaff();
  $maxstaff = mysql_num_rows($rsstaff);
  $navKode = "dash";
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="bs/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="bs/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="bs/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include("nav.php"); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="page-header">
                            Dashboard <small><?php echo cetakDivisi($divisiuser); ?></small>
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->
<div class="row">
                    <div class="col-sm-12">
                        <p> Selamat datang <?php echo $namauser; ?> pada <strong>Sistem Informasi Request Order (SiRO)</strong>. Posisi anda ada didalam unit <b><?php echo cetakDivisi($divisiuser); ?></b>. <br>
                       Hari ini <?php echo date("l, d F Y"); ?> unit anda <b>menerima <?php echo clistService($divisiuser); ?> request</b> dari unit lain, dan <b><?php echo clistKerja($divisiuser); ?> request</b> yang unit anda sedang kerjakan. 
<ul>
<li>Untuk mengirimkan request ke unit lain, silahkan pilih menu <b><a href="request.php">Send Request</a></b></li>
<li>Untuk mengecek order yang masuk dari unit lain, silahkan pilih menu <b><a href="service.php">Recieve Order</a></b></li> 
</ul>
                       </p><hr>
                        
                    </div>
                </div>
              
                <!-- /.row -->

                <div class="row">
                    <div class="col-sm-8" style="">
                        <div class="panel panel-default ds">
                            <div class="panel-heading" style="background-color:#669BEA;">
                                <h3 style="color:#F1F8DD"><b>Recent Request/Order</b></h3>
                            </div>
                            
                                
<?php
  $rsorder  = orderlist($divisiuser);
  $maxorder = mysql_num_rows($rsorder); 
  if ($maxorder > 15){$maxorder=15;}
  $warna = "white";$z=-1;
  for($a=0;$a<$maxorder;$a++){
    $idList = mysql_result($rsorder, $a, 0);
    $nama = mysql_result($rsorder, $a, 1);
    $namaService = mysql_result($rsorder, $a, 2);
    $tgl = mysql_result($rsorder, $a, 3); $newDate = date("d/m", strtotime($tgl));
    $waktu = mysql_result($rsorder, $a, 4);                   
    $z++;                     
    if ($z==1){$warna = "#F5F5FF";$z=-1;}else{$warna = "white";}
    //jika selesai maka gelap
    $status = "<font style='color:blue;'>(Baru)</font>";
    if (cekProses($idList) == true){$status = "(Proses)"; }
    if (cekSelesai($idList) == true){$status = "(Selesai)"; }
?>

                                    <a   class="list-group-item"   style="font-size:13px; background-color:<?php echo $warna; ?>"   >
                                        <span class="badge"><?php echo $waktu; ?></span>
                                        
                                         <?php echo $newDate."  ".$nama; ?> membuat request <?php echo "$namaService <small><i>$status</i></small>"; ?> 
                                        
                                    </a>
<?php
}
 if ($maxorder==0){
?>
                                    <a   class="list-group-item"   style="font-size:13px; background-color:<?php echo $warna; ?>"   >
                                        <span class="badge"><?php echo date("H:i"); ?></span>
                                        
                                         <?php echo date("d/m")."  "; ?> Belum ada Request/Order
                                        
                                    </a>

<?php
 }
?>
                                    
                                  
				    
                                </div>
                                
                         
                    </div>

 
    <div class="col-sm-4" style="">
        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color:#669BEA;">
                                <h3 style="color: #F1F8DD"><b><?php echo cetakDivisi($divisiuser); ?> Staff</b></h3>
                            </div>
<?php
  $rsStaff = liststaff($divisiuser);
  $max = mysql_num_rows($rsStaff);
  $warna = "white";
  for($a=0;$a<$max;$a++){
    $ids = mysql_result($rsStaff,$a,0);
    $nama = mysql_result($rsStaff,$a,1);
    $z++;                     
    if ($z==1){$warna = "#ECECFF";$z=-1;}else{$warna = "white";}

?>

                            <div class="panel-body"  style="background-color:<?php echo $warna; ?>;padding: 4px 4px;"  >
                                <div class="col-sm-2">
                                    <img src="images/user/<?php echo $ids.'.jpg'; ?>"  style="width:38px; height:38px;"/>
                                </div>
                                <div class="col-sm-10">
                                    <a style="font-size:14px;text-decoration:none;"><b><?php echo $nama; ?></b></a><br>
				    <muted style="color:rgba(135, 135, 135, 0.94);font-size:12px;"><i><?php echo cekKerjaan($ids); ?></i></muted>
                                   
                                </div>
                            </div>
<?php
}
?>

   </div>
 
 </div>
                   

            </div>
            <!-- /.container-fluid -->

        
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="bs/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bs/js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="bs/js/plugins/morris/raphael.min.js"></script>
    <script src="bs/js/plugins/morris/morris.min.js"></script>
    <script src="bs/js/plugins/morris/morris-data.js"></script>
 <script>
 setTimeout(function(){
   window.location.reload();
 }, 30000);

 </script>
</body>

</html>
