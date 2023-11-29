			<!-- footer -->
			
			<?php if( have_rows('horizontal_page_segment', $post_id)):?>
				
			<?php else:?>
				<div class="bottom-curve">
				<?php echo file_get_contents( get_template_directory_uri() . '/img/bottom-curve.svg');?>
				</div>
			<?php endif;?>

			
			
			<footer class="footer lightGrayBack" role="contentinfo">
				
				<?php if(is_page_template('template-spanish.php')):?>
				
					<?php include('snippet-spanish-footer.php');?>
					
				<?php else:?>
		
					<?php include('snippet-footer.php');?>
				
				<?php endif;?>
				
			</footer>
			<!-- /footer -->

		</div>
		<!-- /wrapper -->

		<?php wp_footer(); ?>

		<!-- analytics -->
		
		<script>
		(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
		(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
		l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
		ga('send', 'pageview');
		</script>
		
		
		<script type="text/javascript">
			jQuery(document).ready(function() {
				if (jQuery(window).scrollTop() >= 50) {
					jQuery("body").addClass("scrollhead");
				}
			});
			jQuery(window).scroll(function() {    
				var scroll = jQuery(window).scrollTop();
			//>=, not <=
				if (scroll >= 50) {
			//clearHeader, not clearheader - caps H
					jQuery("body").addClass("scrollhead");
				}
				if (scroll <= 50) {
			//clearHeader, not clearheader - caps H
					jQuery("body").removeClass("scrollhead");
				}
			}); //missing );
		</script>


		<script>
			
			jQuery(document).ready(function(){
				  jQuery('.slider_one').slick({
					autoplay: false,
				    dots: true,
				    arrows: false,
					infinite: true,
					speed: 2200,
					slidesToShow: 1,
					adaptiveHeight: true
				});
		
				jQuery('.slider_two').slick({
					autoplay: false,
					dots: false,
				    arrows: true,
					infinite: true,
					speed: 2200,
					slidesToShow: 1,
					adaptiveHeight: false
				});
				
				jQuery('.testimonial_slider_container').slick({
					autoplay: false,
					slidesToShow: 1,
					dots: true,
					arrows: false,
					centerMode: true,
					centerPadding: '-2vw',
					focusOnSelect: true,
					adaptiveHeight: true
				});
				        
			    jQuery(".arrowToggle").click(function(){
				    jQuery(this).parent().toggleClass("visible");
			    })
			    
			});
		</script>
		<script>
			
			jQuery(document).ready(function(){
				
				jQuery('.tab_container').hide();
				jQuery('.tab_container_area .tab_container:first-child').show();
				
				jQuery('.tab_navigation li').click(function(event){
					index = jQuery(this).index();
					
					jQuery('.tab_container').removeClass('active');
					jQuery(this).addClass('active');
					jQuery('.tab_container').hide();
					jQuery('.tab_container').eq(index).show();
				});
				
			});
			
		</script>

		
		
		<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
		
		<?php $footer_code_lower = get_field('footer_code_lower', 'option'); ?>
		
		<?php echo $footer_code_lower;?>
		
	</body>
</html>