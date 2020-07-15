<section class="no-results not-found container">
	<h1 class="page-title">
		<?php esc_html_e( 'Nothing Found', 'jordy' ); ?>
	</h1>

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) {
			/* translators: 1: new post link */
			printf( wp_kses_post( __( '<p>Ready to publish your first post? <a href="%1$s">Get started here</a>.</p>', 'jordy' ) ), esc_url( admin_url( 'post-new.php' ) ) );
		} elseif ( is_search() ) {
			echo '<p>';
			esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'jordy' );
			echo '</p>';
		} else {
			echo '<p>';
			esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'jordy' );
			echo '</p>';
		};
		?>
	</div>
</section>
