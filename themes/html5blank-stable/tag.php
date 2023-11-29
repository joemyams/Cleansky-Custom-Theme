<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section class="blog_container">
			
			<div class="blog_title blueBack">
				<h1 class="white"><?php _e( 'Tag Archive: ', 'html5blank' ); echo single_tag_title('', false); ?></h1>
			</div>
			
			<div class="blog_loop_container">
				<?php get_template_part('loop'); ?>
	
				<?php get_template_part('pagination'); ?>
			</div>

		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>
