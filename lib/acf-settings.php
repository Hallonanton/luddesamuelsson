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
    acf_add_options_page(array(
      'page_title'   => 'Header',
      'parent_slug'  => 'general_fields',
    ));
    acf_add_options_page(array(
      'page_title'   => 'Footer',
      'parent_slug'  => 'general_fields',
    ));
    /*acf_add_options_page(array(
      'page_title'   => 'Avancerade inställningar',
      'parent_slug'  => 'general_fields',
    ));*/
  }
}
add_action( 'init', 'add_custom_acf_options_page' );


/*==============================================================================
  # Google maps API
==============================================================================*/

/*function my_acf_init() {
  $google_maps_key = get_field( 'google_maps_key', 'options' );
  acf_update_setting('google_api_key', $google_maps_key );
}
add_action('acf/init', 'my_acf_init');*/



/*==============================================================================
  # Enqueue styles for ACF-adminpage
==============================================================================*/

function my_acf_admin_enqueue_scripts() {
    wp_register_style( 'acf-admin-css', get_stylesheet_directory_uri() . '/assets/styles/components/acf-admin.css', false, '1.0.0' );
    wp_enqueue_style( 'acf-admin-css' );
}
add_action( 'acf/input/admin_enqueue_scripts', 'my_acf_admin_enqueue_scripts' );


/*==============================================================================
  # Add Avancerade inställningar
==============================================================================*/

/*if( function_exists('acf_add_local_field_group') ):
acf_add_local_field_group(array (
	'key' => 'group_590096c1f3c52',
	'title' => 'Avancerade inställningar',
	'fields' => array (
		array (
			'key' => 'field_5900978995043',
			'label' => 'Google maps key',
			'name' => 'google_maps_key',
			'type' => 'text',
			'instructions' => 'Lägg till en nyckel till Googlemaps API. Gå till https://developers.google.com/maps/documentation/javascript/get-api-key för att skapa en nyckel.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'acf-options-avancerade-installningar',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));
endif; //<!-- function_exists('acf_add_local_field_group') -->*/