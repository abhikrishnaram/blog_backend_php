<?php
	session_start();
	include_once '../includes/connection.php';
		if (isset($_SESSION['logged_in'])) {
		?>

<!DOCTYPE html>
<html>
	<head>
		<title>Blog CMS</title>
		<link rel="stylesheet" type="text/css" href="../asset/style.css">
	</head>
	<body>
		<div class="container">
			<a href="index.php" id="logo">CMS</a><br>

			<ol>
				<li><a href="add.php">Add Article</a></li>
				<li><a href="update.php">Update Article</a></li>
				<li><a href="delete.php">Delete Article</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ol>
		</div>
	</body>
</html>



<?php	}
		else {
		
		if (isset($_POST['username'],$_POST['password'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			if (empty($username) or empty($password)) {
				$error="All fields are required";
			}
			else{
					$sql="SELECT * FROM author WHERE name = '$username' AND password = '$password';";
					$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
					//print_r($result);
					echo mysqli_num_rows($result);
				if (!$result||mysqli_num_rows($result)==1) {
					#entered correct detailes
					$_SESSION['logged_in'] = true;
					header('Location: index.php');
					exit();
				}
				else{
					#detailes wrong
					$error = "Incorrect username or password";
				}
			}
		}
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Blog CMS</title>
		<link rel="stylesheet" type="text/css" href="../asset/style.css">
	</head>
	<body>
		<div class="container">
			<a href="index.php" id="logo">CMS</a><br><br>
			<?php if (isset($error)) { ?>
			<small style="color: #aa0000"><?php echo $error; ?></small>
			<?php } ?>
			<form action="index.php" method="post" autocomplete="off">
				<input type="text" name="username" placeholder="username"/><br>
				<input type="password" name="password" placeholder="password"/><br>
				<input type="submit" value="login"/>
			</form>
			<br><br>
			<a href="../index.php">&larr; View blog</a>
		</div>
	</body>
</html>
<?php } ?>