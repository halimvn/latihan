<!DOCTYPE html>
<?php
error_reporting(0);
?>

<html lang="en">
<?php 
  include("cekstatus.php");
  $rsstaff = liststaff();
  $maxstaff = mysql_num_rows($rsstaff);
  $navKode = "reports";
  $tgla = $_GET["tgla"]; if (empty($tgla)){ $tgla =date('Y-m-01');}
  $tglb = $_GET["tglb"]; if (empty($tglb)){ $tglb =date('Y-m-d');}
  $uri = "cclaporan.php?tgla=$tgla&tglb=$tglb";

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
                      <div class="content-panel" style="padding:10px;">
                         <p><h2 style="">Report {divisi}</h2>
                         
<h4><i class="fa fa-angle-right"></i> Tanggal {tanggal1} sampai 
                         {akhirtanggal1} </h4>

                         </p>
                      </div>
               </div></div><br>
               <div class="row mt">
              <div class="col-lg-12">
                      <div class="content-panel">

                          <section id="no-more-tables" >
                            {tabel}
                              
                          </section>
                      </div><!-- /content-panel -->
                  </div><!-- /col-lg-12 -->
              </div><!-- /row -->

<div class="row" style="padding-left:20px;">
  <div class="col-lg-12">
   <h4><b>Report Summary</b></h4>
   <p> 
      <ul>
<?php
    $tjam = floor($totalTime/60);
    $tsisa = $totalTime - ($tjam*60);
?>
          <li>Total Request: {no} Request</li>
          <li>Total Work Time:  {tjam} jam {tsisa} menit</li>


          <li>Average Work Time: {tjam1} jam {tsisa1} menit</li>
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
