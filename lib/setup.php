<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Enable features from Soil when plugin is activated
  // https://roots.io/plugins/soil/
  add_theme_support('soil-clean-up');
  add_theme_support('soil-nav-walker');
  add_theme_support('soil-nice-search');
  add_theme_support('soil-jquery-cdn');
  add_theme_support('soil-relative-urls');

  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primär meny', 'sage')
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  ///add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  add_editor_style(Assets\asset_path('styles/main.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'sage'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer', 'sage'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_front_page(),
    is_page_template('template-custom.php'),
  ]);

  return apply_filters('sage/display_sidebar', $display);
}

/**
 * Theme assets
 */
function assets() {
/**CSS**/
  wp_enqueue_style('sage/css', Assets\asset_path('styles/main.css'), false, '1.0');

/**JAVASCRIPT**/
  wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js'), ['jquery'], '1.0', true);

/**AJAX**/
  wp_localize_script( 'sage/js', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);


/*==============================================================================
  # Remove user roles
==============================================================================*/

remove_role( 'subscriber' );
remove_role( 'editor' );
remove_role( 'author' );


/*==============================================================================
  # Register custom post_types and taxonomies
==============================================================================*/

/**
 * Register Föreställningar
 */

$labels = array(
  'name'                => 'Föreställningar', 
  'menu_name'           => 'Föreställningar',
  'singular_name'       => 'Föreställning',
  'all_items'           => 'Alla föreställningar',
  'edit_item'           => 'Ändra föreställning',
  'update_item'         => 'Uppdatera föreställning',
  'add_new_item'        => 'Skapa ny föreställning',
  'new_item'            => 'Skapa ny föreställning',
  'view_item'           => 'Visa föreställning',
);

$args = array(
  'labels'              => $labels,
  'public'              => true,
  'publicly_queriable'  => false,
  'show_in_nav_menus'   => true,
  'menu_icon'           => 'dashicons-tickets-alt',
  'has_archive'         => false,
  'supports'            => array('title','page-attributes')
  );
register_post_type( 'shows', $args );

$labels = array(
  'name'                => 'Föreställningar',
  'menu_name'           => 'Föreställningar',
  'singular_name'       => 'Föreställning',
  'search_items'        => 'Sök föreställning',
  'all_items'           => 'Alla föreställningar',
  'edit_item'           => 'Ändra föreställning',
  'update_item'         => 'Uppdatera föreställning',
  'add_new_item'        => 'Skapa ny föreställning',
  'new_item'            => 'Skapa ny föreställning',
  'view_item'           => 'Visa föreställning',
);
$args = array(
  'public'              => false,
  'publicly_queryable'  => false,
  'show_ui'             => true,
  'show_in_menu'        => true,
  'show_in_nav_menus'   => false,
  'show_admin_column'   => true,
  'hierarchical'        => true,
  'query_var'           => true,
  'labels'              => $labels,
);
register_taxonomy( 'show_name', array( 'shows' ), $args );