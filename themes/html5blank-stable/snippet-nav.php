	
	<div class="upper-strip darkBlueBack white">
		
		<?php $translation_link = get_field('translation_link'); ?>
		
		<?php if($translation_link): ?>
		<div class="translation_link_container">
			<div class="btn_translation">
				<a class="btn orangeButtonHollow translation_link" href="<?php echo $translation_link['url'];?>">
						<span>Español</span>
				</a>
			</div>

		</div>
		<?php endif; ?>
		
		<?php
			
			$nav_phone_numbers = get_field('nav_phone_numbers','option');
			$login_button = get_field('login_button','option');
		?>
		<div class="phone_link_container">
		<?php while ( have_rows('nav_phone_numbers','option') ) : the_row();?>
		
			<?php $phone_link = get_sub_field('phone_link','option');?>
			<?php $state_name = get_sub_field('state_name', 'option');?>
			
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
			<?php $nav_logo = get_field('nav_logo','option');?>
			<a href="<?php echo home_url(); ?>">
				<img src="<?php echo $nav_logo['url']; ?>" alt="Logo" class="logo-img">
			</a>
		</div>
		
		<ul class="main_menu lightGrayBack">
			<?php
			while ( have_rows('lower_strip_menu','option') ) : the_row();
	
				$url_or_no_url = get_sub_field('url_or_no_url','option');
				$main_link = get_sub_field('main_link','option');
				$main_link_no_url = get_sub_field('main_link_no_url','option');
				
			if($url_or_no_url == true): ?>
			<li class="main_menu_link">
				<a class="main lnk"><?php echo $main_link_no_url; ?></a>
			<?php else: ?>
			<li class="main_menu_link">
				<a class="main lnk" href="<?php echo $main_link['url']; ?>"><?php echo $main_link['title']; ?></a>
			<?php endif; ?>
			
				<ul class="sub_menu lightGrayBack">
					<?php
					if( have_rows('sub_link_menu','option') ):
					while ( have_rows('sub_link_menu','option') ) : the_row();
			
						$sub_link = get_sub_field('sub_link','option');
					?>
					<li class="sub_menu_link">
						<a class="sub lnk" href="<?php echo $sub_link['url'];?>"><?php echo $sub_link['title'];?></a>
					</li>
					<?php endwhile; ?>
					<?php endif; ?>
				</ul>
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