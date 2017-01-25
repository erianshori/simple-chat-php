<?php
	//function destroy_session(){
		session_start();
		session_unset();
		session_destroy();
		header("Location: index.php");
	//}	// destroy_session();
	?>