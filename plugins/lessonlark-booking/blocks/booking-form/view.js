/**
 * Progressive enhancement for the Booking form: submit with fetch(), show
 * field errors inline, and swap in the success panel without a page reload.
 * Without this script the form still posts normally and redirects back.
 */
( function () {
	function clearErrors( form ) {
		form.querySelectorAll( '.lessonlark-booking__error' ).forEach( function ( n ) {
			n.remove();
		} );
		form.querySelectorAll( '[aria-invalid]' ).forEach( function ( n ) {
			n.removeAttribute( 'aria-invalid' );
			n.removeAttribute( 'aria-describedby' );
		} );
	}

	function showFieldError( form, name, message ) {
		var input = form.querySelector( '[name="' + name + '"]' );
		if ( ! input ) {
			return null;
		}
		var id = input.id + '-error';
		var p = document.createElement( 'p' );
		p.className = 'lessonlark-booking__error';
		p.id = id;
		p.textContent = message;
		input.setAttribute( 'aria-invalid', 'true' );
		input.setAttribute( 'aria-describedby', id );
		input.insertAdjacentElement( 'afterend', p );
		return input;
	}

	function validate( form ) {
		var errors = {};
		var name = form.elements.llb_parent_name;
		var email = form.elements.llb_email;
		if ( ! name.value.trim() ) {
			errors.llb_parent_name = name.dataset.error || 'Please enter your name.';
		}
		if ( ! email.value.trim() || ! email.checkValidity() ) {
			errors.llb_email = email.dataset.error || 'Please enter a valid email address.';
		}
		return errors;
	}

	function init( root ) {
		var form = root.querySelector( '.lessonlark-booking__form' );
		var success = root.querySelector( '.lessonlark-booking__success' );
		var alertBox = root.querySelector( '.lessonlark-booking__alert' );
		var button = form.querySelector( 'button[type="submit"]' );
		var label = button.textContent;

		form.addEventListener( 'submit', function ( event ) {
			event.preventDefault();
			clearErrors( form );
			alertBox.hidden = true;

			var errors = validate( form );
			var first = null;
			Object.keys( errors ).forEach( function ( key ) {
				first = first || showFieldError( form, key, errors[ key ] );
			} );
			if ( first ) {
				first.focus();
				return;
			}

			var data = new FormData( form );
			data.append( 'llb_ajax', '1' );
			button.disabled = true;
			button.textContent = button.dataset.sending || 'Sending…';

			// getAttribute, not form.action: the hidden <input name="action"> shadows that property.
			fetch( form.getAttribute( 'action' ), { method: 'POST', body: data, credentials: 'same-origin' } )
				.then( function ( response ) {
					return response.json();
				} )
				.then( function ( json ) {
					if ( json && json.success ) {
						form.hidden = true;
						success.hidden = false;
						success.focus();
						return;
					}
					var payload = ( json && json.data ) || {};
					var firstInvalid = null;
					Object.keys( payload.errors || {} ).forEach( function ( key ) {
						firstInvalid = firstInvalid || showFieldError( form, key, payload.errors[ key ] );
					} );
					alertBox.textContent = payload.message || alertBox.textContent;
					alertBox.hidden = false; // role="alert" announces it.
					if ( firstInvalid ) {
						firstInvalid.focus();
					}
				} )
				.catch( function () {
					alertBox.hidden = false;
				} )
				.finally( function () {
					button.disabled = false;
					button.textContent = label;
				} );
		} );
	}

	document.querySelectorAll( '.lessonlark-booking' ).forEach( init );
} )();
