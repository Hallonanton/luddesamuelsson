(function($) {
    //Use custom marker
    var marker_url = '/wp-content/themes/theme-name/assets/images/pin.png';

    //Use custom style
    var style= [
        {
            "featureType": "road",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#b1ab85"
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#8cc0c3"
                }
            ]
        },
        {
            "featureType": "poi.park",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#cde6cf"
                }
            ]
        },
        {
            "featureType": "landscape.man_made",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#efede8"
                }
            ]
        }
    ];


/*==============================================================================
  ##1.    Google maps      
==============================================================================*/

    /**
    * Add markers
    */
    function add_marker( $marker, map ) {

        var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

        /*var iconObj = { //38, 51
            url         : marker_url, //<--marker_url = variable
            size        : new google.maps.Size(38, 51),
            scaledSize  : new google.maps.Size(38, 51),
        };*/
        var marker = new google.maps.Marker({
            //icon        : iconObj,
            position    : latlng,
            map         : map
        });

        map.markers.push( marker );

        if( $marker.html() )
        {
            var infowindow = new google.maps.InfoWindow({
               content   : $marker.html()
            });
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open( map, marker );
            });
        }
    }

    /**
    * Center map
    */
    function center_map( map ) {
        var bounds = new google.maps.LatLngBounds();
    
        $.each( map.markers, function( i, marker ){
            var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
            bounds.extend( latlng );
        });

        if( map.markers.length === 1 )
        {
            map.setCenter( bounds.getCenter() );
            map.setZoom( 14 );
      
        }else{
            map.fitBounds( bounds );
        }
    }

    /**
    * Create map
    */
    function new_map( $el ) {
        var $markers = $el.find('.marker');
        var args = {
            zoom                : 14,
            disableDefaultUI    : true,
            draggable           : true,
            fullscreenControl   : true,
            zoomControl         : true,
            scrollwheel         : false,
            mapTypeControl      : false,
            panControl          : false,
            signInControl       : false,
            streetViewControl   : false,
            //styles              : style, //<--style = variable
            center              : new google.maps.LatLng(0, 0),
            mapTypeId           : google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map( $el[0], args);
        map.markers = [];

        $markers.each(function(){ 
            add_marker( $(this), map );
        });

        center_map( map );

        return map;
    }

    /**
    * Create map
    */
    var map = null;
    $('.acf-map').each(function(){
        map = new_map( $(this) );
    });

})(jQuery);