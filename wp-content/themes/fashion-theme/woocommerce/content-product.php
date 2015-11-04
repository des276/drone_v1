<?php
/**
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product, $woocommerce_loop, $ros_opt, $delay_animation_product;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( ! $product->is_visible() )
	return;
$post_id = $post->ID;
$stock_status = get_post_meta($post_id, '_stock_status',true) == 'outofstock';
?>

<?php if (!isset($ros_opt['animated_products']) || $ros_opt['animated_products']){?>
	<li class="wow fadeInUp product-item hover-flip grid1 <?php if($stock_status == "1"){ ?>out-of-stock<?php }?> " data-wow-duration="1s" data-wow-delay="<?php echo esc_attr($delay_animation_product);?>ms" >
<?php }else{ ?>
	<li class="product-item hover-flip grid1 <?php if($stock_status == "1"){ ?>out-of-stock<?php }?> " >
<?php } ?>


<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

<div class="inner-wrap">
	      <div class="product-img">
	      	
	      	<a href="<?php the_permalink(); ?>"><div class="image-overlay"></div>
	         <div class="main-img"><?php echo $product->get_image('shop_catalog');?></div>
				<?php
					if ( $attachment_ids ) {
						$loop = 0;				
						foreach ( $attachment_ids as $attachment_id ) {
							$image_link = wp_get_attachment_url( $attachment_id );
							if ( ! $image_link )
								continue;
							$loop++;
							printf( '<div class="back-img back">%s</div>', wp_get_attachment_image( $attachment_id, 'shop_catalog' ) );
							if ($loop == 1) break;
						}
					} else {
					?>
                    <div class="back-img"><?php echo $product->get_image('shop_catalog');?></div>
                    <?php
					}
				?>
			</a>
		   	 <?php if($stock_status == "1") { ?><div class="out-of-stock-label"><div class="text"><?php _e( 'Sold out', 'woocommerce' ); ?></div></div><?php }?>
			<?php woocommerce_get_template( 'loop/sale-flash.php' ); ?>
			

	      </div>

      <div class="info">

			<p class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
			
          	<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
          	<div class ="product-des">
				<?php echo substr(apply_filters( 'woocommerce_short_description', $post->post_excerpt ),0,250).'...'; ?>
			</div>
			
			<div class="product-interactions text-center">
	      		<div class="quick-view tip-top" data-prod="<?php echo $post->ID; ?>" data-tip="Quick View">
					<div class="quick-view-icon">
						<span class="fa fa-search"></span>
					</div>
				</div>

				
				<?php
					$link = array(
						'url'   => '',
						'label' => '',
						'class' => ''
					);

					$handler = apply_filters( 'woocommerce_add_to_cart_handler', $product->product_type, $product );

					switch ( $handler ) {
						case "variable" :
							$link['url'] 	= apply_filters( 'variable_add_to_cart_url', get_permalink( $product->id ) );
							$link['label'] 	= apply_filters( 'variable_add_to_cart_text', __( 'Select options', 'woocommerce' ) );
						break;
						case "grouped" :
							$link['url'] 	= apply_filters( 'grouped_add_to_cart_url', get_permalink( $product->id ) );
							$link['label'] 	= apply_filters( 'grouped_add_to_cart_text', __( 'View options', 'woocommerce' ) );
						break;
						case "external" :
							$link['url'] 	= apply_filters( 'external_add_to_cart_url', get_permalink( $product->id ) );
							$link['label'] 	= apply_filters( 'external_add_to_cart_text', __( 'Read More', 'woocommerce' ) );
						break;
						default :
							if ( $product->is_purchasable() ) {
								$link['url'] 	= apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
								$link['label'] 	= apply_filters( 'add_to_cart_text', __( 'Add to cart', 'woocommerce' ) );
								$link['class']  = apply_filters( 'add_to_cart_class', 'add_to_cart_button' );
							} else {
								$link['url'] 	= apply_filters( 'not_purchasable_url', get_permalink( $product->id ) );
								$link['label'] 	= apply_filters( 'not_purchasable_text', __( 'Read More', 'woocommerce' ) );
							}
						break;
					}
					echo apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf('<div data-href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="%s product_type_%s tip-top add-to-cart-grid" data-tip="%s">
						<div class="cart-icon">
						<strong><span class="fa fa-shopping-cart"></span></strong>
						<span class="cart-icon-handle"></span>
						<span class="add-to-cart-text">ADD TO CART</span>
			          	
			          	
				    </div></div>', esc_url( $link['url'] ), esc_attr( $product->id ), esc_attr( $product->get_sku() ), esc_attr( $link['class'] ), esc_attr( $product->product_type ), esc_html( $link['label'] ) ), $product, $link );
					?>
					<div class="add-to-link">
						<?php if ( in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
			                   <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
			            </div> 
	        </div>
		    <?php } ?>

          	
	   
      </div>
	


</div>
</li>
