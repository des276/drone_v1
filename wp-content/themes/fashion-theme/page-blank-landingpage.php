<?php
/*
Template name: Blank landingpage
*/
?>
<?php
global $woo_options;
global $woocommerce;
global $ros_opt;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<link rel="shortcut icon" href="<?php if ($ros_opt['site_favicon']) { echo esc_attr($ros_opt['site_favicon']); ?>
	<?php } else { ?><?php echo get_template_directory_uri(); ?>/favicon.png<?php } ?>" />

</head>
<body <?php body_class(); ?>>
<div id="back-to-site">
<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
		<?php bloginfo( 'name' ); ?>
</a>
</div>

<div id="wrapper">
<div id="main-content" class="site-main">

<?php if(in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?> 
	<?php  woocommerce_show_messages(); ?>
<?php } ?>
<div class="page-header">
<?php the_excerpt();?>
</div>
<div id="content" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile;?>
</div>
</div>

<footer class="footer-wrapper" role="contentinfo">
<div class="absolute-footer" style="background-color:<?php echo esc_attr($ros_opt['footer_bottom_color']); ?>">
<div class="row">
	<div class="large-12 columns">
		<div class="left">
			 <?php if ( has_nav_menu( 'footer' ) ) : ?>
				<?php  
						wp_nav_menu(array(
							'theme_location' => 'footer',
							'menu_class' => 'footer-nav',
							'depth' => 1,
							'fallback_cb' => false,
						));
				?>						
			<?php endif; ?>
		<div class="copyright-footer"><?php if(isset($ros_opt['footer_left_text'])) {echo esc_attr($ros_opt['footer_left_text']);} else{ echo 'Define left footer text / navigation in Theme Option Panel';} ?></div>
		</div>
		<div class="right">
				<?php if(isset($ros_opt['footer_right_text'])){ echo do_shortcode($ros_opt['footer_right_text']);} else {echo 'Define right footer text in Theme Option Panel';} ?>
		</div>
	</div>
</div>
</div>
</footer>
</div>

<a href="#top" id="top-link"><span class="icon-angle-up"></span></a>
<?php wp_footer(); ?>
</body>
</html>
