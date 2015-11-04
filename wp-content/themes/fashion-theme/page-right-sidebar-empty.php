<?php
/*
Template name: Right sidebar - Empty title
*/
get_header(); ?>

<div class="page-header">
<?php if( has_excerpt() ) the_excerpt();?>
</div>

<div class="container-wrap page-right-sidebar">
<div class="row">

<div id="content" class="large-9 left columns" role="main">
	<div class="page-inner">
			<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-content">
							<?php the_content(); ?>
							<?php
								wp_link_pages( array(
									'before' => '<div class="page-links">' . __( 'Pages:', 'ltheme_domain' ),
									'after'  => '</div>',
								) );
							?>
						</div>
					</article>
			<?php endwhile; ?>

	</div>
</div>

<div class="large-3 columns right">
<?php get_sidebar(); ?>
</div>

</div>
</div>

<?php get_footer(); ?>
