<div class="container-fluid">
	<div class="row justify-content-center">
		<article class="col col-md-10 page-container">
			<?php 
				if ( have_posts() ) : 
					while ( have_posts() ) : the_post();
						the_content();
					endwhile;
				endif;
			?>
		</article>
	</div>
</div>