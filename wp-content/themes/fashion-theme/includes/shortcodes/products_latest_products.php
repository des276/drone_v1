<?php
add_shortcode("bery_latest_products", "bery_latest_products");
function bery_latest_products($atts, $content = null) {
	global $delay_animation_product;
	$delay_animation_product = 200;
	extract(shortcode_atts(array(
		"title" => '',
		'products'  => '8',
        'orderby' => 'date',
        'order' => 'desc',
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
        
                $args = array(
                    'post_type' => 'product',
					'post_status' => 'publish',
					'ignore_sticky_posts'   => 1,
					'posts_per_page' => $products,
					'orderby' 		=> $orderby,
		    		'order' 		=> $order
                );
                
                $products = new WP_Query( $args );
                
                if ( $products->have_posts() ) : ?>
                            
                    <?php while ( $products->have_posts() ) : $products->the_post(); ?>
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