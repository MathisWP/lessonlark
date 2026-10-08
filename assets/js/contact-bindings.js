/**
 * Editor side of the "lessonlark/contact" block bindings source: shows the
 * saved contact details in connected blocks while editing. Values are set
 * under Appearance → Contact details, so they're read-only here.
 */
( function ( wp, data ) {
	if ( ! data || ! wp.blocks || ! wp.blocks.registerBlockBindingsSource ) {
		return; // WordPress before 6.7 falls back to the block's own text in the editor.
	}

	wp.blocks.registerBlockBindingsSource( {
		name: 'lessonlark/contact',
		label: data.label,
		getValues: function ( args ) {
			var out = {};
			Object.keys( args.bindings ).forEach( function ( attribute ) {
				var key = args.bindings[ attribute ].args && args.bindings[ attribute ].args.key;
				var value = data.values[ key ];
				if ( value !== null && value !== undefined ) {
					out[ attribute ] = value;
				}
			} );
			return out;
		},
		canUserEditValue: function () {
			return false;
		},
	} );
} )( window.wp, window.lessonlarkContact );
