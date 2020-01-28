<?php 
	$seen = (isset($_COOKIE['seen_cookie_box'])) ? $_COOKIE['seen_cookie_box'] : 'null';
	$cookie_text = ( function_exists('get_field') ) ? get_field( 'cookie_text', 'options' ) : '';
	$cookie_btn = ( function_exists('get_field') ) ? get_field( 'cookie_btn', 'options' ) : '';

	if( $seen !== 'seen' && $cookie_text ) :
?>
	<div class="cookie-container">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col col-md-10">
					<div class="cookie-content">
						<div class="text-container">
							<?= $cookie_text; ?>
						</div>
						<div id="cookie-close" class="close-btn">
							<?= ( $cookie_btn ) ? $cookie_btn : 'Jag godkänner' ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>