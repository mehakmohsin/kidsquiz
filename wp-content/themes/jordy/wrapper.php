<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<?php wp_head(); ?>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	</head>
	<body <?php body_class(); ?>>
		<?php do_action( 'xtheme/h/before/page' ); ?>

		<div id="page" class="site" data-layout="<?php echo esc_attr( Xtheme_Club\get_site_layout() ); ?>">
			<?php get_header( Xtheme_Club\Wrapper::get_base() ); ?>

			<div id="content" class="content">
				<?php do_action( 'xtheme/h/before/content__wrapper' ); ?>

				<?php if ( Xtheme_Club\get_site_layout() === 'fullwidth' ) : ?>
					<div class="content__wrapper <?php echo esc_attr( Xtheme_Club\get_site_mode() ); ?>">
						<?php load_template( Xtheme_Club\Wrapper::get_main_template() ); ?>
					</div>
				<?php else : ?>
					<div class="content__wrapper <?php echo esc_attr( Xtheme_Club\get_site_mode() ); ?>">
						<main id="primary" class="content__primary content-area">
							<?php load_template( Xtheme_Club\Wrapper::get_main_template() ); ?>
						</main>

						<aside id="secondary" class="content__secondary widget-area">
							<?php get_sidebar( Xtheme_Club\Wrapper::get_base() ); ?>
						</aside>
					</div>
				<?php endif; ?>

				<?php do_action( 'xtheme/h/after/content__wrapper' ); ?>
			</div>

			<?php get_footer( Xtheme_Club\Wrapper::get_base() ); ?>
		</div>

		<?php wp_footer(); ?>
	</body>
</html>
