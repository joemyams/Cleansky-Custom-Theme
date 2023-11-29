<?php 
/* FLexible Body */
// Initial main flexible content check

/*
	Add this for fade up effect: data-aos="fade-up"
*/

if(is_post_type_archive('job_posting')):
    $slug = get_page_by_path( 'job_posting' );
    $post_id = $slug->ID;
endif;

if( have_rows('horizontal_page_segment', $post_id) ):
	// set individual flexible content items
	while ( have_rows('horizontal_page_segment', $post_id) ) : the_row();
		// Child flexible content segment
		
/*********************************************************
**********************************************************
			Regular Flexible Body 
**********************************************************
**********************************************************/			

				$strip_layout = get_sub_field('strip_layout');
				$strip_shadow = get_sub_field('strip_shadow');
				$mobile_field_order = get_sub_field('mobile_field_order');
				$cust_class = get_sub_field('custom_class');
?>
				<?php if($strip_layout == 'curved_strip'):?>
					<?php if($mobile_field_order == 'true'):?>
					<div class="content_box mobile_flip <?php echo $strip_layout;?> <?php echo $cust_class;?>">
					<?php else:?>
					<div class="content_box <?php echo $strip_layout;?> <?php echo $cust_class;?>">
					<?php endif;?>
						<div class="top-curve">
						<?php echo file_get_contents( get_template_directory_uri() . '/img/top-curve.svg');?>
						</div>
				<?php else:?>
					<?php if($mobile_field_order == 'true'):?>
					<div class="content_box mobile_flip <?php echo $strip_layout;?> <?php echo $cust_class;?>">
					<?php else:?>
					<div class="content_box <?php echo $strip_layout;?> <?php echo $cust_class;?>">
					<?php endif;?>
				<?php endif;?>
				
			
		
				<?php 
					if( have_rows('content_box') ):
					// Child flexible content item
					while ( have_rows('content_box') ) : the_row();
					
					$background_color = get_sub_field('background_color');
					$element_alignment = get_sub_field('element_alignment');
					$curve_right_borders = get_sub_field('curve_right_borders');
					$ci_padding = get_sub_field('ci_padding');
				?>
					<?php if($strip_shadow == 'true'):?>
					
						<?php if($ci_padding == 'true'):?>
						
							<div class="content_items_container shadow_curve_true no_padding <?php echo $background_color;?> <?php echo $element_alignment;?> <?php echo $curve_right_borders;?>">
						<?php else:?>
							<div class="content_items_container shadow_curve_true <?php echo $background_color;?> <?php echo $element_alignment;?> <?php echo $curve_right_borders;?>">
						<?php endif;?>
					<?php else:?>
						<?php if($ci_padding == 'true'):?>
							<div class="content_items_container no_padding <?php echo $background_color;?> <?php echo $element_alignment;?> <?php echo $curve_right_borders;?>">
						<?php else:?>
							<div class="content_items_container <?php echo $background_color;?> <?php echo $element_alignment;?> <?php echo $curve_right_borders;?>">
						<?php endif;?>
				
					<?php endif;?>
	
					<?php
						if( have_rows('content_section') ):
							// Child flexible content item
							while ( have_rows('content_section') ) : the_row();
					?>
							<?php if(get_row_layout() == 'slider_field'):?>
							<div class="slider_curve">
							<?php else:?>
							<?php endif;?>
					<?php
								//Start of Content Items
								//CTA Section One
									if(get_row_layout() == 'cta_section_one'):
										$cta_one_header = get_sub_field('cta_one_header');
										$cta_one_sub_header = get_sub_field('cta_one_sub_header');
										$cta_one_form_header = get_sub_field('cta_one_form_header');
										$cta_one_button = get_sub_field('cta_one_button');
										$cta_one_form_url = get_sub_field('cta_one_form_url');
										$cta_one_form_button_text = get_sub_field('cta_one_form_button_text');
										$cta_one_form_input_text = get_sub_field('cta_one_form_input_text');
										$cta_phone_number = get_sub_field('cta_phone_number');
										$cta_phone_number_title = get_sub_field('cta_phone_number_title');
										$cta_one_background_image1 = get_sub_field('cta_one_background_image');
										$cta_one_background_image2 = get_sub_field('cta_one_background_image_2');
										$cta_one_background_image3 = get_sub_field('cta_one_background_image_3');
										$cta_one_background_image4 = get_sub_field('cta_one_background_image_4');
										$image_mobile = get_sub_field('image_mobile');
					?>
				
										<div class="cta_section_one">
											<div class="cta_one_content">
												<?php echo file_get_contents( get_template_directory_uri() . '/img/up-swoosh.svg');?>
												<h1 class="white"><?php echo $cta_one_header;?></h1>
												<p class="white"><?php echo $cta_one_sub_header; ?></p>
												<?php echo file_get_contents( get_template_directory_uri() . '/img/down-swoosh.svg');?>
											</div>
											<div class="cta_one_form">
												<?php if(get_sub_field('cta_type') == 'button'): ?>
												<div class="cta_one_button">
													<h3 class="white"><?php echo $cta_one_form_header;?></h3>
													<?php if(get_sub_field('hide_link_in_desktop') == 'true'):?>
													<h4 class="cta_one_button_desktop_text white"><?php echo $cta_one_button['title'];?></h4>
													<div class="cta_btn btn_postion_div align_center">
														<div class="btn_container">
															<a class="rev-btn btn greenButton" href="<?php echo $cta_button['url']; ?>">
																<span class="cta_one_button_span"><?php echo $cta_one_button['title'];?></span>
															</a>
														</div>
													</div>
													<?php else: ?>
													<div class="btn_postion_div align_center">
														<div class="btn_container">
															<a class="rev-btn btn greenButton" href="<?php echo $cta_button['url']; ?>">
																<span class="cta_one_button_span"><?php echo $cta_one_button['title'];?></span>
															</a>
														</div>
													</div>
													<?php endif; ?>
												</div>
												
												<?php elseif(get_sub_field('cta_type') == 'form'): ?>
												<form method="GET" action="<?php echo $cta_one_form_url;?>">
													
													<h3 class="white"><?php echo $cta_one_form_header;?></h3>
													<input name="customerTypeId" type="hidden" value="7" >
													<input id="zip" name="zipcode" placeholder="<?php echo $cta_one_form_input_text;?>" type="text" pattern="[0-9]*">
													<!--<input class="rev-btn greenButton" type="submit" value="Get Started">-->
													<button class="rev-btn btn greenButton" type="submit" value="Get Started">
														<span class="cta_one_form_span"><?php echo $cta_one_form_button_text;?></span>
													</button>
												</form>
												<?php elseif(get_sub_field('cta_type') == 'phone_number'): ?>
													<div class="cta_one_button">
													<h3 class="white"><?php echo $cta_one_form_header;?></h3>
													<?php if(get_sub_field('hide_link_in_desktop') == 'true'):?>
													<h4 class="cta_one_button_desktop_text white"><?php echo $cta_phone_number_title;?></h4>
													<div class="cta_btn btn_postion_div align_center">
														<div class="btn_container">
															<a class="rev-btn btn greenButton" href="tel:<?php echo $cta_phone_number; ?>">
																<span class="cta_one_phone_span"><?php echo $cta_phone_number;?></span>
															</a>
														</div>
													</div>
													<?php else: ?>
													<div class="btn_postion_div align_center">
														<div class="btn_container">
															<a class="rev-btn btn greenButton" href="tel:<?php echo $cta_phone_number_title; ?>">
																<span class="cta_one_phone_span"><?php echo $cta_phone_number;?></span>
															</a>
														</div>
													</div>
													<?php endif; ?>
												</div>

												<?php endif; ?>
												
											</div>
											<div class="cta_one_image">
												<img id="cta_one_image_random" src="" alt="random image">
											</div>
											<!-- Image Random -->
											<script type="text/javascript">
												window.onload = function () {
													var imagesRan = ['<?php echo $cta_one_background_image1['url'];?>', '<?php echo $cta_one_background_image2['url'];?>', '<?php echo $cta_one_background_image3['url'];?>', '<?php echo $cta_one_background_image4['url'];?>'];
													var imageRandom = imagesRan[Math.floor(Math.random() * imagesRan.length)];
													document.getElementById("cta_one_image_random").src = imageRandom ;
												}
											</script>
																			</div>
									<?php endif; ?>
									<?php
									//CTA Section Two
									if(get_row_layout() == 'cta_section_two'):
									?>
										<?php include('snippet-cta-two.php'); ?>
										
									<?php endif;?>
									<?php
									//CTA Section Three
									if(get_row_layout() == 'cta_section_three'):
									?>
										<div class="cta-three">
											<div class="cta-three-overlay">
											</div>
											<div class="cta-three-bg">
												<img class="" src="<?php the_sub_field('cta_three_background_image') ?>" alt="Cleansky banner">
											</div>
											<div class="cta-three-content <?php the_sub_field('cta_three_background_image_height') ?>">
												<div>
													<h1><?php the_sub_field('cta_three_header')?></h1>
													<div class="three-sub-container">
														<?php the_sub_field('cta_three_text')?>
													
													<!--button options-->
													<?php if(have_rows('cta_three_button_opt')): ?>
														<?php while(have_rows('cta_three_button_opt')) : the_row(); ?>
															<?php
															if(get_row_layout() == 'single_button'):?>
																<div class="btn_postion_div align_left">
																	<div class="btn_container">
																		<a class="btn greenButton" href="<?php the_sub_field('cta_three_single_button_link')?>">
																			<span id=""><?php the_sub_field('cta_three_single_button_text')?></span>
																		</a>
																	</div>
																</div>
															<?php endif; // end signle button ?>
															<?php
															if(get_row_layout() == 'zipcode_and_button'):?>
																<div class="add-top-padding">
																	<form class="cta_two_form" method="GET" action="<?php the_sub_field('cta_three_zipcode_action_link')?>" data-hs-cf-bound="true">							
																		<input id="zip" name="zipcode" placeholder="Zip" type="text" pattern="[0-9]*">
																						<button class="rev-btn btn greenButton" type="submit" value="Find A Plan" formtarget="_blank">	
																			<span id=""><?php the_sub_field('cta_three_zipcode_button_text')?></span>
																		</button>
																	</form>
																</div>
															<?php endif; // end zipcode box and button ?>
														<?php endwhile; //?>
														<?php endif; // end button option ?>

														
														</div>
													</div>
												<div>
												</div>
											</div>
										</div>
										
									<?php endif;?>
								
								<?php 
								//Large Header
									if(get_row_layout() == 'large_header'):
										$h1_cta = get_sub_field('h1_cta');
										$header_alignment = get_sub_field('header_alignment');
										$flourish = get_sub_field('flourish');
								?>
										<div class="large_header <?php echo $header_alignment;?>">
											<?php if($flourish == 'true'):?>
											<h1 class="flourish">
												<?php echo file_get_contents( get_template_directory_uri() . '/img/up-swoosh.svg');?>
												<?php echo $h1_cta?>
												<?php echo file_get_contents( get_template_directory_uri() . '/img/down-swoosh.svg');?>
											</h1>
											<?php else: ?>
											<h1><?php echo $h1_cta;?></h1>
											<?php endif; ?>
										</div>
									<?php endif;?>
								<?php
								//Medium Header
									if(get_row_layout() == 'medium_header'):
										$h2_cta = get_sub_field('h2_cta');
										$header_alignment = get_sub_field('header_alignment');
										$header_font_size = get_sub_field('header_font_size');
										$header_text_color = get_sub_field('header_text_color');
										$flourish = get_sub_field('flourish');
								?>
										<div class="medium_header <?php echo $header_alignment;?> <?php echo $header_font_size;?> <?php echo $header_text_color;?>">
											<?php if($flourish == 'true'):?>
											<h2 class="flourish">
											<?php echo file_get_contents( get_template_directory_uri() . '/img/up-swoosh.svg');?>
											<?php echo $h2_cta;?>
											<?php echo file_get_contents( get_template_directory_uri() . '/img/down-swoosh.svg');?>
											</h2>
											<?php else: ?>
											<h2><?php echo $h2_cta;?></h2>
											<?php endif; ?>
										</div>
									<?php endif;?>
								<?php
								//Small Header
									if(get_row_layout() == 'small_header'):
										$h3_cta = get_sub_field('h3_cta');
										$header_alignment = get_sub_field('header_alignment');
										$header_font_size = get_sub_field('header_font_size');
										$header_text_color = get_sub_field('header_text_color');
										$flourish = get_sub_field('flourish');
								?>
										<div class="small_header <?php echo $header_alignment;?> <?php echo $header_font_size;?> <?php echo $header_text_color;?>">
											<?php if($flourish == 'true'):?>
											<h3 class="flourish">
											<?php echo file_get_contents( get_template_directory_uri() . '/img/up-swoosh.svg');?>
												<?php echo $h3_cta;?>
											<?php echo file_get_contents( get_template_directory_uri() . '/img/down-swoosh.svg');?>
											</h3>
											<?php else: ?>
											<h3><?php echo $h3_cta;?></h3>
											<?php endif; ?>
										</div>
									<?php endif;?>
								<?php
								//Sub Small Header
									if(get_row_layout() == 'sub_small_header'):
										$h4_cta = get_sub_field('h4_cta');
										$header_alignment = get_sub_field('header_alignment');
										$header_font_size = get_sub_field('header_font_size');
										$header_text_color = get_sub_field('header_text_color');
										$flourish = get_sub_field('flourish');
								?>
										<div class="sub_small_header <?php echo $header_alignment;?> <?php echo $header_font_size;?> <?php echo $header_text_color;?>">
											<?php if($flourish == 'true'):?>
											<h3 class="flourish">
												<?php echo $h4_cta;?>
											</h3>
											<?php else: ?>
											<h4><?php echo $h4_cta;?></h4>
											<?php endif; ?>
										</div>
									<?php endif;?>
								<?php	
								//Button
									if(get_row_layout() == 'single_button_field'):
										$button_style = get_sub_field('button_style');
										$button_link = get_sub_field('button_link');
										$single_button_field_id = get_sub_field('single_button_field_id');
										$button_alignment = get_sub_field('button_alignment');
										if(!empty($button_link)):
								?>			<div class="btn_postion_div <?php echo $button_alignment;?>">
												<div class="btn_container">
													<a class="btn <?php echo $button_style;?>" href="<?php echo $button_link['url'];?>">
														<span id="<?php echo $single_button_field_id;?>"><?php echo $button_link['title'];?></span>
													</a>
												</div>
											</div>
										<?php endif;?>
									<?php endif;?>
								<?php	
								//Large Text Area
									if(get_row_layout() == 'large_text_block'):
										$ltb_text = get_sub_field('ltb_text');
								?>
										<div class="large_text_area"><?php echo $ltb_text;?></div>
									<?php endif;?>
								<?php	
								//Small Text Area
									if(get_row_layout() == 'small_text_block'):
										$stb_text = get_sub_field('stb_text');
										$text_alignment = get_sub_field('text_alignment');
								?>
										<div class="small_text_area <?php echo $text_alignment;?>">
											<span class="span"><?php echo $stb_text;?></span>
										</div>
									<?php endif;?>
								<?php
								//special Text Area
									if(get_row_layout() == 'special_text_block'):
										$special_text = get_sub_field('special_text');
										$special_text_alignment = get_sub_field('special_text_alignment');
										$text_font_size = get_sub_field('text_font_size');
										$text_color_opt = get_sub_field('text_color_opt');
										$font_weight_opt = get_sub_field('font_weight_opt');
								?>
										<div class="special_text_area <?php echo $special_text_alignment;?> <?php echo $text_font_size;?> <?php echo $text_color_opt;?> <?php echo $font_weight_opt;?>">
											<span class="span"><?php echo $special_text;?></span>
										</div>
									<?php endif;?>
								<?php
									//faqs
									if(get_row_layout() == 'faqs_block'):
										$faq_main_header = get_sub_field('faq_main_header');
								?>
										<div class="faq">
											<?php if ('$faq_main_header'): ?>
												<h2><?php echo $faq_main_header;?></h2>
											<?php endif; //repeater text_p ?>
											<div class="two-col-repecter">
												<?php if(have_rows('faq_content')): ?>
													<?php while(have_rows('faq_content')) : the_row(); ?>
														<div class="inner-col">
															<h3><?php the_sub_field('faq_question')?></h3>
															<p><?php the_sub_field('faq_answer')?></p>
														</div>
													<?php endwhile; // ?>
												<?php endif; //?>
											</div>
										</div>
									<?php endif;?>
								<?php
								//Image Field
									if(get_row_layout() == 'image_field'):
										$image = get_sub_field('image');
										$image_mobile = get_sub_field('image_mobile');
								
								?>
									
										<div class="image_field_container">
											<picture>
												<source media="(max-width:650px)" srcset="<?php echo $image_mobile['url'];?>">
												<img src="<?php echo $image['url'];?>" alt="<?php echo $image['alt'];?>">
											</picture>
											
										</div>
									<?php endif;?>
								<?php
								//Icon Row
									if(get_row_layout() == 'icon_row'):
										$icon_layout = get_sub_field('icon_layout');
										$icon_text_alignment = get_sub_field('icon_text_alignment');
										if( have_rows('row') ):
										$icon_elements = get_sub_field('icon_elements');
																			
										
								?>
											<ul class="icon_row <?php echo $icon_layout;?> <?php echo $icon_text_alignment;?>">
												<?php while ( have_rows('row') ) : the_row();
													$icon = get_sub_field('icon');
													$title = get_sub_field('title');
													$content = get_sub_field('content');
												?>	
												
													<li class="main_menu_item">
														
														<?php if(!empty($icon)): ?>
														<img src="<?php echo $icon['url'];?>" alt="<?php echo $icon['alt'];?>">
														<?php endif;?>
														
														<div class="ir_content_container">
															<?php if(!empty($title)): ?>
															<h4><?php echo $title;?></h4>
															<?php endif;?>
															
															<?php if(!empty($content)): ?>
															<p><?php echo $content;?></p>
															<?php endif;?>
														</div>
														
													</li>
												<?php endwhile;?>								
											</ul>
										<?php endif;?>
									<?php endif;?>
								<?php	
								//Zip Code Form
									if(get_row_layout() == 'zip_code_form'):
										$form_alignment = get_sub_field('form_alignment');
										$form_url = get_sub_field('form_url');
										$input_field_text = get_sub_field('input_field_text');
										$button_field_text = get_sub_field('button_field_text');
								?>
										<div class="zip_code_form <?php echo $form_alignment;?>">
											<form method="GET" action="<?php echo $form_url;?>">
												<input name="customerTypeId" type="hidden" value="7" >
												<input id="zip" name="zipcode" placeholder="<?php echo $input_field_text;?>" type="text" pattern="[0-9]*">
												
												
													<button class="rev-btn btn greenButton" type="submit" value="<?php echo $button_field_text;?>">
														<span><?php echo $button_field_text;?></span>
													</button>
											</form>
										</div>
								<?php endif;?>
								
								<?php	
								//Slider
									if(get_row_layout() == 'slider_field'):
										$slider_type = get_sub_field('slider_type');
								?>
									<?php if($slider_type == 'slider_one'):?>
									
										<div class="slider_container slider_one">
											<?php while ( have_rows('sf_slide') ) : the_row();
												$slider_header = get_sub_field('slider_header');
												$slider_content = get_sub_field('slider_content');
												$slider_button = get_sub_field('slider_button');
											?>
											
											<div>
												<h2><?php echo $slider_header;?></h2>
												<p><?php echo $slider_content;?></p>
												<?php if(!empty($slider_button)):?>
												<div class="btn_wrapper">
												<a class="btn greenButton" href="<?php echo $slider_button['url'];?>">
													<span><?php echo $slider_button['title'];?></span>
												</a>
												</div>
												<?php endif;?>
											</div>
											
											<?php endwhile;?>
											
										</div>
									<?php else:?>
										<div class="slider_two_container">
											<div class="slider_container slider_two">
												<?php while ( have_rows('sf_slide') ) : the_row();
													$slider_header = get_sub_field('slider_header');
													$slider_content = get_sub_field('slider_content');
													$slider_button = get_sub_field('slider_button');
													$slider_background_image = get_sub_field('slider_background_image');
												?>
												
												<div style="background-image: url(<?php echo $slider_background_image['url'];?>)">
													<div class="slider_two_content">
														<h2><?php echo $slider_header;?></h2>
														<p><?php echo $slider_content;?></p>
														<?php if(!empty($slider_button)):?>
														<div class="btn_wrapper">
														<a class="btn greenButton" href="<?php echo $slider_button['url'];?>">
															<span><?php echo $slider_button['title'];?></span>
														</a>
														</div>
														<?php endif;?>
													</div>
												</div>
												
												<?php endwhile;?>
												
											</div>
										</div>
																		
									<?php endif;?>
								<?php endif;?>
								<?php
								//Linkable Cards
									if(get_row_layout() == 'linkable_cards'):
								?>
									<ul class="card_wrapper">
										<?php while ( have_rows('card_row') ) : the_row();
											$title = get_sub_field('title');
											$icon = get_sub_field('icon');
											$link = get_sub_field('link');
										?>
											<li class="card">
												<?php if(!empty($link)):?>
												<a class="card_link" href="<?php echo $link['url'];?>"><h4 class="card_title"><?php echo $title;?></h4>
												<img class="card_icon" src="<?php echo $icon['url'];?>" alt="<?php echo $icon['alt'];?>">
												</a>
												<?php else:?>
												<h4 class="card_title"><?php echo $title;?></h4>
												<img class="card_icon" src="<?php echo $icon['url'];?>" alt="<?php echo $icon['alt'];?>">
												<?php endif;?>
											</li>
										
										<?php endwhile;?>
									</ul>
										
								<?php endif;?>
								<?php
								//Plan Boxes
									if(get_row_layout() == 'plan_boxes'):
								?>
									<ul class="pb_box_wrapper">
										<?php while ( have_rows('pb_box') ) : the_row();
											$title = get_sub_field('title');
											$upper_text = get_sub_field('upper_text');
											$lower_text = get_sub_field('lower_text');
											$link_or_form = get_sub_field('link_or_form');
											$link = get_sub_field('link');
											$form_input_text = get_sub_field('form_input_text');
											$form_button_text = get_sub_field('form_button_text');
										?>
											<li class="pb_box">
												<h3 class="white"><?php echo $title;?></h3>
												<div class="plan_content_container">
													<p class="upper_text"><?php echo $upper_text;?></p>
													<p class="lower_text"><?php echo $lower_text;?></p>
													
													<?php if($link_or_form == 'true'):?>
													
														<div class="zip_code_form <?php echo $form_alignment;?>">
															<form method="GET" action="https://signup.cleanskyenergy.com/">
																<input name="customerTypeId" type="hidden" value="7" >
																<input id="zip" name="zipcode" placeholder="<?php echo $form_input_text;?>" type="text" pattern="[0-9]*">
																	<button class="rev-btn btn greenButton" type="submit" value="<?php echo $form_input_text;?>">
																		<span><?php echo $form_button_text;?></span>
																	</button>
															</form>
														</div>
													
													<?php else:?>
														
														<a class="lnk firelight" href="<?php echo $link['url'];?>"><?php echo $link['title'];?></a>
													
													<?php endif;?>

												</div>
											</li>
										
										<?php endwhile;?>
									</ul>
										
								<?php endif;?>
								<?php
								//Table Field
									if(get_row_layout() == 'table_field'):
								?>
										<?php $table = get_sub_field('table');?>
										
										<div class="table_container">

										<?php if ( ! empty ( $table ) ) {

										    echo '<table border="0">';
										
										        if ( ! empty( $table['caption'] ) ) {
										
										            echo '<caption>' . $table['caption'] . '</caption>';
										        }
										
										        if ( ! empty( $table['header'] ) ) {
										
										            echo '<thead>';
										
										                echo '<tr>';
										
										                    foreach ( $table['header'] as $th ) {
										
										                        echo '<th>';
										                            echo $th['c'];
										                        echo '</th>';
										                    }
										
										                echo '</tr>';
										
										            echo '</thead>';
										        }
										
										        echo '<tbody>';
										
										            foreach ( $table['body'] as $tr ) {
										
										                echo '<tr>';
										
										                    foreach ( $tr as $td ) {
										
										                        echo '<td>';
										                            echo $td['c'];
										                        echo '</td>';
										                    }
										
										                echo '</tr>';
										            }
										
										        echo '</tbody>';
										
										    echo '</table>';
										}?>									
											
										</div>
								<?php endif;?>

								<?php
								//Accordion Dropdown
									if(get_row_layout() == 'accordion_dropdown'):
								?>
									<ul class="accordion_wrapper">
										<?php while ( have_rows('accordion') ) : the_row();
											$ad_title = get_sub_field('ad_title');
											$ad_content = get_sub_field('ad_content');
										?>
											<li class="accordion-container">
												<div class="accordion lightGrayBack arrowToggle">
													<span></span>
													<h4 class="ad_title"><?php echo $ad_title;?></h4>
												</div>
												<div class="ad_content"><?php echo $ad_content;?></div>
											</li>
										
										<?php endwhile;?>
									</ul>
										
								<?php endif;?>
								<?php
								//Google Review Boxes
									if(get_row_layout() == 'google_review_boxes'):
								?>
									<div class="testimonial_slider_container">
										<?php while ( have_rows('review') ) : the_row();
											$grb_image = get_sub_field('grb_image');
											$grb_rating = get_sub_field('grb_rating');
											$grb_quote = get_sub_field('grb_quote');
											$grb_name = get_sub_field('grb_name');
										?>
																				
										<div class="testimonial_slide whiteBack">
											<div class="testimonial_image">
												<img src="<?php echo $grb_image['url'];?>" alt="<?php echo $grb_image['alt'];?>">
											</div>
											<div class="grb_star_container">
												<?php if($grb_rating == 'one_star'){
		
													include('img/one-stars.svg');
													
																			
												}elseif($grb_rating == 'two_star'){
													
													include('img/two-stars.svg');
																							
												}elseif($grb_rating == 'three_star'){
													
													include('img/three-stars.svg');
																							
												}elseif($grb_rating == 'four_star'){
													
													include('img/four-stars.svg');
													
												}elseif($grb_rating == 'five_star'){
													
													include('img/five-stars.svg');
																							
												}?>
											</div>
											<div><?php echo $grb_quote;?></div>
											<p><?php echo $grb_name;?></p>
										</div>
																				
										<?php endwhile;?>
																				
									</div>
										
								<?php endif;?>
								<?php
								//Testimonials
									if(get_row_layout() == 'fb_testimonials'):
								?>
									<?php include('snippet-testimonial.php');?>
										
								<?php endif;?>
								
								<?php
								//Job Postings
								?>
								<?php if(get_row_layout() == 'job_postings_feed'):?>
									<?php include('snippet-job-postings.php');?>
								<?php endif;?>
							
							<!--------------------->
							
							<?php if(get_row_layout() == 'slider_field'):?>
							</div>
							<?php else:?>
							<?php endif;?>
							
							<!--------------------->
							
							<?php endwhile;?>
						<?php endif;?>					
					</div>
							
					
				<!--------------------->
					<?php endwhile;?>
				<?php endif;?>
				</div>
				<?php if($strip_shadow == 'true'):?>
						<div class="shadow_curve <?php echo $background_color;?>">
						<?php echo file_get_contents( get_template_directory_uri() . '/img/shadow-curve.svg');?>
						</div>
					<?php else:?>
					<?php endif;?>
					
	<!--------------------->	
		<?php endwhile;?>
<?php endif;?>

<div class="bottom-curve">
	<?php echo file_get_contents( get_template_directory_uri() . '/img/bottom-curve.svg');?>
</div>










