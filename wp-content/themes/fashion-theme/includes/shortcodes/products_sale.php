<?php
add_shortcode("bery_sale_products", "bery_sale_products");
function bery_sale_products($atts, $content = null) {
	global $woocommerce, $delay_animation_product;
	$delay_animation_product = 200;
	extract(shortcode_atts(array(
		"title" => '',
		'products'  => '8',
        'orderby' => 'date',
        'order' => 'ASC',
        'columns' => '4',
        'infinitive' => 'false'
	), $atts));
	ob_start();
	?>
    
    <?php 
	if(function_exists('wc_print_notices')) {
	?>
		<?php if($title){?> 
		<div class="row">
			<div class="large-12 columns">
				<h3 class="section-title"><span><?php echo esc_attr($title); ?></span></h3>
				<div class="bery-hr medium"></div>
			</div>
		</div>
		<?php } ?>

		<div class="row group-slider">
            <ul class="owl-carousel owl-theme slider products-group prod-slider-<?php echo esc_attr($columns);?>">
			 <?php
               	$product_ids_on_sale = woocommerce_get_product_ids_on_sale();
				$product_ids_on_sale[] = 0;

				$meta_query = $woocommerce->query->get_meta_query();

		    	$query_args = array(
		    		'posts_per_page' 	=> $products,
		    		'no_found_rows' => 1,
		    		'post_status' 	=> 'publish',
		    		'post_type' 	=> 'product',
		    		'orderby' 		=> $orderby,
		    		'order' 		=> $order,
		    		'meta_query' 	=> $meta_query,
		    		'post__in'		=> $product_ids_on_sale
		    	);

				$r = new WP_Query($query_args);
                
                if ( $r->have_posts() ) : ?>
                            
                    <?php while ( $r->have_posts() ) : $r->the_post(); ?>
                		<?php $delay_animation_product += 200; ?> 
                        <?php woocommerce_get_template_part( 'content', 'product' ); ?>
            
                    <?php endwhile; ?>
                    
                <?php
                
                endif; 
                wp_reset_query();
                
                ?>
            </ul>  
   		</div>
    <?php } ?>

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}