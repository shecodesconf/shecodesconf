<?php
  /* 
  Plugin Name: Speakers Post Type
  Plugin URI: 
  Description: Custom post type for adding new speakers 
  Version: 0.1.0
  Authour: Jason Lock
  Author URI: 
  License: GPL2
  */

function speakerInit() {
  $speaker = new Speaker();
}
class Speaker {
  function __construct() {
    $args = $this->setArgs();

    add_action( 'save_post', array('Speaker', 'save_speaker_compnay_metadata'), 1, 2);
    add_action( 'add_meta_boxes', array('Speaker', 'companyMetaBox') );
    add_filter( 'enter_title_here', array('Speaker', 'setNameInputValue') );
    register_post_type( 'speaker', $args ); 
    //add_action( 'admin_enqueue_scripts', array('Speaker', 'scripts') );
  }
  
  function scripts() {
    wp_enqueue_script( 'script', plugins_url('/js/scripts.js', __FILE__) , array( 'jquery' ));
  }

  function companyMetaBox() {
    add_meta_box( 'speaker_company_box', __( 'Company Name' ), array('Speaker', 'displayCompanyName'), 'speaker', 'side', 'high' );
  }

  function displayCompanyName( $object, $box ) {
    wp_nonce_field( plugin_basename( __FILE__ ), 'speaker_metabox_nonce' );
    echo '<label for="speaker-company-name">Add Company Name</label>';
    echo '<input class="widefat" type="text" name="speaker-company-name" id="speaker-company-name" value="' . esc_attr( get_post_meta( $object->ID, 'speaker_company_box', true ) ) . '" />';
  }

  function save_speaker_compnay_metadata( $post_id, $post ) {
    $path = plugin_basename( __FILE__ );
    $nonce = $_POST['speaker_metabox_nonce'];
    $meta_key = 'speaker_company_box';
    $meta_box_value = $_POST['speaker-company-name'];

    if ( isset($meta_box_value) ) {
      add_post_meta( $post_id, $meta_key, $meta_box_value );
    } 

    /*
    if ( !isset( $nonce ) || !wp_verify_nonce( $nonce, $path ) )
    return $post_id;

    $post_type = get_post_type_object( $post->post_type );

    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
      return $post_id;

    $new_meta_value = ( isset( $meta_box_value ) ? sanitize_html_class( $meta_box_value ) : '' );

    $meta_value = get_post_meta( $post->ID, $meta_key, true );
    add_post_meta( $post->ID, $meta_key, $new_meta_value, true );

    if ( $new_meta_value && '' == $meta_value )
      add_post_meta( $post->ID, $meta_key, $new_meta_value, true );

    elseif ( $new_meta_value && $new_meta_value != $meta_value )
      update_post_meta( $post->ID, $meta_key, $new_meta_value );

    elseif ( '' == $new_meta_value && $meta_value )
      delete_post_meta( $post->ID, $meta_key, $meta_value );
    */
  }

  function setNameInputValue( $message ) {
    global $post;
    
    if ('speaker' == $post->post_type) {
      $message = 'Enter Speakers Name';
    }

    return $message;
  }

  function setArgs() {
    $labels = array(
      'name'               => _x( 'Speakers', 'post type general name' ),
      'singular_name'      => _x( 'Speaker', 'post type singular name' ),
      'add_new'            => _x( 'Add New', 'speaker' ),
      'add_new_item'       => __( 'Add New Speaker' ),
      'edit_item'          => __( 'Edit Speaker' ),
      'new_item'           => __( 'New Speaker' ),
      'all_items'          => __( 'All Speakers' ),
      'view_item'          => __( 'View Speaker' ),
      'search_items'       => __( 'Search Speakers' ),
      'not_found'          => __( 'No speakers found' ),
      'not_found_in_trash' => __( 'No speakers found in the Trash' ), 
      'parent_item_colon'  => '',
      'menu_name'          => 'Speakers'
    );

    $args = array(
      'labels'        => $labels,
      'description'   => 'Event speakers',
      'public'        => true,
      'menu_position' => 5,
      'supports'      => array( 'title', 'editor', 'thumbnail' ),
      'has_archive'   => true,
    );

    return $args;
  }
}

add_action( 'init', 'speakerInit' );
