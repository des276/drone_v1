<?php
/*
Plugin Name: Simple Popup Plugin
Plugin URI: http://www.grimmdude.com/wordpress-simple-popup-plugin
Description: This plugin makes it easy to create a simple, modifiable popup window.  Using the shortcode you can create a popup link and set the dimensions of each individual popup.
Version: 4.3
Author: Garrett Grimm
Author URI: http://www.grimmdude.com
*/

/*  Copyright 2012  Garrett Grimm  (email : garrett@grimmdude.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
require_once('simple-popup-widget.php');

//Javascript to be placed in header.php
function popup_plugin_script(){
    $width=(get_option('popup_window_width')==null)?'750':get_option('popup_window_width');
    $height=(get_option('popup_window_height')==null)?'550':get_option('popup_window_height');
    $myleft=(get_option('popup_window_left')==null || (get_option('popup_window_left')==0)) ? '0' : get_option('popup_window_left');
    $mytop=(get_option('popup_window_top')==null || (get_option('popup_window_top')==0))  ? '0' : get_option('popup_window_top');
    $scrollbar=(get_option('popup_scrollbar')==1) ? "yes" : "no";
    $toolbar=(get_option('popup_window_toolbar')==1) ? "yes" : "no";
    $location=(get_option('popup_window_location')==1) ? "yes" : "no";
	?>
	<!--Simple Popup Plugin v4.0 / RH Mods-->
	<script language="javascript" type="text/javascript">
	<!--
	var swin=null;
	function popitup(mypage,w,h,pos,myname,infocus){
	    if (w!=parseInt(w)||w<=0) w=$width;
	    if (h!=parseInt(h)||h<=0) h=$height;
	    if (myname==null){myname="swin"};
	    var myleft = <?php echo $myleft; ?>;
	    var mytop = <?php echo $mytop; ?>;
	    if (myleft==0 && mytop==0 && pos!="random"){pos="center"};
	    if (pos=="random"){myleft=(screen.width)?Math.floor(Math.random()*(screen.width-w)):100;mytop=(screen.height)?Math.floor(Math.random()*((screen.height-h)-75)):100;}
	    if (pos=="center"){myleft=(screen.width)?(screen.width-w)/2:100;mytop=(screen.height)?(screen.height-h)/2:100;}
	    settings="width=" + w + ",height=" + h + ",top=" + mytop + ",left=" + myleft + ",scrollbars=<?php echo $scrollbar; ?>,location=<?php echo $location; ?>,directories=no,status=no,menubar=no,toolbar=<?php echo $toolbar; ?>,resizable=no";swin=window.open(mypage,myname,settings);
	    if (infocus==null || infocus=="front"){swin.focus()};
	    return false;
	}
	// -->
	</script>
	<!--/Simple Popup Plugin-->
	<?php
}

//inserts script in head of document
add_action ( 'wp_head', 'popup_plugin_script' );

//Options page
add_action('admin_menu', 'simple_popup_menu');

//Set option defaults only if option doesn't exist
add_option('popup_window_width', '500');
add_option('popup_window_height', '500');
add_option('popup_window_left', '0');
add_option('popup_window_top', '0');

//defines shortcode
add_shortcode('popup', 'popup_plugin_shortcode');

add_action('init', 'simple_popup_Widget_init', 1);

function simple_popup_menu() {
    add_options_page('Simple Popup Plugin Options', 'Simple Popup Plugin', 8, __FILE__, 'simple_popup_options');
}

function simple_popup_options() {
    include('simple_popup_admin.php');
}

function popup_plugin_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'url' => '',
		'class' => '',
		'height' => get_option('popup_window_height'),
		'width' => get_option('popup_window_width'),
	), $atts ) );
    return "<a href='{$url}' onclick='return popitup(this.href, {$width}, {$height});' class='simple_popup_link {$class}'>$content</a>";    
}

//defines tag for theme templates
function simple_popup_link( $templateurl, $link_text ) {
    echo "<a href='$templateurl' onclick='return popitup(this.href);' class='simple_popup_link'>$link_text</a>";    
}

function simple_popup_Widget_init() {
    register_widget('simple_popup_Widget');
}



/* Merging of Simple Auto Delay Popup Plugin */

//message upon activation
function auto_delay_popup_activation_message() {
  //echo '<div class=\'updated fade\'><p>Thanks for purchasing Auto Delay Popup Plugin!</p></div>';
}

// shortcode for adding delayed popup to posts & pages [bartag foo="foo-value"]
function auto_delay_popup_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'url' 		=> NULL,
		'id' 		=> NULL,
		'height' 	=> '400',
		'width' 	=> '600',
		'delay' 	=> '3',
		'frequency' => NULL,
		'title'		=> NULL,
	), $atts ) );
	
	//set id to pageid=$id so we can add or remove the whole bit if needed from the url
	$id = "pageid=$id";
	
	//if the url isn't set default to the page/post template for the popup
	if ($url == NULL) {
		$url = plugins_url( 'auto_delay_popup_content.php' , __FILE__ );
	}

	//otherwise if the url is set don't add the pageid=$id variable to the url
	else {
		$id = NULL;
	}

	//multiply delay by 1000 to get ms from seconds
	$delay = $delay * 1000 ;

	//if frequency is set then set a cookie with the proper expiration time
	if (is_numeric($frequency)) {
		$cookie = "jQuery.cookie('auto_delay_popup', 'false', { expires: $frequency });";

	} else {
		$cookie = "jQuery.removeCookie('auto_delay_popup');";
		unset($_COOKIE['auto_delay_popup']);
	}

	if ( ! isset($_COOKIE['auto_delay_popup'])) {
		//return the script which will trigger the popup at the proper delay
		return "
			<script type='text/javascript'>
				$cookie
				jQuery(function() {
	    			setTimeout(\"tb_show('{$title}', '{$url}?{$id}&amp;height={$height}&amp;width={$width}&amp;TB_iframe=true')\",{$delay});
				});
			</script>";

	} else {
		return;
	}
}

//queue frontend scripts
function auto_delay_popup_queue_frontend_scripts() {
	//register jquery.cookie.js
	wp_register_script('jquery.cookie',plugins_url( 'scripts/jquery.cookie.js' , __FILE__ ));
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery.cookie', NULL, array('jquery'));
}

function auto_delay_popup_sitewide() {
	$enable_option = get_option('simple_auto_delay_popup_enable');
	$frequency = get_option('simple_auto_delay_popup_frequency');

	if (!$frequency || $frequency == 0) {
		unset($_COOKIE['auto_delay_popup']);
	}

	if (
		! isset($_COOKIE['auto_delay_popup']) && 
		($enable_option == 'homepage' && is_front_page()) || 
		($enable_option == 'posts' && is_single()) ||
		($enable_option == 'pages' && is_page()) ||
		($enable_option == 'everywhere')
		) 
	{
		?>
			<div id="simple_auto_delay_popup_title_div" style="display:none;">
			     <div><?php echo get_option('simple_auto_delay_popup_content'); ?></div>
			</div>
			<script type='text/javascript'>
				<?php if ($frequency > 0): ?>
					jQuery.cookie('auto_delay_popup', 'false', { expires: <?php echo $frequency; ?> });
				<?php else: ?>
					jQuery.removeCookie('auto_delay_popup');
				<?php endif; ?>

				jQuery(function() {
	    			setTimeout("tb_show('<?php echo get_option('simple_auto_delay_popup_title'); ?>', '#TB_inline?inlineId=simple_auto_delay_popup_title_div')",
	    				<?php echo get_option('simple_auto_delay_popup_delay') * 1000; ?>
	    			);
				});
			</script>
		<?php
	}
}

add_thickbox();
//register_activation_hook( __FILE__, 'auto_delay_popup_activation_message' );//queue scripts
add_action ( 'wp_print_scripts', 'auto_delay_popup_queue_frontend_scripts' );
add_shortcode( 'autopopup', 'auto_delay_popup_shortcode' );
add_action ( 'wp_footer', 'auto_delay_popup_sitewide' );
add_option('simple_auto_delay_popup_title', '');
add_option('simple_auto_delay_popup_content', '');
add_option('simple_auto_delay_popup_delay', '1');
add_option('simple_auto_delay_popup_frequency', '1');
add_option('simple_auto_delay_popup_enable', '0');