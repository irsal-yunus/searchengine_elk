<?php
require_once 'app/init.php';

if (!empty($_POST)) {
	if(isset($_POST['title'], $_POST['body'], $_POST['keywords'])) {

		$title 		= $_POST['title'];
		$body 		= $_POST['body'];
		$keywords 	= explode(',', $_POST['keywords']);

		$indexed = $es->index([
			'index' => 'articles',
			'type'	=> 'articles',
			'body'  => [
				'title' => $title,
				'body'  => $body,
				'keywords' => $keywords
			]
		]);
	}
}
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Add | ES</title>
		<link rel="stylesheet" href="css/main.css">
	</head>
	<body>
		<form action="add.php" method="post" autocomplete="off">
			<div>
				<label>
					Title
					<input type="text" name="title">
				</label>				
			</div>
			<br>
			<div>
				<label>
					Body
					<textarea name="body" rows="8"></textarea>
				</label>				
			</div>
			<br>
			<div>
				<label>
					Keywords
					<input type="text" name="keywords" placeholder="comma, "></textarea>
				</label>				
			</div>
			<br>
				<input type="submit" value="Search">
			</div>
		</form>
	</body>
</html>