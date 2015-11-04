<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $ros_opt;

$related = $product->get_related(12);

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related,
	'post__not_in'			=> array($product->id)
) );

$products = new WP_Query( $args );


if ( $products->have_posts() ) : ?>

	<div class="related products">
		<div class="row">
			<div class="large-12 columns">
				<h3 class="section-title"><span><?php _e( 'Related Products', 'woocommerce' ); ?></span></h3>
				<div class="bery-hr medium"></div>
			</div>
		</div>
		<div class="row group-slider">
            <ul class="owl-carousel owl-theme slider products-group prod-slider-4">
				<?php while ( $products->have_posts() ) : $products->the_post(); ?>
					<?php woocommerce_get_template_part( 'content', 'product' ); ?>
				<?php endwhile; ?>
            </ul>  
   		</div> 
	</div>

<?php endif;

wp_reset_postdata();
