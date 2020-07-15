<section class="error-404 not-found">
	<h1>
		<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'jordy' ); ?>
	</h1>
	<p>
		<?php esc_html_e( 'You could either go back or go to homepage', 'jordy' ); ?>
	</p>
	<p>
		<?php printf( '<a href="%s" class="btn btn--blue">%s</a>', esc_url( Xtheme_Club\HOME_URL ), esc_html__( 'Go home', 'jordy' ) ); ?>
	</p>
</section>
