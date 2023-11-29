<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<!-- article -->

	<article id="post-<?php the_ID(); ?>" class="loop_feed">

			<div class="article_box">
				<div class="thumbnail">
					<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
							<?php the_post_thumbnail(); // Declare pixel size you need inside the array ?>
					<?php endif; ?>
				</div>
						
				<div class="article_content">
		
					<h3><?php the_title(); ?></h3>
			
					<span class="date"><?php the_time('m.d.y'); ?></span>
					
					<?php html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>
					
					<a class="permalink_box lnk orange" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Read More</a>
					
				</div>
				
				
				
			</div>
			
	</article>

	<!-- /article -->

<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>
