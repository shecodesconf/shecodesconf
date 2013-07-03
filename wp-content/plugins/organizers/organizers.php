<?php
  /* 
  Plugin Name: Organizers Post Type
  Plugin URI: 
  Description: Custom post type for adding new organizers 
  Version: 0.1.0
  Authour: Jason Lock
  Author URI: 
  License: GPL2
  */

function organizerInit() {
  $organizer = new Organizer();
}

class Organizer {
  function __construct() {
    $args = $this->setArgs();

    add_action( 'save_post', array('Organizer', 'save_organizer_compnay_metadata'), 1, 2);
    add_action( 'add_meta_boxes', array('Organizer', 'companyMetaBox') );
    add_filter( 'enter_title_here', array('Organizer', 'setNameInputValue') );
    register_post_type( 'organizer', $args ); 
    //add_action( 'admin_enqueue_scripts', array('Organizer', 'scripts') );
  }
  
  function scripts() {
    wp_enqueue_script( 'script', plugins_url('/js/scripts.js', __FILE__) , array( 'jquery' ));
  }

  function companyMetaBox() {
    add_meta_box( 'organizer_company_box', __( 'Company Name' ), array('Organizer', 'displayCompanyName'), 'organizer', 'side', 'high' );
  }

  function displayCompanyName( $object, $box ) {
    wp_nonce_field( plugin_basename( __FILE__ ), 'organizer_metabox_nonce' );
    echo '<label for="organizer-company-name">Add Company Name</label>';
    echo '<input class="widefat" type="text" name="organizer-company-name" id="organizer-company-name" value="' . esc_attr( get_post_meta( $object->ID, 'organizer_company_box', true ) ) . '" />';
  }

  function save_organizer_compnay_metadata( $post_id, $post ) {
    $path = plugin_basename( __FILE__ );
    $nonce = $_POST['organizer_metabox_nonce'];
    $meta_key = 'organizer_company_box';
    $meta_box_value = $_POST['organizer-company-name'];

    if ( isset($meta_box_value) ) {
      add_post_meta( $post_id, $meta_key, $meta_box_value );
    } 
  }

  function setNameInputValue( $message ) {
    global $post;
    
    if ('organizer' == $post->post_type) {
      $message = 'Enter Organizers Name';
    }

    return $message;
  }

  function setArgs() {
    $labels = array(
      'name'               => _x( 'Organizers', 'post type general name' ),
      'singular_name'      => _x( 'Organizer', 'post type singular name' ),
      'add_new'            => _x( 'Add New', 'organizer' ),
      'add_new_item'       => __( 'Add New Organizer' ),
      'edit_item'          => __( 'Edit Organizer' ),
      'new_item'           => __( 'New Organizer' ),
      'all_items'          => __( 'All Organizers' ),
      'view_item'          => __( 'View Organizer' ),
      'search_items'       => __( 'Search Organizers' ),
      'not_found'          => __( 'No organizers found' ),
      'not_found_in_trash' => __( 'No organizers found in the Trash' ), 
      'parent_item_colon'  => '',
      'menu_name'          => 'Organizers'
    );

    $args = array(
      'labels'        => $labels,
      'description'   => 'Event organizers',
      'public'        => true,
      'menu_position' => 5,
      'supports'      => array( 'title', 'editor', 'thumbnail' ),
      'has_archive'   => true,
    );

    return $args;
  }
}

add_action( 'init', 'organizerInit' );
