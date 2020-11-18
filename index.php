<?php
require_once 'app/init.php';

if (isset($_GET['q'])) {
	$q = $_GET['q'];

	$query = $es->search([
		'body' => [
			'query' => [
				'bool' => [
					'should' => [
						'match' => ['title' => $q],
						'match' => ['body' => $q]
					]
				]
			]
		]
	]);

	echo '<pre>', print_r($query), '</pre>';

	die();

	if($query['hits']['total'] >=1) {
		$result = $query['hits']['hits'];
	}
}

?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Search | ES</title>
		<link rel="stylesheet" href="css/main.css">
	</head>
	<body>
		<form action="index.php" method="get" autocomplete="off">
			<label>
				Search for Something
				<input type="text" name="q">
			</label>

			<input type="submit" value="Search">
		</form>

		<?php
		if(isset($resul)) {
			foreach($result as $r) {
			?>
				<div class="result">
					<a href="#<?php echo $r['_id']; ?>"><?php echo $r['_source']['title']; ?></a>
					<div class="result-keywords"><?php echo implode(', ', $r['_source']['keywords']); ?></div>
				</div>
				<?php

			}
		}
		?>
	</body>
</html>