<?php
  /* 
  Plugin Name: Sponsors Post Type
  Plugin URI: 
  Description: Custom post type for adding new sponsors 
  Version: 0.1.0
  Authour: Jason Lock
  Author URI: 
  License: GPL2
  */

function sponsorInit() {
  $sponsor = new Sponsor();
}
class Sponsor {
  function __construct() {
    $args = $this->setArgs();

    add_action( 'save_post', array('Sponsor', 'save_sponsor_compnay_metadata'), 1, 2);
    add_action( 'add_meta_boxes', array('Sponsor', 'partnerMetaBox') );
    add_filter( 'enter_title_here', array('Sponsor', 'setNameInputValue') );
    register_post_type( 'sponsor', $args ); 
    //add_action( 'admin_enqueue_scripts', array('Sponsor', 'scripts') );
  }
  
  function scripts() {
    wp_enqueue_script( 'script', plugins_url('/js/scripts.js', __FILE__) , array( 'jquery' ));
  }

  function partnerMetaBox() {
    add_meta_box( 'is_partner_box', __( ' ' ), array('Sponsor', 'displayIsPartner'), 'sponsor', 'side', 'high' );
  }

  function displayIsPartner( $object, $box ) {
    wp_nonce_field( plugin_basename( __FILE__ ), 'is_partner_box_nonce' );
    echo '<label for="is-partner">Are they a partner?</label>';
    
    $value = esc_attr( get_post_meta( $object->ID, 'is_partner_box', true ) );

    $checked = '';
    if ($value) {
      $checked = 'checked';
    }
    echo '<input class="widefat" type="checkbox" name="is-partner" id="is-partner" value="1" '. $checked .'/>';
  }

  function save_sponsor_compnay_metadata( $post_id, $post ) {
    $path = plugin_basename( __FILE__ );
    $nonce = $_POST['sponsor_metabox_nonce'];
    $meta_key = 'is_partner_box';
    $meta_box_value = $_POST['is-partner'];

    if ( isset($meta_box_value) ) {
      add_post_meta( $post_id, $meta_key, $meta_box_value );
    } else {  
      add_post_meta( $post_id, $meta_key, 0 );
    }
  }

  function setNameInputValue( $message ) {
    global $post;
    
    if ('sponsor' == $post->post_type) {
      $message = 'Enter Sponsors Name';
    }

    return $message;
  }

  function setArgs() {
    $labels = array(
      'name'               => _x( 'Sponsors', 'post type general name' ),
      'singular_name'      => _x( 'Sponsor', 'post type singular name' ),
      'add_new'            => _x( 'Add New', 'sponsor' ),
      'add_new_item'       => __( 'Add New Sponsor' ),
      'edit_item'          => __( 'Edit Sponsor' ),
      'new_item'           => __( 'New Sponsor' ),
      'all_items'          => __( 'All Sponsors' ),
      'view_item'          => __( 'View Sponsor' ),
      'search_items'       => __( 'Search Sponsors' ),
      'not_found'          => __( 'No sponsors found' ),
      'not_found_in_trash' => __( 'No sponsors found in the Trash' ), 
      'parent_item_colon'  => '',
      'menu_name'          => 'Sponsors'
    );

    $args = array(
      'labels'        => $labels,
      'description'   => 'Event sponsors',
      'public'        => true,
      'menu_position' => 5,
      'supports'      => array( 'title', 'editor', 'thumbnail' ),
      'has_archive'   => true,
    );

    return $args;
  }
}

add_action( 'init', 'sponsorInit' );
