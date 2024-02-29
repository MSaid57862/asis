<?php
if (isset($_SESSION['user_id']) && ($_SESSION['access_level']=='5') ) {	
	    
	}
	else{
		header("location: ../logout.php");
		exit();
	}
?>	