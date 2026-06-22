<?php 

	function auth($reqRole, $usrRole){
		if($usrRole === null) {
			header("Refresh: 4; url= ../../inc/logout.php");
			die("Not logged in!");
		}
		if(!str_contains($reqRole, $usrRole)) {
			header("Refresh: 4; url= ../../inc/logout.php");
			die("Unauthorized access to this page!");
		}
	}