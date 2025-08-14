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
								<?php if($page_title):?>
									<h1 class="color-white uppercase">
										<?=esc_html( $page_title );?>
									</h1>
								<?php endif;?>
							</div>
						</header><!-- .entry-header -->
					<?php endif;?>
					<section class="entry-content" itemprop="text">
						
						<?php if( $faq ):?>
							<section class="form-section bg-teal color-white">
								<div class="grid-container">
									<ul class="accordion" data-accordion data-multi-expand="true" data-allow-all-closed="true">
										<?php $i = 1; foreach($faq as $f):
											$q = $f['question'] ?? null;
											$a = $f['answer'] ?? null;
											if( $q && $a ):
										?>
											<li class="accordion-item<?php if($i == 1):?> is-active<?php endif;?>" data-accordion-item>
												<a href="#" class="accordion-title">
													<?=wp_kses_post( $q );?>
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
							<section class="contact-cta bg-orange">
								<?php if( $ccta_large_text ):?>
									<h2><?=wp_kses_post($ccta_large_text);?></h2>
								<?php endif;?>
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