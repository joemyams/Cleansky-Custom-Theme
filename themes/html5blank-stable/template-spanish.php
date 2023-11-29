<?php /* Template Name: Spanish Template */ ?>

<?php get_header(); ?>

	<body <?php body_class(); ?>>
		
		<?php $footer_code_upper = get_field('footer_code_upper', 'option'); ?>
		
		<?php echo $footer_code_upper;?>

		<!-- wrapper -->
		<div class="site-wrapper">

			<!-- header -->
			
			<header class="header clear" role="banner">

					<!-- nav -->
					<nav class="nav" role="navigation">
						<?php include('snippet-spanish-nav.php'); ?>
					</nav>
			
			</header>


	<main role="main" >
		<!-- section -->
		<section>
			
			<?php include('snippet-flexiblebody.php');?>

		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>
