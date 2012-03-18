<?php

require_once 'includes/db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$rate = filter_input(INPUT_GET, 'rate', FILTER_SANITIZE_NUMBER_INT);

if (empty($id) || $rate < 0 || $rate > 5) {
	header('Location: index.php');
	exit;
}

$sql = $db->prepare('
	SELECT id, votes_num, votes_total
	FROM dinobones
	WHERE id = :id
');
$sql->bindValue(':id', $id, PDO::PARAM_INT);
$sql->execute();
$rating = $sql->fetch();
$sql = null;

if (empty($rating)) {
	header('Location: index.php');
	exit;
}

$votes_num = $rating['votes_num'] + 1;
$votes_total = $rating['votes_total'] + $rate;

$sql = $db->prepare('
	UPDATE dinobones
	SET votes_num = :votes_num, votes_total = :votes_total
	WHERE id = :id
');
$sql->bindValue(':id', $id, PDO::PARAM_INT);
$sql->bindValue(':votes_num', $votes_num, PDO::PARAM_INT);
$sql->bindValue(':votes_total', $votes_total, PDO::PARAM_INT);
$sql->execute();

header('Location: index.php');
exit;
