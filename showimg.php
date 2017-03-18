<?php
	include "dbconnect.php";
	
	if(isset($_GET['id']))
	{
		$id=mysqli_real_escape_string($DBcon,$_GET['id']);
		$query=mysqli_query($DBcon,"SELECT * FROM adop WHERE imgid='$id'");
		while($row=mysqli_fetch_assoc($query))
		{
			$imgData=$row['image'];
			header("content-type:image/png");
			echo $imgData;
	
		}
		}
	else
	{
		echo "error";
	}


?>