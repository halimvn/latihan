<?php
error_reporting(0);
?>


<?php 
  
  
  $navKode = "reports";
  $tgla = $_GET["tgla"]; if (empty($tgla)){ $tgla =date('Y-m-01');}
  $tglb = $_GET["tglb"]; if (empty($tglb)){ $tglb =date('Y-m-d');}
  $uri = "claporan.php?tgla=$tgla&tglb=$tglb";

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


    $tjam = floor($totalTime/60);
    $tsisa = $totalTime - ($tjam*60);
  
     $totalTime1 = floor($totalTime/$no); 
    $tjam = floor($totalTime1/60);
    $tsisa = $totalTime1 - ($tjam*60);
   
$html = file_get_contents("co.php");
$html = str_replace('{divisi}', $test, $html);
$html = str_replace('{angka}', $no, $html);
$html = str_replace('{tjam}', $tjam, $html);
$html = str_replace('{tsisa}', $tsisa, $html);
$html = str_replace('{tanggal}',$date , $html);
$html = str_replace('{judullap}',$judul ,$html);
$html = str_replace('{pemberirequest}',$pemberirequest ,$html);
$html = str_replace('{unitrequest}',$pemberirequest ,$html);
$html = str_replace('{teknisi}',$pemberirequest ,$html);
$html = str_replace('{statuskerjan}',$pemberirequest ,$html);
$html = str_replace('{akhirtanggal}', $lastdate, $html);
$html = str_replace('{no}', $a, $html);
$html = str_replace('{staff}', $staff, $html);
$html = str_replace('{tgl}', $tgla, $html);
$html = str_replace('{tglax}', $tglax, $html);
$html = str_replace('{wkta}', $wkta, $html);
$html = str_replace('{tglbx}', $tglbx, $html);
$html = str_replace('{wktb}', $wktb, $html);
$html = str_replace('{stat}', $stat, $html);
$html = str_replace('{aminute}', $aminute, $html);
$html = str_replace('{namaunit}', $namaunit, $html);
$html = str_replace('{namareq}', $namareq, $html);
$html = str_replace('{requestor}', $requestor, $html);

$html = "Halim";

$test = cetakDivisi($divisiuser);
$judul = judullap($_GET["req"], 1);
$pemberirequest = judullap($_GET["nreq"], 2);
$unitrequest =judullap($_GET["unit"], 3);
$teknisi =judullap($_GET["stf"], 4);
$statuskerjaan =judullap($_GET["swork"], 5);
$lastdate = date("d F Y", strtotime($tglb));

$halim = $judullap . " " . $pemberirequest . " " . $staff . "Haklim";
$ta = '2016-03-01';
$date = date("d F Y", strtotime($tgla));


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
$dompdf->load_html($html);
$dompdf->render();
$dompdf ->stream("example.pdf",array("Attachment"=>0));
*/

?>
