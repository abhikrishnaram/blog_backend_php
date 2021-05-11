<?php
		include_once 'includes/connection.php'; 
		include_once 'includes/articlequery.php';
		include_once 'includes/ParseDown.php';
		$article = new Article;
		$Parsedown = new Parsedown();

		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$data = $article->fetch_data($id);

			//print_r($data);
		
?>

<html>
	<head>
		<title>Blog CMS</title>
		<link rel="stylesheet" type="text/css" href="asset/style.css">
	</head>
	<body>
		<div class="container">
			<a href="index.php" id="logo">CMS</a>

			<h4><?php echo $data['title']; ?></h4>
			-<small>posted 
				<?php echo date('l jS', $data['date']); ?>
			</small>
			<img src="<?php echo$data['img_url']?>">
			<p><?php echo $data['description']; ?></p>
			<br>
			<br>
			<p>
				<?php 
					echo $Parsedown->text($data['markdown']); 
				?>					
			</p>
			<a href="index.php">&larr; Back</a>
		</div>
	</body>
</html>

<?php 
		}
	else
		{
			header('Location: index.php');
			exit();
		}

?>		