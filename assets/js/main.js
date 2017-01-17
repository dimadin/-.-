$( document ).ready( function() {
	var autosized = false;

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

	// Hide tooltip when mouse leaves it
	$( ".clipboard-button, .resetter-button" ).on( 'mouseleave', function() {
		if ( 'show' == $( this ).data( 'tooltip-status' ) ) {
			$( this ).data( 'tooltip-status', 'hide' )
				.tooltip('hide');
		}
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

	var maybeUpdateAutosize = function() {
		if ( autosized ) {
			autosize.update( $( 'textarea' ) );
		}
	}
} );
