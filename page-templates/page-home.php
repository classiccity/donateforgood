<?php
/**
 * Template name: Home Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();
$fields = get_fields();
$hero_background_image = $fields['hero_background_image'] ?? null;

// hero
$hero_image = $fields['hero_image'] ?? null;
$hero_title = $fields['hero_title'] ?? null;

// form
$form_section_id = $fields['form_section_id'] ?? null;
$form_logo = $fields['form_logo'] ?? null;
$form_id = $fields['donate_form_id'] ?? null;

// about
$about_section_id = $fields['about_section_id'] ?? null;
$about_large_copy = $fields['about_large_copy'] ?? null;
$about_medium_copy = $fields['about_medium_copy'] ?? null;

// how it works
$how_section_id = $fields['how_section_id'] ?? null;
$how_title = $fields['how_title'] ?? null;
$how_columns = $fields['how_columns'] ?? null;

// partners
$partners_section_id = $fields['partners_section_id'] ?? null;
$partner_columns = $fields['partner_columns'] ?? null;

// testimonials
$testimonials_section_id = $fields['testimonials_section_id'] ?? null;
$testimonials = $fields['testimonials'] ?? null;
?>
	<div class="content">
		<div class="inner-content">

			<main id="primary" class="site-main">
		
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if($hero_background_image || $hero_image || $hero_title):?>
						<header class="entry-header home-hero text-center"
							style="background-image: url(<?=$hero_background_image['url'];?>);";
						>
							<div class="grid-container">
								<?php if($hero_image):?>
									<div class="img-wrap">
										<?=wp_get_attachment_image( $hero_image['id'], 'full' );?>
									</div>
								<?php endif;?>
								<?php if($hero_title):?>
									<h1 class="color-white uppercase">
										<?=esc_html( $hero_title );?>
									</h1>
								<?php endif;?>
							</div>
						</header><!-- .entry-header -->
					<?php endif;?>
					<section class="entry-content" itemprop="text">
						
					<?php if ( $form_logo || $about_large_copy || $about_medium_copy ): ?>
					<section class="form-section bg-teal color-white">
						<div class="grid-container">

							<!-- Logo + Form (same row) -->
							<div id="<?= sanitize_title( $form_section_id ); ?>" class="top grid-x grid-padding-x align-middle">
								<?php if ( $form_logo ): ?>
									<div class="logo-wrap cell small-12 medium-shrink">
										<?= wp_get_attachment_image( $form_logo['id'], 'full' ); ?>
									</div>
								<?php endif; ?>

								<?php if ( $form_id ): ?>
									<div class="donation-form cell small-12 medium-auto">
										<?= do_shortcode( sprintf(
											'[gravityform id="%d" title="true" description="false" ajax="true"]',
											(int) $form_id
										) ); ?>
									</div>
								<?php endif; ?>
							</div>

							<!-- About copy (below) -->
							<?php if ( $about_large_copy || $about_medium_copy ): ?>
								<div id="<?= sanitize_title( $about_section_id ); ?>" class="bottom grid-x grid-padding-x">
									<?php if ( $about_large_copy ): ?>
										<div class="large-copy cell small-12 medium-6">
											<?= wp_kses_post( $about_large_copy ); ?>
										</div>
									<?php endif; ?>
									<?php if ( $about_medium_copy ): ?>
										<div class="medium-copy cell small-12 medium-6">
											<?= wp_kses_post( $about_medium_copy ); ?>
										</div>
									<?php endif; ?>
								</div>
							<?php endif; ?>

						</div>
					</section>
					<?php endif; ?>

						
						<?php if( $how_title || $how_columns ):?>
							<section id="<?=sanitize_title($how_section_id);?>" class="faq bg-navy color-white text-center" data-equalizer data-equalize-on="medium">
								<div class="grid-container">
									<?php if( $how_title ):?>
										<h2>
											<?=wp_kses_post($how_title);?>
										</h2>
									<?php endif;?>
									<?php if( $how_columns ):?>
										<div class="grid-x grid-padding-x align-center small-up-1 medium-up-2 tablet-up-4">
											<?php foreach($how_columns as $how_column):
												$icon = $how_column['icon'] ?? null;
												$title = $how_column['title'] ?? null;
												$text = $how_column['text'] ?? null;
											?>
												<div class="cell">
													<?php if($icon):?>
														<div class="icon-wrap grid-x align-middle align-center" data-equalizer-watch>
															<?=wp_get_attachment_image( $icon['id'], 'full' );?>
														</div>
													<?php endif;?>
													<?php if( $title || $text ):?>
														<div class="title-text">
															<?php if( $title ):?>
																<h3><?=wp_kses_post($title);?></h3>
															<?php endif;?>
															<?php if( $text ):?>
																<div class="medium-copy">
																	<p><?=wp_kses_post($text);?></p>
																</div>
															<?php endif;?>
														</div>
													<?php endif;?>
												</div>
											<?php endforeach;?>
										</div>	
									<?php endif;?>
								</div>
							</section>
						<?php endif;?>
						
						<?php if($partner_columns):?>
							<section id="<?=sanitize_title($partners_section_id);?>" class="partners" data-equalizer data-equalize-on="medium">
								<div class="grid-container">
									<div class="grid-x grid-padding-x align-center small-up-1 medium-up-2 tablet-up-3">
										<?php foreach($partner_columns as $partner_column):
											$logo = $partner_column['logo'] ?? null;
											$copy = $partner_column['copy'] ?? null;
										?>
											<div class="cell">
												<?php if($logo):?>
													<div class="logo-wrap text-center grid-x align-bottom align-center" data-equalizer-watch>
														<?=wp_get_attachment_image( $logo['id'], 'full' );?>
													</div>
												<?php endif;?>
												<?php if($copy):?>
													<div class="copy-wrap">
														<?=wp_kses_post($copy);?>
													</div>
												<?php endif;?>
											</div>
										<?php endforeach;?>
									</div>
								</div>
							</section>
						<?php endif;?>
						
						<?php if($testimonials):?>
							<section id="<?=sanitize_title($testimonials_section_id);?>" class="testimonials bg-teal color-white">
								<div class="grid-container">
									<div class="grid-x align-center align-middle">
										<?php if( count($testimonials) > 1 ):?>
											<div class="cell shrink show-for-medium">
												<div class="swiper-btn swiper-button-prev">
													<svg xmlns="http://www.w3.org/2000/svg" width="33" height="78"><path fill-rule="evenodd" fill="#FFF" d="M0 38.1 33 0v78L0 38.1Z"/></svg>
												</div>
											</div>
										<?php endif;?>
										<div class="cell auto">
											<div class="testimonials-slider overflow-hidden">
												<div class="swiper-wrapper align-middle">
													<?php foreach($testimonials as $testimonial):
														$quote = $testimonial['quote'] ?? null;
														$citation = $testimonial['citation'] ?? null;
													?>
														<div class="swiper-slide text-center">
															<?php if($quote):?>
																<div class="quote-wrap">
																	“<?=wp_kses_post($quote);?>”
																</div>
															<?php endif;?>
															<?php if($citation):?>
																<div class="citation-wrap">
																	– <?=wp_kses_post($citation);?>
																</div>
															<?php endif;?>
														</div>
													<?php endforeach;?>
												</div>
												<?php if( count($testimonials) > 1 ):?>
													<div class="swiper-pagination hide-for-medium"></div>
												<?php endif;?>
											</div>
										</div>
										<?php if( count($testimonials) > 1 ):?>
											<div class="cell shrink show-for-medium">
												<div class="swiper-btn swiper-button-next">
													<svg xmlns="http://www.w3.org/2000/svg" width="33" height="78"><path fill-rule="evenodd" fill="#FFF" d="M33 38.1 0 78V0l33 38.1Z"/></svg>
												</div>
											</div>
										<?php endif;?>
									</div>
								</div>
							</section>
						<?php endif;?>
						
					</section> <!-- end article section -->
							
					<footer class="article-footer">
						 <?php wp_link_pages(); ?>
					</footer> <!-- end article footer -->
						
				</article><!-- #post-<?php the_ID(); ?> -->
		
			</main><!-- #main -->
				
		</div>
	</div>

<?php
get_footer();