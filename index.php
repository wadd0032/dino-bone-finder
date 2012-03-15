<?php

require_once 'includes/db.php';

$results = $db->query('
	SELECT id, name
	FROM dinobones
	ORDER BY name ASC
');

include 'includes/theme-top.php';

?>

<ul>
<?php foreach ($results as $dino) : ?>
	<li>
		<a href="single.php?id=<?php echo $dino['id']; ?>"><?php echo $dino['name']; ?></a>
	</li>
<?php endforeach; ?>
</ul>

<?php

include 'includes/theme-bottom.php';

?>
