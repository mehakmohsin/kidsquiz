(
	function( api ) {

		// Extends our custom "document" section.
		api.sectionConstructor[ 'document' ] = api.Section.extend( {

			// No events for this type of section.
			attachEvents: function() {
			},

			// Always make the section active.
			isContextuallyActive: function() {
				return true;
			}
		} );

		// Extends our custom "pro features" section.
		api.sectionConstructor[ 'upsell' ] = api.Section.extend( {

			// No events for this type of section.
			attachEvents: function() {
			},

			// Always make the section active.
			isContextuallyActive: function() {
				return true;
			}
		} );

	}
)( wp.customize );
