<?php 
	// connection
	session_start();
	$host = "localhost";
	$username = "root";
	$password = "";
	$database = "db_chat";

	$conn = mysqli_connect("$host","$username","$password","$database");
	if($conn){

		// echo "we are connected <br>";
	}
	else{
		echo "no connection";
	}

	if(isset($_POST['username'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		// $query = mysqli_query($conn, "SELECT `user_id` FROM `t_user` WHERE `username` = '$username';");
		$query = mysqli_query($conn, "SELECT * FROM `tb_user` WHERE BINARY `username` = '$username';");
		$fetch = mysqli_fetch_assoc($query);
		$user_id = $fetch['user_id'];
		if(is_null($user_id)){
			echo "Hello ".$username.", Have a nice chat";
			$query = mysqli_query($conn, "INSERT INTO `tb_user` (`username`,`password`) VALUES ('$username', '$password');");
		}
		else{
			if($fetch['password'] == $password)
			{
				$_SESSION['username'] = $username;
				// echo "welcome back ". $_SESSION['username'];
			}
			else{
				?>
				<script type="text/javascript">
				alert("Username has been taken or your password is wrong. Please Retry");
				</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=index.php'>";
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ciluluk Chat</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<style type="text/css">
		textarea{
			padding:10px;
			width: 500px;
			height: 350px;
			font-family: "arial";
			font-size: 17px;
			white-space: pre-line;
		}
		.message-text{
			width: 335px;
		}
		.send-button{
			width: 160px;
		}
	</style>
</head>
<body>
	<section class="container">
		<header><h1> Welcome to Ciluluk Chat</h1></header>
		<h2>Please Sign Up/In</h2>
		<form action="" method="POST" >
			<input type="text" name="username" required placeholder="Username">
			<input type="password" name="password" required placeholder="Password">
			<input type="submit" name="submit"><br>

			<a href="function.php">Log Out</a><br>
			<!-- <a href="ujang.php">go check session</a> -->
			<?php 
				if(isset($_SESSION['username'])){
					echo "<h3>Welcome back ". $_SESSION['username']. "</h3>";
				}
				
				?>
		</form>
	</section>
	<br>
	<section class="container">
		<form method="POST">
			<input class="message-text" type="text" name="" placeholder="Your Message">
			<input class="send-button" type="submit" name="" value="<?php if(isset($_SESSION['username'])){echo "Send";} else {echo "Please Sign in to Chat";} ?>">
		</form>
		<br>
		<textarea><?php
				if(isset($_SESSION['username'])){
					$query = mysqli_query($conn, "SELECT * FROM `tb_chat` LIMIT 5;");
					
						while($fetch = mysqli_fetch_assoc($query)){
							echo "\n".$fetch['message'];
						}
				}
			?>
		</textarea>
		
	</section>
	
</body>
</html>