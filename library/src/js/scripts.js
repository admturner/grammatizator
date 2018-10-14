/*
 * Grammatizator Scripts File
 * Author: Eddie Machado
 * Author: Adam Turner
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * Dependencies: jQuery
 *
 * @since 0.4
 */

var viewport = updateViewportDimensions();
var timeToWaitForLast = 100;

/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them
 * off, for better performance, esp. on mobile.
 */
var waitForFinalEvent = ( function() {
	var timers = {};
	return function( callback, ms, uniqueId ) {
		if ( ! uniqueId ) {
			uniqueId = 'Do not call this twice without a uniqueId';
		}
		if ( timers[uniqueId] ) {
			clearTimeout ( timers[uniqueId] );
		}
		timers[uniqueId] = setTimeout( callback, ms );
	};
}() );

/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height
 * properties. See:
 * http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript
 */
function updateViewportDimensions() {
	var w = window,
		d = document,
		e = d.documentElement,
		g = d.getElementsByTagName( 'body' )[0],
		x = w.innerWidth || e.clientWidth || g.clientWidth,
		y = w.innerHeight || e.clientHeight || g.clientHeight;

	return { width: x, height: y };
}

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
*/
function loadGravatars() {
	viewport = updateViewportDimensions();
	if ( 768 <= viewport.width ) {
		jQuery( '.comment img[data-gravatar]' ).each( function() {
			jQuery( this ).attr( 'src', jQuery( this ).attr( 'data-gravatar' ) );
		} );
	}
}

/*
 * Put all your regular jQuery in here.
*/
jQuery( document ).ready( function( $ ) {

	/*
	 * Let's fire off the gravatar function
	 * You can remove this if you don't need it
	 */
	waitForFinalEvent( loadGravatars(), timeToWaitForLast, 'load-gravatars' );

	/* Toggly nav menu learned and liberally borrowed from:
	 * http://www.filamentgroup.com/lab/responsive-design-approach-for-navigation.html
	 * http://http://alistapart.com/
	 *
	 * This script mostly just watches for clicks on the Menu button and toggles
	 * some classes, then CSS does the rest to handle display and styling.
	 *
	 * @since 0.4
	 */
	$( '.global-nav' ).addClass( 'fancy' );
	$( '.nav-jump' ).click( function() {
		var navvy = $( 'html' ).hasClass( 'show-nav' );

		if ( ! navvy ) {
			$( 'html' ).addClass( 'show-nav' );
		} else {
			$( 'html' ).removeClass( 'show-nav' );
		}

		return false;
	} );

	$( '.global-nav' ).click( function( event ) {
		event.stopPropagation();
	} );

	$( 'body' ).click( function() {
		$( 'html' ).removeClass( 'show-nav' );
	} );
} );
