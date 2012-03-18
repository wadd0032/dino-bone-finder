<?php

require_once 'includes/db.php';

$results = $db->query('
	SELECT id, name, adr, lat, lng, votes_num, votes_total
	FROM dinobones
	ORDER BY name ASC
');

include 'includes/theme-top.php';

?>

<ol class="dinos">
<?php foreach ($results as $dino) : ?>
	<?php
		if ($dino['votes_num'] > 0) {
			$rating = ($dino['votes_total'] / ($dino['votes_num'] * 5)) * 5;
		} else {
			$rating = 0;
		}
	?>
	<li itemscope itemtype="http://schema.org/TouristAttraction">
		<a href="single.php?id=<?php echo $dino['id']; ?>" itemprop="name"><?php echo $dino['name']; ?></a>
		<span itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
			<meta itemprop="latitude" content="<?php echo $dino['lat']; ?>">
			<meta itemprop="longitude" content="<?php echo $dino['lng']; ?>">
		</span>
		<meter value="<?php echo $rating; ?>" min="0" max="5"><?php echo $rating; ?> out of 5</meter>
		<ol class="rater">
		<?php for ($i = 1; $i <= 5; $i++) : ?>
			<?php $class = ($i <= $rating) ? 'is-rated' : ''; ?>
			<li><a href="rate.php?id=<?php echo $dino['id']; ?>&rate=<?php echo $i; ?>" class="rater-level <?php echo $class; ?>">★</a></li>
		<?php endfor; ?>
		</ol>
	</li>
<?php endforeach; ?>
</ol>

<div id="map"></div>

<?php

include 'includes/theme-bottom.php';

?>
