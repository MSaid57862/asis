<?php
if (isset($_SESSION['user_id']) && ($_SESSION['access_level']=='2') ) {	
	    if($_SESSION['pass_change']=='0'|| $_SESSION['pass_change']==''){
	         echo "<script> location.href='changePassword.php'; </script>";
	    }else{
	        
	    }
	}
	else{
		header("location: ../logout.php");
		exit();
	}
?>	