<!DOCTYPE html>
<html lang="id">
<?php 
  error_reporting(0);
  include("cekstatus.php");
  
  $navKode = "write";
  $kirimke = $_GET["to"];
  if($kirimke==""){$kirimke=17;}
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Work Order - Write Request</title>


    <!-- Bootstrap Core CSS -->
    <link href="bs/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="bs/css/sb-admin.css" rel="stylesheet">

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
                            Write Request
                        </h1>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <p style="text-align: justify"> <b>Pilih request</b> berdasarkan kategori yang disediakan, apabila anda memiliki <b>gambar/screenshot atau dokumen</b> yang ingin dikerjakan, silahkan mengattach dokumen kedalam sistem dan <b>berikan deskripsi request</b> yang ingin dikerjakan untuk mempermudah kami untuk mengirim staff yang sesuai dengan kendala bapak/ibu. <b>Apabila request sudah dibuat</b>, anda bisa melihat di <b>Request List</b> pada akun anda. 
                        </p>
                        <hr>
                    </div>
                </div>
                <!-- /.row -->
               
                  
                  <div class="row " style="background-color:#509F44; padding: 30px 15px;">
                    <div class="col-sm-7">
                       <form role="form" method="POST" action="save.php?fkuser=<?php echo $iduser; ?>" enctype="multipart/form-data">
                            	<div class="form-group">
                                <label>Request to?</label>
                                <select class="form-control" name="cbounit" id="cbounit" onchange="Javascript: ckirim()">
                                  
                                  <option value="17" <?php if ($kirimke==17){echo "selected"; } ?>>IT Center</option>
                                  <option value="2"  <?php if ($kirimke==2){echo "selected"; } ?>>BAUK (Bagian Umum)</option>
                                  <option value="3"  <?php if ($kirimke==3){echo "selected"; } ?>>BAAK (Bagian Akademik)</option>

                                </select>
                                </div>

                                <div class="form-group">
                                <label>Request about?</label>
                                <select class="form-control" name="cbodaftar" id="cbodaftar">
                                  <?php  echo optionIsi("tblservice", "", " WHERE fkdivisi=$kirimke"); ?>                                    
                                </select>
                                </div>

                                

			    <div class="form-group">
                                <label>Explain your request</label>
                                <textarea name="txtdetail" class="form-control" rows="3" placeholder="Write your problem here..."></textarea>
                            </div>



                                <button  type="button" class="btn btn-primary" onclick="submit();">Send Request</button>

                                
                       </form>
  </div>

<div class="col-sm-1" style="min-height:50px;">
</div>


<div class="col-sm-4" style="border-left: 2px solid white">
        <div class="panel">
                            <div class="panel-heading" style="background-color:#499F3D;border:3px solid white">
                                <h3 style="color: #F1F8DD"><b><?php echo cetakDivisi($kirimke); ?></b></h3>
                            </div>
<?php
  $rsStaff = liststaff($kirimke);
  $max = mysql_num_rows($rsStaff);
  $warna = "white";
  for($a=0;$a<$max;$a++){
    $ids = mysql_result($rsStaff,$a,0);
    $nama = mysql_result($rsStaff,$a,1);
                       
    if ($z==1){$warna = "#C7F3D1";$z=-1;}else{$warna = "white";}$z++;  

?>

                            <div class="panel-body"  style="background-color:<?php echo $warna; ?>; border:3px solid white; padding: 2px 2px;"  >
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
 <br>                      

		


        


            </div>

            <!-- /.container-fluid -->

            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="bs/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bs/js/bootstrap.min.js"></script>

</body>


<script>
 function ckirim(){
   ke = document.getElementById("cbounit").value;
   location.href= "?to=" + ke;
 }
</script>   

</html>
