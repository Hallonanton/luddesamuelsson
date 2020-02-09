<?php
/**
 * Block Name: Instagram
 */

$instagram_id = get_field('instagram_id');
$client_id = get_field('client_id');
$request_id = "https://api.instagram.com/v1/users/".$instagram_id."/media/recent/?client_id=".$client_id;


$placeholder_array = [
	[
		'src' 	=> '/wp-content/uploads/2020/02/desktop-1600x1071.jpg',
		'link'	=> '/',
		'alt'		=> 'Alt-text'
	],
	[
		'src' 	=> '/wp-content/uploads/2020/02/desktop-1600x1071.jpg',
		'link'	=> '/',
		'alt'		=> 'Alt-text'
	],
	[
		'src' 	=> '/wp-content/uploads/2020/02/desktop-1600x1071.jpg',
		'link'	=> '/',
		'alt'		=> 'Alt-text'
	],
	[
		'src' 	=> '/wp-content/uploads/2020/02/desktop-1600x1071.jpg',
		'link'	=> '/',
		'alt'		=> 'Alt-text'
	],
	[
		'src' 	=> '/wp-content/uploads/2020/02/desktop-1600x1071.jpg',
		'link'	=> '/',
		'alt'		=> 'Alt-text'
	],
	[
		'src' 	=> '/wp-content/uploads/2020/02/desktop-1600x1071.jpg',
		'link'	=> '/',
		'alt'		=> 'Alt-text'
	],
	[
		'src' 	=> '/wp-content/uploads/2020/02/desktop-1600x1071.jpg',
		'link'	=> '/',
		'alt'		=> 'Alt-text'
	],
	[
		'src' 	=> '/wp-content/uploads/2020/02/desktop-1600x1071.jpg',
		'link'	=> '/',
		'alt'		=> 'Alt-text'
	],
	[
		'src' 	=> '/wp-content/uploads/2020/02/desktop-1600x1071.jpg',
		'link'	=> '/',
		'alt'		=> 'Alt-text'
	],
	[
		'src' 	=> '/wp-content/uploads/2020/02/desktop-1600x1071.jpg',
		'link'	=> '/',
		'alt'		=> 'Alt-text'
	]
];

?>

<?php if ( $placeholder_array ) : ?>
	<ul class="block block__instagram">
		<?php foreach( $placeholder_array as $item ) : ?>

			<li class="instagram-item">
				<a href="<?= $item['link'] ?>" target="_blank" rel="noopener noreferrer">					
					<img class="lazyload" data-src="<?= $item['src'] ?>" alt="<?= $item['alt'] ?>">
				</a>
			</li>

		<?php endforeach; ?>
	</ul>
<?php endif; ?>