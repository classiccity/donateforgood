<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package trailhead
 */
$footer_menu_title = get_field('footer_menu_title', 'option') ?? null;
$footer_logo = get_field('footer_logo', 'option') ?? null;
$footer_contact_id = get_field('footer_contact_id', 'option') ?? null;
$footer_contact_title = get_field('footer_contact_title', 'option') ?? null;
$footer_phone_number = get_field('footer_phone_number', 'option') ?? null;
$footer_address = get_field('footer_address', 'option') ?? null;
$footer_email_address = get_field('footer_email_address', 'option') ?? null;
$footer_copyright_text = get_field('footer_copyright_text', 'option') ?? null;

?>

				<footer id="colophon" class="site-footer bg-black color-white">
					<div class="site-info">
						<div class="grid-container">
							<div class="grid-x grid-padding-x">
								<?php if( $footer_menu_title || ! empty( trailhead_footer_links() ) ):?>
									<div class="left cell small-12 medium-6 tablet-4 show-for-tablet">
										<?php if($footer_menu_title):?>
											<h3>
												<?=wp_kses_post($footer_menu_title);?>
											</h3>
										<?php endif;?>
										<?php trailhead_footer_links();?>
									</div>
								<?php endif;?>
								
								<?php if($footer_logo):?>
									<div class="cell small-12 tablet-4">
										<div class="logo-wrap">
											<?=wp_get_attachment_image( $footer_logo['id'], 'full' );?>
										</div>
									</div>
								<?php endif;?>
								
								<?php if( $footer_menu_title || ! empty( trailhead_footer_links() ) ):?>
									<div class="left cell small-12 medium-6 tablet-4 hide-for-tablet">
										<?php if($footer_menu_title):?>
											<h3>
												<?=wp_kses_post($footer_menu_title);?>
											</h3>
										<?php endif;?>
										<?php trailhead_footer_links();?>
									</div>
								<?php endif;?>
								
								<?php if( $footer_contact_title || $footer_phone_number || $footer_address || $footer_email_address || $footer_email_address ):?>
									<div id="<?=esc_attr($footer_contact_id);?>" class="right cell small-12 medium-6 tablet-4">
										<?php if( $footer_contact_title ):?>
											<h3>
												<?=wp_kses_post($footer_contact_title);?>
											</h3>
										<?php endif;?>
										<?php if($footer_phone_number):?>
											<div>
												Phone: <a href="tel:<?=esc_attr( $footer_phone_number );?>"><?=esc_attr( $footer_phone_number );?></a>
											</div>
										<?php endif;?>
										<?php if($footer_address):?>
											<div>
												Address: <?=esc_attr( $footer_address );?>
											</div>
										<?php endif;?>
										<?php if($footer_email_address):?>
											<div>
												Email: <a href="mailto:<?=esc_attr( $footer_email_address );?>"><?=esc_attr( $footer_email_address );?></a>
											</div>
										<?php endif;?>
									</div>
								<?php endif;?>
							</div>
							<?php if($footer_copyright_text):?>
								<div class="grid-x grid-padding-x align-center subfooter color-light-gray">
									<?=wp_kses_post($footer_copyright_text);?>
									<?=date('Y');?>
								</div>
							<?php endif;?>
						</div>
					</div><!-- .site-info -->
				</footer><!-- #colophon -->
					
			</div><!-- #page -->
			
		</div>  <!-- end .off-canvas-content -->
							
	</div> <!-- end .off-canvas-wrapper -->
					
<?php wp_footer(); ?>

</body>
</html>
