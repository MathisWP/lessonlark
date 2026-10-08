/**
 * Editor UI for the Booking form block.
 * Plain ES5 + wp globals so the plugin needs no build step.
 */
( function ( wp ) {
	var el = wp.element.createElement;
	var __ = wp.i18n.__;
	var be = wp.blockEditor;
	var c = wp.components;
	var ServerSideRender = wp.serverSideRender;

	wp.blocks.registerBlockType( 'lessonlark/booking-form', {
		edit: function ( props ) {
			var a = props.attributes;
			var set = props.setAttributes;

			return el(
				'div',
				be.useBlockProps(),
				el(
					be.InspectorControls,
					null,
					el(
						c.PanelBody,
						{ title: __( 'Form settings', 'lessonlark-booking' ) },
						el( c.TextControl, {
							label: __( 'Send requests to', 'lessonlark-booking' ),
							help: __( 'Leave empty to use the site admin email.', 'lessonlark-booking' ),
							type: 'email',
							value: a.recipient,
							onChange: function ( v ) { set( { recipient: v } ); },
						} ),
						el( c.TextareaControl, {
							label: __( 'Subjects', 'lessonlark-booking' ),
							help: __( 'Comma-separated. Leave empty for the defaults.', 'lessonlark-booking' ),
							value: a.subjects,
							onChange: function ( v ) { set( { subjects: v } ); },
						} ),
						el( c.TextControl, {
							label: __( 'Button text', 'lessonlark-booking' ),
							value: a.submitLabel,
							placeholder: __( 'Request my free consultation', 'lessonlark-booking' ),
							onChange: function ( v ) { set( { submitLabel: v } ); },
						} ),
						el( c.TextareaControl, {
							label: __( 'Success message', 'lessonlark-booking' ),
							value: a.successMessage,
							placeholder: __( 'Thanks! Your request is in. You’ll hear back within one business day.', 'lessonlark-booking' ),
							onChange: function ( v ) { set( { successMessage: v } ); },
						} ),
						el( c.ToggleControl, {
							label: __( 'Email a confirmation to the visitor', 'lessonlark-booking' ),
							checked: a.sendConfirmation,
							onChange: function ( v ) { set( { sendConfirmation: v } ); },
						} )
					)
				),
				el(
					c.Disabled,
					null,
					el( ServerSideRender, { block: 'lessonlark/booking-form', attributes: a } )
				)
			);
		},
		save: function () {
			return null;
		},
	} );
} )( window.wp );
