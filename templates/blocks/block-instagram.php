<?php
/**
 * Block Name: Instagram
 */

$id = 'block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$access_token = get_field('instagram_access_token', 'options');
$instagram_feed = get_instagram_feed($access_token, 8);
?>

<?php if ( $instagram_feed ) : ?>
	<ul id="<?= $id ?>" class="block block__instagram">
		<?php foreach( $instagram_feed as $image_obj ) : ?>

			<?php 
				$link = $image_obj->link;
				$src = $image_obj->images->standard_resolution->url;
			?>

			<li class="instagram-item">
				<a href="<?= $link ?>" target="_blank" rel="noopener noreferrer">					
					<img class="lazyload" data-src="<?= $src ?>">
				</a>
			</li>

		<?php endforeach; ?>
	</ul>
<?php endif; ?>