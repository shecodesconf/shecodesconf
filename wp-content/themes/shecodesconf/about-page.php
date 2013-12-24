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
            $credits = get_post_meta(get_the_ID(), 'about-credits', 1);

            echo '<div class="overview">'; 
              echo '<h2>' . $overview . '</h2>';
            echo '</div>';
            ?>

            <div class="title-block">
              <h2> <?php echo the_title();?></h2>
              <div class="accent"></div>
            </div>
  
            <?php
            echo '<p class="about-desc">'. $desc . '</p>';

            echo '<hr class="divider">';

            echo '<div class="title-block">';
              echo '<h2>Organizers</h2>';
              echo '<div class="accent"></div>';
            echo '</div>';
          endwhile;

          echo '<div class="fluid-row organizers">';
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
            echo '<a href="' . get_post_meta(get_the_ID(), 'organizer-url', true) . '" class="headshot__container">';
            echo wp_get_attachment_image($image[0]->ID, 'medium');
            echo '<div class="headshot--info">';
            echo '<h5>'; 
            echo the_title(); 
            echo '</h5>';
            echo '<p>' . get_post_meta(get_the_ID(), 'organizer-job-title', true) . ', ' . get_post_meta(get_the_ID(), 'organizer-company-name', true) . '</p>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
          }
          echo '</div>';
          ?>
          <?php
          /* Keeping until for sure this needs to be removed 
          $args = array( 'post_type' => 'sponsor' );
          $sponsor = new WP_Query( $args );

          if ($sponsor->have_posts()) { 
            echo '<hr class="divider">
            <div class="title-block">
              <h3>Sponsors</h3>
              <div class="accent"></div>
            </div>';
          
            echo '<div class="fluid-row">';
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
                echo get_the_content();
                echo '</div>';
              }
            }
            echo '</div>';
          }

          $args = array( 'post_type' => 'sponsor' );
          $sponsor = new WP_Query( $args );
      
          if ($sponsor->the_post()) { 
            echo '<hr class="divider">
            <div class="title-block">
              <h3>Partners</h3>
              <div class="accent"></div>
            </div>';

            echo '<div class="fluid-row">';
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
          }
            */
          ?>
          <hr class="divider">

          <div class="title-block">
            <h2>Credits</h2>
            <div class="accent"></div>
          </div>
          <p class="about-desc"><?php echo $credits; ?></p>
          <div class="cta-block">
            <p>Interested in becoming a sponsor?</p>
            <a href="mailto:info@shecodesconf.com" class="button button--green">Contact Us</a>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php get_footer(); ?>
