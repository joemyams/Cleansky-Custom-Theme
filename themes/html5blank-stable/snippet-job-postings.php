<?php
   $the_query = new WP_Query( array('posts_per_page'=>3,
	   'post_type'=>'job_posting',
	   'order' => 'ASC',
	   'paged' => get_query_var('paged') ? get_query_var('paged') : 1)
   );
?>
<main role="main">
	<section>
		<div class="job_posts_feed">
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<!-- article -->
			<article id="post-<?php the_ID(); ?>">
				<div class="job_posts_container">

					<div class="job_post lightGrayBack">
						<h3><?php the_title(); ?></h3>

						<a class="lnk orange" href="<?php the_permalink(); ?>" class="lnk">Read More</a>

					</div>
				</div>
			</article>
		<?php endwhile; ?>	
		</div>
	</section>
</main>
<?php wp_reset_postdata(); ?>