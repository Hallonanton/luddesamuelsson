<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

	<?php /*
		$google_maps_key = get_field( 'google_maps_key', 'options' ); 
		if( $google_maps_key ) :
			echo '<script src="https://maps.googleapis.com/maps/api/js?key='.$google_maps_key.'"></script>';
		endif;
	*/ ?>

	<!--[if IE]>
	<script src="<?php echo get_template_directory_uri().'/assets/scripts/html5shiv.js'; ?>"></script>
    <![endif]-->

</head>

