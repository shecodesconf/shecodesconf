<?php
  /* 
  Plugin Name: home Post Type
  Plugin URI: 
  Description: Custom post type for adding events 
  Version: 0.1.0
  Authour: Jason Lock
  Author URI: 
  License: GPL2
  */

function home_init() {
  $speaker = new home();
}

class home {
  function __construct() {
    $post_id = $_GET['post'];
    $page = get_the_title($post_id);
    
    add_action( 'save_post', array('home', 'save_home'),10, 2);
    if ( $page !== 'Home' )  return; 

    remove_post_type_support( 'page', 'title' );
    remove_post_type_support( 'page', 'editor' );

    add_action( 'add_meta_boxes', array('home', 'setup') );
    //add_action( 'add_meta_boxes', array('home', 'organizers') );
    add_action( 'admin_enqueue_scripts', array('home', 'scripts') );
  }

  function scripts() {
    wp_enqueue_script( 'script', plugins_url('/js/scripts.js', __FILE__) , array( 'jquery' ));
  }

  function setup() {
    add_meta_box( 'home_deatils', __( 'home Page' ), array('home', 'display_home'), 'page', 'normal', 'high' );
  }

  function display_home() {
    wp_nonce_field( plugin_basename( __FILE__ ), 'home_nonce' );
    echo '<h5 style="line-height: 1; margin-top: 20px;">Overview</h5>';
    wp_editor('', 'home-overview', array(
      'media_buttons' => false,
      'textarea_name' => 'home-overview'
    ));
  }

  function save_home( $post_id, $post ) {
    $path = plugin_basename( __FILE__ );
    $nonce = $_POST['schedule_metabox_nonce'];
    $feilds = array (
      array( 'id' => 'home-overview' ),
      );

      
      foreach ( $feilds as $feild ) {
        $name = $feild['id'];

        $value = ( isset($_POST[$name]) ) ? $_POST[$name] : null; 

        if ( $value ) {
          update_post_meta( $post_id, $name, $value);
        } 
      }
  }

}

add_action( 'init', 'home_init' );
