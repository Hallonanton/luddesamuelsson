<?php
/**
 * Block Name: Biljettförsäljning
 */

$id = 'block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$show = get_field('show');
$title = 'Köp biljetter till "'.$show->name.'"';
$args = array(
	'posts_per_page'   	=> -1,
	'order'			        => 'ASC',
	'orderby'			      => 'meta_value_num',
	'meta_key'					=> 'date',
	'post_type'        	=> 'shows',
	'post_status'      	=> 'publish',
	'suppress_filters' 	=> true 
);
$posts_array = get_posts( $args );
?>

<div id="<?= $id ?>" class="block block__tickets">
	<h2 class="block-title"><?= $title ?></h2>

	<?php if ( $posts_array ) : ?>

		<ul class="show-list">
			<?php foreach( $posts_array as $post ) : ?>

				<?php 
					$ID = $post->ID;
					$show_name = ( $n = get_field('show_name', $ID) ) ? $n : $show->name;
					$tickets = get_field('tickets', $ID);
					$tickets_link = get_field('tickets_link', $ID);
					$google_maps = get_field('google_maps', $ID);
					$google_maps_link = ( $google_maps ) ? 'http://maps.google.com/maps?q='.$google_maps['lat'].','.$google_maps['lng']	: null;
					$city = get_field('city', $ID);
					$place = get_field('place', $ID);
					$time = get_field('time', $ID);
					$date = get_field('date', $ID);
					$format_date = ($date) ? date_format(date_create($date),"d/n") : null;
					$comment = get_field('comment', $ID);
					$link_id = str_replace(' ', '-', $city.'-'.$place.'-'.$format_date);
				?>

				<li class="show-item <?= $tickets['value'] ?>">
					<time class="date" datetime="<?= $date ?>">
						<?= $format_date ?>
					</time>
					<div class="content">
						<h3 class="show-title"><?= $show_name ?></h3>
						<h4 class="info-title">
							<?= ($google_maps_link) ? '<a href="'.$google_maps_link.'" title="Visa i Google Maps" target="_blank" rel="noopener noreferrer">' : '' ?>
								<?= $city.' - '.$place; ?>
							<?= ($google_maps_link) ? '</a>' : '' ?>
							<?= ($time) ? '<time>'.$time.'</time>' : '' ?>
						</h4>
						
						<?= ($comment) ? '<p class="comment">'.$comment.'</p>' : '' ?>
					</div>
					<div class="cta">
						<a id="<?= $link_id ?>" class="show-ticket-link btn btn--icon" href="<?= $tickets_link ?>" title="<?= $tickets ?>" target="_blank" rel="noopener noreferrer">
							<?= $tickets['label'] ?>
							<?= file_get_contents( get_template_directory_uri().'/dist/images/tickets.svg' ); ?>
						</a>
					</div>
				</li>

			<?php endforeach; ?>	
		</ul>

	<?php else : ?>
		<p>Det finns inga biljetter till denna föreställning tillagda just nu.</p>
	<?php endif; ?>
</div>