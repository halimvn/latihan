 <?php
    include("mpdf/mpdf.php");
  $urx =  $_SERVER['REQUEST_URI'];
  $urx =  str_replace("cpdf","claporan",$urx); 
  $urx = "http://wo.uib.ac.id".$urx;
   


$url = $urx;
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// you may set this options if you need to follow redirects. Though I didn't get any in your case
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
$content = curl_exec($curl);
curl_close($curl);

$html = file_get_contents($content);


$mpdf=new mPDF('c','A4','','' , 0 , 0 , 0 , 0 , 0 , 0); 
 
$mpdf->SetDisplayMode('fullpage');
 
$mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
 
$mpdf->WriteHTML(file_get_contents('claporan.php'));
         
//print_r($html);

$mpdf->Output();



?> 
