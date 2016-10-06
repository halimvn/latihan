
<?php
error_reporting(0);
?>


<?php 
  
  
  $navKode = "reports";
  $tglla = $_GET["tgla"]; if (empty($tgla)){ $tgla =date('Y-m-01');}
  $tgllb = $_GET["tglb"]; if (empty($tglb)){ $tglb =date('Y-m-d');}
  $uri = "cclaporan.php?tgla=$tgla&tglb=$tglb";

?>
<?php

require "dompdf/dompdf_config.inc.php";
include("cekstatus.php");
include("mpdf/mpdf.php");
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
  //$tgla = mysql_result($laphas,$a,4); $tglax = ubahTanggalc($tgla); //ubah tanggal jadi hari/bulan
  $tgla = $_GET['tgla'];
  $tglb = $_GET['tglb'];
  $wkta = mysql_result($laphas,$a,5);
  
  $lapdet = lapOrder($idreq);$lapnama = lapNama($idreq); 
  $maxdet = mysql_num_rows($lapdet); 
  $staff  = mysql_result($lapdet, 0, 0);
  $wktb   = "-";
  //$tglb   = mysql_result($lapdet, 0, 3); $tglbx = ubahTanggalc($tglb);
  $fkstatus = mysql_result($lapdet, 0, 2);
  $aminutes="-";
  if ($fkstatus == 3){$stat = "<a style='color:black;text-decoration:none;' >Process</a>";$swork1=3;$staff  = mysql_result($lapnama, 0, 0);
        $idstaff  = mysql_result($lapnama, 0, 1); }
  if ($fkstatus == 4){$stat = "<a style='color:black;text-decoration:none;' >Done</a>"; $swork1=4;
      $wktb  = mysql_result($lapdet, 0, 1);
      $staff  = mysql_result($lapnama, 0, 0);$idstaff  = mysql_result($lapnama, 0, 1);
      $tglb   = mysql_result($lapdet, 0, 3); $tglbx = ubahTanggalc($tglb);
    $tgla = $_GET['tgla'];
  $tglb = $_GET['tglb'];
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

 // if ($idnamaunit == $divisiuser){  //Untuk request dari IT sendiri tidak ditampilkan
  //    $a++;continue;
  //} 
  
  
  if (!empty($_GET["stf"])){ 
   if ($_GET["stf"] != $idstaff) {$a++;continue;}
  } 
if (!empty($_GET["swork"])){ 
   if ($_GET["swork"] != $swork1) {$a++;continue;}
  }   

  $no++;
  $totalTime += $sminutes;

  $a++;}

$tabel = <<<TABLE
<link href="bs/css/bootstrap.min.css" rel="stylesheet">
 <link href="bs/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="bs/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="bs/css/style-responsive.css" rel="stylesheet">

    <link href="bs/css/table-responsive.css" rel="stylesheet">
    <style type="text/css">
    th {
      padding:5px;
    }
    table {margin: 0 20px 20px 20px;}
 
    body {padding:30px;}
    td{

      padding:2px 10px 10px 10px;
    }
    </style>
<table class=" table-bordered table-striped table-condensed cf">
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
TABLE;
for ($a = 0; $a < $maxlap ; $a++){
  $id="";
  $idreq = mysql_result($laphas,$a,0);
  $namareq = mysql_result($laphas,$a,1); $idnamareq = mysql_result($laphas,$a,7); 
  $isireq=mysql_result($laphas,$a,6); 

  $requestor = mysql_result($laphas,$a,2); $idrequestor = mysql_result($laphas,$a,8);
  $namaunit = mysql_result($laphas,$a,3); $idnamaunit = mysql_result($laphas,$a,9);
  $tgla = mysql_result($laphas,$a,4); $tglax = ubahTanggalc($tgla); //ubah tanggal jadi hari/bulan
 
  $wkta = mysql_result($laphas,$a,5);
     
  $tglba = $_GET['tglb'];
  $tglaa = $_GET['tgla'];

  if (empty($tglba)){$tglba = date("Y-m-d");}
  if (empty($tglaa)){$tglaa = date("Y-m-01");}
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

 // if ($idnamaunit == $divisiuser){  //Untuk request dari IT sendiri tidak ditampilkan
  //    $a++;continue;
  //} 
  
  
  if (!empty($_GET["stf"])){ 
   if ($_GET["stf"] != $idstaff) {$a++;continue;}
  } 
if (!empty($_GET["swork"])){ 
   if ($_GET["swork"] != $swork1) {$a++;continue;}
  }   

  $no++;
  $totalTime = $sminutes;

$tabel .="<tr>";
$tabel .="<td>" . ($a+1) . "</td>";
$tabel .="<td>" .$tgla . "</td>" ;
$tabel .="<td>" .mysql_result($laphas,$a,1). "</td>" ;
$tabel .="<td>" . mysql_result($laphas,$a,2) . "</td>" ;
$tabel .="<td>" .mysql_result($laphas,$a,3) . "</td>" ;
$tabel .="<td>" .mysql_result($lapnama, 0, 0) . "</td>" ;
$tabel .="<td>" .ubahTanggalc($tgla) ." " . $wkta ."</td>" ;
$tabel .="<td>" .ubahTanggalc($tglb) ." " . $wktb . "</td>" ;
$tabel .="<td>" .$aminutes . "</td>" ;
$tabel .="<td>" .$stat . "</td>" ;
}

  $tglla = $_GET["tgla"]; if (empty($tgla)){ $tgla =date('Y-m-01');}
  $tgllb = $_GET["tglb"]; if (empty($tglb)){ $tglb =date('Y-m-d');}
  $uri = "cclaporan.php?tgla=$tgla&tglb=$tglb";
$lastdate = date("d F Y", strtotime($tglba));
$test = cetakDivisi($divisiuser);
$date = date("d F Y", strtotime($tglaa));
$tabel .= "</table>";

 $tjam = floor(($totalTime)/60);
    $tsisa = $totalTime - ($tjam*60);
    
     $totalTime = floor($totalTime/$no); 
    $tjam1 = floor($totalTime/60);
    $tsisa1 = $totalTime - ($tjam1*60);
$html = file_get_contents("cclaporan.php");
$html = str_replace('{tabel}', $tabel, $html);
$html = str_replace('{divisi}', $test, $html);
$html = str_replace('{akhirtanggal1}', $lastdate, $html);
$html = str_replace('{tanggal1}',$date , $html);
$html = str_replace('{no}', $a, $html);
$html = str_replace('{tjam}', $tjam, $html);
$html = str_replace('{tsisa}', $tsisa, $html);
$html = str_replace('{tjam1}', $tjam1, $html);
$html = str_replace('{tsisa1}', $tsisa1, $html);
$mpdf=new mPDF('c','A4','','' , 0 , 0 , 0 , 0 , 0 , 0); 
 
$mpdf->SetDisplayMode('fullpage');
 
$mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
 
$mpdf->WriteHTML($html);
         
//print_r($html);

$mpdf->Output();

/*

$dompdf = new DOMPDF();
$dompdf->set_paper("A4");

// load the html content
$dompdf->load_html($content);
$dompdf->render();
$dompdf ->stream("example.pdf",array("Attachment"=>0));
*/

?>
