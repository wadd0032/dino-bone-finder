<?php

require_once 'includes/db.php';

$results = $db->query('
	SELECT id, name
	FROM dinobones
	ORDER BY name ASC
');

?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Dinosaurs Bones!</title>
</head>
<body>

	<ul>
	<?php foreach ($results as $dino) : ?>
		<li>
			<a href="single.php?id=<?php echo $dino['id']; ?>"><?php echo $dino['name']; ?></a>
		</li>
	<?php endforeach; ?>
	</ul>

</body>
</html>
