<?php
/**
 * Block Name: Hero
 */

$id = 'block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$block_classes = [
	'block',
	'block__hero'
];

if( !empty($block['align']) ) {
    $block_classes[] = ' align'.$block['align'];
}

$image_mobile = get_field('image_mobile');
$vertical_mobile = get_field('vertical_mobile');
$horizontal_mobile = get_field('horizontal_mobile');
$image_desktop = get_field('image_desktop');
$vertical_desktop = get_field('vertical_desktop');
$horizontal_desktop = get_field('horizontal_desktop');
$title = get_field('title');
$text = get_field('text');
$link = get_field('link');
$text_color = get_field('text_color');
$text_color_hover = get_field('text_color_hover');
$text_pos = get_field('text_pos');
?>

<style type="text/css">
	#<?= $id ?> {
		color: <?= $text_color ?>;
	}
	#<?= $id ?> .btn {
		color: <?= $text_color ?>;
		border-color: <?= $text_color ?>;
	}
	#<?= $id ?> .btn::before {
		background-color: <?= $text_color ?>;
	}
	#<?= $id ?> .btn:hover {
		color: <?= $text_color_hover ?>;
	}
	#<?= $id ?> picture img {
		object-position: <?= $horizontal_mobile.' '.$vertical_mobile ?>;
	}
	@media screen and (min-width: 900px) {
		#<?= $id ?> picture img {
			object-position: <?= $horizontal_desktop.' '.$vertical_desktop ?>;
		}
	}
</style>
<div id="<?= $id ?>" class="<?= implode(' ', $block_classes) ?>">
	
	<div class="inner container-fluid">
		<div class="row justify-content-center">
			<div class="col col-md-10">

				<picture>
				    <source media="(min-width: 1200px)" data-srcset="<?= $image_desktop['sizes']['xl'] ?>, <?= $image_desktop['sizes']['xl_retina'] ?> 2x">
				    <source media="(min-width: 900px)" data-srcset="<?= $image_desktop['sizes']['lg'] ?>, <?= $image_desktop['sizes']['lg_retina'] ?> 2x">
				    <source media="(min-width: 600px)" data-srcset="<?= $image_mobile['sizes']['md'] ?>, <?= $image_mobile['sizes']['md_retina'] ?> 2x">
				    <source media="(min-width: 0px)" data-srcset="<?= $image_mobile['sizes']['sm'] ?>, <?= $image_mobile['sizes']['sm_retina'] ?> 2x">
				    <img class="lazyload" data-src="<?= $image_desktop['sizes']['xl'] ?>" alt="<?= $image_desktop['alt'] ?>">
				</picture>

				<div class="text-container">
					<?= ($title) ? '<h1 class="title">'.$title.'</h1>' : '' ?>
					<?= ($text) ? '<p class="text">'.$text.'</p>' : '' ?>
					<?= ($link) ? '<a class="btn" href="'.$link['url'].'"'.(($link['target']) ? 'target="_blank" rel="noopener noreferrer' : '').'>'.$link['title'].'</a>' : '' ?>
				</div>

			</div>
		</div>
	</div>

</div>