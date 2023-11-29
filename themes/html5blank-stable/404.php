<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>

			<!-- article -->
			<article id="post-404">

				<h1><?php _e( 'Page not found', 'html5blank' ); ?></h1>
					
					<div class="btn_container">
						<a class="btn orangeButton" href="<?php echo home_url(); ?>">
							<?php echo file_get_contents( get_template_directory_uri() . '/img/up-swoosh.svg');?>
							<span>Return Home</span>
							<?php echo file_get_contents( get_template_directory_uri() . '/img/down-swoosh.svg');?>
						</a>
					</div>

	

			</article>
			<!-- /article -->

		</section>
		<!-- /section -->
	</main>


<?php get_footer(); ?>
