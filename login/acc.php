<!DOCTYPE html>
<html lang="en">
<?php 
  error_reporting(0); 
  include("cekstatus.php");    
  $navKode = "account";
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Your Account</title>


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
                            Account Settings
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                       <p> Masukan data anda dengan benar untuk mempermudah komunikasi antar unit kerja. Anda tidak dapat mengubah email, dan password karena Sistem ini telah terintegrasi dengan email UIB milik anda.
                           
                           <ul> 
                              <li>Isikan nama anda, Unit kerja, Nomor Telepon Pribadi / Extension </li>
                              <li>Upload foto anda dengan format gambar jpg, atau png. Pastikan ukuranya tidak lebih dari 1.2Mb</li>
                              <li>Saat melakukan upload, tunggu beberapa detik hingga upload selesai dan gambar akan muncul.</li> 
                              <li>Jika data yang diisikan sudah benar, anda dapat menekan tombol <b>Update Data</b></li>
                              <li>Kemudian anda dapat melakukan Request-Order ke Unit yang sudah siap menerima order.</li>

                           </ul>
                       </p>
                       <hr>
                    </div>
                </div>

<?php
  $rsAkun = readAkun($iduser);
  $mail = mysql_result($rsAkun, 0, 0);
  $nama = mysql_result($rsAkun, 0, 1);
  $telp = mysql_result($rsAkun, 0, 2);
  $divisi = mysql_result($rsAkun, 0, 3);



?>
                <!-- /.row -->
                <div class="row">
                  <div class="col-lg-4">
                      <div class="panel-heading " style="height:180px;border:1px solid silver" >
                              <center><img src="images/user/<?php echo $iduser.'.'.'jpg';?>"  width="140" height="120" class="img-thumbnail img-responsive"> 
                              <b style="color:black"></b></center>
                       </div>
                   </div>

                  <div class="col-lg-8">

<div class="form-group">
                                <h4><label>Email</label></h4>
                                <input id="sMail" class="form-control" placeholder="" value="<?php echo $mail; ?>" disabled>
                	     </div>
            		    
                             <div class="form-group">
                                <h4><label>Upload your Photo (*.jpg, *.png, max. 1.2Mb)</label></h4>

                               <form action="cFoto.php" method="POST" enctype="multipart/form-data">

                                  <input onchange="submit();" type="file" id="sBanner" name="sBanner" multiple="false" />
                                  <input type="text" value="<?php echo $iduser; ?>" value="" name="txtid" id="txtid" style="visibility:hidden;" >
                                  <input type="text" value="acc.php" name="txtlokasi" id="txtlokasi" style="visibility:hidden;">
                                  <submit style="visibility: hidden;position:absolute;"></submit>
	                       </form>

                </div>

                             
			     
                  </div>


                </div>
 <div class="form-group">
                                <h4><label>Nama Lengkap</label></h4>
                                <input id="sNama" class="form-control " placeholder="Write your name here" value="<?php echo $nama; ?>">
           		     </div>
                <div class="form-group">
                                <h4><label>Unit Kerja (Biro/Prodi)</label></h4>
                                <select class="form-control" id="cbodivisi">

                                  <?php  echo optionIsi("tbldivisi", $divisi); ?>
                                    
                                </select>
                </div>
                
		<div class="form-group">
                                <h4><label>Telepon / Extension</label></h4>
                                <input id="sTelepon" class="form-control" placeholder="Write phone numbers" value="<?php echo $telp; ?>"  >
                </div>


		
                                 <a class="btn btn-primary" onclick="Javascript: saveTeks();">Update Data&nbsp</a>
                 
                


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



<script type="text/javascript">
function getXMLHttpRequestObject()
{
  var xmlhttp;  
  if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
    try {
      xmlhttp = new XMLHttpRequest();
    } catch (e) {
      xmlhttp = false;
    }
  }
  return xmlhttp;
}

  function saveTeks(){
          
 	  
    	  mail = document.getElementById('sMail').value;
          nama = document.getElementById('sNama').value;     
    	  divisi = document.getElementById('cbodivisi').value;
          telepon = document.getElementById('sTelepon').value;
          
    
          usr = "<?php echo $iduser; ?>";
          url = "sacc.php"; 

          params = "nama="+nama+"&mail="+mail+"&user="+usr+"&telepon="+telepon+"&div="+divisi;

          http = new getXMLHttpRequestObject();
  	  http.open("POST", url, true); 
	  http.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
    	  http.setRequestHeader("Content-length", params.length);
    	  http.setRequestHeader("Connection", "close");
	  http.onreadystatechange = function() {//Call a function when the state changes.
		if(http.readyState == 4 && http.status == 200) {
			alert(http.responseText);
        	        window.location.reload();
							       }
    		}
	   http.send(params);

        
  }
</script>


</html>
