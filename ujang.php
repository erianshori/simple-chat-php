<?php
	session_start();
	if(isset($_SESSION['username'])){
		echo "the username is ". $_SESSION['username'];
	}
	else{
		echo "Please sign in";
	}
	$url = "index.php";
	echo "<br><a href=".$url.">Mysite</a>";

?>