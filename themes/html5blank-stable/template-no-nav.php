<?php /* Template Name: No Nav Template */ get_header(); ?>

	<main role="main" class="no_nav_template">
		<!-- section -->
		
		<?php $translation_link = get_field('translation_link'); ?>
		
		<?php if($translation_link): ?>

		<div class="upper-strip darkBlueBack white">
			<div class="translation_link_container">
				<div class="btn_translation">
					<a class="btn orangeButtonHollow translation_link" href="<?php echo $translation_link['url'];?>">
						<?php echo file_get_contents( get_template_directory_uri() . '/img/up-swoosh.svg');?>
							<span>Español</span>
						<?php echo file_get_contents( get_template_directory_uri() . '/img/down-swoosh.svg');?>
					</a>
				</div>

			</div>
		</div>
		<?php endif; ?>

		<section>
			
			<?php include('snippet-flexiblebody.php');?>

		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>
