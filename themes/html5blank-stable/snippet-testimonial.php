<div class="testimonial_slider_container">
	<?php while ( have_rows('testimonials','option') ) : the_row();
		$testimonial_image = get_sub_field('testimonial_image', 'option');
		$testimonial_quote = get_sub_field('testimonial_quote', 'option');
		$testimonial_name = get_sub_field('testimonial_name', 'option');
	?>
											
	<div class="testimonial_slide whiteBack">
		<div class="testimonial_image">
			<img src="<?php echo $testimonial_image['url'];?>" alt="<?php echo $testimonial_image['alt'];?>">
		</div>
		<div class="testimonial-content"><?php echo $testimonial_quote;?>
		<p><?php echo $testimonial_name;?></p></div>
	</div>
											
	<?php endwhile;?>
											
</div>
