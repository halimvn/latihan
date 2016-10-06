  <?php  
    error_reporting(0); 
    include("../data/connect.php");
       
    $mail = $_POST['mail'];
    $password = $_POST['pwd'];

if ((empty($_POST['mail'])) || (empty($_POST['pwd'])))
{
                 header("Location: ../index.php?log=-1");exit();
}
else {

	$sSQL = "SELECT * FROM tbluser where email = '$mail' and password=PASSWORD('$password')";
  $has  = mysql_query($sSQL);
  $row = mysql_fetch_assoc($has);
	if (!empty($row)) {  
                     session_start();
                     $_SESSION["iduser"] = $row['id'];
                header("Location: ./index.php");
                
	} else {  
	        //debug langsung kirim saja
                //session_start();
                //$_SESSION['iduser'] = 13;
                //header("Location: index.php");
                header("Location: ../index.php?log=-1");
	       }  
	}
  

  ?> 


