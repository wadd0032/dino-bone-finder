<?php

require_once '../includes/users.php';

if (!user_is_signed_in()) {
	header('Location: sign-in.php');
	exit;
}

require_once '../includes/db.php';

$results = $db->query('
	SELECT id, name, adr, lat, lng, rate_count, rate_total
	FROM dinobones
	ORDER BY name ASC
');

include_once '../includes/theme-top.php';

?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8" />
	<title>Admin</title>
</head>

<body>

<a href="sign-out.php">Sign Out</a>

	<ol>
		<?php foreach ($results as $garden) : ?>
			<li>
				<?php echo $garden['name']; ?>
				&bull;
				<a href="edit.php?id=<?php echo $garden['id']; ?>">Edit</a>
				&bull;
				<a href="delete.php?id=<?php echo $garden['id']; ?>">Delete</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>

<?php

include_once '../includes/theme-bottom.php';

?>