<?php 
require( '../../../wp-blog-header.php' ); 
$auto_delay_popup_pageid_query = new WP_Query();
$auto_delay_popup_pageid_query->query('page_id='.$_GET['pageid']);
$auto_delay_popup_pageid_query->the_post();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<style>
		#auto_delay_popup_body {background-color:#ffffff;background-image:none;}
		#auto_delay_popup_content {padding:8px;}	
	</style>
	<link type="text/css" rel="stylesheet" media="all" href="<?php echo get_stylesheet_uri() ?> ">
</head>
<body id="auto_delay_popup_body">
	<div <?php post_class(); ?> id="auto_delay_popup_content">
	 		<?php the_content(); ?>
	</div>
</body>
</html>