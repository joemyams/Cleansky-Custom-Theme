<div class="upper-footer">

	<div class="footer-logo">
		<?php $footer_logo = get_field('spanish_footer_logo','option');?>
		<?php $footer_logo_link = get_field('spanish_footer_logo_link','option');?>
		<a href="<?php echo $footer_logo_link['url'];?>">
			<img alt=" <?php echo $footer_logo['alt'];?>" src="<?php echo $footer_logo['url'];?>">
		</a>
	</div>
	<div class="footer-menu-container">
		<ul class="footer-menu">
			<?php while ( have_rows('spanish_menu_column','option') ) : the_row();?>
			<?php $footer_main_link = get_sub_field('spanish_footer_main_link','option');?>
			<?php $footer_main_link_no_url = get_sub_field('spanish_footer_main_link_no_url','option');?>
			<?php $url_or_no_url = get_sub_field('spanish_url_or_no_url', 'option');?>
			<?php if($url_or_no_url == true):?>
				<li class="footer-main-li">
					<a class="footer-main lnk"><?php echo $footer_main_link_no_url;?></a>
			<?php else:?>
				<li class="footer-main-li">
					<a class="footer-main lnk" href="<?php echo $footer_main_link['url'];?>"><?php echo $footer_main_link['title'];?></a>
			<?php endif;?>
					<ul class="footer-sub-menu">
					<?php 
						if( have_rows('spanish_sub_menu','option') ):
						while ( have_rows('spanish_sub_menu','option') ) : the_row();
					?>
						<?php $sub_link = get_sub_field('spanish_sub_link','option'); ?>
						<li>
							<a class="footer-sub lnk" href="<?php echo $sub_link['url'];?>"><?php echo $sub_link['title'];?></a>
						</li>
					<?php endwhile;?>
					<?php endif;?>
					</ul>

				
				</li>
			
			<?php endwhile;?>
			
			<li class="footer-main-li contact-column">
				<?php $contact_section_title = get_field('spanish_contact_section_title','option');?>
				<?php $footer_address = get_field('spanish_footer_address','option');?>
				<?php $footer_phone_numbers = get_field('spanish_footer_phone_numbers','option');?>
				
				<a class="lnk footer-main" href="<?php echo $contact_section_title['url'];?>"><?php echo $contact_section_title['title'];?></a>
				<p><?php echo $footer_address;?></p>
				
				<?php while ( have_rows('spanish_footer_phone_numbers', 'options') ): the_row();?>
					<?php $footer_phone = get_sub_field('spanish_footer_phone','option');?>
					<?php $state_name = get_sub_field('spanish_state_name','option');?>
					
					<?php if(!empty($state_name)): ?>
						<span class="state_name"><?php echo $state_name;?></span>
					<?php endif;?>
					<a class="lnk footer-phone" href="tel:<?php echo $footer_phone;?>">
						
						<?php echo $footer_phone;?>
					</a>
				<?php endwhile;?>
					
			</li>
		</ul>
		
	</div>
</div>
<div class="lower-footer">
	<?php $legal_text_left = get_field('spanish_legal_text_left','option');?>
	
	<div class="legal"><?php echo $legal_text_left;?></div>

	<div class="legal container">
		
		<p class="license-text">Licensed in</p>
			<ul class="tab_navigation">
			<?php while(have_rows('spanish_legal_text_right','option')) : the_row();?>
				<?php $state_region = get_sub_field('spanish_state_region');?>
				
					<li>
						<a><?php echo $state_region?></a><i>,</i>
					</li>
					
			<?php endwhile;?>
			</ul>
			<div class="tab_container_area">
				<?php while(have_rows('spanish_legal_text_right','option')) : the_row();?>
				<?php $state_region_info = get_sub_field('spanish_state_region_info');?>
				
					<div class="tab_container">
						<p><?php echo $state_region_info?></p>
					</div>
					
				<?php endwhile;?>
				
			</div>
		
	</div>
	
	
</div>






