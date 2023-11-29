<?php get_header(); ?>

	<main role="main">
	<!-- section -->
	<section>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<!-- article -->
		<article id="post-<?php the_ID(); ?>" class="single_post">
			<div class="post_wrapper">
				<div class="post_top_container blueBack">
					<div class="post_title_container ">
						<div class="post_title">
							<h1 class="white"><?php the_title(); ?></h1>
				
							<h3 class="date white"><?php the_time('m.d.y'); ?></h3>
						</div>
					</div>
					<div class="post_image_container">
						<!-- post thumbnail -->
						<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
							<?php the_post_thumbnail(); // Fullsize image for the single post ?>
						<?php endif; ?>
						<!-- /post thumbnail -->
					</div>
					<!-- /post details -->					
				</div>
				<div class="post_content">
					<?php the_content(); // Dynamic Content ?>
				</div>
			</div>

		</article>
		<!-- /article -->

	<?php endwhile; ?>

	<?php else: ?>

		<!-- article -->
		<article>

			<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>

	</section>
	<!-- /section -->
	</main>

<?php get_footer(); ?>

