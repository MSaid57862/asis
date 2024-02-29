<?php
if (isset($_SESSION['user_id']) && ($_SESSION['access_level']=='1') ) {	
	    if($_SESSION['pass_change'] == '0'){
	       header("location: changePassword.php");
	    }else{
	        
	    }
	}
	else{
		header("location: ../logout.php");
		exit();
	}
?>	