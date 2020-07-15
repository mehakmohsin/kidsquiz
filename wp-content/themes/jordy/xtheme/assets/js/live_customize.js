/**
 * File live_customize.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

(
	function( $ ) {
		wp.customize( 'topbar_phone', function( value ) {
			value.bind( function( to ) {
				$( '.top-bar__left .phone span' ).text( to );
			} );
		} );
		wp.customize( 'topbar_address', function( value ) {
			value.bind( function( to ) {
				$( '.top-bar__left .address span' ).text( to );
			} );
		} );
	}
)( jQuery );
