<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

global $ros_opt, $woocommerce_loop;
if(is_cart()){$woocommerce_loop['columns'] = 4;} 
?>
<div class="row"><div class="large-12 columns">

<?php if(!empty($woocommerce_loop)){ ?>
	<ul class="products thumb small-block-grid-1 large-block-grid-<?php echo esc_attr($woocommerce_loop["columns"]); ?>">
<?php } else { ?>
	<ul class="products thumb small-block-grid-1 large-block-grid-3">
<?php } ?>
