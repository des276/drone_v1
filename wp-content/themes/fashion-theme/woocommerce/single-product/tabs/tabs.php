<?php
/**
 * Single Product tabs / and sections
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
global $ros_opt;

if (!empty( $tabs ) )  : ?>

	<div class="tabbed-content woocommerce-tabs">
		<ul class="tabs">
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<li class="<?php echo $key ?>_tab">
					<a href="#tab-<?php echo $key ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
				</li>
				<li class="separator">/</li>
			<?php endforeach; ?>

			<?php 
			
			if($ros_opt['tab_title']){
				?> 
				<li class="additional-tab">
					<a href="#tab-additional"><?php echo esc_attr($ros_opt['tab_title'])?></a>
				</li>
				<li class="separator">/</li>
			<?php } ?>
		</ul>

		<?php foreach ( $tabs as $key => $tab ) : ?>
			<div class="panel entry-content" id="tab-<?php echo $key ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ) ?>
			</div>
		<?php endforeach; ?>

		<?php 
			if($ros_opt['tab_title']){ ?> 
			<div class="panel entry-content" id="tab-additional">
				 <?php echo do_shortcode($ros_opt['tab_content']);?>
			</div>	
		<?php } ?>
	</div>

<?php endif;?>