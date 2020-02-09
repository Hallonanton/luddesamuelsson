<?php
/*==============================================================================

  # Remove page support
  # Add options pages
  # Google maps API
  # Enqueue styles for ACF-adminpage
  # Add Avancerade inställningar

==============================================================================*/

/*==============================================================================
  # Remove page support
==============================================================================*/

//These are removed so that the user easier can detect what is what when adding ACF-fields
add_action('init', 'custom_page_support');
function custom_page_support(){
  //remove_post_type_support('page', 'editor'); Better to remove via ACF-fields
  remove_post_type_support('page', 'thumbnail');
}
add_action('admin_init', 'remove_acf_options_page', 99);
function remove_acf_options_page() {
   remove_menu_page('acf-options');
}


/*==============================================================================
  # Add options pages
==============================================================================*/

function add_custom_acf_options_page(){   
  if( function_exists( 'acf_add_options_page' ) ){
    acf_add_options_page(array(
      'page_title'   => 'Temainställningar',
      'menu_title'   => 'Temainställningar',
      'menu_slug'    => 'general_fields',
      'capability'   => 'edit_posts',
      'parent_slug'  => '',
      'position'     => '8',
      'icon_url'     => false,
      'redirect'     => true,
    ));
    acf_add_options_page(array(
      'page_title'   => 'Generella fält',
      'parent_slug'  => 'general_fields',
    ));
  }
}
add_action( 'init', 'add_custom_acf_options_page' );


/*==============================================================================
  # Enqueue styles for ACF-adminpage
==============================================================================*/

function my_acf_admin_enqueue_scripts() {
    wp_register_style( 'acf-admin-css', get_stylesheet_directory_uri() . '/assets/styles/components/acf-admin.css', false, '1.0.0' );
    wp_enqueue_style( 'acf-admin-css' );
}
add_action( 'acf/input/admin_enqueue_scripts', 'my_acf_admin_enqueue_scripts' );


/*==============================================================================
  # ACF render custom blocks
==============================================================================*/

function my_acf_block_render_callback( $block ) {

  // convert name ("acf/testimonial") into path friendly slug ("testimonial")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from within the "template-parts/block" folder
  if( file_exists( get_theme_file_path("/templates/blocks/block-{$slug}.php") ) ) {
    include( get_theme_file_path("/templates/blocks/block-{$slug}.php") );
  }
}

/*==============================================================================
  # Gutenberg custom ategories
==============================================================================*/

add_filter( 'block_categories', function( $categories, $post ) {
    return array_merge(
        $categories,
        array(
            array(
                'slug'  => 'ludde',
                'title' => 'Ludde',
            ),
        )
    );
}, 10, 2 );

/*==============================================================================
  # ACF custom blocks
==============================================================================*/

add_action('acf/init', 'register_custom_blocks');
function register_custom_blocks() {

  // check function exists
  if( function_exists('acf_register_block') ) {

    // register a hero
    acf_register_block(array(
      'name'              => 'hero',
      'title'             => __('Hero'),
      'description'       => __('Skapat för att används längst upp på en sida.'),
      'render_callback'   => 'my_acf_block_render_callback',
      'category'          => 'ludde',
      'icon'              => 'format-image',
      'keywords'          => array( 'image', 'bild', 'hero', 'cover' ),
      'mode'              => 'edit',
      'supports'          => array(
        'align' => true,
        'mode'  => false
      ),
    ));

    // register a tickets
    acf_register_block(array(
      'name'              => 'tickets',
      'title'             => __('Biljettförsäljning'),
      'description'       => __('Lista föreställningar.'),
      'render_callback'   => 'my_acf_block_render_callback',
      'category'          => 'ludde',
      'icon'              => 'tickets-alt',
      'keywords'          => array( 'tickets', 'show', 'biljetter', 'föreställning' ),
      'mode'              => 'edit',
      'supports'          => array(
        'align' => false,
        'mode'  => false
      ),
    ));

    // register a instagram
    acf_register_block(array(
      'name'              => 'instagram',
      'title'             => __('Instagram'),
      'render_callback'   => 'my_acf_block_render_callback',
      'category'          => 'ludde',
      'icon'              => 'format-gallery',
      'keywords'          => array( 'instagram', 'image', 'bild' ),
      'mode'              => 'edit',
      'supports'          => array(
        'align' => false,
        'mode'  => false
      ),
    ));

  }
};