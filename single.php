<?php

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
  header('Location: index.php');
  exit;
}

require_once 'includes/db.php';

$sql = $db->prepare('
  SELECT id, name, adr, lat, lng, rate_count, rate_total
  FROM dinobones
  WHERE id = :id
');

$sql->bindValue(':id', $id, PDO::PARAM_INT);
$sql->execute();
$dino = $sql->fetch();

if (empty($dino)) {
  header('Location: index.php');
  exit;
}

$title = $dino['name'];

if ($dino['rate_count'] > 0) {
  $rating = round($dino['rate_total'] / $dino['rate_count']);
} else {
  $rating = 0;
}

include 'includes/theme-top.php';

?>

<h1><?php echo $dino['name']; ?></h1>

<dl>
  <dt>Average Rating</dt><dd><meter value="<?php echo $rating; ?>" min="0" max="5"><?php echo $rating; ?> out of 5</meter></dd>
  <dt>Address</dt><dd><?php echo $dino['adr']; ?></dd>
  <dt>Longitude</dt><dd><?php echo $dino['lng']; ?></dd>
  <dt>Latitude</dt><dd><?php echo $dino['lat']; ?></dd>
</dl>

<h2>Rate</h2>
<ol class="rater">
  <li class="rater-level"><a href="rate.php?id=<?php echo $dino['id']; ?>&rate=1">★</a></li>
  <li class="rater-level"><a href="rate.php?id=<?php echo $dino['id']; ?>&rate=2">★</a></li>
  <li class="rater-level"><a href="rate.php?id=<?php echo $dino['id']; ?>&rate=3">★</a></li>
  <li class="rater-level"><a href="rate.php?id=<?php echo $dino['id']; ?>&rate=4">★</a></li>
  <li class="rater-level"><a href="rate.php?id=<?php echo $dino['id']; ?>&rate=5">★</a></li>
</ol>

<?php

include 'includes/theme-bottom.php';

?>
