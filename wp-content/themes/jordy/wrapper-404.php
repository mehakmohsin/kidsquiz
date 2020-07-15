<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div id="page" class="site">
			<div id="content" class="content">
				<div class="content__wrapper">
					<?php load_template( Xtheme_Club\Wrapper::get_main_template() ); ?>
				</div>
			</div>
		</div>
	</body>
</html>
