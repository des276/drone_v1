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
	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
	  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>



	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>	


<div id="wrapper" class="fixNav-enabled">
	<?php
		if ($ros_opt['fixed_nav']):
			get_template_part('headers/header-sticky');
	 	endif;
	 ?>
	 
	<?php
		$ht = ''; $hstrucutre = ''; $custom_header = '';  $page_slider = '';
		if (isset($post->ID)){
			$custom_header = get_post_meta($post->ID,'custom_header',true);
			if (!empty($custom_header)){
				$ht = $custom_header;
			}
			else
			{
				$ht = apply_filters('custom_header_filter',$ht);
			}
			$hstrucutre = bery_get_header_structure($ht);
		}else{
			$hstrucutre = 1;
		}
		
		get_template_part('headers/header-structure', $hstrucutre);
	?>
	

<div id="main-content" class="site-main light">
<?php  if(function_exists('wc_print_notices')) {wc_print_notices();}?>