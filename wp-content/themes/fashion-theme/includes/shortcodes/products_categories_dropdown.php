<?php
/**
 * Walk the Product Categories.
 *
 * @return mixed
 */
function wc_walk_category_dropdown_tree_1() {
	if ( ! class_exists( 'WC_Product_Cat_Dropdown_Walker_1' ) ) {
		class WC_Product_Cat_Dropdown_Walker_1 extends Walker {

			var $tree_type = 'category';
			var $db_fields = array ('parent' => 'parent', 'id' => 'term_id', 'slug' => 'slug' );

			/**
			 * @see Walker::start_el()
			 * @since 2.1.0
			 *
			 * @param string $output Passed by reference. Used to append additional content.
			 * @param int $depth Depth of category in reference to parents.
			 * @param integer $current_object_id
			 */
			public function start_el( &$output, $cat, $depth = 0, $args = array(), $current_object_id = 0 ) {

				if ( ! empty( $args['hierarchical'] ) )
					$pad = str_repeat('&nbsp;', $depth * 3);
				else
					$pad = '';

				$cat_name = apply_filters( 'list_product_cats', $cat->name, $cat );

				$value = isset( $args['value'] ) && $args['value'] == 'id' ? $cat->term_id : $cat->slug;
				$output .= "<li>";
				$output .= $pad . __( $cat_name, 'woocommerce' );

				if ( ! empty( $args['show_count'] ) )
					$output .= '&nbsp;(' . $cat->count . ')';

				$output .= "</li>\n";
			}
		}
	}

	$args = func_get_args();

	// the user's options are the third parameter
	if ( empty( $args[2]['walker']) || !is_a($args[2]['walker'], 'Walker' ) ) {
		$walker = new WC_Product_Cat_Dropdown_Walker_1;
	} else {
		$walker = $args[2]['walker'];
	}

	return call_user_func_array( array( &$walker, 'walk' ), $args );
}

/**
 * WooCommerce Dropdown categories
 *
 * Stuck with this until a fix for http://core.trac.wordpress.org/ticket/13258
 * We use a custom walker, just like WordPress does
 *
 * @param int $deprecated_show_uncategorized (default: 1)
 * @return string
 */
function leetheme_wc_product_dropdown_categories( $args = array(), $deprecated_hierarchical = 1, $deprecated_show_uncategorized = 1, $deprecated_orderby = '' ) {
	global $wp_query;

	if ( ! is_array( $args ) ) {
		_deprecated_argument( 'wc_product_dropdown_categories()', '2.1', 'show_counts, hierarchical, show_uncategorized and orderby arguments are invalid - pass a single array of values instead.' );

		$args['show_counts']        = $args;
		$args['hierarchical']       = $deprecated_hierarchical;
		$args['show_uncategorized'] = $deprecated_show_uncategorized;
		$args['orderby']            = $deprecated_orderby;
	}

	$current_product_cat = isset( $wp_query->query['product_cat'] ) ? $wp_query->query['product_cat'] : '';
	$defaults            = array(
		'pad_counts'         => 1,
		'show_counts'        => 1,
		'hierarchical'       => 1,
		'hide_empty'         => 1,
		'show_uncategorized' => 1,
		'orderby'            => 'name',
		'selected'           => $current_product_cat,
		'menu_order'         => false
	);

	$args = wp_parse_args( $args, $defaults );

	if ( $args['orderby'] == 'order' ) {
		$args['menu_order'] = 'asc';
		$args['orderby']    = 'name';
	}

	$terms = get_terms( 'product_cat', apply_filters( 'wc_product_dropdown_categories_get_terms_args', $args ) );

	if ( ! $terms ) {
		$output = "<span>".__('Category', 'ltheme_domain')."</span><i class='fa fa-angle-down'></i></div>";
		// return;
	}

	$output	 = "<span>".__('Category', 'ltheme_domain')."</span><i class='fa fa-angle-down'></i></div><div class='nav-dropdown'><ul>";
	$output .= wc_walk_category_dropdown_tree_1( $terms, 0, $args );
	$output .= "</ul>";
	echo $output;
}

add_shortcode("product_categories_dropdown", "woo_product_categories_dropdown");
function woo_product_categories_dropdown( $atts, $content = null ) {

  extract(shortcode_atts(array(
    "count"         => '0',
    "hierarchical"  => '0',
    "orderby"       => ''
    ), $atts));
    ob_start();

$c = ( isset( $count ) ) ? $count : 0;
$h = ( isset( $hierarchical ) ) ? $hierarchical : '';
$o = ( isset( $orderby ) && $orderby != '' ) ? $orderby : 'order';

leetheme_wc_product_dropdown_categories();

?>

<?php

return ob_get_clean();
}