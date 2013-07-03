<?php
/*
Template Name: About Page 
*/

get_header(); ?>

  
	<div id="primary" class="fluid-row">
		<div id="content" class="fluid-row--full" role="main">
          <?php
          while ( have_posts() ) : the_post();

            $overview = get_post_meta(get_the_ID(), 'about-overview', 1);
            $desc = get_post_meta(get_the_ID(), 'about-description', 1);

            echo '<div class="overview">'; 
              echo '<h2>' . $overview . '</h2>';
            echo '</div>';
            ?>

            <div class="title-block">
              <h1> <?php echo the_title();?></h1>
              <div class="accent"></div>
            </div>
  
            <?php
            echo '<p>'. $desc . '</p>';

            echo '<hr class="divider">';

            echo '<div class="title-block">';
              echo '<h1>Orginizers</h1>';
              echo '<div class="accent"></div>';
            echo '</div>';
          endwhile;

          echo '<div class="fluid-row">';
          $args = array( 'post_type' => 'organizer' );
          $organizers = new WP_Query( $args );
          while ( $organizers->have_posts() ) { 
            $organizers->the_post();
            $args = array(
                'post_type' => 'attachment',
                'post_mime_type' => 'image',
                'post_parent' => get_the_ID()
                );

            $image = get_posts($args);
            echo '<div class="fluid-row__unit fluid-row__unit--1-5 origanizer headshot">';
            echo wp_get_attachment_image($image[0]->ID, 'medium');
            echo '<p>' . get_post_meta(get_the_ID(), 'organizer_company_box', true) . '</p>';
            echo '<div class="inner-shadow"></div>';
            echo '</div>';
          }
          echo '</div>';
          ?>
          <hr class="divider">
          <div class="title-block">
            <h3>Sponsors</h3>
            <div class="accent"></div>
          </div>
          <?php
          echo '<div class="fluid-row">';
          $args = array( 'post_type' => 'sponsor' );
          $sponsor = new WP_Query( $args );
          while ( $sponsor->have_posts() ) { 
            $sponsor->the_post();
            $args = array(
                'post_type' => 'attachment',
                'post_mime_type' => 'image',
                'post_parent' => get_the_ID()
                );

            $image = get_posts($args);
            $is_partner = get_post_meta(get_the_ID(), 'is_partner_box', true);
            if (!$is_partner) {
              echo '<div class="fluid-row__unit fluid-row__unit--1-5">';
              echo wp_get_attachment_image($image[0]->ID, 'medium');
              echo '</div>';
            }
          }
          echo '</div>';
          ?>
          <hr class="divider">
          <div class="title-block">
            <h3>Partners</h3>
            <div class="accent"></div>
          </div>
          <?php
          echo '<div class="fluid-row">';
          $args = array( 'post_type' => 'sponsor' );
          $sponsor = new WP_Query( $args );
          while ( $sponsor->have_posts() ) { 
            $sponsor->the_post();
            $args = array(
                'post_type' => 'attachment',
                'post_mime_type' => 'image',
                'post_parent' => get_the_ID()
                );

            $image = get_posts($args);
            $is_partner = get_post_meta(get_the_ID(), 'is_partner_box', true);
            if ($is_partner) {
              echo '<div class="fluid-row__unit fluid-row__unit--1-5">';
              echo wp_get_attachment_image($image[0]->ID, 'medium');
              echo '</div>';
            }
          }
          echo '</div>';
          ?>
          <div class="cta-block">
            <p>Interested in becoming a speaker?</p>
            <a href="" class="button button--green">Contact Us</a>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php get_footer(); ?>
