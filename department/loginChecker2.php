<?php
if (isset($_SESSION['user_id']) && ($_SESSION['access_level']=='2') ) {	
	    
	}
	else{
		header("location: ../logout.php");
		exit();
	}
?>	