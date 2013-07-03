<?php
/*
Template Name: Schedule Template
*/

get_header(); ?>

  
	<div id="primary" class="fluid-row">
		<div id="content" class="fluid-row--full" role="main">
      <div class="title-block">
			  <h2><?php the_title(); ?></h2>
        <div class="accent"></div>
      </div>
      <div class="fluid-row schedule">
        <aside class="fluid-row__unit fluid-row__unit--1-6">
        </aside>
        <div class="fluid-row__unit fluid-row__unit--4-5 schedule__items">
          <?php
            $args = array( 'post_type' => 'schedule' );
            $schedule_items = new WP_Query( $args );

            while($schedule_items->have_posts()) {
              $schedule_items->the_post();
              ?>

              <div class="schedule__items--item schedule__item">
                <h5><?php echo the_title() ?></h5>
                <span class="schedule__item--speaker"> <?php echo get_post_meta(get_the_ID(), 'speaker_name', true) ?></span>
                <div class="schedule__item--timeframe"> 
                  <?php echo get_post_meta(get_the_ID(), 'timeframe-from', true) ?>
                  <span>:</span>
                  <?php echo get_post_meta(get_the_ID(), 'timeframe-to', true) ?>
                </div>
                <p> <?php echo substr( strip_tags(get_the_content()),0,235) ?></p>
                <div class="schedule__item--dot"></div>
              </div>
            <?php } ?>
          <div class="schedule__items-dot"></div>
        </div>
      </div>
    </div>
  </div>

<?php get_footer(); ?>
