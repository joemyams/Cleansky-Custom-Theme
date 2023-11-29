<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<div class="blog_title">
					<h1 class="flourish">
						<?php echo file_get_contents( get_template_directory_uri() . '/img/up-swoosh.svg');?>
						<?php single_cat_title(); ?>
						<?php echo file_get_contents( get_template_directory_uri() . '/img/down-swoosh.svg');?>
					</h1>
		</div>
		<section class="blog_container">
			<div>
				<div class="blog_loop_container">
					<?php get_template_part('loop'); ?>
				</div>
				<?php get_template_part('pagination'); ?>
			</div>
			<div class="sidebar_container">
					<?php get_sidebar(); ?>
			</div>
			
		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>
