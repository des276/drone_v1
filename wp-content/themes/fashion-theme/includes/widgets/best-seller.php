<?php

add_action( 'widgets_init', 'best_seller_widget' );

function best_seller_widget() {
	register_widget( 'Leetheme_Best_Seller_Widget' );
}

/**
 * @since 2.8.0
 */
class Leetheme_Best_Seller_Widget extends WP_Widget {
	
	function Leetheme_Best_Seller_Widget() {
		$this->woo_widget_cssclass = 'widget_best_sellers';
		$this->woo_widget_description = __( 'Display a list of your best selling products on your site.', 'ltheme_domain' );
		$this->woo_widget_idbase = 'woocommerce_best_sellers';
		$this->woo_widget_name = __( 'Leetheme Best Sellers', 'ltheme_domain' );

		$widget_ops = array( 'classname' => $this->woo_widget_cssclass, 'description' => $this->woo_widget_description );

		$this->WP_Widget('best_sellers', $this->woo_widget_name, $widget_ops);

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */

	function widget($args, $instance) {
		global $woocommerce;

		$cache = wp_cache_get('widget_best_sellers', 'widget');

		if ( !is_array($cache) ) $cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Best Sellers', 'woocommerce' ) : $instance['title'], $instance, $this->id_base);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;

    	$query_args = array(
    		'posts_per_page' => $number,
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

		if ( $r->have_posts() ) {

			echo $before_widget;

			if ( $title )
				echo $before_title . $title . $after_title;

			echo '<ul class="product_list_widget">';

			while ( $r->have_posts()) {
				$r->the_post();
				global $product;

				echo '<li><div class="row">
							<div class="large-6 small-6 columns">

								<a href="' . get_permalink() . '">
									<div class="product-img">
										<div class="image-overlay"></div>
										' . ( has_post_thumbnail() ? get_the_post_thumbnail( $r->post->ID, 'shop_catalog' ) : woocommerce_placeholder_img( 'shop_catalog' ) ) . ' 
											
									</div>
								</a>
							</div>
							<div class="large-6 columns">
								<div class="text-info">
									<a href="' . get_permalink() . '">' . get_the_title() . '</a>
									' . $product->get_price_html() . '
								</div>
							</div>
						</div>
				';
				
			}

			echo '</li></ul>';

			echo $after_widget;
		}

		wp_reset_postdata();

		$content = ob_get_clean();

		if ( isset( $args['widget_id'] ) ) $cache[$args['widget_id']] = $content;

		echo $content;

		wp_cache_set('widget_best_sellers', $cache, 'widget');
	}

	/**
	 *
	 * @see WP_Widget->update
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['hide_free'] = 0;

		if ( isset( $new_instance['hide_free'] ) ) {
			$instance['hide_free'] = 1;
		}

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_best_sellers']) ) delete_option('widget_best_sellers');

		return $instance;
	}

	/**
	 *
	 * @access public
	 * @return void
	 */

	function flush_widget_cache() {
		wp_cache_delete( 'widget_best_sellers', 'widget' );
	}


	/**
	 *
	 * @see WP_Widget->form
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	
	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] ) $number = 5;
		$hide_free_checked = ( isset( $instance['hide_free'] ) && 1 == $instance['hide_free'] ) ? ' checked="checked"' : '';

		?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:', 'woocommerce' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php _e( 'Number of products to show:', 'woocommerce' ); ?></label>
		<input id="<?php echo esc_attr( $this->get_field_id('number') ); ?>" name="<?php echo esc_attr( $this->get_field_name('number') ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>

		<p><input id="<?php echo esc_attr( $this->get_field_id('hide_free') ); ?>" name="<?php echo esc_attr( $this->get_field_name('hide_free') ); ?>" type="checkbox"<?php echo esc_attr($hide_free_checked); ?> />
		<label for="<?php echo esc_attr($this->get_field_id('hide_free')); ?>"><?php _e( 'Hide free products', 'woocommerce' ); ?></label></p>
<?php
	}
}
?>