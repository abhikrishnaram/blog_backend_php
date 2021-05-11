<?php 

	session_start();
	include_once '../includes/connection.php';
	include_once '../includes/articlequery.php';
		$article = new Article();
		
		if (isset($_SESSION['logged_in'])) {
				if (isset($_POST['update'])) {
					//echo "<pre>";
					//var_dump($_POST);					
					//echo "</pre>";
					$id = $_POST['id'];
					$title = $_POST['title'];
					$markdown = addslashes($_POST['markdown']);
					$img_url = $_POST['img_url'] ?? null; 
					$description = $_POST['description'] ?? null;
					$seo_title = $_POST['seo_title'] ?? null;
					$author = $_POST['author'] ?? null;

					$sql="UPDATE `post` SET `title`='$title',`seo_title`='$seo_title',`description`='$description',`img_url`='$img_url',`markdown`='$markdown',`author`='$author' WHERE `id`='$id'";
					$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));									
					if(mysqli_affected_rows($conn)==1){
						$msg = "update Successfull";
						header('Location: update.php');

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

			<h4>Update Article</h4>

		<?php
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				$data = $article->fetch_data($id);							
		?>
			<?php if (isset($error)) { ?>
				<small style="color: #aa0000"><?php echo $error; ?></small>
			<?php } ?>

			<form action="<?php $_PHP_SELF ?>" method="POST" autocomplete="off">
				<input type="text" name="id" placeholder="ID" value="<?php echo($data["id"]); ?>"/><br><br>
				<input type="text" name="title" placeholder="Title" value="<?php echo($data["title"]); ?>" /><br><br>
				<input type="text" name="seo_title" placeholder="Seo title" value="<?php echo($data["seo_title"]); ?>" /><br><br>
				<input type="text" name="description" placeholder="Description" value="<?php echo($data["description"]); ?>"/><br><br>
				<input type="text" name="img_url" placeholder="Image URL" value="<?php echo($data["img_url"]); ?>"/><br><br>
				<textarea rows="15" cols="50" placeholder="Markdown" name="markdown"><?php echo($data["markdown"]); ?></textarea><br><br>
				<input type="text" name="author" placeholder="Author" value="<?php echo($data["author"]); ?>"/><br><br>
				<input type="submit" name="update" value="Update Article" style="display: block;">
			</form>
		<?php										
			}else{
				$articles = $article->fetch_all();				
		?>	
			
			<?php if (isset($msg)) { ?>
				<small style="color: green"><?php echo $msg; ?></small>
			<?php } ?>
			
			<?php foreach($articles as $article){ ?>
				<li>
					<a href="update.php?id=<?php echo $article['id']; ?>">
						<?php echo $article['title']; ?>
					</a>
					<small>- posted on
						<?php 
								$db = $article['date'];
								$timestamp = strtotime($db);
								echo date("m-d-Y", $timestamp); 
						?>							
					</small>
				</li><br>
			<?php } ?>

		<?php 				
			}
		?>
		</div>
	</body>
</html>

<?php		
		}else{
			header('Location: index.php');
		}
?>