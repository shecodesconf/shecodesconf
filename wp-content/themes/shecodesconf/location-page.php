<?php
/*
Template Name: Location Page
*/

get_header(); ?>

  
	<div id="primary" class="fluid-row">
		<div id="content" class="fluid-row--full" role="main">
            <div class="title-block">
              <h2> <?php echo the_title();?></h2>
              <div class="accent"></div>
            </div>
          <hr class="divider mbn mtn">
		      <div class="fluid-row">
            <div class="fluid-row__unit fluid-row__unit--1-2 location-image" style="width:49%;">
              <div class="location-image__info">
                <h3>Computer History Museum</h3>
                <p>
                  1401 N Shoreline Blvd, Mountain View, CA 94043
                </p>
              </div>
              
            </div>
            <div class="fluid-row__unit fluid-row__unit--1-2 location-map">
              <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Computer+History+Museum,+1401,+Mountain+View,+CA&amp;aq=0&amp;oq=computer+h&amp;sll=37.7577,-122.4376&amp;sspn=0.184303,0.363579&amp;ie=UTF8&amp;hq=Computer+History+Museum,+1401,+Mountain+View,+CA&amp;hnear=&amp;radius=15000&amp;t=m&amp;ll=37.414313,-122.077307&amp;spn=0.071946,0.071946&amp;output=embed"></iframe>
            </div>
          <div>
          <hr class="divider mtn">
          <div class="cta-block">
            <a href="//shecodes.eventbrite.com/" class="button button--green">Get Tickets</a>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php get_footer(); ?>
