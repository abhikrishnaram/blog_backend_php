<?php 
		include_once 'includes/connection.php'; 
		include_once 'includes/articlequery.php';
		$article = new Article();
		$articles = $article->fetch_all();							 

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Blog CMS</title>
		<link rel="stylesheet" type="text/css" href="asset/style.css">
	</head>
	<body>
		<div class="container">
			<a href="index.php" id="logo">CMS</a>
			<ol>
				<?php foreach($articles as $article){ ?>
				<li>
					<a href="article.php?id=<?php echo $article['id']; ?>">
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
			</ol>
		</div>
		<a href="admin/index.php" id="ad">Admin &rarr;</a>
	</body>
</html>