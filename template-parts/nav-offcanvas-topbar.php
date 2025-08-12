<?php
/**
 * The off-canvas menu uses the Off-Canvas Component
 *
 * For more info: https://jointswp.com/docs/off-canvas-menu/
 */
$logo = get_field('header_logo', 'option');
$header_phone_label = get_field('header_phone_label', 'option') ?? null;
$header_displayed_header_phone_number = get_field('header_displayed_header_phone_number', 'option') ?? null;
$header_phone_number = get_field('header_phone_number', 'option') ?? null;
?>

<div class="top-bar-wrap grid-container fluid">

	<div class="top-bar" id="top-bar-menu">
	
		<div class="top-bar-left float-left">
			
			<div class="site-branding show-for-sr">
				<?php
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$trailhead_description = get_bloginfo( 'description', 'display' );
				if ( $trailhead_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $trailhead_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->
			<div class="grid-x grid-padding-x align-middle">
				<?php if($logo):?>
					<ul class="menu cell shrink">
						<li class="logo"><a href="<?php echo home_url(); ?>">
							<?=wp_get_attachment_image( $logo['id'], 'full' );?>
						</a></li>
					</ul>
				<?php endif;?>
				<div class="cell auto show-for-medium">
					<?php trailhead_top_nav();?>	
				</div>
			</div>
		</div>
		<div class="menu-toggle-wrap top-bar-right float-right">
			<?php if( $header_phone_label || $header_phone_number || $header_displayed_header_phone_number ):?>
				<div class="header-phone uppercase color-white">
					<?php if( $header_phone_label && $header_displayed_header_phone_number ):?>
						<b><?=wp_kses_post($header_phone_label);?></b>
					<?php endif;?>
					<?php if( $header_phone_number ):?>
						<a href="tel:<?=esc_attr($header_phone_number);?>"><?=esc_attr($header_displayed_header_phone_number);?></a>
					<?php endif;?>
				</div>
			<?php endif;?>
			<ul class="menu hide-for-medium">
				<!-- <li><button class="menu-icon" type="button" data-toggle="off-canvas"></button></li> -->
				<li><a id="menu-toggle" data-toggle="off-canvas"><span></span><span></span><span></span></a></li>
			</ul>
		</div>
	</div>
	
</div>