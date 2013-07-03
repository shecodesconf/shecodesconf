<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage SheCodesConf 
 * @since SheCodesConf 1.0
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
    <html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
  <html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width" />
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <!--[if lt IE 9]>
      <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
    <![endif]-->
    <?php wp_head(); ?>
    <link href='http://fonts.googleapis.com/css?family=Arvo:400,400italic|Open+Sans:400italic,400' rel='stylesheet' type='text/css'>
  </head>

  <body <?php body_class(); ?>>
    <div class="fluid-row">
      <header id="masthead" class="" role="banner">
        <img src="http://shecodesconf.com/wp-content/themes/shecodesconf/header.png">
      </header>
    </div>
    <div class="fluid-row main-menu">
      <nav id="site-navigation" class="fluid-row--full" role="navigation">
        <?php  wp_nav_menu( array( 'theme_location' => 'main', 'menu_class' => 'inline-list main-menu__links' ) ); ?>
      </nav>
    </div>

      <?php $header_image = get_header_image();
      if ( ! empty( $header_image ) ) : ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
      <?php endif; ?>
    <div id="main" class="wrapper">
