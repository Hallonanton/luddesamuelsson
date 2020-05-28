<?php 
/*==============================================================================

  # output_socialmedia

==============================================================================*/

/*==============================================================================
  # output_socialmedia
==============================================================================*/

function output_socialmedia() {

	$facebook = get_field('facebook', 'options');
	$instagram = get_field('instagram', 'options');
	$twitter = get_field('twitter', 'options');
	$youtube = get_field('youtube', 'options');
	$snapchat = get_field('snapchat', 'options');
	$get_template_directory = get_template_directory();

?>
	<ul class="menu-list social-list">

		<?php if ( $facebook ) : ?>
			<li class="menu-item">
					<a class="icon-link" href="<?= $facebook ?>" target="_blank" rel="noopener noreferrer">
					<?= file_get_contents( $get_template_directory.'/dist/images/facebook.svg' ); ?>
				</a>
			</li>
		<?php endif; ?>

		<?php if ( $twitter ) : ?>
			<li class="menu-item">
					<a class="icon-link" href="<?= $twitter ?>" target="_blank" rel="noopener noreferrer">
					<?= file_get_contents( $get_template_directory.'/dist/images/twitter.svg' ); ?>
				</a>
			</li>
		<?php endif; ?>

		<?php if ( $instagram ) : ?>
			<li class="menu-item">
					<a class="icon-link" href="<?= $instagram ?>" target="_blank" rel="noopener noreferrer">
					<?= file_get_contents( $get_template_directory.'/dist/images/instagram.svg' ); ?>
				</a>
			</li>
		<?php endif; ?>

		<?php if ( $youtube ) : ?>
			<li class="menu-item">
					<a class="icon-link" href="<?= $youtube ?>" target="_blank" rel="noopener noreferrer">
					<?= file_get_contents( $get_template_directory.'/dist/images/youtube.svg' ); ?>
				</a>
			</li>
		<?php endif; ?>

		<?php if ( $snapchat ) : ?>
			<li class="menu-item">
					<a class="icon-link" href="<?= $snapchat ?>" target="_blank" rel="noopener noreferrer">
					<?= file_get_contents( $get_template_directory.'/dist/images/snapchat.svg' ); ?>
				</a>
			</li>
		<?php endif; ?>

	</ul>
<?php }
	
?>