<section class="section">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col col-md-10">
				
				<?php if (!have_posts()) : ?>
				  <div class="alert alert-warning">
				    Tyvärr hittades inga poster
				  </div>

				  <?php get_search_form(); ?>

				<?php endif; ?>

				<?php while (have_posts()) : the_post(); ?>

					<h1 class="heading margin-top-40 margin-bot-30"><?php the_title(); ?></h1>
					<p class="margin-bot-30"><?php the_content(); ?></p>

				<?php endwhile; ?>

				<?php the_posts_navigation(); ?>
				
			</div>
		</div>
	</div>