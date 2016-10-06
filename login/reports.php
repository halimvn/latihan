<!DOCTYPE html>
<html lang="en">
<?php 
  error_reporting(0);
  include("cekstatus.php");
  $rsstaff = liststaff();
  $maxstaff = mysql_num_rows($rsstaff);
  $navKode = "reports";
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
                            Reports <small></small>
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-sm-5">
                        
                         <div class="widget">
                            <div class="widget-header">
                                <i class="icon-bar-chart"></i>
                                <center><b>Total Request (Internal & External)</b></center>
                            </div>
                            <!-- /widget-header -->
                            <div class="widget-content">
                                <canvas id="chart-request" class="chart-holder" width="538" height="250">
                                </canvas>
                                <!-- /bar-chart -->
                            </div>
                            <!-- /widget-content -->
                        </div>
                        
                    </div>
<div class="col-sm-1">
</div>
                    <div class="col-sm-5">
                        
                         <div class="widget">
                            <div class="widget-header">
                                <i class="icon-bar-chart"></i>
                                <center><b>Staff Service Counter (Month)</b></center>
                            </div>
                            <!-- /widget-header -->
                            <div class="widget-content">
                                <canvas id="chart-service" class="chart-holder" width="538" height="250">
                                </canvas>
                                <!-- /bar-chart -->
                            </div>
                            <!-- /widget-content -->
                        </div>
                        
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
    <script src="bs/base.js"></script>

    
 <script type="text/Javascript">
   var chartRequest = {
            labels: ["Rabu", "Kamis", "Jumat", "Sabtu", "Minggu", "Senin", "Selasa"],
            axisY:{
       			 minimum: 0,
        		maximum: 20,     
      		  },

            datasets: [
				{
                                    title: "External",
				    fillColor: "red",
				    strokeColor: "rgba(220,220,220,1)",
				    data: [25, 22, 21, 5, 0, 24, 31]
				},
                                {
                                    title: "Internal",
				    fillColor: "green",
				    strokeColor: "rgba(220,220,220,1)",
				    data: [12, 10, 7, 1, 1, 21, 15]
				},

                                {
                                    title: "Total",
				    fillColor: "blue",
				    strokeColor: "rgba(220,220,220,1)",
				    data: [37, 32, 29, 6, 1, 45, 46]
				}
				
			]

        }

var chartService = {
            labels: ["Aryo", "M. Jufri", "Rio R.", "Ari P.", "Bagus", "Rahman", "Halim"],
            axisY:{
       			 minimum: 0,
        		maximum: 20,     
      		  },

            datasets: [
				{
                                    title: "External",
				    fillColor: "red",
				    strokeColor: "rgba(220,220,220,1)",
				    data: [25, 22, 21, 5, 0, 24, 31]
				},
                                {
                                    title: "Internal",
				    fillColor: "green",
				    strokeColor: "rgba(220,220,220,1)",
				    data: [12, 10, 7, 1, 1, 21, 15]
				},

                                {
                                    title: "Total",
				    fillColor: "blue",
				    strokeColor: "rgba(220,220,220,1)",
				    data: [37, 32, 29, 6, 1, 45, 46]
				}
				
			]

        }

  var myLine = new Chart(document.getElementById("chart-request").getContext("2d")).Bar(chartRequest); 

  var myLine = new Chart(document.getElementById("chart-service").getContext("2d")).Bar(chartService); 

</script>


</body>

</html>
