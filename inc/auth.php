<?php 

	function auth($role){
		if($role == "STD"){
			// echo "Hallo User";
		}else{
			// login page
		}
	}

	function logout(){
		session_destroy();
		header("Location: ./../../index.php");
}