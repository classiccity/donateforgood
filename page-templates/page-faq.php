<?php
/**
 * Template name: FAQ Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();
$fields = get_fields();

// page title
$page_title = $fields['page_title'] ?? null;

// FAQ
$faq = $fields['faq'] ?? null;

// Contact CTA
$ccta_large_text = $fields['ccta_large_text'] ?? null;
$ccta_medium_text = $fields['ccta_medium_text'] ?? null;

// Gallery
$image_gallery = $fields['image_gallery'] ?? null;

?>
	<div class="content">
		<div class="inner-content">

			<main id="primary" class="site-main">
		
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if( $page_title ):?>
						<header class="entry-header page-banner text-center bg-teal">
							<div class="grid-container">
								<h1 class="color-white m-0">
									<?php if($page_title) {
										echo esc_html( $page_title );
									} else {
										the_title();
									};?>
								</h1>
							</div>
						</header><!-- .entry-header -->
					<?php endif;?>
					<section class="entry-content" itemprop="text">
						
						<?php if( $faq ):?>
							<section class="form-section bg-teal color-white">
								<div class="grid-container">
									<ul class="accordion m-0" data-accordion data-multi-expand="true" data-allow-all-closed="true">
										<?php $i = 1; foreach($faq as $f):
											$q = $f['question'] ?? null;
											$a = $f['answer'] ?? null;
											if( $q && $a ):
										?>
											<li class="accordion-item bg-navy<?php if($i == 1):?> is-active<?php endif;?>" data-accordion-item>
												<a href="#" class="accordion-title h3 m-0">
													<b><?=wp_kses_post( $q );?></b>
												</a>
												<div class="accordion-content" data-tab-content>
													<?=wp_kses_post($a);?>
												</div>
											</li>
										<?php $i++; endif; endforeach;?>
									</ul>
								</div>
							</section>
						<?php endif;?>
						
						<?php if( $ccta_large_text || $ccta_large_text ):?>
							<section class="contact-cta bg-orange color-white text-center">
								<div class="grid-container">
									<?php if( $ccta_large_text ):?>
										<div class="large-text"><?=wp_kses_post($ccta_large_text);?></div>
									<?php endif;?>
									<?php if( $ccta_medium_text ):?>
										<div class="medium-text"><?=wp_kses_post($ccta_medium_text);?></div>
									<?php endif;?>
								</div>
							</section>
						<?php endif;?>
						
						<?php if($image_gallery):?>
							<section class="img-gallery bg-orange">
								<div class="grid-container">
									<div class="grid-x grid-padding-x small-up-2 medium-up-4">
										<?php foreach($image_gallery as $image):
											if( $image ):	
										?>
											<div class="cell">
												<div class="inner">
													<?=wp_get_attachment_image( $image['id'], 'large' );?>
												</div>
											</div>
										<?php endif; endforeach;?>
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