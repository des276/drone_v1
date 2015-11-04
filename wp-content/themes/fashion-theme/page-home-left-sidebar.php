<?php
/*
Template name: Home Left sidebar - Empty title
*/
get_header(); ?>



<div class="page-header">
<?php if( has_excerpt() ) the_excerpt();?>
</div>

<div class="cat-header">
		<?php 
		?>
		<?php if(isset($ros_opt['cat_bg']) && $ros_opt['cat_bg'] != '') {
			if($wp_query->query_vars['paged'] == 1 || $wp_query->query_vars['paged'] < 1){
				echo do_shortcode('[block id="homepage-slider-boxed"]');
			}
		} ?>
</div>

<div  class="container-wrap page-left-sidebar">
<div class="row">

<div id="content" class="large-9 right columns" role="main">
	<div class="page-inner">
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'lux' ),
							'after'  => '</div>',
						) );
					?>
				</div>
					</article>
			<?php endwhile; ?>
	</div>
</div>

<div class="large-3 columns left">
<?php //dynamic_sidebar('home-sidebar'); ?>
</div>

</div>
</div>


<?php get_footer(); ?>
