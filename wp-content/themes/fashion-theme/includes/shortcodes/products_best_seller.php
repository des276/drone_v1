<?php
add_shortcode("bery_bestseller_products", "bery_best_sellers");
function bery_best_sellers($atts, $content = null) {
	global $woocommerce, $delay_animation_product;
	$delay_animation_product = 200;
	extract(shortcode_atts(array(
		'title' => '',
		'products'  => '8',
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
                $query_args = array(
			    		'posts_per_page' => $products,
			    		'post_status' 	 => 'publish',
			    		'post_type' 	 => 'product',
			    		'meta_key' 		 => 'total_sales',
			    		'orderby' 		 => 'meta_value_num',
			    		'no_found_rows'  => 1,
			    	);

			    	$query_args['meta_query'] = $woocommerce->query->get_meta_query();

			    	if ( isset( $instance['hide_free'] ) && 1 == $instance['hide_free'] ) {
			    		$query_args['meta_query'][] = array(
						    'key'     => '_price',
						    'value'   => 0,
						    'compare' => '>',
						    'type'    => 'DECIMAL',
						);
			    	}

					$r = new WP_Query($query_args);
                
                if ( $r->have_posts() ) : ?>
                    <?php while ( $r->have_posts() ) : $r->the_post(); ?>
                    	<?php $delay_animation_product += 200; ?> 
                        <?php woocommerce_get_template_part( 'content', 'product' ); ?>
                    <?php endwhile;?>
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