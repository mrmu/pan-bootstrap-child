<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<link href="//www.google-analytics.com" rel="dns-prefetch">
		<link href="<?php echo VB_THEME_URI; ?>logo.png" rel="shortcut icon">
		<link href="<?php echo VB_THEME_URI; ?>logo.png" rel="apple-touch-icon-precomposed">
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>" />
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open();
		} else {
			do_action( 'wp_body_open' );
		}
		?>

		<!-- header -->
		<header class="header main-header clear">
			<nav id="main_navbar"  class="navbar navbar-expand-lg navbar-light">

				<div class="container p-0">

					<!-- Hamburger (Mobile) -->
					<button class="navbar-toggler ms-1 order-1 order-lg-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

					<!-- Logo -->
					<a class="navbar-brand order-2 order-lg-1 mx-0 py-0 pt-2 pt-lg-0" href="<?php echo home_url(); ?>">
						<?php
						$custom_logo_id = get_theme_mod( 'custom_logo' );
						$logo_img = wp_get_attachment_image_src( $custom_logo_id , 'full' );
						if ( has_custom_logo() ) {
							?>
							<div style="max-width: 150px; max-height: 55px;">
								<img src="<?php echo esc_url($logo_img[0]);?>" alt="<?php echo get_bloginfo( 'name' );?>" style="width:100%; height:100%; max-height: 50px;">
							</div>
							<?php
						} else {
							?>
							<div class="py-1 py-lg-2" style="display:inline-block; margin-left:5px; height: 55px; color:#555; font-weight:bold;">
								<?php bloginfo('name'); ?>
							</div>
							<?php
						}
						?>
					</a>

					<!-- Menu (PC & Mobile) -->
					<div class="menu_wrap collapse navbar-collapse order-4 order-lg-2" id="navbarSupportedContent">
						<ul id="menu-main-menu" class="navbar-nav me-auto">
							<?php pan_bootstrap_nav(); ?>
						</ul>
					</div>

					<div class="links_wrap me-1 d-flex order-3 order-lg-3">
						<a href="d-inline-block" style="font-size: 26px; padding: 0 5px; margin-right: 5px;">
							<i class="far fa-envelope"></i>
						</a>
					</div>
				</div>
				<!-- /.container -->

			</nav>
		</header>
		<!-- /header -->
