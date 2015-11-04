<?php
add_shortcode("bery_product_categories", "bery_product_categories");
function bery_product_categories($atts, $content = null) {
	global $delay_animation_product;
	$delay_animation_product = 200;
	extract( shortcode_atts( array (
			'number'     => null,
			'title' => '',
			'orderby'    => 'name',
			'order'      => 'ASC',
			'columns' 	 => '4',
			'hide_empty' => 1,
			'parent'     => '',
			'infinitive' => 'false',

			), $atts ) );
		if ( isset( $atts[ 'ids' ] ) ) {
			$ids = explode( ',', $atts[ 'ids' ] );
		  	$ids = array_map( 'trim', $ids );
		} else {
			$ids = array();
		}

		$hide_empty = ( $hide_empty == true || $hide_empty == 1 ) ? 1 : 0;

	  	$args = array(
	  		'orderby'    => $orderby,
	  		'order'      => $order,
	  		'hide_empty' => $hide_empty,
			'include'    => $ids,
			'pad_counts' => true,
			'child_of'   => $parent
		);

	  	$product_categories = get_terms( 'product_cat', $args );

	  	if ( $parent !== "" )
	  		$product_categories = wp_list_filter( $product_categories, array( 'parent' => $parent ) );

	  	if ( $number )
	  		$product_categories = array_slice( $product_categories, 0, $number );

	  	$woocommerce_loop['columns'] = $columns;


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

		<div class="row group-slider category-slider">
            <ul class="owl-carousel owl-theme slider products-group prod-cat-slider-<?php echo esc_attr($columns);?>">
			  <?php
               if ( $product_categories ) {
					foreach ( $product_categories as $category ) {
						woocommerce_get_template( 'content-product_cat.php', array(
							'category' => $category
						) );
						$delay_animation_product += 200; 
					}
				}
				woocommerce_reset_loop();  
                ?>
            </ul> 
		</div>

    
    <?php } ?>

	<?php

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}