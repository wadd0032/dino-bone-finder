<?php

require_once 'includes/db.php';

$results = $db->query('
  SELECT id, name, adr, lat, lng, rate_count, rate_total
  FROM dinobones
  ORDER BY name ASC
');

include 'includes/theme-top.php';

?>

<ol class="dinos">
<?php foreach ($results as $dino) : ?>
  <?php
    if ($dino['rate_count'] > 0) {
      $rating = round($dino['rate_total'] / $dino['rate_count']);
    } else {
      $rating = 0;
    }
  ?>
  <li itemscope itemtype="http://schema.org/TouristAttraction" data-id="<?php echo $dino['id']; ?>">
    <a href="single.php?id=<?php echo $dino['id']; ?>" itemprop="name"><?php echo $dino['name']; ?></a>
    <span itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
      <meta itemprop="latitude" content="<?php echo $dino['lat']; ?>">
      <meta itemprop="longitude" content="<?php echo $dino['lng']; ?>">
    </span>
    <meter value="<?php echo $rating; ?>" min="0" max="5"><?php echo $rating; ?> out of 5</meter>
    <ol class="rater">
    <?php for ($i = 1; $i <= 5; $i++) : ?>
      <?php $class = ($i <= $rating) ? 'is-rated' : ''; ?>
      <li class="rater-level <?php echo $class; ?>">★</li>
    <?php endfor; ?>
    </ol>
  </li>
<?php endforeach; ?>
</ol>

<div id="map"></div>

<?php

include 'includes/theme-bottom.php';

?>
