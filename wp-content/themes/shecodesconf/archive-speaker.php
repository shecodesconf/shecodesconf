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
    $speaker_link = str_replace( ' ', '-', the_title('','',false) ); 
    $speaker_link = strtolower( $speaker_link );
    ?>
      <div id="<?php echo $speaker_link; ?>" class="media speaker">
        <div class="media__img speaker--img"><?php echo wp_get_attachment_image($image[0]->ID, 'medium'); ?></div>
         <div class="media__body">
        <h3><?php echo the_title(); ?></h3>
        <p><small><?php echo get_post_meta(get_the_ID(), 'speaker_company_box', true); ?> </small></p>
        <p><?php echo strip_tags(get_the_content(), '<p>,<a>,<br>'); ?></p>
        </div>
      </div>
      <hr class="divider">
  <?php } ?>
  </div>
  </div>

<?php get_footer(); ?>
