<!DOCTYPE html>
<html lang="id">
<?php 
  error_reporting(0);
  include("cekstatus.php");
  include("../data/connect.php");
  $navKode = "request";
  
  $delx = $_GET['delid'];

  if (!empty($delx)){
    $hasildelete = deleteTeks2($delx);
  }
  
function deleteTeks2($idteks){
    $sSQL  = "DELETE FROM tblrequest WHERE id=$idteks";
    $hasil = mysql_query($sSQL);
    $sSQL  = "DELETE FROM tblrequestdetail WHERE id=$idteks";
    $hasil = mysql_query($sSQL);

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

    <title>Request List</title>

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
                           Request List
			  </h1>
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <p style='text-align: justify'> Pada halaman ini anda dapat melihat <b>list request yang anda kirimkan</b> kepada unit lainnya.<br>
                            <ol>
                               <li> Anda dapat mengklik <b>tombol hijau</b> untuk membuat request baru,</li>
                               <li> Kemudian unit kerja yang anda kirimkan akan menerima request anda,</li>
                               <li> Apabila dalam beberapa menit unit yang ditujukan sudah mengirimkan staff, maka anda bisa <a href="request.php"><b>reload</b></a> page ini untuk mengetahui staff yang akan membantu anda,</li>
                               <li> Apabila dalam waktu 10 menit request belum dibalas, anda dapat menghubungi unit tersebut melalui telepon,</li>
                               <li> Apabila request anda sudah diselesaikan, jangan lupa untuk menutup request anda.</li>
                               <li> Pada saat akan menutup request, masukan tanggal dan waktu yang sesuai dengan pekerjaan yang diselesaikan, </li>
                               <li> Isilah pesan pada penutup request sebagai feedback bagi unit yang mengerjakan, atau sekedar memberikan ucapan terima kasih.</li>
</ol>
                        </p>
                        <hr>
                    </div>
                </div>

<?php 
  if ($hasildelete==1){
?>
<div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<i class="fa fa-info-circle"></i>  <strong>Request anda nomor #<?php echo $delx; ?></strong> dibatalkan.
</div>


<?php
}
?> 

                <!-- /.row -->
                  <div class="row">
			
                    <div class="col-lg-1 text-right">                           
                         <a class="btn btn-success" href="write.php"> Send Request</a><br>
                    </div>

			</div>


			<hr>
              
                

                <!-- Main jumbotron for a primary marketing message or call to action -->
<?php 
  $rsRequest = listRequest($iduser);
  $maxReq = mysql_num_rows($rsRequest);
  if ($maxReq > 12){$maxReq=12;}
  for($a=0;$a<$maxReq;$a++){
      $idReq    = mysql_result($rsRequest,$a, 0);
      $judul    = mysql_result($rsRequest,$a, 1);$divisi = mysql_result($rsRequest,$a, 7);
      $isi      = mysql_result($rsRequest,$a, 2);
      $tgl      = mysql_result($rsRequest,$a, 3);$tgl = ubahTanggal($tgl);
      $jam      = mysql_result($rsRequest,$a, 4);
      $tutup    = requestclose($idReq);
      $lampiran = mysql_result($rsRequest,$a, 5); $exLampiran = substr(strrchr($lampiran,'.'),1);
      if ($tutup == true){$warna="background:rgba(13, 14, 13, 0.6)";}else{$warna="background:rgba(148, 149, 237, 0.27)";}
?>
                
                <div class="jumbotron" style="padding:25px 25px;<?php echo $warna; ?>">
                    <div class="row">
                    <div class="col-sm-1"> 
                       <div style="width: 70px;height:90px;">
                          <table class="jumbotron" style="width: 70px;height:70px;background-color:white">
                              <td style="text-align:center;font-size:28px;height:10px;"><b><?php echo cTanggal($tgl); ?></b></td>
                              <tr>
                              <td style="text-align:center;font-size:20px;"><b><?php echo substr(cBulan($tgl),0,3); ?></b></td>
                             
                          </table>

                       </div>
                    </div>

                    <div class="col-sm-5" style="margin-bottom: 10px;">
                    
                                <?php echo $jam; ?> - <?php echo $divisi; ?><br>
                                <a style="font-size:20px;color:black;text-decoration:none; " ><?php echo $judul; ?></a><br>



<?php if(cekKerja($idReq)==false){ 

?>
                                <a href="#"   data-title="Are you sure to cancel this request?" 
data-href="<?php echo '?delid='.$idReq; ?>"
                        data-toggle="confirmation-popout" data-placement="bottom">Cancel request</a> &nbsp &nbsp
                                 <a href="#"  data-toggle="modal" data-target="#mod<?php echo $idReq; ?>">Close Request</a> 

   	<div id="mod<?php echo $idReq; ?>" class="modal fade" role="dialog">
              <div class="modal-dialog">

    <!-- Modal content-->
               <div class="modal-content">
                 <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			
                        <h4>Close Work #<?php echo $idReq; ?>: <?php echo $judul; ?></h4>
		</div>
		<div class="modal-body">
<form action="close.php?reg=<?php echo $idReq; ?>&iduser=<?php echo $iduser; ?>" method="POST">
                <div class="row">
                <div class='col-sm-8'>


                    <label>Tangal Selesai <small style="color:silver">(Tahun/Bulan/Tanggal)</small></label>
                    <div class='input-group date' id='datetimepicker3'>
                       <input name="txttgl"  type='text' class="form-control"  value="<?php echo date('Y-m-d');?>"/>
                           <span class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                       </span>
                   </div>
                </div>
                <div class='col-sm-4'>
                    <label>Waktu </label>
                   <div class='input-group date' id='datetimepicker4'>
                       <input name="txtwaktu"  type='text' class="form-control" value="<?php echo date('H:i');?>" />
                           <span class="input-group-addon">
                           <span class="glyphicon glyphicon-time"></span>
                       </span>
                   </div>
                </div>
                </div>
                   <div class="row" style="margin-top:15px;">
			<div class='col-sm-12'>
                        <label>Pesan anda</label>
			<textarea name="txtdetail" class="form-control" rows="3" placeholder="Tuliskan pesan anda.."></textarea>
			</div>
                   </div>
		</div>
		<div class="modal-footer">
			<button type="button"  onclick="submit();" class="btn btn-primary">Save Project</button>
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
     <a style="text-decoration:none;"><b>Your Request</b></a> 
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
