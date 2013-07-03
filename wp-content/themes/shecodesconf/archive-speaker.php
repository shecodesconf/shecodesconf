<?php
/*
Template Name: My Custom Page
*/

get_header(); ?>

  
	<div id="primary" class="fluid-row">
		<div id="content" class="fluid-row--full" role="main">
      <div class="title-block">
			  <h2><?php the_title(); ?></h2>
        <div class="accent"></div>
      </div>

    
  <?php
  $args = array( 'post_type' => 'speaker' );

  $speakers = new WP_Query( $args );

  while($speakers->have_posts()) {
    $speakers->the_post();
    $args = array(
      'post_type' => 'attachment',
      'post_mime_type' => 'image',
      'post_parent' => get_the_ID()
    );

    $image = get_posts($args);
    ?>
      <div class="media">
        <div class="media__img"><?php echo wp_get_attachment_image($image[0]->ID, 'medium'); ?></div>
         <div class="media__body">
        <h5><?php echo the_title(); ?></h5>
        <p><small><?php echo get_post_meta(get_the_ID(), 'speaker_company_box', true); ?> </small></p>
        <p><?php echo substr( strip_tags(get_the_content()),0,235); ?></p>
        </div>
      </div>
      <hr class="divider">
  <?php } ?>
  </div>
  </div>

<?php get_footer(); ?>
