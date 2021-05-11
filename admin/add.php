<?php 

	session_start();
	include_once '../includes/connection.php';
		if (isset($_SESSION['logged_in'])) {

				if (isset($_POST['title'],$_POST['markdown'],$_POST['img_url'])) {
						$title = $_POST['title'];
						$markdown = addslashes($_POST['markdown']);
						$img_url = $_POST['img_url'] ?? null; 
						$description = $_POST['description'] ?? null;
						$seo_title = $_POST['seo_title'] ?? null;
						$author = $_POST['author'] ?? null;

						if (empty($title) or empty($markdown))
						{
							$error = "Title or content cannot be empty!";
						}
						else{
							$sql="INSERT INTO `post`(`title`, `seo_title`, `description`, `img_url`, `markdown`, `author`) VALUES ('$title','$seo_title', '$description', '$img_url', '$markdown', '$author' );";
							$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
							header('Location: index.php');
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
			<a href="index.php" id="logo">CMS</a><br>

			<h4>Add Article</h4>
			<?php if (isset($error)) { ?>
			<small style="color: #aa0000"><?php echo $error; ?></small>
			<?php } ?>
			<form action="add.php" method="post" autocomplete="off">
				<input type="text" name="title" placeholder="Title" /><br><br>
				<input type="text" name="seo_title" placeholder="Seo title" /><br><br>
				<input type="text" name="description" placeholder="Description" /><br><br>
				<input type="text" name="img_url" placeholder="Image URL" /><br><br>
				<textarea rows="15" cols="50" placeholder="Markdown" name="markdown"></textarea><br><br>
				<input type="text" name="author" placeholder="Author" /><br><br>
				<input type="submit" value="Add Article" style="display: block;">
			</form>

		</div>
	</body>
</html>

<?php		
		}
		
		else{
			header('Location: index.php');
		}
?>