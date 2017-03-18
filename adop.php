<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<style>
#sty {
	width: 600px;
	height: 120px;
	border: 3px solid #cccccc;
	padding: 5px;
	font-family: Tahoma, sans-serif;
	background-image: url(bg.gif);
	background-position: bottom right;
	background-repeat: no-repeat;
}

#descrip{
	margin-left:150px;
	margin-right:200px;
}

</style>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Adopt && Rescue</title>

<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 

</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
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
            <li><a href="petprod.php">PET PRODUCTS</a></li>
            <li><a href="clinic.php">CLINICS</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo $userRow['username']; ?></a></li>
            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

	

   
</br>
</br>

<div class="container">
<br>
<br>
<center>
<p>POST INFORMATION FOR RESCUE/ADOPTION</p>

<form class="form-inline" id="sameform" action="adop.php" method="POST" enctype="multipart/form-data">
  <div class="form-group" style="text-align:center;">
    <label class="sr-only" for="textarea">POST YOUR AD</label>
	<textarea id="descrip" class="form-control" name="des" form="sameform" rows="5" cols="140" autocomplete="off"></textarea>   
<br><br>
UPLOAD IMAGE<input type="file" name="image" class="form-control">
  </div>
<br><br>
  
	<input type="submit" name="submit" value="UPLOAD">

</form>
</center>
</div>
<hr>
<?php

	if(isset($_POST['submit']))
	{
		include "dbconnect.php";
		$con=mysqli_connect($DBhost,$DBuser,$DBpass,$DBname);
		$imageName=($_FILES['image']['name']);
		$imageData=addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
		$imageType=($_FILES['image']['type']);
		$des=$_POST['des'];
		
		if(substr($imageType,0,5) == "image")
		{
			echo "Code working...";
			$DBcon->query("INSERT INTO adop(name,image,des)VALUES('$imageName','$imageData','$des')");
			echo "Image uploaded!!";
		}
		else
		{
			echo "Only images are allowed";
		}

}
?>
 <p>Pet Descriptions</p>
 
 <?php
	include "dbconnect.php";
	$select="SELECT des FROM adop";
	$result=mysqli_query($DBcon,$select);
	while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
	{
		$i=1;
?>
	<div style="margin-top:100px;margin-left:200px;margin-right:200px;font-family:Verdana, Geneva, sans-serif;">
		<pre class="c2">
		
			<table>
				<tr>
					<td padding="5px"></td>
					<td padding="5px">Pet Description:</td>
				</tr>
				<tr>
					<td><img height="250" width="250" src="showimg.php?id=<?php echo $i;?>"></td>
					<td><?php echo $row['des']."<br>";?></td>
				</tr>
			
			</table>
	
			
		</pre>
	</div>


<?php
	$i++;
	}
?>




</body>
</html>