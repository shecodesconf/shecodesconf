<?php
/*
Template Name: Home Page 
*/

get_header(); ?>

  
	<div id="primary" class="fluid-row">
		<div id="content" class="fluid-row--full" role="main">
          <?php
          while ( have_posts() ) : the_post();

            $overview = get_post_meta(get_the_ID(), 'home-overview', 1);
            $desc = get_post_meta(get_the_ID(), 'home-description', 1);
            $speaker_desc = get_post_meta(get_the_ID(), 'home-speaker-description', 1);

            echo '<div class="overview">'; 
              echo '<h2>' . $overview . '</h2>';
            echo '</div>';
            echo '<p class="home-desc" style="margin-top:50px;">' . $desc . '</p>';
            ?>

            <?php
            echo '<hr class="divider mbn">';

            echo '<div class="title-block">';
              echo '<h2>Speakers</h2>';
              echo '<div class="accent"></div>';
            echo '</div>';
              echo '<p class="home-desc" style="margin-bottom:15px;">' . $speaker_desc . '</p>';
          endwhile;

          echo '<div class="fluid-row">';
          $args = array( 'post_type' => 'speaker', 'posts_per_page' => -1 );
          $speakers = new WP_Query( $args );
          $i = 1;
          $row_count = 1;

          while ( $speakers->have_posts() ) { 
            $speakers->the_post();
            $args = array(
                'post_type' => 'attachment',
                'post_mime_type' => 'image',
                'post_parent' => get_the_ID()
                );

            $speaker_link = str_replace( ' ', '-', the_title('','',false) ); 
            $speaker_link = strtolower( $speaker_link );

            $image = get_posts($args);
            echo '<div class="fluid-row__unit fluid-row__unit--1-4 headshot">';
            echo '<a href="speakers/#' . $speaker_link .'" class="headshot__container">';
            echo wp_get_attachment_image($image[0]->ID, 'medium');
            echo '<div class="headshot--info">';
            echo '<h5>'; 
            echo the_title(); 
            echo '</h5>';
            echo '<p>' . get_post_meta(get_the_ID(), 'speaker_company_box', true) . '</p>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
        
            // Reset counter;
            if ( $row_count == 4 ) $row_count = 0;
            if ($i == $speakers->post_count) {
              if ( $row_count == 0 ) $grid = '1';
              if ( $row_count == 3 ) $grid = '1-4';
              if ( $row_count == 2 ) $grid = '1-2';
              if ( $row_count == 1 ) $grid = '3-4';

              echo '<div class="fluid-row__unit fluid-row__unit--' . $grid . ' hash headshot__empty"><a href="schedule" class="button button--black-stroke">See Event Schedule</a></div>';
            } 

            $i++;
            $row_count++;
          }

          echo '</div>';
          ?>
          <?php
          $args = array( 'post_type' => 'sponsor' );
          $sponsor = new WP_Query( $args );
          if ($sponsor->have_posts()) {
            echo '
            <div class="title-block">
              <h2>Sponsors</h2>
              <div class="accent"></div>
            </div>';
            echo '<div class="fluid-row corporate-logos">';

            while ( $sponsor->have_posts() ) { 
              $sponsor->the_post();
              echo '<div class="fluid-row__unit fluid-row__unit--1-2 corporate-logo">';
              echo get_the_content();
              echo '</div>';
            }
            echo '</div>';
          }

          $args2 = array( 'post_type' => 'partner' );
          $partner = new WP_Query( $args2 );
          if ($partner->have_posts()) {
            echo '
            <hr class="divider">
            <div class="title-block">
              <h2>Partners</h2>
              <div class="accent"></div>
            </div>';
            echo '<div class="fluid-row corporate-logos">';
            while ( $partner->have_posts() ) { 
              $partner->the_post();
                echo '<div class="fluid-row__unit fluid-row__unit--1-2 corporate-logo">';
                echo get_the_content();
                echo '</div>';
            }
            echo '</div>';
          }
          ?>
          <div class="cta-block">
            <p>Interested in participating in SheCodes as a sponsor, partner, or speaker?</p>
            <a href="mailto:info@shecodesconf.com" class="button button--green">Contact Us</a>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php get_footer(); ?>
