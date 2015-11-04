<?php
/*
Template name: Default Template (No title - No breadcrumb)
*/
get_header(); ?>
<div class="page-header">
<?php if( has_excerpt() ) the_excerpt();?>
</div>

<div  class="container-wrap">
<div class="row">
<div id="content" class="large-12 left columns" role="main">

		
			<?php while ( have_posts() ) : the_post(); ?>

				<?php the_content(); ?>
			
			<?php endwhile;?>

</div>

</div>
</div>


<?php get_footer(); ?>
