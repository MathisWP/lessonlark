/**
 * Editor UI for the Scheduler block.
 * Plain ES5 + wp globals so the plugin needs no build step.
 */
( function ( wp ) {
	var el = wp.element.createElement;
	var useState = wp.element.useState;
	var __ = wp.i18n.__;
	var be = wp.blockEditor;
	var c = wp.components;

	var HOSTS = /^https:\/\/([a-z0-9-]+\.)*(calendly\.com|cal\.com)\//i;

	function Placeholder( props ) {
		var draft = useState( props.url || '' );
		var value = draft[ 0 ];
		var setValue = draft[ 1 ];
		var valid = HOSTS.test( value.trim() );

		return el(
			c.Placeholder,
			{
				icon: 'clock',
				label: __( 'Scheduler', 'lessonlark-booking' ),
				instructions: __( 'Paste your Cal.com or Calendly booking link, e.g. https://cal.com/your-name/consultation or https://calendly.com/your-name/30min', 'lessonlark-booking' ),
			},
			el(
				'form',
				{
					style: { display: 'flex', gap: '8px', width: '100%' },
					onSubmit: function ( e ) {
						e.preventDefault();
						if ( valid ) {
							props.onChange( value.trim() );
						}
					},
				},
				el( 'input', {
					type: 'url',
					className: 'components-placeholder__input',
					placeholder: 'https://cal.com/…',
					value: value,
					style: { flex: 1 },
					onChange: function ( e ) { setValue( e.target.value ); },
				} ),
				el( c.Button, { variant: 'primary', type: 'submit', disabled: ! valid }, __( 'Embed', 'lessonlark-booking' ) )
			),
			value && ! valid
				? el( 'p', { style: { color: '#b32d2e', margin: '8px 0 0' } }, __( 'Use an https:// link from cal.com or calendly.com.', 'lessonlark-booking' ) )
				: null
		);
	}

	wp.blocks.registerBlockType( 'lessonlark/scheduler', {
		edit: function ( props ) {
			var a = props.attributes;
			var set = props.setAttributes;
			var blockProps = be.useBlockProps();

			if ( ! a.url ) {
				return el( 'div', blockProps, el( Placeholder, { url: a.url, onChange: function ( url ) { set( { url: url } ); } } ) );
			}

			return el(
				'div',
				blockProps,
				el(
					be.InspectorControls,
					null,
					el(
						c.PanelBody,
						{ title: __( 'Scheduler settings', 'lessonlark-booking' ) },
						el( c.TextControl, {
							label: __( 'Booking link', 'lessonlark-booking' ),
							type: 'url',
							value: a.url,
							onChange: function ( v ) { set( { url: v } ); },
						} ),
						el( c.RangeControl, {
							label: __( 'Height (px)', 'lessonlark-booking' ),
							min: 400,
							max: 1200,
							step: 10,
							value: a.height,
							onChange: function ( v ) { set( { height: v } ); },
						} )
					)
				),
				el(
					'div',
					{ className: 'lessonlark-scheduler', style: { height: a.height + 'px' } },
					el( 'iframe', {
						src: a.url,
						title: __( 'Scheduling calendar preview', 'lessonlark-booking' ),
						style: { width: '100%', height: '100%', border: 0, pointerEvents: 'none' },
					} )
				)
			);
		},
		save: function () {
			return null;
		},
	} );
} )( window.wp );
