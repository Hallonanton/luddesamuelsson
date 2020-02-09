<footer id="footer" class="footer container-fluid">

	<?php wp_nav_menu([
		'theme_location' => 'footer_menu',
		'container'			=> false,
		'menu_class'	=> 'menu-list link-list'
	]); ?>

	<?php output_socialmedia(); ?>

</footer>