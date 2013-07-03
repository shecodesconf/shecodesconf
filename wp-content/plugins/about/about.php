<?php
  /* 
  Plugin Name: About Post Type
  Plugin URI: 
  Description: Custom post type for adding events 
  Version: 0.1.0
  Authour: Jason Lock
  Author URI: 
  License: GPL2
  */

function about_init() {
  $speaker = new About();
}

class About {
  function __construct() {
    $post_id = $_GET['post'];
    $page = get_the_title($post_id);
    
    add_action( 'save_post', array('About', 'save_about'),10, 2);
    if ( $page !== 'About' )  return; 

    remove_post_type_support( 'page', 'title' );
    remove_post_type_support( 'page', 'editor' );

    add_action( 'add_meta_boxes', array('About', 'setup') );
    //add_action( 'add_meta_boxes', array('About', 'organizers') );
    add_action( 'admin_enqueue_scripts', array('About', 'scripts') );
  }

  function save() {
    foo();
  }

  function scripts() {
    wp_enqueue_script( 'script', plugins_url('/js/scripts.js', __FILE__) , array( 'jquery' ));
  }

  function setup() {
    add_meta_box( 'about_deatils', __( 'About Page' ), array('About', 'display_about'), 'page', 'normal', 'high' );
  }

  function organizers() {
    add_meta_box( 'about_orginizers', __( 'Orginizers' ), array('About', 'display_organizers'), 'page', 'side');
  }

  function display_organizers() {
    echo '<button id="add-headshot" class="button">Add Headshot</button>';
    echo '<div id="o-prev" style="width:32px;height:32px;"></div>';
    echo '<label for="o-name" style="display:block;">Orginizer Name</label>';
    echo '<input id="o-name" type="text name="o-name">';
    echo '<button id="add-o" class="button" style="display:block;">Add Organizers</button>';
    echo '<div id="orginizers-list"></div>';
  }

  function display_about() {
    wp_nonce_field( plugin_basename( __FILE__ ), 'about_nonce' );
    echo '<h5 style="line-height: 1; margin-top: 20px;">Overview</h5>';
    wp_editor('', 'about-overview', array(
      'media_buttons' => false,
      'textarea_name' => 'about-overview'
    ));

    echo '<h5 style="line-height: 1; margin-top: 20px;">Description</h5>';
    wp_editor('', 'about-description', array(
      'media_buttons' => false,
      'textarea_name' => 'about-description'
    ));
  }

  function save_about( $post_id, $post ) {
    $path = plugin_basename( __FILE__ );
    $nonce = $_POST['schedule_metabox_nonce'];
    $feilds = array (
      array( 'id' => 'about-overview' ),
      array( 'id' => 'about-description' ),
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

add_action( 'init', 'about_init' );
