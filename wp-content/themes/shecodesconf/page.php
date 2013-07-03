<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage SheCodesConf 
 * @since SheCodesConf 1.0
 */

get_header(); ?>

	<div id="primary" class="fluid-row">
		<div id="content" class="fluid-row--full" role="main">
			<h1 class="entry-title"><?php the_title(); ?></h1>
      <h2>heading2</h2>
      <h3>heading3</h3>
      <h4>heading3</h4>
      <p>
        wklejfhwlekjfhw lkejfhlw kej fhlwkjehfl wkjehfl wkjehf lkwj ehflkwjehflkwjeh flkwje fhlkwjef lkwjef lwkjef lwkje flkwje fklwje flkwefh wlkefwlkjef lwkjef lwkje fhwlkjef wlkjef wlkje fwkljef hwlefj hwlkejf wlkejhf
      </p>
      <p>
        wklejfhwlekjfhw lkejfhlw kej fhlwkjehfl wkjehfl wkjehf lkwj ehflkwjehflkwjeh flkwje fhlkwjef lkwjef lwkjef lwkje flkwje fklwje flkwefh wlkefwlkjef lwkjef lwkje fhwlkjef wlkjef wlkje fwkljef hwlefj hwlkejf wlkejhf
      </p>
      <a href="" class="button button--green">BUY A TICKET</a>
      <div class="fluid-row">
        <div style="height: 42px; background-color:red;" class="fluid-row__unit fluid-row__unit--1-3"></div>
        <div style="height: 42px; background-color:red;" class="fluid-row__unit fluid-row__unit--1-3"></div>
        <div style="height: 42px; background-color:red;" class="fluid-row__unit fluid-row__unit--1-3"></div>
      </div>
		</div>
	</div>

<?php get_footer(); ?>
