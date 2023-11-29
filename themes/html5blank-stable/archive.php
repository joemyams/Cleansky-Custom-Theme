
<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section class="blog_container">
			<?php
				if(is_post_type_archive('learning_center')):
				$slug = get_page_by_path( 'learning_center' ); 
				$post_id = $slug->ID;
			?>
			<div>
				<div class="blog_title_container">
					<div class="blog_title">
						<h1 class="flourish">
							<?php echo file_get_contents( get_template_directory_uri() . '/img/up-swoosh.svg');?>
								<?php post_type_archive_title(); ?>
							<strong><?php echo term_description() ?></strong>
							<?php echo file_get_contents( get_template_directory_uri() . '/img/down-swoosh.svg');?>
						</h1>
					</div>
					<div class="sidebar_container">
						<?php if(have_rows('lcfs_category_menu','options')):?>
						
							<div class="sidebar">			
								<h3 class="category_title white darkBlueBack">Categories</h3>
								
								<div class="category_list lightGrayBack">
								<?php while (have_rows('lcfs_category_menu','options')) : the_row();?>
									<?php $lcfs_category = get_sub_field('lcfs_category');?>
										
										<a class="lnk darkBlue" href="<?php echo esc_url( get_term_link( $lcfs_category ) ); ?>" class="lnk">
											<?php echo esc_html( $lcfs_category->name ); ?>
										</a>
										
									<?php endwhile; ?>
								</div>
							</div>
							
						<?php endif; ?>

					</div>
				</div>
			</div>
			
			<div class="blog_loop_container">
				<?php get_template_part('loop'); ?>
	
				<?php get_template_part('pagination'); ?>
			</div>
			
			<?php
				elseif(is_post_type_archive('job_posting')):
				$slug = get_page_by_path( 'job_posting' ); 
				$post_id = $slug->ID;
				
			?>	
				
			<div>
				<div class="blog_title_container">
					<div class="blog_title">
						<h1 class="flourish">
							<?php echo file_get_contents( get_template_directory_uri() . '/img/up-swoosh.svg');?>
							<?php post_type_archive_title(); ?>
							<strong><?php echo term_description() ?></strong>
							<?php echo file_get_contents( get_template_directory_uri() . '/img/down-swoosh.svg');?>
						</h1>
					</div>

				</div>
			</div>
			
			<div class="blog_loop_container">
				<?php get_template_part('loop'); ?>
	
				<?php get_template_part('pagination'); ?>
			</div>
			
			<?php endif; ?>
			
		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>
