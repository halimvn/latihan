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

    <title>Manage User</title>

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
                <div class="col-lg-12">
                    
                      
                        <h1 class="page-header">
                            Manage User <small><?php echo cetakDivisi($divisiuser); ?></small>
                        </h1>
                        
                    </div>
                </div>
                        <!-- /.panel-heading -->
                        
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="dataTables-example_wrapper"><div class="row"><div class="col-sm-6"><div id="dataTables-example_length" class="dataTables_length"></div></div><div class="col-sm-6"><div class="dataTables_filter" id="dataTables-example_filter">
                               
          
                                

                                </div>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table aria-describedby="dataTables-example_info" role="grid" class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
                                    <thead>
                                        <tr role="row"><th aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" style="width: 207px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting_asc">Nama</th><th aria-label="Browser: activate to sort column ascending" style="width: 248px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">Email</th>
                                        <th aria-label="Browser: activate to sort column ascending" style="width: 248px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">Posisi</th>
                                        <th aria-label="Browser: activate to sort column ascending" style="width: 248px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">Action</th>
                                        </tr>
                                    </thead>
                                   <?php
                                    
                                    $result = showUser();
                                   
                                    
                                    $max = mysql_num_rows($result);
                                    echo " <tbody>";
                                    if ($max > 0 ){
                                        while ($row = mysql_fetch_assoc($result)) {
                                            # code...
                                        
                                    
                                      ?>
                                        
                                  <tr role='row' class='gradeA odd'>
                                            <td class='sorting_1'>
                                           <?php  echo $row['nama'] ;?>
                                            </td>
                                            <td>
                                            <?php echo  $row['email'];?>
                                            </td>
                                            
                                             <td>
                                                <?php echo $row['posisi'];?>
                                            </td>
                                            <td>
                                                
                                               <button href="#"  data-toggle="modal" data-target="#mod291"  class="btn btn-primary" >Edit</button>
       

    <div id="mod291" class="modal fade" role="dialog">
              <div class="modal-dialog">

    <!-- Modal content-->
               <div class="modal-content">
                 <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            
                        <h4>Edit User</h4>
        </div>
        <div class="modal-body">
        
        
<form action="updateuser.php" method="POST">
                <div class="row">
                        <div class='col-sm-12'>
                        <label>Nama</label>
                        <select class="form-control" id="namastaff" name="namastaff" >

                            <?php

                              echo optionListUser($namauser); ?>         
                        </select>
                        <label>Ubah Posisi</label>
                        <select class="form-control" id="cbostaff" name="cbostaff" >

                            <?php

                              echo optionUser($divisiuser); ?>         
                        </select>
                        </div>
                </div>
                
                   <div class="row" style="margin-top:15px;">
            
                   </div>
        </div>
        <div class="modal-footer">
            <button type="button"  onclick="submit();" class="btn btn-primary">Tambah</button>
        </div>

             </div>

           </div>
</form>
                                            </td>
                                          </tr>
                                        <?php
                                    }
                                }
                                        echo "</tbody>";

                                        ?>
                                </table></div></div>
                            </div>
                            <!-- /.table-responsive -->
                            

    <!-- Modal content-->
               

             </div>

           </div>
</form>
      </div>
      
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
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
