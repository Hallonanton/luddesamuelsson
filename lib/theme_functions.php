<?php 
/*==============================================================================

  # Add img sizes
  # Clean up the admin menu
  # Sanitize uploaded file name
  # Move Yoast meta to bottom
  # AJAX Set seen cookie box
  # Change excerpt
  # Wrap string with phone- or mail-link
  # Register footer menu
  # Google maps API

==============================================================================*/

/*==============================================================================
  # Add img sizes
==============================================================================*/

add_action( 'init', 'custom_img_sizes' );
function custom_img_sizes(){
  
  add_image_size( 'logo',  250, 150);
  add_image_size( 'logo_retina',  500, 300);

}
add_filter('jpeg_quality', function($arg){ return 100; });


/*==============================================================================
  # Clean up the admin menu
==============================================================================*/

//Remove these pages from the menu so that the user has a easier time finding whats important
add_action( 'admin_menu', 'custom_menu_page_removing' );
function custom_menu_page_removing() { 
  remove_menu_page( 'edit-comments.php' );          //Comments
  remove_menu_page( 'edit.php' );                   //Posts
}

add_action( 'admin_menu', 'adjust_the_wp_menu', 999 );
function adjust_the_wp_menu() {
  remove_submenu_page( 'themes.php', 'theme-editor.php' );
  remove_submenu_page( 'themes.php', 'widgets.php' );
  //remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
  remove_submenu_page( 'options-general.php', 'options-discussion.php' );
}


/*==============================================================================
  # Sanitize uploaded file name
==============================================================================*/

function safe_file_name( $filename ) {
  if( $filename ){
    $filename = esc_attr( $filename );
    $filename = str_replace([' ','/',','],'-',strtolower( $filename ));
    $filename = str_replace(['ö'],'o', $filename);
    $filename = str_replace(['å','ä'],'a', $filename);
    $filename = preg_replace( '/-{2,}/', '-', $filename );
    return $filename;
  }else{
    return false;
  }
}
add_filter( 'sanitize_file_name', 'safe_file_name', 10 );


/*==============================================================================
  # Move Yoast meta to bottom
==============================================================================*/

function yoasttobottom() {
  return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');


/*==============================================================================
  # AJAX Set seen cookie box
==============================================================================*/

function num_of_weeks( $weeks = 4 ){
  return 60*60*24*7*(int)$weeks;
}

function set_seen_cookie_box(){

  setcookie( 'seen_cookie_box', 'seen', time()+num_of_weeks(52), '/' );

  die();
}
add_action("wp_ajax_set_seen_cookie_box", "set_seen_cookie_box");
add_action("wp_ajax_nopriv_set_seen_cookie_box", "set_seen_cookie_box");


/*==============================================================================
  # Change excerpt
==============================================================================*/

/**
 * apply_custom_excerpt()
 * 
 * Makes it possible to make any text into an excerpt with a custom link
 *
 * @param $content full text that will become the excerpt
 * @param $link if set adds a link at the end of the excerpt
 * @param $target  if added the link gets target="_blank"
 * 
 * @return returns the excerpt
 *
 * @version 1.0
 */ 

global $excerpt_link;
global $excerpt_link_target;

function new_excerpt_more( $more ) {
  global $post;
  global $excerpt_link;
  global $excerpt_link_target;
  
  $more_tag  = '... ';
  
  if( $excerpt_link !== false ){
    $target = '';
    $read_more = __( 'Läs mer' );
    if( $excerpt_link_target !== false ){
      $target = 'target="_blank"';
    }
    $read_more = '<a class="text-link" href="'.$excerpt_link.'" '.$target.'>'.$read_more.'</a>';
    $more_tag .= $read_more;
  }

  return $more_tag;
}
function new_excerpt_length( $length ) {
    return 25;
}
function rw_trim_excerpt( $text='' )
{
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
    $excerpt_length = apply_filters('excerpt_length', 'new_excerpt_more' );
    $excerpt_more = apply_filters('excerpt_more', 'new_excerpt_more' );
    return wp_trim_words( $text, $excerpt_length, $excerpt_more );
}

add_filter( 'excerpt_more', 'new_excerpt_more' );
add_filter( 'excerpt_length', 'new_excerpt_length' );
add_filter( 'wp_trim_excerpt', 'rw_trim_excerpt' );

function apply_custom_excerpt( $content, $link = false, $target = false ){
  global $excerpt_link;
  global $excerpt_link_target;
  $excerpt_link = $link;
  $excerpt_link_target = $target;
  return apply_filters( 'get_the_excerpt', $content ); 
}



/*==============================================================================
  # Wrap string with phone- or mail-link
==============================================================================*/

/**
 * convert_string_to_link()
 * 
 * Finds phonenumbers and emailadresses inside a given string and
 * wraps them with a tel: or mailto: link
 *
 * @param $string search for phonenumbers and emailadresses inside this string
 * @param $linkclass add a class to the wraped link
 * 
 * @return string with wrapped links
 * 
 * @version 2.0
 */ 

function convert_string_to_link( $string, $linkclass = '' ){
  settype( $string, 'string' );

  //Match phone
    $phone_matches = array(
      '[+0-9]{2,5}[\-\s]{1,3}[0-9]{2,}[\s][0-9]{2,}[\s][0-9]{2,}[\s][0-9]{2,}',
      '[+0-9]{2,5}[\-\s]{1,3}[0-9]{2,}[\s][0-9]{2,}[\s][0-9]{2,}',
      '[+0-9]{2,5}[\-\s]{1,3}[0-9]{2,}[\s][0-9]{2,}',
      '[+0-9]{2,5}[\-\s]{1,3}[0-9]{5,}',
      '[+0-9]{5,}',
    );
    $phone_reg = '/';
    $phone_reg .= implode( '|', $phone_matches );
    $phone_reg .= '/';

    $string = preg_replace_callback( $phone_reg, function($match) use ($linkclass){
      $class = ( $linkclass ) ? ' class="'.$linkclass.'"' : '';
      $tel = str_replace( [' ','-'], '', $match[0] );
      $replacement = '<a href="tel:'.$tel.'"'.$class.'>'.$match[0].'</a>';
      return $replacement;
    }, $string );

  //Match mail
    $mail_matches = array(
      '[a-zA-ZåäaÅÄÖ0-9-_.]{2,}[\@][a-zA-ZåäaÅÄÖ0-9-_.]{2,}[\.][a-zA-ZåäaÅÄÖ0-9-_.]{2,8}',
    );
    $mail_reg = '/';
    $mail_reg .= implode( '|' , $mail_matches );
    $mail_reg .= '/';

    $string = preg_replace_callback( $mail_reg, function($match) use ($linkclass){
      $class = ( $linkclass ) ? ' class="'.$linkclass.'"' : '';
      $replacement = '<a href="mailto:'.$match[0].'"'.$class.'>'.$match[0].'</a>';
      return $replacement;
    }, $string );  

  return $string;
}


/*==============================================================================
  # Register footer menu
==============================================================================*/

add_action( 'after_setup_theme', 'register_custom_nav_menus' );
function register_custom_nav_menus() {
  register_nav_menus( array(
    'footer_menu' => 'Footer meny',
  ) );
}


/*==============================================================================
  # Google maps API
==============================================================================*/

function my_acf_init() {
  $google_maps_key = get_field( 'google_maps_key', 'options' );
  acf_update_setting('google_api_key', $google_maps_key );
}
add_action('acf/init', 'my_acf_init');