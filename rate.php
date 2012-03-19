<?php

require_once 'includes/db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$rate = filter_input(INPUT_GET, 'rate', FILTER_SANITIZE_NUMBER_INT);

if (empty($id) || $rate < 0 || $rate > 5) {
	header('Location: index.php');
	exit;
}

$sql = $db->prepare('
	UPDATE dinobones
	SET rate_count = rate_count + 1, rate_total = rate_total + :rate
	WHERE id = :id
');
$sql->bindValue(':id', $id, PDO::PARAM_INT);
$sql->bindValue(':rate', $rate, PDO::PARAM_INT);
$sql->execute();

header('Location: index.php');
exit;
