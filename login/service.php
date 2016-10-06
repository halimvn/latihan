<!DOCTYPE html>
<html lang="id">
<?php 
  error_reporting(0);
  include("cekstatus.php");
  include("../data/connect.php");
  $navKode = "service";
  $st = $_GET["st"];if($st==""){$st=0;}

  $takex = $_GET['takeid'];

  if (!empty($takex)){
    $hasiltake = takeService($takex, $iduser);
  }
  
function takeService($takex, $userid){
    $tglx = date("Y-m-d");
    $jamx = date("H:i");
    $sSQL = "SELECT fkrequest FROM tblrequestdetail WHERE fkrequest = '$takex' AND fkstaff = '$userid' AND fkmanager = '$userid'";
    $has  = mysql_query($sSQL);
    $xxmax = mysql_num_rows($has);
    if ($xxmax == 0){ 
      $sSQL  = "INSERT INTO tblrequestdetail (fkrequest, fkstaff, fkmanager, fkstatus, tanggal, waktu) VALUES ('$takex', '$userid','$userid',3,'$tglx','$jamx')";
      $hasil = mysql_query($sSQL);
    }

    if(mysql_affected_rows() > 0){
      return 1;
      }else{
      return 0;
    }

}
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Service List</title>

    <!-- Bootstrap Core CSS -->
    <link href="bs/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="bs/css/sb-admin.css" rel="stylesheet">



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
                          Recieve Order <small><?php echo cetakDivisi($divisiuser); ?></small>
			  </h1>
                        
                    </div>
                </div>

<div class="row">
                    <div class="col-lg-12">
                        <p style='text-align: justify'> Pada halaman ini anda dapat melihat <b>order yang masuk</b> kepada unit <?php echo cetakDivisi($divisiuser); ?>.<br>
                            <ol>
                               <li> Anda dapat mengklik <b>Today Request</b> untuk mengecek order pada hari ini,</li>
                               <li> Anda juga dapat mengklik <b>Pending Request</b> untuk mengecek order hari sebelumnya yang masih pending,</li>
                               <li> Apabila anda ingin mengerjakan order yang dikirimkan, anda dapat melakukan click pada <b>Take Request</b></li>
                               <li> Apabila anda seorang manager unit kerja, anda dapat menunjuk staff dengan melakukan click pada <b>Send Staff</b></li>
                               <li> Tuliskan pesan, untuk berkomunikasi dengan user yang melakukan request.</li>
</ol>
                        </p>
                        <hr>
                    </div>
                </div>

                <!-- /.row -->
                  <div class="row">
			
                    <div class="col-sm-6">                           
                         <a class="btn btn-primary" href="?st=0"> Today Request</a> 
                         <a class="btn btn-primary" href="?st=1"> Pending Request</a> 
                         
                    </div>


			</div>


			<hr>
              
                

                <!-- Main jumbotron for a primary marketing message or call to action -->
<?php 
  $rsRequest = listService($divisiuser, $st);
  $maxReq = mysql_num_rows($rsRequest);

  for($a=0;$a<$maxReq;$a++){
      $idReq    = mysql_result($rsRequest,$a, 0);
      $judul    = mysql_result($rsRequest,$a, 1);$divisi = mysql_result($rsRequest,$a, 7);
      $isi      = mysql_result($rsRequest,$a, 2);
      $tgl      = mysql_result($rsRequest,$a, 3);$tgl = ubahTanggal($tgl);
      $jam      = mysql_result($rsRequest,$a, 4);
      $pros    = requestproses($idReq);
      $tutup    = requestclose($idReq);
      $lampiran = mysql_result($rsRequest,$a, 5);$exLampiran = substr(strrchr($lampiran,'.'),1);
      $xfkuser  = mysql_result($rsRequest,$a, 6);
      
      if ($tutup == true){
          $warna="background:rgba(13, 14, 13, 0.6)";
          if ($st==1){$a++;continue;}
      }else if($pros == true){
          $warna="background:rgba(126, 237, 110, 0.51)";
           }else{
          $warna="background:rgba(148, 149, 237, 0.27)";
      }
      
    //  if ($st==1){
    //     if($tutup=true){
    //        $a++; continue;
    //     }
    //  }

?>
                
                <div class="jumbotron" style="padding:25px 25px;<?php echo $warna; ?>">
                    <div class="row">
                    <div class="col-sm-1"> 
                       <div style="width: 70px;height:70px;">
                          <table class="jumbotron" style="width: 70px;height:70px;background-color:white">
                              <td style="text-align:center;font-size:28px;height:10px;"><b><?php echo cTanggal($tgl); ?></b></td>
                              <tr>
                              <td style="text-align:center;font-size:20px;"><b><?php echo substr(cBulan($tgl),0,3); ?></b></td>
                              

                          </table>

                       </div>
                    </div><br>
                    <div class="col-sm-5" style="margin-bottom: 10px;">

                    
                                <?php echo $jam; ?> - <?php echo $divisi; ?><br>
                                <a style="font-size:20px;color:black;text-decoration:none; " ><?php echo $judul; ?></a><br>
<?php if(cekAmbil($idReq)==false){ 

?>
                                <a href="#"   data-title="Are you sure to take this request?" 
data-href="<?php echo '?takeid='.$idReq; ?>"
                        data-toggle="confirmation-popout" data-placement="bottom">Take Request</a> &nbsp &nbsp
                                 <a href="#"  data-toggle="modal" data-target="#mod<?php echo $idReq; ?>">Send Staff</a> 

   	<div id="mod<?php echo $idReq; ?>" class="modal fade" role="dialog">
              <div class="modal-dialog">

    <!-- Modal content-->
               <div class="modal-content">
                 <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			
                        <h4>Sending Staff to #<?php echo $idReq; ?>: <?php echo $judul; ?></h4>
		</div>
		<div class="modal-body">
<form action="send.php?reg=<?php echo $idReq; ?>&iduser=<?php echo $iduser; ?>" method="POST">
                <div class="row">
                        <div class='col-sm-12'>
                        <label>Pilih Staff</label></h4>
                        <select class="form-control" id="cbostaff" name="cbostaff" >
                            <?php  echo optionStaff(3, 0,$divisiuser); ?>         
                        </select>
                        </div>
                </div>
                <div class="row">
               
                
                </div>
                   <div class="row" style="margin-top:15px;">
			<div class='col-sm-12'>
                        <label>Pesan anda</label>
			<textarea name="txtdetail" class="form-control" rows="3" placeholder="Tuliskan pesan anda.."></textarea>
			</div>
                   </div>
		</div>
		<div class="modal-footer">
			<button type="button"  onclick="submit();" class="btn btn-primary">Send to Work</button>
		</div>

             </div>

           </div>
</form>
      </div>


<?php 
}
?>






                               


                     </div>

    <div class="col-sm-6" style="border-left:1px solid #C0C6B6;">
     <div style="background-color: white;width:100%;padding: 10px 10px;margin-bottom: 10px;" class="jumbotron">
     
     <a style="text-decoration:none;"><b><?php echo cekUser($xfkuser) ?> Request</b></a> 
     <?php if($exLampiran !=""){ ?>
     <a style="font-size:10px;" target="_blank" href="upload/<?php echo $idReq.'.'.$exLampiran; ?>"><?php echo $lampiran; ?></a> 
     <?php } ?> 
     <br>
     <a style="color:#696969; font:13px 'Helvetica Neue',Helvetica,Arial,sans-serif; text-decoration:none;"><?php  echo $isi; ?></a>
     </div>
<?php
  $rsReqHistory = requestHistory($idReq);
  $maxHist = mysql_num_rows($rsReqHistory);
  
  for($x=0;$x<$maxHist;$x++){
    $note = mysql_result($rsReqHistory,$x,1);
    $man  = mysql_result($rsReqHistory,$x,2); if ($man==$iduser){$man = "You ";}else{$man = cekUser($man);}
    $stf  = mysql_result($rsReqHistory,$x,3); $stf = cekUser($stf);
    $sts  = mysql_result($rsReqHistory,$x,4);
    $xWkt = mysql_result($rsReqHistory,$x,6);

?>
                               <div  style="background-color:white;padding: 10px 10px;margin-bottom: 5px;" class="jumbotron">
                                   <?php if ($sts==3){ ?>
                                   <small style="color:#20780B; font:13px 'Helvetica Neue',Helvetica,Arial,sans-serif; text-decoration:none;"><?php echo  "$man send staff ($stf)"; ?> to start service in your request at <?php echo $xWkt; ?> </small>
                                   <?php } ?>

                                   <?php if ($sts==4){ ?>
                                   <a style=" text-decoration:none;"><?php echo  "<b>$man has close request</b> order service at <b>$xWkt</b>."; ?> </a>
                                   <?php } ?>
                                  <?php if ($note !=""){ ?>
                                   <small style="color:rgba(87, 87, 86, 0.84); font:13px 'Helvetica Neue',Helvetica,Arial,sans-serif; text-decoration:none;"><br>"<?php echo $note; ?>"</small>
                                  <?php } ?>
                               </div>
<?php } ?>


    </div>


                    </div>

                    
                       
                    
                </div>
<?php } ?>


<?php
  if ($maxReq==0){
?>
 <div class="jumbotron" style="padding:25px 25px;background:rgba(148, 149, 237, 0.27)">
                    <div class="row">
                    <div class="col-sm-1"> 
                       <div style="width: 70px;height:70px;">
                          <table class="jumbotron" style="width: 70px;height:70px;background-color:white">
                              <td style="text-align:center;font-size:28px;height:10px;"><b><?php echo date("d"); ?></b></td>
                              <tr>
                              <td style="text-align:center;font-size:20px;"><b><?php echo substr(date("F"),0,3); ?></b></td>                             
                          </table>

                       </div>
                    </div>
<div class="col-sm-5" style="margin-bottom: 10px;">

                    
                                <?php echo date("H:i"); ?> - <?php echo cetakDivisi($divisiuser); ?><br>
                                <a style="font-size:20px;color:black;text-decoration:none; " ><?php echo "Belum ada order yang masuk"; ?></a><br>
</div>
<div class="col-sm-6" style="border-left:1px solid #C0C6B6;min-height:70px;">
</div>
 </div>

<?php
}
?>



            </div>
            <!-- /.container-fluid -->


        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="bs/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bs/js/bootstrap.min.js"></script>
    <script src="bs/tooltip.js"></script>
    <script src="bs/bootstrap-confirmation.js"></script>
    <script type="text/javascript" src="bs/datetimepicker.js"></script>
 <script>
  $('[data-toggle="confirmation-popout"]').confirmation();
</script>


<script type="text/javascript">

  $(function() {
    $('#datetimepicker3').datetimepicker({
      pickDate: false
    });
  });
</script>



</body>

</html>
