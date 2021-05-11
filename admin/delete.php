<?php 

	session_start();
	include_once '../includes/connection.php';
	include_once '../includes/articlequery.php';
		$article = new Article();
		
		if (isset($_SESSION['logged_in'])) {
			$articles = $article->fetch_all();
			if (isset($_GET['del'])) {
				$id = $_GET['del'];
				$sql="DELETE FROM post WHERE id = '$id';";
				$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

				if(mysqli_affected_rows($conn)==1){$msg = "delete Successfull";}
					
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
			<a href="index.php" id="logo">CMS</a><br>

			<h4>Delete Article</h4>
			<?php if (isset($msg)) { ?>
			<small style="color: green"><?php echo $msg; ?></small>
			<?php } ?>


			<form action="delete.php" method="GET">
				<select onchange="this.form.submit();" name="del">
					<option value="">None</option>
					<?php foreach($articles as $article){ ?>
				<option value="<?php echo $article['id']; ?>">
						<?php echo $article['title']; ?></option>
					<br>
				<?php } ?>
				</select>
			</form>
			<a href="index.php">&larr; Back</a>
		</div>
	</body>
</html>

<?php		}
		else{
			header('Location: index.php');
		}
?>