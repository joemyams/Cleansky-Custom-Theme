<?php get_header(); ?>
	
	<main role="main">
		<!-- section -->
		<section class="blog_container">
			
			<div class="blog_title blueBack">
				<h1 class="white"><?php echo sprintf( __( '%s Search Results for ', 'html5blank' ), $wp_query->found_posts ); echo get_search_query(); ?></h1>
			</div>
			
			<div class="blog_loop_container">
				<?php get_template_part('loop'); ?>
	
				<?php get_template_part('pagination'); ?>
			</div>

		</section>
		<!-- /section -->
	</main>


<?php get_footer(); ?>
