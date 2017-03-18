<?php
session_start();
include 'dbconnect.php';

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
<title>Breed</title>

<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 

<link rel="stylesheet" href="style.css" type="text/css" />

<style>
	.c1
	{
		font-size:18px;
		
	}
	.c2
	{
		font-size:20px;
	}
	
</style>
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


<div class="container" style="margin-top:50px;text-align:center;font-family:Verdana, Geneva, sans-serif;font-size:35px;">
    <p></p>
</div>

<div class="c1" style="margin-top:100px;margin-left:200px;margin-right:200px;font-family:Verdana, Geneva, sans-serif;">

<pre>
<fieldset>
<legend>Counterpart request form</legend>
<form class="c1" action = "breed.php" method="post" name="br"><br>
		Pet		:	<input type="radio" name="dorc"  value="Dog" checked> Dog   <input type="radio" name="dorc" value="Cat">cat<br>
		Breed		:	<input type="text" name="breed"  placeholder="Breed" required autocomplete="off"><br>
		Gender		:	<input type="radio" name="gender"  value="male" checked> Male   <input type="radio" name="gender" value="female">Female<br>
		Age		:	<input type="text" name="age"  placeholder="Age" required autocomplete="off"><br>
		Crossbreed	:	<input type="radio" name="crossbreed"  value="yes" checked> Yes   <input type="radio" name="crossbreed" value="no"> No<br>
		Contact no	:	<input type="integer" name="phno"  required autocomplete="off"><br>
	
						<input type="submit" name="submitted" value="Submit">
</form>
</fieldset>
</pre>
</div>
<hr>
<?php
	include "dbconnect.php";
	$select="SELECT * FROM breed";
	$result=mysqli_query($DBcon,$select);
	while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
	{
?>
	<div style="margin-top:100px;margin-left:200px;margin-right:200px;font-family:Verdana, Geneva, sans-serif;">
		<pre class="c2">
		
			Pet		:<?php echo $row['pet']."<br>";?>
			Breed		:<?php echo $row['breed']."<br>";?>
			Gender		:<?php echo $row['gender']."<br>";?>
			Age		:<?php echo $row['age']."<br>";?>
			Crossbreed	:<?php echo $row['crossbreed']."<br>";?>
			Contact no.	:<?php echo $row['phno']."<br>";?>
			
		</pre>
	</div>


<?php
	}
?>

<?php
	include 'dbconnect.php';

if(isset($_POST['submitted'])) {
 
 $pet = strip_tags($_POST['dorc']);
 $breed = strip_tags($_POST['breed']);
 $gen = strip_tags($_POST['gender']);
 $age = strip_tags($_POST['age']);
 $crossbreed = strip_tags($_POST['crossbreed']);
 $phno = strip_tags($_POST['phno']);
 
 $query = "INSERT INTO breed(pet,breed,gender,age,crossbreed,phno) VALUES('$pet','$breed','$gen','$age','$crossbreed','$phno')";
 if ($DBcon->query($query)) {
   $msg = "<div class='alert alert-success'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Posted successfully!!
     </div>";
  }
  else {
   $msg = "<div class='alert alert-danger'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while Posting !
     </div>";
  }

}
?>

</body>
</html>