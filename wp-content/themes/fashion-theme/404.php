<?php
/**
 * @package leetheme
 */
get_header(); ?>

<div  class="container-wrap">
<div class="row">

	
<div id="content" class="large-12 left columns" role="main">
		<article id="post-0" class="post error404 not-found text-center">

				<header class="entry-header">
					<img src="<?php echo get_template_directory_uri().'/css/images/404.jpg'; ?>" />
					<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'ltheme_domain' ); ?></h1>
				</header><!-- .entry-header -->
				<div class="entry-content">


		<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'ltheme_domain' ); ?></p>

					<?php get_search_form(); ?>

								</div>
			</article>


</div>

</div>
</div>


<?php get_footer(); ?>


	
