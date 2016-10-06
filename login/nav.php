<?php 
  
  if (empty($navKode)){
     $navKode = "";
  }
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Request Panel</a>
            </div>
            <!-- Top Menu Items -->
            
            <ul class="nav navbar-right top-nav">
                
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $namauser; ?>  <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        
                        <li>
                            <a href="acc.php"><i class="fa fa-fw fa-gear"></i> Account</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="out.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li  <?php if($navKode=="dash"){echo "class='active'"; } ?>>
                        <a href="index.php"> Dashboard</a>
                    </li>

                    <li  <?php if($navKode=="request"){echo "class='active'"; } ?>>
                        <a href="request.php"> Send Request </a>
                    </li >
                    <li  <?php if($navKode=="service"){echo "class='active'"; } ?>>
                        <a href="service.php"> Receive Order </a>
                    </li >                   
           
                    <li >
                     
                        
                    </li>
			
                    
                    <li  <?php if($navKode=="account"){echo "class='active'"; } ?>>
                        <a href="acc.php"><i class="fa fa-fw fa-desktop"></i> Account</a>
                    </li>
            
<?php 
if ($posisiuser <= 2){
?>

<li>
                        

                        <ul id="admin" >
                            
                            
                            
                            <li>
                                <a href="biro.php">Biro</a>
                            </li>
                            <li>
                                <a href="addservice.php"> Service</a>
                            </li>
                            <li>
                                <a href="user.php"> Manage User</a></li>
                            
                            
			 
                        </ul>
                    </li>
      
<?php
}
?>
<?php 
if ($posisiuser == 3 || $posisiuser == 6){
?>

<li>
                        

                        <ul id="admin" >
                            
                            
                            <li>
                            	<a href="laporan.php">Reports</a>
                            </li>
                            
                            
                            
			 
                        </ul>
                    </li>
      
<?php
}
?>
                  
                    
                </ul>

                    

            </div>
            <!-- /.navbar-collapse -->
        </nav>


