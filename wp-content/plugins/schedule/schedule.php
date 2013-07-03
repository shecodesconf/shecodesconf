<?php
  /* 
  Plugin Name: Schedule Post Type
  Plugin URI: 
  Description: Custom post type for adding events 
  Version: 0.1.0
  Authour: Jason Lock
  Author URI: 
  License: GPL2
  */

function schedule_init() {
  $speaker = new Schedule();
}

class Schedule {
  function __construct() {
    $args = $this->setArgs();

    add_action( 'save_post', array('Schedule', 'save_schedule_metadata'), 1, 2);
    add_action( 'add_meta_boxes', array('Schedule', 'schedule_info_meta_box') );
    add_filter( 'enter_title_here', array('Schedule', 'set_title_name_iput') );
    register_post_type( 'schedule', $args ); 
  }

  function schedule_info_meta_box() {
    add_meta_box( 'schedule_info', __( 'Schedule Information' ), array('Schedule', 'display_schedule_info'), 'schedule', 'side', 'high' );
  }

  function display_schedule_info( $object, $box ) {
    wp_nonce_field( plugin_basename( __FILE__ ), 'schedule_info_nonce' );
    echo '<div style="margin-bottom:20px;">';
      echo '<label for="speaker_name" style="margin-bottom:5px;display:block;">Speakers Name</label>';
      echo '<input class="widefat" type="text" name="speaker_name" id="speaker_name" value="' . esc_attr( get_post_meta( $object->ID, 'speaker_name', true ) ) . '" />';
    echo '</div>';
    echo '<div style="margin-bottom:20px;">';
      echo '<label for="timeframe-from" style="margin-bottom:5px;display:block;">Time Slot</label>';
      echo '<input class="widefat" type="text" name="timeframe-from" id="timeframe-from" value="' . esc_attr( get_post_meta( $object->ID, 'timeframe-from', true ) ) . '" style="margin-bottom:5px;"/>';
      echo '<input class="widefat" type="text" name="timeframe-to" id="timeframe-to" value="' . esc_attr( get_post_meta( $object->ID, 'timeframe-to', true ) ) . '" />';
    echo '</div>';
  }

    /*
  function timeframe_meta_box() {
    add_meta_box( 'timeframe_box', __( 'Time Slot' ), array('Schedule', 'display_timeframe'), 'schedule', 'side', 'high' );
  }

  function display_timeframe( $object, $box ) {
    wp_nonce_field( plugin_basename( __FILE__ ), 'schedule_metabox_nonce' );
    echo '<label for="timeframe-from">Add a Time Slot</label>';
    echo '<input class="widefat" type="text" name="timeframe-from" id="timeframe-from" value="' . esc_attr( get_post_meta( $object->ID, 'timeframe_box', true ) ) . '" />';
    echo '<input class="widefat" type="text" name="timeframe-to" id="timeframe-to" value="' . esc_attr( get_post_meta( $object->ID, 'timeframe_box', true ) ) . '" />';
  }
    */

  function save_schedule_metadata( $post_id, $post ) {
    $path = plugin_basename( __FILE__ );
    $nonce = $_POST['schedule_metabox_nonce'];
    $feilds = array (
      array( 'id' => 'speaker_name' ),
      array( 'id' => 'timeframe-from' ),
      array( 'id' => 'timeframe-to' ) );

      foreach ( $feilds as $feild ) {
        $name = $feild['id'];

        $value = ( isset($_POST[$name]) ) ? $_POST[$name] : null; 

        if ( $value ) {
          add_post_meta( $post_id, $name, $value);
        } 
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

  function set_title_name_iput( $message ) {
    global $post;
    
    if ('schedule' == $post->post_type) {
      $message = 'Schedual Item Title';
    }

    return $message;
  }

  function setArgs() {
    $labels = array(
      'name'               => _x( 'Schedule', 'post type general name' ),
      'singular_name'      => _x( 'Schedule', 'post type singular name' ),
      'add_new'            => _x( 'Add New', 'schedual_item' ),
      'add_new_item'       => __( 'Add New Schedule Item' ),
      'edit_item'          => __( 'Edit Schedule Item' ),
      'new_item'           => __( 'New Schedule Item' ),
      'all_items'          => __( 'All Schedules Item\'s' ),
      'view_item'          => __( 'View Schedule' ),
      'search_items'       => __( 'Search Schedules' ),
      'not_found'          => __( 'No schedule items found' ),
      'not_found_in_trash' => __( 'No  schedule items found in the Trash' ), 
      'parent_item_colon'  => '',
      'menu_name'          => 'Schedules'
    );

    $args = array(
      'labels'        => $labels,
      'description'   => 'Event schedule',
      'public'        => true,
      'menu_position' => 5,
      'supports'      => array( 'title', 'editor', 'thumbnail' ),
      'has_archive'   => true,
    );

    return $args;
  }
}

add_action( 'init', 'schedule_init' );
