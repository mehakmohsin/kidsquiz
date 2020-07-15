<?php

use function Xtheme_Club\site_logo;

?>
<div class="header__left site__branding">
	<?php if ( is_front_page() ) : ?>
		<h1 class="site__title">
			<?php site_logo(); ?>
		</h1>
	<?php else : ?>
		<p class="site__title">
			<?php site_logo(); ?>
		</p>
	<?php endif; ?>
</div>
