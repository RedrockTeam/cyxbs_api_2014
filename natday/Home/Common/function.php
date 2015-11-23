<?php


	function check_login(){
		$login_name=session('login_name');
		if($login_name){
			
		}else{
			
			header("location:".U("Admin:login/index"));
		}
	}	

	function check_level($level=3){
		$name = session('login_name');
		if($name && C($name.".level") >= $level){
			
		}else{
			
			echo '<script language="javascript"> 
			alert("your level is not enough,go back"); 
			window.history.back(-1); 
			</script> ';
			exit();
		}
		
	}

?>