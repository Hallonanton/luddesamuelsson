<?php
/**
 * Block Name: Biljettförsäljning
 */

$show = get_field('show');
$title = 'Köp biljetter till "'.$show->name.'"';
$args = array(
	'posts_per_page'   => -1,
	'post_type'        => 'shows',
	'post_status'      => 'publish',
	'suppress_filters' => true 
);
$posts_array = get_posts( $args );
?>

<div>
	<h2><?= $title ?></h2>

	<?php if ( $posts_array ) : ?>

		<ul>
			<?php foreach( $posts_array as $key => $post ) : ?>

				<?php 
					$ID = $post->ID;
					$city = get_field('city', $ID);
					$place = get_field('place', $ID);
					$time = get_field('time', $ID);
					$date = get_field('date', $ID);
				?>

				<li>
					<h3><?= $date.' '.$show->name ?><?= ( $key === 0 ) ? ' - Premiär!' : '' ?></h3>
					<h4><?= $city.' - '.$place.' '.$time; ?></h4>
				</li>

			<?php endforeach; ?>	
		</ul>

	<?php else : ?>
		<p>Det finns inga biljetter till denna föreställning tillagda just nu.</p>
	<?php endif; ?>
</div>