$( document ).ready( function() {
	var touchSupport, autosized = false;

	// Indicates if the browser supports the W3C Touch Events API (via Modernizr)
	if ( ('ontouchstart' in window ) || window.DocumentTouch && document instanceof DocumentTouch ) {
		touchSupport = true;
	} else {
		touchSupport = false;
	}

	// On larger screens, add more textarea rows when they are needed
	if ( $( window ).width() > 767 ) {
		autosize( $( 'textarea' ) );
		autosized = true;
	}

	// When Cyrillic textarea is filled, copy transliterated Latin text to Latin textarea
	$( "#cyrillic" ).on( 'input', function() {
		$( '#latin' ).val( serbianTransliteration.toLatin( $( this ).val() ) );
		maybeUpdateAutosize();
	} );

	// When Latin textarea is filled, copy transliterated Cyrillic text to Cyrillic textarea
	$( "#latin" ).on( 'input', function() {
		$( '#cyrillic' ).val( serbianTransliteration.toCyrillic( $( this ).val() ) );
		maybeUpdateAutosize();
	} );

	// When reset button if submitted, clean both textareas
	$( ".resetter-button" ).on( 'click', function() {
		var tooltipStatus;

		// Clean textareas
		$( '#cyrillic' ).val( '' );
		$( '#latin' ).val( '' );

		// Update textareas sizes
		maybeUpdateAutosize();

		// Get current elements tooltip status
		tooltipStatus = $( this ).data( 'tooltip-status' );

		// If element didn't have tooltip before, display one
		if ( 'hide' != tooltipStatus || 'show' != tooltipStatus ) {
			// Display tooltip
			$( this ).tooltip( {
				title: 'Очишћено!',
				trigger: 'click'
			} );
		}

		// Always display tooltip
		$( this ).data( 'tooltip-status', 'show' )
			.tooltip( 'show' );
	} );

	// Hide tooltip when mouse leaves button
	$( ".clipboard-button, .resetter-button" ).on( 'mouseleave', function() {
		maybeHideTooltip();
	} );

	// Hide tooltip when text is changed
	$( "#cyrillic, #latin" ).on( 'keypress', function() {
		maybeHideTooltip();
	} );

	// Add values to clipboard on events
	var clipboardButtons = new Clipboard( '.clipboard-button' );

	// Display tooltips when buttons values is added to clipboard
	clipboardButtons.on( 'success', function( e ) {
		var title, tooltipStatus;

		// Get current elements tooltip status
		tooltipStatus = $( e.trigger ).data( 'tooltip-status' );

		// If element didn't have tooltip before, display one
		if ( 'hide' != tooltipStatus || 'show' != tooltipStatus ) {
			// Show title depending on action
			if ( 'cut' == e.action ) {
				title = 'Исечено!';
			} else {
				title = 'Умножено!';
			};

			// Display tooltip
			$( e.trigger ).tooltip( {
				title: title,
				trigger: 'click'
			} );
		}

		// Always display tooltip
		$( e.trigger ).data( 'tooltip-status', 'show' )
			.tooltip( 'show' );

		e.clearSelection();
	} );

	// Force autoresizing of textareas
	var maybeUpdateAutosize = function() {
		if ( autosized ) {
			autosize.update( $( 'textarea' ) );
		}
	}

	// Hide tooltips on all buttons
	var maybeHideTooltip = function() {
		$( ".clipboard-button, .resetter-button" ).each( function() {
			if ( 'show' == $( this ).data( 'tooltip-status' ) ) {
				$( this ).data( 'tooltip-status', 'hide' )
					.tooltip('hide');
			}
		} );
	}

	// Only if device doesn't have touch support
	if ( ! touchSupport ) {
		// Display shortcuts modal link
		$( '#shortcuts-link' ).removeAttr( 'hidden' );

		// Add keyboard shorcuts
		Mousetrap.bind( 'mod+alt+u', function() {
			$( "#cyrillic-copy" ).trigger( "click" );
			return false;
		} );
		Mousetrap.bind( 'mod+alt+i', function() {
			$( "#cyrillic-cut" ).trigger( "click" );
			return false;
		} );
		Mousetrap.bind( 'mod+alt+o', function() {
			$( "#cyrillic-reset" ).trigger( "click" );
			return false;
		} );
		Mousetrap.bind( 'mod+shift+alt+u', function() {
			$( "#latin-copy" ).trigger( "click" );
			return false;
		} );
		Mousetrap.bind( 'mod+shift+alt+i', function() {
			$( "#latin-cut" ).trigger( "click" );
			return false;
		} );
		Mousetrap.bind( 'mod+shift+alt+o', function() {
			$( "#latin-reset" ).trigger( "click" );
			return false;
		} );
		Mousetrap.bind( "mod+alt+c", function() {
			$( "#cyrillic" ).focus();
			return false;
		} );
		Mousetrap.bind( [ 'mod+alt+l', 'mod+shift+alt+l' ], function() {
			$( "#latin" ).focus();
			return false;
		} );
	}
} );
