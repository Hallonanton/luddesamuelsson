/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages

/*==============================================================================

  # Local scroll 
  # Cookie consent
  # Menu toggle
  # function()

==============================================================================*/

/*==============================================================================
  # Local scroll 
==============================================================================*/

/**
 * scrollTo()
 * 
 * ScrollTo scrolls to a given element in a given time
 * ScrollTo handlers calls the function onload if a hash is present and 
 * when a linked is clicked if the hash exists on the same page
 * 
 * @param $ele Element too scroll to 
 * @param $time Scroll time in ms
 * 
 * @return scrolls to element
 *
 * @version  1.0
 */

function scrollTo( $ele, $time ){
  var $offset = $ele.offset().top;
  $("html, body").animate({
    scrollTop: $offset+'px' 
  }, $time );
}
//ScrollTo handlers
var $hash = window.location.hash;
//If a link contains a hash and it exists on the same page, scroll to it
$( 'a' ).on( 'click', function( e ){
  var $target = $( this );
  //Do nothing if the link is a part of a no-scroll element
  if( !($target.parents( '.no-scroll' ).length) && !($target.hasClass('no-scroll')) ){
    //Get the a-tag if target is a child to the a-tag (This seams to be necessary if the link contains an svg-obj)
    if( !( $target.is( 'a' )) ){
      $target = $target.closest( 'a' );
    }
    //Check for hash, prevent default if found  
    var $href = $target.attr( 'href' ),
      $hrefIndex = $href.indexOf('#');
    //If link contains hash
    if( $hrefIndex >= 0 ){
      var $hrefLength = $href.length,
        $hash = $href.substring( $hrefIndex, $hrefLength );
      //If hash exists on this page
      if( $( $hash ).length ){
        e.preventDefault();
        scrollTo( $( $hash ), 500 );
      }
    }
  }
});

//Scrolls to hash on page load if it exists
if( $hash.length > 0 ){
  scrollTo( $( $hash ), 1500 );
}

//<!--ScrollTo handlers End-->


/*==============================================================================
  # Cookie consent
==============================================================================*/

$( '#cookie-close' ).on( 'click', function(e) {
  $( this ).closest( '.cookie-container' ).addClass( 'hide' );

  var data = {};

  $.ajax({
    type: 'POST',
    dataType : 'json',
    url: my_ajax_object.ajax_url,
    data: {action: 'set_seen_cookie_box', data : data},
    success: function(data){

    }
  });
});


/*==============================================================================
  # Menu toggle 
==============================================================================*/

function handleMainMenu( open ) {
  if ( open ) {
    $('body').addClass('menu-open');
    $('#menu-btn').addClass('open');
    $('#main-nav').addClass('open');

  } else {
    $('body').removeClass('menu-open');
    $('#menu-btn').removeClass('open');
    $('#main-nav').removeClass('open');

  }
}

$('#menu-btn').on('click', function(){
  var isOpen = $(this).hasClass('open');
  handleMainMenu( !isOpen );
});


/*==============================================================================
  # function()
==============================================================================*/



/*==============================================================================
  <!-- End of custom javascript -->  
==============================================================================*/

      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
