	
	<div class="upper-strip darkBlueBack white">
		
		<?php $spanish_translation_link = get_field('spanish_translation_link'); ?>
		
		<?php if($spanish_translation_link): ?>
		<div class="translation_link_container spanish">
			<div class="btn_translation">
				<a class="btn orangeButtonHollow translation_link" href="<?php echo $spanish_translation_link['url'];?>">
					<span>English</span>
				</a>
			</div>
		</div>
		<?php endif; ?>
		
		<?php
			
			$nav_phone_numbers = get_field('spanish_nav_phone_numbers','option');
			$login_button = get_field('spanish_login_button','option');
		?>
		<div class="phone_link_container">
		<?php while ( have_rows('spanish_nav_phone_numbers','option') ) : the_row();?>
		
			<?php $phone_link = get_sub_field('spanish_phone_link','option');?>
			<?php $state_name = get_sub_field('spanish_state_name', 'option');?>
			
			<a class="lnk phone_link white" href="tel:<?php echo $phone_link;?>">
				<?php if(!empty($state_name)): ?>
				<span class="state_name"><?php echo $state_name;?>: </span>
				<?php endif; ?>
				<span><?php echo $phone_link;?></span>
				
			</a>
			
		<?php endwhile;?>
		</div>
		
		<div class="btn_wrapper">
		<a class="btn greenButton login_btn white" href="<?php echo $login_button['url'];?>">									
			<span><?php echo $login_button['title'];?></span>
		</a>
		</div>
	</div>
	
	<div class="lower-strip lightGrayBack">
		<div class="nav-logo">
			<?php $nav_logo = get_field('spanish_nav_logo','option');?>
			<?php $nav_logo_link = get_field('spanish_nav_logo_link', 'option'); ?>
			<a href="<?php echo $nav_logo_link['url'];?>">
				<img src="<?php echo $nav_logo['url']; ?>" alt="Logo" class="logo-img">
			</a>
		</div>
		
		<ul class="main_menu lightGrayBack">
			<?php
			while ( have_rows('spanish_lower_strip_menu','option') ) : the_row();
	
				$url_or_no_url = get_sub_field('spanish_url_or_no_url','option');
				$main_link = get_sub_field('spanish_main_link','option');
				$main_link_no_url = get_sub_field('spanish_main_link_no_url','option');
				
			if($url_or_no_url == true): ?>
			<li class="main_menu_link">
				<a class="main lnk"><?php echo $main_link_no_url; ?></a>
			<?php else: ?>
			<li class="main_menu_link">
				<a class="main lnk" href="<?php echo $main_link['url']; ?>"><?php echo $main_link['title']; ?></a>
			<?php endif; ?>
							
				<?php if( have_rows('spanish_sub_link_menu','option') ): ?>
				<ul class="sub_menu lightGrayBack">
					<?php while ( have_rows('spanish_sub_link_menu','option') ) : the_row();
			
						$sub_link = get_sub_field('spanish_sub_link','option');
					?>
					<li class="sub_menu_link">
						<a class="sub lnk" href="<?php echo $sub_link['url'];?>"><?php echo $sub_link['title'];?></a>
					</li>
					<?php endwhile; ?>
				</ul>
				<?php endif; ?>
				
			</li>
			<?php endwhile; ?>
		</ul>
		
		<div class="hamburger darkBlueFill">
			<?php echo file_get_contents( get_template_directory_uri() . '/img/hamburger.svg');?>
		</div>
		
	</div>
	
	<div class="menu_background"></div>

	
	
<script type="text/javascript">
	
	jQuery(".hamburger").click(function(){
        jQuery("nav").toggleClass("open");
    });
    
    jQuery(".menu_background").click(function(){
	    jQuery("nav").toggleClass("open");
    });
        
</script>