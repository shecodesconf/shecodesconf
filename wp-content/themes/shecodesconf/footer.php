<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage SheCodesConf 
 * @since SheCodesConf 1.0
 */
?>
    </div>
    <hr class="divider mbn">
    <footer id="colophon" role="contentinfo">
      <a href="//shecodes.eventbrite.com/" class="button button--white-stroke">Get Tickets</a>
      <ul class="inline-list socail-links">
        <li>Connect with us.</li>
        <li><a href="//twitter.com/SheCodesConf" class="socail-links--twitter">twitter</a></li>
      </ul> 

      <ul class="inline-list legal">
        <li>&copy; 2013 SheCodes</li>
      </ul> 
    </footer>

  <?php wp_footer(); ?>
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-42563115-1', 'shecodesconf.com');
    ga('send', 'pageview');
  </script>
  </body>
</html>
