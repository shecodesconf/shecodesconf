<?php
/*
Template Name: Schedule Template
*/

get_header(); ?>

  
	<div id="primary" class="fluid-row">
		<div id="content" class="fluid-row--full" role="main">
      <div class="title-block">
			  <h2>Schedule</h2>
        <div class="accent"></div>
      </div>
      <div class="fluid-row schedule">
        <aside class="fluid-row__unit fluid-row__unit--1-6">
        </aside>
        <div class="fluid-row__unit fluid-row__unit--4-5 schedule__items">
          <?php
            $args = array( 'post_type' => 'schedule', 'posts_per_page' => -1 );
            $schedule_items = new WP_Query( $args );

            while($schedule_items->have_posts()) {
              $schedule_items->the_post();
              $speaker = get_post_meta(get_the_ID(), 'speaker_name', true);
              $speaker_link = str_replace( ' ', '-', $speaker ); 
              $speaker_link = strtolower( $speaker_link );
              ?>

              <div class="schedule__items--item schedule__item">
                <h3><?php echo the_title() ?></h3>
                <a href="/speakers/#<?php echo $speaker_link ?>" class="schedule__item--speaker"> <?php echo $speaker; ?></a>
                <div class="schedule__item--timeframe"> 
                  <?php echo get_post_meta(get_the_ID(), 'timeframe_start', true) ?>
                  <span>-</span>
                  <?php echo get_post_meta(get_the_ID(), 'timeframe_end', true) ?>
                </div>
                <p> <?php echo get_the_content(); ?></p>
                <div class="schedule__item--dot"></div>
              </div>
            <?php } ?>
          <div class="schedule__items-dot"></div>
        </div>
      </div>
    </div>
  </div>

<?php get_footer(); ?>
