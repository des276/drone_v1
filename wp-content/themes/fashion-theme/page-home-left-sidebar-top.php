<?php
/*
Template name: Home Left Categories - Empty title
*/
get_header(); ?>

<?php

/* Display popup window */
if (isset($ros_opt['promo_popup']) && $ros_opt['promo_popup'] == 1){?>
	<div class="popup_link hide"><a class="leetheme-popup open-click" href="#leetheme-popup"><?php _e('Newsletter', 'ltheme_domain'); ?></a></div>
	<?php do_action('after_page_wrapper'); ?>
<?php } ?>


<div class="page-header">
<?php if( has_excerpt() ) the_excerpt();?>
</div>

<div  class="container-wrap">
	<div class="row">
		<div id="content" class="large-12 left columns" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php the_content(); ?>
					
					<?php endwhile; ?>
					
		</div>

	</div>
</div>

	
<?php get_footer(); ?>