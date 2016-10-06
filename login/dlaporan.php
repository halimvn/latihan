<!DOCTYPE html>

<html lang="en">
<?php 
  include("cekstatus.php");
  $rsstaff = liststaff();
  $maxstaff = mysql_num_rows($rsstaff);
  $navKode = "reports";
  $tgla = $_GET["tgla"]; if (empty($tgla)){ $tgla =date('Y-m-01');}
  $tglb = $_GET["tglb"]; if (empty($tglb)){ $tglb =date('Y-m-d');}
  $uri = "claporan.php?tgla=$tgla&tglb=$tglb";

?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reports</title>

    <!-- Bootstrap Core CSS -->
    <link href="bs/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="bs/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="bs/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="bs/css/style-responsive.css" rel="stylesheet">

    <link href="bs/css/table-responsive.css" rel="stylesheet">
    <link href="bs/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body style="background-color: white;">




        <div id="page-wrapper" >

               <div class="row mt">
              <div class="col-lg-12">
                      <div class="content-panel">
                         <p><h2>Report <?php echo cetakDivisi($divisiuser); ?></h2>
                         
                         <?php if (!empty($_GET["req"])){echo "<h4>Request: ".judullap($_GET["req"], 1)."</h4>";} ?>
                         <?php if (!empty($_GET["nreq"])){echo "<h4>Pemberi Request: ".judullap($_GET["nreq"], 2)."</h4>";} ?>
                         <?php if (!empty($_GET["unit"])){echo "<h4>Unit Request: ".judullap($_GET["unit"], 3)." </h4>";} ?>
                         <?php if (!empty($_GET["stf"])){echo "<h4>Teknisi: ".judullap($_GET["stf"], 4)." </h4>";} ?>
                         <?php if (!empty($_GET["swork"])){echo "<h4>Status Pekerajaan: ".judullap($_GET["swork"], 5)."</h4>";} ?>
<h4><i class="fa fa-angle-right"></i> Tanggal <?php echo date("d F Y", strtotime($tgla)) ; ?> sampai 
                         <?php echo date("d F Y", strtotime($tglb)) ; ?> </h4>

                         </p>
                      </div>
               </div></div><br>
               <div class="row mt">
              <div class="col-lg-12">
                      <div class="content-panel">

                          <section id="no-more-tables">
                              <table class="table table-bordered table-striped table-condensed cf">
                                  <thead class="cf">
                                  <tr style="background-color: #D6DFFC;">
                                      <th style="text-align:center">No.</th>
                                      <th>Tanggal</th>
                                      <th>Request Order</th>
                                      <th class="numeric">Request From</th>
                                      <th class="numeric">Unit Kerja</th>
                                      <th class="numeric">Worker</th>
                                      <th class="numeric">Start</th>
                                      <th class="numeric">Close</th>
                                      <th class="numeric">Durasi</th>
                                      <th class="numeric">Status</th>
                                  </tr>
                                  </thead>
                                  <tbody>
<?php

  //cetak Syarat
  if (!empty($_GET["req"])){
    $syarat = " AND a.fkservice = ".$_GET["req"];
  }
  if (!empty($_GET["nreq"])){
    $syarat = " AND a.fkuser = ".$_GET["nreq"];
  }
  if (!empty($_GET["unit"])){
    $syarat = " AND d.id = ".$_GET["unit"];
  }

  $stf = "";$swork1 = "";
  $laphas = lapRequest($tgla, $tglb, $syarat, $divisiuser);
  $maxlap = mysql_num_rows($laphas);
  $no =0; $totalTime=0;
  $a=0;while($a<$maxlap){
  $id="";
  $idreq = mysql_result($laphas,$a,0);
  $namareq = mysql_result($laphas,$a,1); $idnamareq = mysql_result($laphas,$a,7); 
  $isireq=mysql_result($laphas,$a,6); 
  
  $requestor = mysql_result($laphas,$a,2); $idrequestor = mysql_result($laphas,$a,8);
  $namaunit = mysql_result($laphas,$a,3); $idnamaunit = mysql_result($laphas,$a,9);
  $tgla = mysql_result($laphas,$a,4); $tglax = ubahTanggalc($tgla); //ubah tanggal jadi hari/bulan
  $wkta = mysql_result($laphas,$a,5);
  
  $lapdet = lapOrder($idreq);$lapnama = lapNama($idreq); 
  $maxdet = mysql_num_rows($lapdet); 
  $staff  = mysql_result($lapdet, 0, 0);
  $wktb   = "-";
  $tglb   = mysql_result($lapdet, 0, 3); $tglbx = ubahTanggalc($tglb);
  $fkstatus = mysql_result($lapdet, 0, 2);
  $aminutes="-";
  if ($fkstatus == 3){$stat = "<a style='color:black;text-decoration:none;' >Process</a>";$swork1=3;$staff  = mysql_result($lapnama, 0, 0);
        $idstaff  = mysql_result($lapnama, 0, 1); }
  if ($fkstatus == 4){$stat = "<a style='color:black;text-decoration:none;' >Done</a>"; $swork1=4;
      $wktb  = mysql_result($lapdet, 0, 1);
      $staff  = mysql_result($lapnama, 0, 0);$idstaff  = mysql_result($lapnama, 0, 1);
      $tglb   = mysql_result($lapdet, 0, 3); $tglbx = ubahTanggalc($tglb);
    
     $atime = strtotime("$tgla $wkta");
     $btime = strtotime("$tglb $wktb");
     $aminutes = round(abs($btime - $atime) / 60,2);
     $sminutes = $aminutes; 
     if ($aminutes >= 60){
         $ajam = floor($aminutes/60);
         $sisa = $aminutes - ($ajam*60);
         if ($sisa<10){$sisa = "0".$sisa;}
         if ($ajam<10){$ajam = "0".$ajam;}
         $aminutes = $ajam. ":".$sisa;
     }else{
      if ($aminutes<10){$aminutes = "0".$aminutes;}
      $aminutes = "00:".$aminutes;

     }
  }
  if ($fkstatus == ""){$stat = "<a style='color:black;text-decoration:none;' >Waiting</a>";$swork1=0; }

  if ($idnamaunit == $divisiuser){  //Untuk request dari IT sendiri tidak ditampilkan
      $a++;continue;
  } 
  
  
  if (!empty($_GET["stf"])){ 
   if ($_GET["stf"] != $idstaff) {$a++;continue;}
  } 
if (!empty($_GET["swork"])){ 
   if ($_GET["swork"] != $swork1) {$a++;continue;}
  }   

  $no++;
  $totalTime += $sminutes;
  //$no = $no - $nox;
?>

                                  <tr>
                                      <td data-title="No." style="text-align:center"><?php echo $no;?>.</td>
                                      <td data-title="Request Order"><a style="font-size:12px;color:black"><?php echo $tgla; ?></a></td>
                                      <td data-title="Request Order"><a style="font-size:12px;color:black"><?php echo $namareq; ?></a></td>
                                      <td data-title="Requestor"><a style="font-size:12px;color:black" ><?php echo $requestor; ?></a></td>
                                      <td data-title="Unit Kerja"> <a style="font-size:12px;color:black" ><?php echo $namaunit; ?></td>
                                      <td data-title="Staff"><a style="font-size:12px;color:black" ><?php echo $staff; ?></a></td>
                                      <td data-title="Start Work" style="font-size:12px;color:black"><?php echo $tglax; ?> <?php echo $wkta; ?></td>
                                      <td data-title="Close Work" style="font-size:12px;color:black"><?php echo $tglbx; ?> <?php echo $wktb; ?></td>
                                      <td style="text-align:center" data-title="Work Time" style="font-size:12px;color:black"><?php echo $aminutes; ?></td>
                                      <td data-title="Work Status" style="font-size:12px;color:black"><?php echo $stat; ?></td>
                                  </tr>
                                  
<?php

  

$a++;}
?>
                                  
                                  </tbody>
                              </table>
                          </section>
                      </div><!-- /content-panel -->
                  </div><!-- /col-lg-12 -->
              </div><!-- /row -->

<div class="row">
  <div class="col-lg-12">
   <h4><b>Report Summary</b></h4>
   <p> 
      <ul>
<?php
    $tjam = floor($totalTime/60);
    $tsisa = $totalTime - ($tjam*60);
?>
          <li>Total Request: <?php echo $no; ?> Request</li>
          <li>Total Work Time: <?php echo $tjam." jam ".$tsisa." menit"; ?></li>
<?php
    $totalTime = floor($totalTime/$no); 
    $tjam = floor($totalTime/60);
    $tsisa = $totalTime - ($tjam*60);
?>

          <li>Average Work Time: <?php echo $tjam." jam ".$tsisa." menit"; ?></li>
      </ul>
   </p>
  </div>
</div>

                   
              
                <!-- /.row -->

               
            <!-- /.container-fluid -->

        
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="bs/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bs/js/bootstrap.min.js"></script>
    <script src="bs/excanvas.min.js"></script>
    <script src="bs/chart.min.js" type="text/javascript"></script>
    <script src="bs/bootstrap.js"></script>


<script type="text/javascript" src="bs/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="bs/bootstrap-datetimepicker.min.js"></script>



    <script src="bs/base.js"></script>
    <script class="include" type="text/javascript" src="bs/jquery.dcjqaccordion.2.7.js"></script>
    <script src="bs/jquery.scrollTo.min.js"></script>
    <script src="bs/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="bs/common-scripts.js"></script>

   <script type="text/javascript">
     function caridata(){
         tgla = document.getElementById("txttgla").value;
         tglb = document.getElementById("txttglb").value;      
         location.href = "laporan.php?tgla="+tgla+"&tglb="+tglb;
     }
   </script>

     <script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
	$('.form_date').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	$('.form_time').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });
</script>



</body>

</html>
