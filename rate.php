<?php

require_once 'includes/db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$rate = filter_input(INPUT_GET, 'rate', FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
	header('Location: index.php');
	exit;
}

if ($rate < 0 || $rate > 5) {
	header('Location: single.php?id=' . $id);
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

/*
  Set a cookie to remember the user has already voted.
  We have to remember the ID of every single thing they voted on
   and they must all be inside one single cookie--which is a string.
  So, we have to come up with a solution to store all the IDs
   and since we are storing the IDs, we may as well store what they rated.

  // http://www.flickr.com/photos/andyfox/2534644455/sizes/o/in/photostream/

  Our cookie will look something like this:
   1:4;5:3;6:2

  Or, translated:
   id:rate;id:rate;id:rate
*/

$cookie_content = $cookie_content . ';' . $id . ':' . $rate;

// http://php.net/setcookie
setcookie('dinobones_rated', $cookie_content, time() + 60 * 60 * 24 * 365, '/');

header('Location: single.php?id=' . $id);
exit;
