<?php
	$cta_two_header = get_sub_field('cta_two_header');
	$cta_two_sub_header = get_sub_field('cta_two_sub_header');
	$cta_two_button = get_sub_field('cta_two_button');
	$cta_two_background_image = get_sub_field('cta_two_background_image');							
	$image_mobile = get_sub_field('image_mobile');
										
	$cta_two_form_url = get_sub_field('cta_two_form_url');
	$cta_two_form_button_text = get_sub_field('cta_two_form_button_text');
	$cta_two_form_button_id = get_sub_field('cta_two_form_button_id');
	$cta_two_form_input_text = get_sub_field('cta_two_form_input_text');
	$button_link = get_sub_field('button_link');
	$button_type = get_sub_field('button_type');
	$open_in_new_tab = get_sub_field('open_in_new_tab');
	$button_features = get_sub_field('button_features');
?>

<div class="cta_section_two">
	<?php if(!empty($cta_two_header)): ?>
											
	<img class="cta_two_background_image" src="<?php echo $cta_two_background_image['url'];?>" alt="<?php echo $cta_two_background_image['alt'];?>">

											
	<div class="cta_two_content">
		<h1 class="white"><?php echo $cta_two_header;?></h1>
		<p class="white"><?php echo $cta_two_sub_header;?></p>
												
		<?php if($button_type == 'single_button'){?>
		<div class="cta_btn btn_postion_div">
			<div class="btn_container">
				<?php if($open_in_new_tab == true):?>
				<a class="rev-btn btn greenButton" href="<?php echo $button_features['button_link']['url']; ?>" target="_blank">
				<?php else: ?>
				<a class="rev-btn btn greenButton" href="<?php echo $button_features['button_link']['url']; ?>">
				<?php endif; ?>
				<span class="cta_one_button_span"><?php echo $button_features['button_link']['title'];?></span>
				</a>
			</div>
		</div>
													
		<?php }elseif($button_type == 'button_and_input'){?>																	
			<form class="cta_two_form" method="GET" action="<?php echo $button_features['cta_two_form_url'];?>">
				
				<?php while ( have_rows( 'button_features' ) ) : the_row();?>
					<?php while ( have_rows( 'input_values' ) ) : the_row();?>
					<?php 
						$input_name = get_sub_field('input_name');
						$input_value = get_sub_field('input_value');
					?>
					<input type="hidden" name="<?php echo $input_name?>" value="<?php echo $input_value;?>" >
					<?php endwhile;?>
				<?php endwhile;?>
			
				<input id="zip" name="zipcode" placeholder="<?php echo $button_features['cta_two_form_input_text'];?>" type="text" pattern="[0-9]*">
				<?php if($open_in_new_tab == true): ?>
				<button class="rev-btn btn greenButton" type="submit" value="Find A Plan" formtarget="_blank">
				<?php else: ?>
				<button class="rev-btn btn greenButton" type="submit" value="Find A Plan" >
				<?php endif; ?>
					<span id="<?php echo $button_features['cta_two_form_button_id'];?>"><?php echo $button_features['cta_two_form_button_text'];?></span>
				</button>
			</form>
		<?php }elseif($button_type == 'none'){ ?>
			
		<?php }?>
	</div>
	
	<?php endif;?>
</div>
.