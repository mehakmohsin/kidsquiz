<?php
/**
 * Display Header Media Text
 *
 * @package Photo_Journal
 */
?>
<?php
$header_media_title = get_theme_mod( 'photo_journal_header_media_title', current_user_can( 'edit_theme_options' ) ? esc_html__( 'Header Media', 'photo-journal' ) : '' );

$header_media_text = get_theme_mod( 'photo_journal_header_media_text', current_user_can( 'edit_theme_options' ) ? esc_html__( 'Photography', 'photo-journal' ) : '' );

if ( $header_media_title || $header_media_text ) : ?>
<div class="custom-header-content sections header-media-section">
	<?php if ( $header_media_title ) : ?>
	<h2 class="entry-title"><?php echo wp_kses_post( $header_media_title ); ?></h2>
	<?php endif; ?>

	<?php
	$button_url  = get_theme_mod( 'photo_journal_header_media_url' );
	$button_text = get_theme_mod( 'photo_journal_header_media_url_text' );
	?>

	<p class="site-header-text"><?php echo wp_kses_post( $header_media_text ); ?>
	<?php if ( $button_url || $button_text ) : ?><a class="more-link"  href="<?php echo esc_url( $button_url ); ?>" target="<?php echo get_theme_mod( 'photo_journal_header_url_target' ) ? '_blank' : '_self'; ?>"  > <span class="more-button"><?php echo esc_html( $button_text ); ?><span class="screen-reader-text"><?php echo wp_kses_post( $header_media_title ); ?><?php endif; ?></span></span></a></p>
</div>
<?php endif; ?>
