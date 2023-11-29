<?php /* Template Name: Spanish No Nav Template */ ?>
<!doctype html>
<?php if(is_page_template('template-spanish.php')):?>
	<html lang="es-US" class="no-js">
<?php else:?>
	<html lang="en-US" class="no-js">					
<?php endif;?>		
		
		<head>
		
		<?php $header_code = get_field('header_code', 'option'); ?>
		
		<?php echo $header_code;?>
		
		
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
        
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        
        <link href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css" rel="stylesheet"/>
		<link href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css" rel="stylesheet"/>
		
		<?php $translation_link = get_field('translation_link'); ?>
		<?php $spanish_translation_link = get_field('spanish_translation_link'); ?>
		
		<?php if($translation_link || $spanish_translation_link): ?>
			<?php if(is_page_template('template-spanish.php')):?>
					
				<link rel="alternate" hreflang="es" href="<?php echo get_permalink( get_the_ID() ); ?>" />
				<link rel="alternate" hreflang="en" href="<?php echo $spanish_translation_link['url'];?>" />
							
			<?php else:?>
				
				<link rel="alternate" hreflang="es" href="<?php echo $translation_link['url']; ?>" />
				<link rel="alternate" hreflang="en" href="<?php echo get_permalink( get_the_ID() ); ?>" />
						
			<?php endif;?>
	
		<?php endif;?>

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<?php wp_head(); ?>
		
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
        </script>
        
	</head>
	<body <?php body_class(); ?> id="remove-nav-top">
		
		<?php $footer_code_upper = get_field('footer_code_upper', 'option'); ?>
		
		<?php echo $footer_code_upper;?>

		<!-- wrapper -->
		<div class="site-wrapper">

			<!-- header -->
			<?php if(is_page_template('template-no-nav.php')){}else{?>
			<header class="header clear remove-nav-item" role="banner">

					<!-- nav -->

					<nav class="nav" role="navigation">

						
						
					<?php if(is_page_template('template-spanish.php')):?>
				
						<?php include('snippet-spanish-nav.php'); ?>
						
					<?php else:?>
			
						<?php include('snippet-nav.php'); ?>
					
					<?php endif;?>

					</nav>
					<!-- /nav -->
					

			</header>
			<?php } ?>
			<!-- /header -->

	<main role="main" class="no_nav_template">
		<!-- section -->
		<div class="upper-strip darkBlueBack white">
		
		<?php $spanish_translation_link = get_field('spanish_translation_link'); ?>
		
		<?php if($spanish_translation_link): ?>
		<div class="translation_link_container spanish">
			<div class="btn_translation">
				<a class="btn orangeButtonHollow translation_link" href="<?php echo $spanish_translation_link['url'];?>">
					<?php echo file_get_contents( get_template_directory_uri() . '/img/up-swoosh.svg');?>
						<span>English</span>
					<?php echo file_get_contents( get_template_directory_uri() . '/img/down-swoosh.svg');?>
				</a>
			</div>
		</div>
		<?php endif; ?>
		
		
		
	</div>

		<section>
			
			<?php include('snippet-flexiblebody.php');?>

		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>