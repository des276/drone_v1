<?php
/**
 *
 * @package leetheme
 */
ob_start();
if ( ! isset( $content_width ) ) $content_width = 1000; /* pixels */

define( 'LEE_WOOCOMMERCE_ACTIVED', in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) );



require_once('admin/index.php');

global $ros_opt;
$ros_opt = $smof_data;


/************ Plugin recommendations **********/
require_once ('includes/class-tgm-plugin-activation.php');
add_action( 'tgmpa_register', 'leetheme_register_required_plugins' );
function leetheme_register_required_plugins() {

	$plugins = array(


		array(
			'name'     				=> 'WooCommerce', 
			'slug'     				=> 'woocommerce',
			'source'   				=> get_template_directory() . '/includes/plugins/woocommerce.zip', 
			'required' 				=> true,
			'version' 				=> '2.3.11', 
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'     				=> 'Revolution Slider',
			'slug'     				=> 'revolution-slider',
			'source'   				=> get_template_directory() . '/includes/plugins/revslider.zip',
			'required' 				=> false,
			'version' 				=> '4.6.0',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'     				=> 'WPBakery Visual Composer',
			'slug'     				=> 'wpbakery-visual-composer',
			'source'   				=> get_template_directory() . '/includes/plugins/js_composer.zip',
			'required' 				=> false,
			'version' 				=> '4.5.3',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'     				=> 'Ninja Forms',
			'slug'     				=> 'ninja-forms',
			'source'   				=> get_template_directory() . '/includes/plugins/ninja-forms.zip',
			'required' 				=> true,
			'version' 				=> '2.8.13',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		
		array(
			'name'     				=> 'Taxonomy Metadata',
			'slug'     				=> 'taxonomy-metadata',
			'source'   				=> get_template_directory() . '/includes/plugins/taxonomy-metadata.zip',
			'required' 				=> true,
			'version' 				=> '0.4',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		
		array(
			'name'     				=> 'Unlimited Sidebars Woosidebars',
			'slug'     				=> 'woosidebars',
			'source'   				=> get_template_directory() . '/includes/plugins/woosidebars.zip',
			'required' 				=> false,
			'version' 				=> '1.4.1',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		
		array(
			'name'     				=> 'YITH WooCommerce Ajax Search',
			'slug'     				=> 'yith-woocommerce-ajax-search',
			'source'   				=> get_template_directory() . '/includes/plugins/yith-woocommerce-ajax-search.zip',
			'required' 				=> true,
			'version' 				=> '1.2.5',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
			array(
			'name'     				=> 'YITH WooCommerce Wishlist',
			'slug'     				=> 'yith-woocommerce-wishlist',
			'source'   				=> get_template_directory() . '/includes/plugins/yith-woocommerce-wishlist.zip',
			'required' 				=> true,
			'version' 				=> '1.1.7',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
			array(
			'name'     				=> 'WooCommerce Sales Countdown',
			'slug'     				=> 'wooCommerce-sales-ocuntdown',
			'source'   				=> get_template_directory() . '/includes/plugins/woosalescountdown.zip',
			'required' 				=> true,
			'version' 				=> '1.8.6',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'     				=> 'My Custom Code',
			'slug'     				=> 'my-custom-code',
			'source'   				=> get_template_directory() . '/includes/plugins/my-custom-code.zip',
			'required' 				=> true,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'     				=> 'Regenerate Thumbnails',
			'slug'     				=> 'regenerate-thumbnails',
			'source'   				=> get_template_directory() . '/includes/plugins/regenerate-thumbnails.zip',
			'required' 				=> false,
			'version' 				=> '2.2.4',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
	);

	$config = array(
		'domain'       		=> 'ltheme_domain',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', '' ),
			'menu_title'                       			=> __( 'Install Plugins', 'ltheme_domain' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'ltheme_domain' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'ltheme_domain' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'ltheme_domain' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'ltheme_domain' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'ltheme_domain' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}


if ( ! function_exists( 'leetheme_setup' ) ) :
function leetheme_setup() {

	require( get_template_directory() . '/includes/dynamic-css.php' );

	require( get_template_directory() . '/includes/theme-functions.php' );

	require( get_template_directory() . '/includes/theme-options.php' );
	
	require( get_template_directory() . '/includes/ot-meta-box-api.php' );

	load_theme_textdomain( 'ltheme_domain', get_template_directory() . '/languages' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'custom-header' );

	add_image_size( 'normal-thumb', 750, 250, true );
	add_image_size( 'list-thumb', 250, 200, true );

	register_nav_menus( array(
		'primary' => __( 'Main Menu', 'ltheme_domain' ),
		'top_bar_nav' => __( 'Top bar Menu', 'ltheme_domain' ),
		'shop_by_category' => __('Shop by Category', 'ltheme_domain'),
		'my_account' => __('My Account', 'ltheme_domain'),
	) );


	add_filter( 'wp_nav_menu_items', 'add_loginout_link', 10, 2 );
	function add_loginout_link( $items, $args ){
		if (is_user_logged_in() && $args->theme_location == 'top_bar_nav'){
			$items .= '<li class="menu-item"><a href="'.get_permalink(2798).'" title="">'.__('My Account','ltheme_domain').'</a></li>';
			$items .= '<li class="menu-item"><a href="'.get_permalink(5).'" title="">'.__('My Wishlist','ltheme_domain').'</a></li>';
			$items .= '<li class="menu-item"><a class="nav-top-link" href="'.wp_logout_url().'">'.__('Log Out','ltheme_domain').'</a></li>';
		}
		elseif (!is_user_logged_in() && $args->theme_location == 'top_bar_nav') {
	        $items .= '<li class="menu-item"><a href="'.get_permalink( get_option('woocommerce_myaccount_page_id') ).'" title="">'.__('Login','ltheme_domain').'</a></li>';
	    }
	return $items;
	}

}
endif; 
add_action( 'after_setup_theme', 'leetheme_setup' );


function leetheme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'ltheme_domain' ),
		'id'            => 'sidebar-main',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	) );


	register_sidebar( array(
		'name'          => __( 'Shop Sidebar', 'ltheme_domain' ),
		'id'            => 'shop-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	) );

	register_sidebar( array(
		'name'          => __( 'Product Sidebar', 'ltheme_domain' ),
		'id'            => 'product-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	) );

	 register_sidebar( array(
		'name'          => __( 'Products group', 'ltheme_domain' ),
		'id'            => 'sidebar-products-group',
		'before_widget' => '<div id="%1$s" class="large-3 columns widget left %2$s">',
		'after_widget'  => '</div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer', 'ltheme_domain' ),
		'id'            => 'sidebar-footer',
		'before_widget' => '<div id="%1$s" class="large-3 columns widget left %2$s">',
		'after_widget'  => '</div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Shop by Category', 'ltheme_domain' ),
		'id'            => 'shop-by-category',
		'before_widget' => '<aside id="%1$s" class="shop-by-category">',
		'after_widget'  => '</aside>',
	) );

}
add_action( 'widgets_init', 'leetheme_widgets_init' );


include_once('includes/widgets/recent-posts.php');
include_once('includes/widgets/best-seller.php'); 
include_once('includes/widgets/contact-us.php');
include_once('includes/widgets/flickr.php');

/**
 * Enqueue scripts and styles
 */
function leetheme_scripts() {
	
	global $ros_opt;

	if ( ! is_admin() ) {
		wp_deregister_style('woocommerce-layout');	
		wp_deregister_style('woocommerce-smallscreen');	
		wp_deregister_style('woocommerce-general');	
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//CSS
	wp_enqueue_style( 'leetheme-icons', get_template_directory_uri() .'/css/fonts.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'leetheme-animations', get_template_directory_uri() .'/css/animations.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'leetheme-animate', get_template_directory_uri() .'/css/animate.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'owlcarousel', get_template_directory_uri() .'/css/owl.carousel.css', array(), '1.0', 'all');
	wp_enqueue_style( 'leetheme-style', get_stylesheet_uri(), array(), '1.0', 'all');
	wp_enqueue_style( 'font-awesome-style', get_template_directory_uri() . '/css/font-awesome-4.2.0/css/font-awesome.min.css', array(), '1.0', 'all');

	//Scripts
	
	wp_enqueue_script( 'leetheme-cookie', get_template_directory_uri() .'/js/jquery.cookie.js', array(), false, true );
	wp_enqueue_script( 'leetheme-modernizer', get_template_directory_uri() .'/js/modernizr.js', array(), false, true );
 	wp_enqueue_script( 'leetheme-scrollTo', get_template_directory_uri() .'/js/jquery.scrollTo.js', array(), false, true );
 	wp_enqueue_script( 'leetheme-JRespond', get_template_directory_uri() .'/js/jquery.jRespond.js', array(), false, true );
 	wp_enqueue_script( 'leetheme-hoverIntent', get_template_directory_uri() .'/js/jquery.hoverIntent.js', array(), false, true );
 	wp_enqueue_script( 'leetheme-jpanelmenu', get_template_directory_uri() .'/js/jquery.jpanelmenu.js', array(), false, true );
 	wp_enqueue_script( 'leetheme-waypoints', get_template_directory_uri() .'/js/jquey.waypoints.js', array(), false, true );
 	wp_enqueue_script( 'leetheme-packer', get_template_directory_uri() .'/js/jquery.packer.js', array(), false, true );
 	wp_enqueue_script( 'leetheme-tipr', get_template_directory_uri() .'/js/jquery.tipr.js', array(), false, true );

 	if (LEE_WOOCOMMERCE_ACTIVED){
 		wp_enqueue_script( 'leetheme-variations', get_template_directory_uri() .'/js/jquery.variations.js', array(), false, true );
 	}
	wp_enqueue_script( 'leetheme-magnific-popup', get_template_directory_uri() .'/js/jquery.magnific-popup.js', array(), false, true );
	wp_enqueue_script( 'leetheme-owlcarousel', get_template_directory_uri() .'/js/owl.carousel.min.js', array(), false, true );
	wp_enqueue_script( 'leetheme-parallax', get_template_directory_uri() .'/js/jquery.stellar.js', array(), false, true );
	wp_enqueue_script( 'leetheme-theme-js', get_template_directory_uri() .'/js/main.js', array(), false, true );
	wp_enqueue_script( 'leetheme-wow-js', get_template_directory_uri() .'/js/wow.min.js', array(), false, true );

	wp_deregister_style('yith-wcwl-font-awesome');
	wp_deregister_style('yith-wcwl-font-awesome-ie7');
	wp_deregister_style('yith-wcwl-main');
}
add_action( 'wp_enqueue_scripts', 'leetheme_scripts' );

//* Enqueue script to activate WOW.js
add_action('wp_enqueue_scripts', 'sk_wow_init_in_footer');
function sk_wow_init_in_footer() {
	add_action( 'print_footer_scripts', 'wow_init' );
}

function wow_init() { ?>
	<script type="text/javascript">
		new WOW().init();
	</script>
<?php }



function leetheme_admin_bar_render() {
	 global $wp_admin_bar;
	if (current_user_can( 'manage_options' ) ){
	 $optionUrl = get_admin_url().'themes.php?page=optionsframework';
	 $blocks_url = get_post_type_archive_link( 'blocks' );
	}
}
add_action( 'wp_before_admin_bar_render', 'leetheme_admin_bar_render' );


/* UNREGISTRER DEFAULT WOOCOMMERCE HOOKS */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_breadcrumb', 20);
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_show_messages', 10 );

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

add_filter('widget_text', 'do_shortcode');

add_filter('the_excerpt', 'do_shortcode');

add_action('init', 'leetheme_post_type_support');
function leetheme_post_type_support() {
	add_post_type_support( 'page', 'excerpt' );
}


include_once( get_template_directory() . '/includes/google-fonts.php' );

include_once( get_template_directory() . '/includes/importer/importer.php' );


include_once('includes/shortcodes/collapses.php');
include_once('includes/shortcodes/tabs.php');
include_once('includes/shortcodes/buttons.php');
include_once('includes/shortcodes/grid.php');
include_once('includes/shortcodes/carousel.php');
include_once('includes/shortcodes/share.php');
include_once('includes/shortcodes/titles.php');
include_once('includes/shortcodes/latest_post.php');
include_once('includes/shortcodes/banners.php');
include_once('includes/shortcodes/google_maps.php');
include_once('includes/shortcodes/messages.php');
include_once('includes/shortcodes/search.php');
include_once('includes/shortcodes/widget_to_shortcode.php');
include_once('includes/shortcodes/others.php');

include_once('includes/shortcodes/product_categories.php');
include_once('includes/shortcodes/products_best_seller.php');
include_once('includes/shortcodes/products_categories_dropdown.php');
include_once('includes/shortcodes/products_custom.php');
include_once('includes/shortcodes/products_featured.php');
include_once('includes/shortcodes/products_latest_products.php');
include_once('includes/shortcodes/products_sale.php');
include_once('includes/shortcodes/products_weekly_featured.php');


include_once('includes/vc.php');


function add_ieFix () {
	$ie_css = get_template_directory_uri() .'/css/ie-fix.css';
    echo '<!--[if lt IE 9]>';
    echo '<link rel="stylesheet" type="text/css" href="'.$ie_css.'">';
    echo '<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>';
    echo "<script>var head = document.getElementsByTagName('head')[0],style = document.createElement('style');style.type = 'text/css';style.styleSheet.cssText = ':before,:after{content:none !important';head.appendChild(style);setTimeout(function(){head.removeChild(style);}, 0);</script>";
    echo '<![endif]-->';
}
add_action('wp_head', 'add_ieFix');


if(isset($ros_opt['products_pr_page'])){
	$products = $ros_opt['products_pr_page'];
	add_filter( 'loop_shop_per_page', create_function( '$cols', "return $products;" ), 20 );
}


add_filter('logout_url', 'new_logout_url', 10, 2);
function new_logout_url($logouturl, $redir)
{
	$redir = get_option('siteurl');
	return $logouturl . '&amp;redirect_to=' . urlencode($redir);
}


/* Filter add LeethemeNavDropdown to the widget Custom Menu*/
function myplugin_custom_walker( $args ) {
    return array_merge( $args, array(
		'walker' => new LeethemeNavDropdown()
    ) );
}
add_filter( 'wp_nav_menu_args', 'myplugin_custom_walker' );


/* Filter add  property='stylesheet' to the wp enqueue style*/
function mycustom_wpenqueue( $src ){
	return str_replace("rel='stylesheet'","rel='stylesheet' property='stylesheet'",$src);
}
add_filter('style_loader_tag', 'mycustom_wpenqueue');


/* Remove Wordpress update */
add_action('admin_menu','wphidenag');
function wphidenag() {
	remove_action( 'admin_notices', 'update_nag', 3 );
	remove_filter( 'update_footer', 'core_update_footer' );
}


/* Remove message Woocommerce */
function remove_upgrade_nag() {
   echo '<style type="text/css">
           .woocommerce-message.updated, .plugin-update-tr, .rs-update-notice-wrap {display: none}
         </style>';
}
add_action('admin_head', 'remove_upgrade_nag');


// Escape HTML tags in post content
add_filter('the_content', 'escape_code_fragments');


// Escape HTML tags in comments
add_filter('pre_comment_content', 'escape_code_fragments');

function escape_code_fragments($source) {
  $encoded = preg_replace_callback('/<script(.*?)>(.*?)<\/script>/ims',
  create_function(
    '$matches',
    '$matches[2] = preg_replace(
        array("/^[\r|\n]+/i", "/[\r|\n]+$/i"), "",
        $matches[2]);
      return "<pre" . $matches[1] . ">" . esc_html( $matches[2] ) . "</pre>";'
  ),
  $source);

  if ($encoded)
    return $encoded;
  else
    return $source;
}

// Visual Composer plugin
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
	
	add_filter( 'vc_shortcodes_css_class', 'leetheme_customize_vc_rows_columns', 10, 2 );
}

?>