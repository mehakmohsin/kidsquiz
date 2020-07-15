/**
 * File live_title_desc.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

(
	function( $ ) {
		// Site title and description.
		wp.customize( 'blogname', function( value ) {
			value.bind( function( to ) {
				$( '.site__title a' ).text( to );
			} );
		} );
		wp.customize( 'blogdescription', function( value ) {
			value.bind( function( to ) {
				$( '.site__description' ).text( to );
			} );
		} );
	}
)( jQuery );
