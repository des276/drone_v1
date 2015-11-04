<?php
function leetheme_custom_css() {
global $ros_opt;
?>

<style type="text/css">
	<?php  if (isset($ros_opt['type_texts'])) {?>
		.top-bar-nav a.nav-top-link,
		body,
		p,
		#top-bar,
		.cart-inner .nav-dropdown,
		.nav-dropdown {
		    font-family: <?php echo esc_attr($ros_opt['type_texts']) ?>, helvetica, arial, sans-serif!important;
		}
	<?php }?>

	<?php if (isset($ros_opt['type_nav'])) { ?>
		.main-navigation a.nav-top-link{font-family: <?php echo esc_attr($ros_opt['type_nav']) ?>,helvetica,arial,sans-serif!important;}
	<?php }?>

	<?php if (isset($ros_opt['type_headings'])) { ?>
		h1,h2,h3,h4,h5,h6{font-family: <?php echo esc_attr($ros_opt['type_headings']) ?>,helvetica,arial,sans-serif!important;}
	<?php }?>

	<?php if (isset($ros_opt['type_alt'])) { ?>
		.alt-font{font-family: <?php echo esc_attr($ros_opt['type_alt']) ?>,Georgia,serif!important;}
	<?php }?>

	<?php if(isset($ros_opt['site_layout']) && $ros_opt['site_layout'] == 'boxed'){?> 
		body.boxed,
		body.framed-layout,
		body {
		    background-color: <?php echo esc_attr($ros_opt['site_bg_color']); ?>;
		    background-image: url("<?php echo esc_url($ros_opt['site_bg_image']); ?>");
		    background-attachment: fixed;
		}
	<?php }?>

	/* COLOR PRIMARY */
	<?php if(isset($ros_opt['color_primary'])){?> 
	
		/* COLOR */
		.badge.style3 .inner .inner-text,
		.add-to-cart-grid .cart-icon strong,
		.tagcloud a,
		.navigation-paging a,
		.navigation-image a,
		ul.page-numbers a,
		ul.page-numbers li > span,
		#header-outer-wrap .mobile-menu a,
		.logo a,
		li.mini-cart .cart-icon strong,
		.widget_product_tag_cloud a,
		.widget_tag_cloud a,
		.post-date,
		#header-outer-wrap .mobile-menu a.mobile-menu a,
		.checkout-group h3,
		.order-review h3,
		.mini-cart-item .cart_list_product_price,
		.minicart_total_checkout span.amount,
		.remove:hover i,
		.tabbed-content ul.tabs li a:hover,
		.tabbed-content ul.tabs li.active a,
		.price,
		.product-item .info .price,
		.widget_products .product_list_widget li .amount,
		.widget_top_rated_products .product_list_widget li .amount,
		.support-icon,
		.entry-meta a,
		#order_review_heading,
		.checkout-group h3,
		.shop_table.cart td.product-name a,
		a.shipping-calculator-button,
		h3.breadcrumb,
		.widget_product_categories li a:hover,
		.widget_layered_nav li a:hover,
		.widget_layered_nav_filters li a:hover,
		.product_list_widget .text-info span,
		.left-text i,
		a,
		.widget_product_categories li.current-cat > a,
		.collapsing.categories.list li:hover span,
		.copyright-footer span,
		#menu-shop-by-category li.active.menu-parent-item .nav-top-link::after,
		.product_list_widget .product-title:hover,
		.product_list_widget span.amount,
		.header-type-3 ul.header-nav li a.nav-top-link:hover,
		.mini-cart .remove .fa-trash-o:hover,
		.widget_product_categories li:hover a,
		.widget_layered_nav li:hover a,
		.widget_layered_nav_filters li:hover a,
		.remove .icon-close:hover,
		.absolute-footer .left .copyright-footer span,
		.html-text i {
		    color: <?php echo esc_attr($ros_opt['color_primary']) ?>;
		}
		ul.header-nav li.active a.nav-top-link,
		ul li .nav-dropdown > ul > li:hover > a,
		ul li .nav-dropdown > ul > li:hover > a::before,
		ul li .nav-dropdown > ul > li .nav-column-links > ul > li a:hover,
		ul li .nav-dropdown > ul > li .nav-column-links > ul > li:hover > a::before {
		    color: <?php echo esc_attr($ros_opt['color_primary']) ?>;
		}
		
		.blog_shortcode_item .blog_shortcode_text h3 a:hover,
		.main-navigation li.menu-item a:hover,
		.widget-area ul li a:hover,
		h1.entry-title a:hover,
		.comments-area a,
		.product-item .info .name a:hover,
		.wishlist_table td.product-name a:hover,
		.product_list_widget .text-info a:hover,
		.product-list .info .name:hover,
		ul.main-navigation li .nav-dropdown > ul > li .nav-column-links > ul > li a:hover {
		    color: <?php echo esc_attr($ros_opt['color_primary']) ?> !important;
		}
		
		/* BACKGROUND */
		.wish-list-icon:hover,
		.tabbed-content.pos_pills ul.tabs li.active a,
		li.featured-item.style_2:hover a,
		.bery_hotspot,
		ul.page-numbers li > span,
		.label-new.menu-item a:after,
		.text-box-primary,
		.navigation-paging a:hover,
		.navigation-image a:hover,
		.next-prev-nav .prod-dropdown > a:hover,
		ul.page-numbers a:hover,
		.widget_product_tag_cloud a:hover,
		.widget_tag_cloud a:hover,
		.custom-cart-count,
		.iosSlider .sliderNav a:hover span,
		a.button.trans-button:hover,
		.please-wait i,
		li.mini-cart .cart-icon .cart-count,
		.product-img .product-bg,
		#submit,
		button,
		#submit,
		button,
		input[type="submit"],
		li.mini-cart.active .cart-icon,
		.cart-wishlist .mini-cart .cart-link .cart-icon,
		.post-item:hover .post-date,
		.blog_shortcode_item:hover .post-date,
		.product-category:hover .header-title,
		.group-slider .sliderNav a:hover,
		.support-icon.square-round:hover,
		.entry-header .post-date-wrapper,
		.entry-header .post-date-wrapper:hover,
		.comment-inner .reply a:hover,
		.checkout-breadcrumb div:hover span,
		.woocommerce-cart .title-cart span,
		.woocommerce-checkout .title-checkout span,
		.woocommerce-checkout .title-cart span,
		ul.page-numbers a:hover,
		ul.page-numbers li span.current,
		.social-icons .icon.icon_email:hover,
		.widget_collapscat h3,
		ul.header-nav li a.nav-top-link::before,
		.sliderNav a span:hover,
		.shop-by-category h3.section-title,
		ul.header-nav li a.nav-top-link::before,
		.custom-footer-1 .bery-hr,
		.filter-tabs li i:hover,
		.filter-tabs li.active i,
		.products.list .product-interactions .quick-view:hover,
		.products.list .product-interactions .yith-wcwl-add-button:hover,
		ul.header-nav li a.nav-top-link::before,
		.widget_collapscat h2,
		.shop-by-category h2.widgettitle,
		.rev_slider_wrapper .type-label-2,
		.owl-carousel .owl-controls .owl-pagination .owl-page.active,
		.owl-carousel .owl-controls .owl-pagination .owl-page:hover,
		.cart-wishlist .wish-list-inner .wish-list-icon:hover {
		    background-color: <?php echo esc_attr($ros_opt['color_primary']) ?>
		}

		.sliderBullets .bullet.active,
		.sliderBullets .bullet:hover,
		.flipContainer .pager span.dot.current,
		.button.trans-button.primary,
		.tparrows:hover {
		    background-color: <?php echo esc_attr($ros_opt['color_primary']) ?> !important
		}
		
		.sliderBullets .bullet.active,
		.sliderBullets .bullet:hover,
		.flipContainer .pager span.dot.current,
		.tp-bullets.simplebullets.round .bullet:hover,
		.tp-bullets.simplebullets.round .bullet.selected {
		    background-color: <?php echo esc_attr($ros_opt['color_primary']) ?> !important
		}
		/* BORDER COLOR */
		.text-bordered-primary,
		.badge.style3 .inner,
		ul.page-numbers li > span,
		.add-to-cart-grid .cart-icon-handle,
		.add-to-cart-grid.please-wait .cart-icon strong,
		.navigation-paging a,
		.navigation-image a,
		ul.page-numbers a,
		ul.page-numbers a:hover,
		.post.sticky,
		.widget_product_tag_cloud a,
		.next-prev-nav .prod-dropdown > a:hover,
		.iosSlider .sliderNav a:hover span,
		.group-slider .sliderNav a:hover,
		.woocommerce .order-review,
		.woocommerce-checkout form.login,
		li.mini-cart .cart-icon strong,
		li.mini-cart .cart-icon .cart-icon-handle,
		.post-date,
		.main-navigation .nav-dropdown ul,
		.cart-inner .nav-dropdown,
		.search-dropdown .nav-dropdown,
		.remove:hover i,
		.support-icon.square-round:hover,
		.checkout-breadcrumb div:hover span,
		.woocommerce-cart .title-cart span,
		.woocommerce-checkout .title-checkout span,
		.woocommerce-checkout .title-cart span,
		.widget_price_filter .ui-slider .ui-slider-handle,
		ul.page-numbers a:hover,
		ul.page-numbers li span.current,
		h3.section-title span,
		.social-icons .icon.icon_email:hover,
		.button.trans-button.primary,
		.cart-wishlist .wish-list-inner:hover .wish-list-icon,
		.products.list .product-interactions .yith-wcwl-wishlistexistsbrowse a {
		    border-color: <?php echo esc_attr($ros_opt['color_primary']) ?>;
		}

		.widget_product_tag_cloud a:hover,
		.widget_tag_cloud a:hover,
		.promo .sliderNav span:hover,
		.remove .icon-close:hover {
		    border-color: <?php echo esc_attr($ros_opt['color_primary']) ?> !important;
		}

		.tabbed-content ul.tabs li a:hover:after,
		.tabbed-content ul.tabs li.active a:after {
		    border-top-color: <?php echo esc_attr($ros_opt['color_primary']) ?>;
		}

		.woocommerce-cart .title-cart p,
		.woocommerce-checkout .title-checkout p,
		.woocommerce-checkout .title-cart p {
		    border-bottom: 2px solid <?php echo esc_attr($ros_opt['color_primary']) ?>;
		}

		.collapsing.categories.list li:hover,
		#menu-shop-by-category li.active {
		    border-left-color: <?php echo esc_attr($ros_opt['color_primary'])?> !important;
		}
	<?php }?>
	
	/* COLOR SECONDARY */
	<?php if(isset($ros_opt['color_secondary'])){?> 

		a.secondary.trans-button,
		li.menu-sale a {
		    color: <?php echo esc_attr($ros_opt['color_secondary']) ?>!important
		}
		.label-sale.menu-item a:after,
		.mini-cart:hover .custom-cart-count,
		.badge .inner,
		.button.secondary,
		.button.checkout,
		#submit.secondary,
		button.secondary,
		.button.secondary,
		input[type="submit"].secondary {
		    background-color: <?php echo esc_attr($ros_opt['color_secondary']) ?>
		}
		a.button.secondary,
		.button.secondary {
		    border-color: <?php echo esc_attr($ros_opt['color_secondary']) ?>;
		}
		.badge .inner {
		    border-right-color: <?php echo esc_attr($ros_opt['color_secondary']) ?> !important;
		    border-top-color: <?php echo esc_attr($ros_opt['color_secondary']) ?>!important;
		}
		a.secondary.trans-button:hover {
		    color: #FFF!important;
		    background-color: <?php echo esc_attr($ros_opt['color_secondary']) ?>!important
		}
		ul.page-numbers li > span {
		    color: #FFF;
		}
		
	<?php }?>

	/* COLOR SUCCESS */
	<?php if(isset($ros_opt['color_success'])){?> 
		.woocommerce-message {
		    color: <?php echo esc_attr($ros_opt['color_success']) ?>!important
		}
		.woocommerce-message:before,
		.woocommerce-message:after {
		    color: #FFF!important;
		    background-color: <?php echo esc_attr($ros_opt['color_success']) ?>!important
		}
		.label-popular.menu-item a:after,
		.add-to-cart-grid.please-wait .cart-icon strong,
		.tooltip-new.menu-item > a:after {
		    background-color: <?php echo esc_attr($ros_opt['color_success']) ?>;
		    border-color: <?php echo esc_attr($ros_opt['color_success']) ?>;
		}
		.add-to-cart-grid.please-wait .cart-icon .cart-icon-handle,
		.add-to-cart-grid.added .cart-icon .cart-icon-handle,
		.woocommerce-message {
		    border-color: <?php echo esc_attr($ros_opt['color_success']) ?>
		}
		.tooltip-new.menu-item > a:before {
		    border-top-color: <?php echo esc_attr($ros_opt['color_success']) ?> !important;
		}
		.out-of-stock-label {
		    border-right-color: <?php echo esc_attr($ros_opt['color_success']) ?> !important;
		    border-top-color: <?php echo esc_attr($ros_opt['color_success']) ?>!important;
		}
		.product-interactions .add-to-cart-grid.added .cart-icon,
		.yith-wcwl-wishlistexistsbrowse a,
		.yith-wcwl-wishlistaddedbrowse a {
		    background-color: <?php echo esc_attr($ros_opt['color_success']) ?>
		}

	<?php }?>

	/* COLOR BUTTON */
	<?php if(isset($ros_opt['color_button'])) {?> 
		form.cart .button,
		.cart-inner .button.secondary,
		.checkout-button,
		input#place_order,
		input.button,
		.btn-viewcart,
		.btn-checkout,
		input#submit,
		.add-to-cart-grid-style2,
		.add_to_cart,
		button.button {
		    background-color: <?php echo esc_attr($ros_opt['color_button']) ?>!important;
		}
	<?php } else if(isset($ros_opt['color_primary'])){?>
		form.cart .button:hover,
		.button:hover,
		a.primary.trans-button:hover,
		.form-submit input:hover,
		#payment .place-order input:hover,
		input#submit:hover {
		    background-color: <?php echo esc_attr($ros_opt['color_primary']) ?>!important;
		};
	<?php } ?>


	/* COLOR HOVER */
	<?php if(isset($ros_opt['color_hover'])) {?>
		#submit:hover,
		button:hover,
		.button:hover,
		input[type="submit"]:hover,
		.product-interactions .quick-view:hover,
		.product-interactions .add-to-cart-grid .cart-icon:hover {
		    border-color: <?php echo esc_attr($ros_opt['color_hover']);?>;
		}

		form.cart .button:hover,
		.button:hover,
		a.primary.trans-button:hover,
		.form-submit input:hover,
		#payment .place-order input:hover,
		input#submit:hover,
		.add-to-cart-grid-style2:hover,
		.add-to-cart-grid-style2.added,
		.add-to-cart-grid-style2.loading,
		.product-list .product-img .quick-view.fa-search:hover,
		.products.list .product-interactions .add-to-cart-grid:hover,
		.product-interactions .add-to-cart-grid .cart-icon:hover,
		.product-interactions .add-to-link .quick-view:hover,
		.yith-wcwl-add-button .add_to_wishlist:hover,
		.yith-wcwl-add-to-wishlist a:hover,
		.product-interactions .quick-view:hover,
		.product-interactions .add-to-link .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a:hover,
		.product-interactions .add-to-link .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a:hover,
		.product-interactions .add-to-link .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a:hover,
		.products.list .product-interactions .yith-wcwl-add-button:hover,
		.owl-carousel .owl-controls .owl-buttons div:hover {
		    background-color: <?php echo esc_attr($ros_opt['color_hover']) ?>!important;
		};
	<?php }?>


   	<?php if(is_admin_bar_showing()){ ?> 
    	.tipr_container_bottom{display: none;position: absolute;margin-top: 13px;z-index: 1000;}
   		.tipr_container_top{display: none;position: absolute;margin-top:-70px;z-index: 1000;}
	<?php } ?>
	
</style>

<?php 
}
add_action( 'wp_head', 'leetheme_custom_css', 100 );
?>