<?php
session_start();
include_once 'dbconnect.php';

if (!isset($_SESSION['userSession'])) {
 header("Location: index.php");
}

$query = $DBcon->query("SELECT * FROM tbl_users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$DBcon->close();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Clinic</title>

<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 

<link rel="stylesheet" href="style.css" type="text/css" />


</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="home.php">PetParadise</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="adop.php">ADOPT && RESCUE</a></li>
            <li><a href="breed.php">BREED</a></li>
            <li><a href="petprod.php">PET SHOPS</a></li>
            <li><a href="clinic.php">CLINICS</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo $userRow['username']; ?></a></li>
            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<div class="container" style="margin-top:150px;text-align:center;font-family:Verdana, Geneva, sans-serif;font-size:35px;">
 <a href=""></a><br /><br />
    <p>Search for the nearest pet clinics</p>
</div>
<div class="container">
</br>
</br>
<center>
<p>ENTER YOUR LOCATION</p>
<form action="clinic.php" class="form-inline" name="clinic" method="POST">
  <div class="form-group">
    <input type="text" class="form-control" name="loc" id="loc" size="40" autocomplete="off">
<br><br>
<br>
  <button type="submit" class="btn btn-default" name="submitted">Submit</button></center>
</form>
</div>


<?php
	include "dbconnect.php";
	if(isset($_POST['submitted']))
	{
		$loc=strip_tags($_POST['loc']);
		$select="SELECT * FROM clinic WHERE address LIKE '%{$loc}%'";
		
	$result=mysqli_query($DBcon,$select);
	while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
	{
?>
	<div style="margin-top:100px;margin-left:200px;margin-right:200px;font-family:Verdana, Geneva, sans-serif;">
		<pre class="c2">
		
			Clinic name		:<?php echo $row['clinicname']."<br>";?>
			Doctor name		:<?php echo $row['drname']."<br>";?>
			Address			:<?php echo $row['address']."<br>";?>
			Locality		:<?php echo $row['locality']."<br>";?>
			Contact no.		:<?php echo $row['phno']."<br>";?>
			
		</pre>
	</div>


<?php
	}
	}
?>




</body>
</html>