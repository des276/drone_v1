<?php
// **********************************************************************// 
// ! Customize the VC rows and columns to use theme's Foundation framework
// **********************************************************************//
if ( ! function_exists( 'leetheme_customize_custom_css_classes' ) ) {
	
    function leetheme_customize_vc_rows_columns( $class_string, $tag ) {
            
        // vc_row 
        if ( $tag == 'vc_row' || $tag == 'vc_row_inner' ) {
        	
            $replace = array(
                'vc_row-fluid' 	=> 'row',
                'wpb_row' 		=> '',
                'vc_row'		=> '',
                'vc_inner'		=> '',
            );
			
            $class_string = leetheme_replace_string_with_assoc_array( $replace, $class_string );
			
        }
        
        // vc_column
        if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
        	
            $replace = array(
                'wpb_column' 		=> '',
                'column_container' 	=> '',
                
            );
			
            $to_be_replaced = array( '', '' );
            
            $class_string = leetheme_replace_string_with_assoc_array(
                                $replace, preg_replace( '/vc_span(\d{1,2})/', 'lee-col large-$1 columns', $class_string )
                            );
							
			// Custom columns	
			$class_string = leetheme_replace_string_with_assoc_array(
                                $replace, preg_replace( '/vc_(\d{1,2})\\/12/', 'lee-col large-$1 columns', $class_string )
                            );
							
			// VC 4.3.x (it changed the tags)
			$class_string = leetheme_replace_string_with_assoc_array(
                                $replace, preg_replace('/vc_col-(xs|sm|md|lg)-(\d{1,2})/', 'lee-col large-$2 columns', $class_string)
                            );
							
        }
        
        return $class_string;
		
    }

}


// Used in "leetheme_customize_vc_rows_columns()" [plugin-custom-functions.php]
if ( ! function_exists( 'leetheme_replace_string_with_assoc_array' ) ) {
	
	function leetheme_replace_string_with_assoc_array( array $replace, $subject ) { 
	   return str_replace( array_keys( $replace ), array_values( $replace ), $subject );    
	}
	
}

// **********************************************************************// 
// ! Visual Composer Setup
// **********************************************************************//
add_action( 'init', 'bery_VC_setup');
if(!function_exists('getCSSAnimation')) {
	function getCSSAnimation($css_animation) {
        $output = '';
        if ( $css_animation != '' ) {
            wp_enqueue_script( 'waypoints' );
            $output = ' wpb_animate_when_almost_visible wpb_'.$css_animation;
        }
        return $output;
	}
}
if(!function_exists('buildStyle')) {
    function buildStyle($bg_image = '', $bg_color = '', $bg_image_repeat = '', $font_color = '', $padding = '', $margin_bottom = '') {
        $has_image = false;
        $style = '';
        if((int)$bg_image > 0 && ($image_url = wp_get_attachment_url( $bg_image, 'large' )) !== false) {
            $has_image = true;
            $style .= "background-image: url(".$image_url.");";
        }
        if(!empty($bg_color)) {
            $style .= vc_get_css_color('background-color', $bg_color);
        }
        if(!empty($bg_image_repeat) && $has_image) {
            if($bg_image_repeat === 'cover') {
                $style .= "background-repeat:no-repeat;background-size: cover;";
            } elseif($bg_image_repeat === 'contain') {
                $style .= "background-repeat:no-repeat;background-size: contain;";
            } elseif($bg_image_repeat === 'no-repeat') {
                $style .= 'background-repeat: no-repeat;';
            }
        }
        if( !empty($font_color) ) {
            $style .= vc_get_css_color('color', $font_color); // 'color: '.$font_color.';';
        }
        if( $padding != '' ) {
            $style .= 'padding: '.(preg_match('/(px|em|\%|pt|cm)$/', $padding) ? $padding : $padding.'px').';';
        }
        if( $margin_bottom != '' ) {
            $style .= 'margin-bottom: '.(preg_match('/(px|em|\%|pt|cm)$/', $margin_bottom) ? $margin_bottom : $margin_bottom.'px').';';
        }
        return empty($style) ? $style : ' style="'.$style.'"';
    }
}
if(!function_exists('bery_VC_setup')) {
	function bery_VC_setup() {
		if (!class_exists('WPBakeryVisualComposerAbstract')) return;
		global $vc_params_list;
		$vc_params_list[] = 'icon';
		
		vc_remove_element("vc_carousel");
		vc_remove_element("vc_images_carousel");
		vc_remove_element("vc_tour");
		
		
		
		$target_arr = array(__("Same window", "js_composer") => "_self", __("New window", "js_composer") => "_blank");
		$add_css_animation = array(
		  "type" => "dropdown",
		  "heading" => __("CSS Animation", "js_composer"),
		  "param_name" => "css_animation",
		  "admin_label" => true,
		  "value" => array(__("No", "js_composer") => '', __("Top to bottom", "js_composer") => "top-to-bottom", __("Bottom to top", "js_composer") => "bottom-to-top", __("Left to right", "js_composer") => "left-to-right", __("Right to left", "js_composer") => "right-to-left", __("Appear from center", "js_composer") => "appear"),
		  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "js_composer")
		);


		// **********************************************************************// 
	    // ! Add the parent element
	    // **********************************************************************//
    	//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		    class WPBakeryShortCode_Your_Gallery extends WPBakeryShortCodesContainer {};
		    class WPBakeryShortCode_bery_slider extends WPBakeryShortCodesContainer {};
		    class WPBakeryShortCode_bery_banner_grid extends WPBakeryShortCodesContainer {};
		    class WPBakeryShortCode_background extends WPBakeryShortCodesContainer {};
		    class WPBakeryShortCode_col extends WPBakeryShortCodesContainer {};
		    class WPBakeryShortCode_tabgroup extends WPBakeryShortCodesContainer {};
		    class WPBakeryShortCode_tab extends WPBakeryShortCodesContainer {};
		    class WPBakeryShortCode_collapses extends WPBakeryShortCodesContainer {};
		    class WPBakeryShortCode_collapses_item extends WPBakeryShortCodesContainer {};
		    class WPBakeryShortCode_row extends WPBakeryShortCodesContainer {};

		}
		if ( class_exists( 'WPBakeryShortCode' ) ) {
		    class WPBakeryShortCode_Single_Img extends WPBakeryShortCode {};
		    class WPBakeryShortCode_bery_banner extends WPBakeryShortCode {};
		}



		// **********************************************************************// 
	    // ! Row (add fullwidth, parallax option)
	    // **********************************************************************//
		vc_add_param('vc_row', array(
	    	 "type" => 'checkbox',
		      "heading" => __("Fullwidth?", 'ltheme_domain'),
		      "param_name" => "fullwidth",
		      "value" => array(
         				'Yes, please' => true
         			)
		));

		 vc_add_param( 'vc_row', array(
	         "type" => "checkbox",
	         "heading" => __("Parallax",'ltheme_domain'),
	         "param_name" => "parallax",
	         "value" => array(
	         				'Yes, please' => true
	         			)
	    ));

	    // **********************************************************************// 
	    // ! Register New Element: Slider
	    // **********************************************************************//

    	$slider_params = array(
	    	"name" => __("Lee Slider", 'ltheme_domain'),
		    "base" => "bery_slider",
		    "as_parent" => array('except' => 'bery_slider'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    "content_element" => true,
		    'category' => 'Lee Theme',
		    "params" => array(
		    	array(
		            "type" => "textfield",
		            "heading" => __("Title", 'ltheme_domain'),
		            "param_name" => "title"
		        ),
		        array(
					"type" => "dropdown",
				    "heading" => "Title align",
				    "param_name" => "align",
				    "value" => array(
				    	__('Left', 'ltheme_domain') => '',
				    	__('Center', 'ltheme_domain') => 'center',
				    	)
				),
		    	array(
		    		"type" => "dropdown",
	    			"heading" => __('Display Bullets','ltheme_domain'),
	    			"param_name" => "bullets",
	    			"value" => array(
	    					__('Enable', 'ltheme_domain') => 'true',
	    					__('Disable', 'ltheme_domain') => 'false'
    					),
	    			"description" => 'You only use bullets or arrows for navigation. If disable bullets. You can select arrow navigation at bellow.'
		    	),
		    	array(
		    		"type" => "dropdown",
	    			"heading" => __('Bullets type','ltheme_domain'),
	    			"param_name" => "bullets_type",
	    			"value" => array(
	    					__('Center', 'ltheme_domain') => '',
	    					__('Left', 'ltheme_domain') => 'bullets_type_2'
    					),
	    			"description" => 'Select bullets display type.'
		    	),
		    	array(
		    		"type" => "dropdown",
	    			"heading" => __('Display arrows','ltheme_domain'),
	    			"param_name" => "navigation",
	    			"value" => array(
	    					__('Enable', 'ltheme_domain') => 'true',
	    					__('Disable', 'ltheme_domain') => 'false'
    					)
		    	),
		    	array(
		    		"type" => "dropdown",
	    			"heading" => __('Number columns','ltheme_domain'),
	    			"param_name" => "column_number",
	    			"value" => array(
	    					__('1', 'ltheme_domain') => '1',
	    					__('2', 'ltheme_domain') => '2',
	    					__('3', 'ltheme_domain') => '3',
	    					__('4', 'ltheme_domain') => '4',
	    					__('5', 'ltheme_domain') => '5',
	    					__('6', 'ltheme_domain') => '6',
    					)
		    	),
		    	array(
		    		"type" => "dropdown",
	    			"heading" => __('Responsive item numbers for mobile', 'ltheme_domain'),
	    			"param_name" => "column_number_small",
	    			"value" => array(
	    					__('1', 'ltheme_domain') => '1',
	    					__('2', 'ltheme_domain') => '2',
	    					__('3', 'ltheme_domain') => '3',
	    					__('4', 'ltheme_domain') => '4',
	    					__('5', 'ltheme_domain') => '5',
	    					__('6', 'ltheme_domain') => '6',
    					)
		    	),
		    	array(
		    		"type" => "dropdown",
	    			"heading" => __('Responsive item numbers for tablet','ltheme_domain'),
	    			"param_name" => "column_number_tablet",
	    			"value" => array(
	    					__('1', 'ltheme_domain') => '1',
	    					__('2', 'ltheme_domain') => '2',
	    					__('3', 'ltheme_domain') => '3',
	    					__('4', 'ltheme_domain') => '4',
	    					__('5', 'ltheme_domain') => '5',
	    					__('6', 'ltheme_domain') => '6',
    					)
		    	),
		    	array(
		    		"type" => "dropdown",
	    			"heading" => __('Auto Play','ltheme_domain'),
	    			"param_name" => "autoplay",
	    			"value" => array(
	    					__('Enable', 'ltheme_domain') => 'true',
	    					__('Disable', 'ltheme_domain') => 'false'
    					)
		    	),
		    	array(
		    		"type" => "dropdown",
	    			"heading" => __('Slide Speed','ltheme_domain'),
	    			"param_name" => "slideSpeed",
	    			"value" => array(
	    					__('0.3s', 'ltheme_domain') => '300',
	    					__('0.4s', 'ltheme_domain') => '400',
	    					__('0.5s', 'ltheme_domain') => '500',
	    					__('0.6s', 'ltheme_domain') => '600',
	    					__('0.7s', 'ltheme_domain') => '700',
	    					__('0.8s', 'ltheme_domain') => '800',
	    					__('0.9s', 'ltheme_domain') => '900',
	    					__('1s', 'ltheme_domain') => '1000',
    					)
		    	),
		    	array(
		    		"type" => "dropdown",
	    			"heading" => __('Pagination Speed','ltheme_domain'),
	    			"param_name" => "paginationSpeed",
	    			"value" => array(
	    					__('0.4s', 'ltheme_domain') => '400',
	    					__('0.5s', 'ltheme_domain') => '500',
	    					__('0.6s', 'ltheme_domain') => '600',
	    					__('0.7s', 'ltheme_domain') => '700',
	    					__('0.8s', 'ltheme_domain') => '800',
	    					__('0.9s', 'ltheme_domain') => '900',
	    					__('1s', 'ltheme_domain') => '1000',
    					)
		    	),
		    	array(
		    		"type" => "dropdown",
	    			"heading" => __('Border Slider','ltheme_domain'),
	    			"param_name" => "border",
	    			"value" => array(
	    					__('Enable', 'ltheme_domain') => 'true',
	    					__('Disable', 'ltheme_domain') => 'border-none'
    					)
		    	),
		        array(
		            "type" => "textfield",
		            "heading" => __("Extra class name", 'ltheme_domain'),
		            "param_name" => "el_class",
		            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'ltheme_domain')
		        )
		    ),
		    "js_view" => 'VcColumnView'
	    );
    	vc_map($slider_params);


    	// **********************************************************************// 
	    // ! Register New Element: Banner Grid
	    // **********************************************************************//

    	$banner_grid_params = array(
    		"name" => "Banner Grid",
		    "base" => "bery_banner_grid",
		    "icon" => "icon-wpb-leetheme",
		    "category" => "Lee Theme",
		    "content_element" => true,
		    "as_parent" => array('only','col, bery_banner'),
		    "params" => array(
		        array(
		            "type" => "dropdown",
	    			"heading" => __('Padding','ltheme_domain'),
	    			"param_name" => "padding",
	    			"value" => array(
	    				__('10px','ltheme_domain') => '10',
	    				__('15px','ltheme_domain') => '15',
	    				__('30px','ltheme_domain') => '30'
    				)
		        )
		    ),
		    "js_view" => 'VcColumnView'
    	);
	    vc_map($banner_grid_params);


	    // **********************************************************************// 
	    // ! Register New Element: Tab group
	    // **********************************************************************//

    	$tab_group_params = array(
	    	"name" => __("Lee Tab Group", 'ltheme_domain'),
		    "base" => "tabgroup",
		    "as_parent" => array('only' => 'tab'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    "content_element" => true,
		    "category" => 'Lee Theme',
		    "show_settings_on_create" => true,
		    "params" => array(
		    	array(
		            "type" => "textfield",
		            "heading" => __("Title", 'ltheme_domain'),
		            "param_name" => "title",
		            "description" => __("Title for tab group. Alway align left", 'ltheme_domain')
		        ),
		    	array(
					"type" => "dropdown",
				    "heading" => "Title align",
				    "param_name" => "align",
				    "value" => array(
				    	__('Right', 'ltheme_domain') => 'right',
				    	__('Center', 'ltheme_domain') => 'center',
				    	),
				    "description" => __("Align title for title tab inner panel.", 'ltheme_domain')
				),
		        array(
		            "type" => "textfield",
		            "heading" => __("Extra class name", 'ltheme_domain'),
		            "param_name" => "el_class",
		            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'ltheme_domain')
		        )
		        
		    ),
		    "js_view" => 'VcColumnView'
	    );
    	vc_map($tab_group_params);



    	// **********************************************************************// 
	    // ! Register New Element: Tab inner
	    // **********************************************************************//

    	$tab_params = array(
	    	"name" => __("Lee Tab Inner", 'ltheme_domain'),
		    "base" => "tab",
		    "content_element" => true,
		    //"as_child" => array('only','tab_group'),
		    "as_parent" => array('except' => 'tabgroup'),
		    "category" => 'Lee Theme',
		    "params" => array(
		    	array(
		            "type" => "textfield",
		            "heading" => __("Tab Title", 'ltheme_domain'),
		            "param_name" => "title",
		            "description" => __("Enter tab title.", 'ltheme_domain')
		        ),
		        array(
		            "type" => "textfield",
		            "heading" => __("Extra class name", 'ltheme_domain'),
		            "param_name" => "el_class",
		            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'ltheme_domain')
		        )
		    ),
		    "js_view" => 'VcColumnView'
	    );
    	vc_map($tab_params);


    	// **********************************************************************// 
	    // ! Register New Element: Accordion Group
	    // **********************************************************************//

    	$accordion_group_params = array(
	    	"name" => __("Accordion Group", 'ltheme_domain'),
		    "base" => "collapses",
		    "as_parent" => array('only' => 'collapses_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    "content_element" => true,
		    "category" => 'Lee Theme',
		    "params" => array(
		        array(
		            "type" => "textfield",
		            "heading" => __("Accordion Group Title", 'ltheme_domain'),
		            "param_name" => "title",
		            "description" => __("Enter Accordion Group title.", 'ltheme_domain')
		        ),
		    ),
		    "js_view" => 'VcColumnView'
	    );
    	vc_map($accordion_group_params);


    	// **********************************************************************// 
	    // ! Register New Element: Accordion item
	    // **********************************************************************//

    	$accordion_item_params = array(
	    	"name" => __("Lee Accordion Item", 'ltheme_domain'),
		    "base" => "collapses_item",
		    "content_element" => true,
		    "as_parent" => array('except' => 'collapses'),
		    "category" => 'Lee Theme',
		    "params" => array(
		    	array(
		            "type" => "textfield",
		            "heading" => __("Tab Title", 'ltheme_domain'),
		            "param_name" => "title",
		            "description" => __("Enter Accordion Item title.", 'ltheme_domain')
		        )
		    ),
		    "js_view" => 'VcColumnView'
	    );
    	vc_map($accordion_item_params);


    	// **********************************************************************// 
	    // ! Register New Element: Lee Row
	    // **********************************************************************//
    	$lee_row_params = array(
    		"name" => "Lee Row",
		    "base" => "row",
		    "icon" => "icon-wpb-leetheme",
		    "category" => "Lee Theme",
		    "content_element" => true,
		    "show_settings_on_create" => false,
		    "as_parent" => array('only' => 'col'),
		    "params" => array(
		        array(
		            "type" => "textfield",
		            "heading" => __('Row padding', 'ltheme_domain'),
		            "param_name" => "padding",
		            "description" => __("Insert a style row padding.", 'ltheme_domain')
		        )
		    ),
		    "js_view" => 'VcColumnView'
    	);
	    vc_map($lee_row_params);



	    // **********************************************************************// 
	    // ! Register New Element: Lee Columns
	    // **********************************************************************//

    	$lee_columns_params = array(
    		"name" => "Lee Columns",
		    "base" => "col",
		    "icon" => "icon-wpb-leetheme",
		    "category" => "Lee Theme",
		    "content_element" => true,
		    "as_parent" => array('only','bery_banner'),
		    "params" => array(
		        array(
		            "type" => "dropdown",
		            "heading" => __('Column', 'ltheme_domain'),
		            "param_name" => "span",
		            "value" => array(
		            	__('1 Column', 'ltheme_domain') => '1/12',
		            	__('2 Columns', 'ltheme_domain') => '1/6',
		            	__('3 Columns', 'ltheme_domain') => '1/4',
		            	__('4 Columns', 'ltheme_domain') => '1/3',
		            	__('5 Columns', 'ltheme_domain') => '5/12',
		            	__('6 Columns', 'ltheme_domain') => '1/2',
		            	__('7 Columns', 'ltheme_domain') => '7/12',
		            	__('8 Columns', 'ltheme_domain') => '2/3',
		            	__('9 Columns', 'ltheme_domain') => '3/4',
		            	__('10 Columns', 'ltheme_domain') => '5/6',
		            	__('11 Columns', 'ltheme_domain') => '11/12',
		            	__('12 Columns', 'ltheme_domain') => '1/1'
		            )
		        )
		    ),
		    "js_view" => 'VcColumnView'
    	);
	    vc_map($lee_columns_params);



		// **********************************************************************// 
	    // ! Register New Element: Banner 
	    // **********************************************************************//
	
	    $banner_params = array(
	      'name' => 'Bery Banner',
	      'base' => 'berybanner',
	      'icon' => 'icon-wpb-leetheme',
	      'category' => 'Lee Theme',
	      'as_parent' => array('except' => 'berybanner'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
	      'params' => array(
	      	array(
	    			"type" => "textfield",
	    			"heading" => __('Banner Height','ltheme_domain'),
	    			"param_name" => "height",
	    			"value" => ""
    		),
	        array(
	    			"type" => "textfield",
	    			"heading" => __('Banner Background','ltheme_domain'),
	    			"param_name" => "img_src",
	    			"value" => ""
    		),
	        array(
	          "type" => "textfield",
	          "heading" => __("Link", "js_composer"),
	          "param_name" => "link"
	        ),
	        array(
	    			"type" => "dropdown",
	    			"heading" => __('Background Parallax', 'ltheme_domain'),
	    			"param_name" => "parallax",
	    			"value" => array(
    					__('None', 'ltheme_domain') => '',
    					__('Level 1', 'ltheme_domain') => '0.9',
    					__('Level 2', 'ltheme_domain') => '0.6',
    					__('Level 3', 'ltheme_domain') => '0.3',
    					__('Level 4', 'ltheme_domain') => '0.1',
	    				)
    		),
	        array(
	          "type" => "textarea_html",
	          "holder" => "div",
	          //"admin_label" => true,
	          "heading" => "Banner Text",
	          "param_name" => "content",
	          "value" => "Some promo text",
	          
	        ),
	        array(
	    			"type" => "dropdown",
			        "heading" => "Text Color",
			        "param_name" => "text_color",
			        "value" => array(
			        	__('Black', 'ltheme_domain') => 'light',
			        	__('White', 'ltheme_domain') => 'dark',
			        	)
    		),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Horizontal align", 'ltheme_domain'),
	          "param_name" => "align",
	          "value" => array( "", __("Left", 'ltheme_domain') => "left", __("Center", 'ltheme_domain') => "center", __("Right", 'ltheme_domain') => "right")
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Vertical align", 'ltheme_domain'),
	          "param_name" => "valign",
	          "value" => array( __("Top", 'ltheme_domain') => "top", __("Middle", 'ltheme_domain') => "middle", __("Bottom", 'ltheme_domain') => "bottom")
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Content padding", "js_composer"),
	          "param_name" => "padding_text"
	        ),
         	array(
	          "type" => "dropdown",
	          "heading" => __("Display text effect", 'ltheme_domain'),
	          "param_name" => "effect_text",
	          "value" => array(
    					__('None', 'ltheme_domain') => '',
    					__('bounce', 'ltheme_domain') => 'bounce',
    					__('flash', 'ltheme_domain') => 'flash',
    					__('pulse', 'ltheme_domain') => 'pulse',
    					__('rubberBand', 'ltheme_domain') => 'rubberBand',
    					__('shake', 'ltheme_domain') => 'shake',
    					__('swing', 'ltheme_domain') => 'swing',
    					__('tada', 'ltheme_domain') => 'tada',
    					__('wobble', 'ltheme_domain') => 'wobble',
    					__('bounceIn', 'ltheme_domain') => 'bounceIn',
    					__('bounceOut', 'ltheme_domain') => 'bounceOut',
    					__('fadeIn', 'ltheme_domain') => 'fadeIn',
    					__('fadeInDown', 'ltheme_domain') => 'fadeInDown',
    					__('fadeInLeft', 'ltheme_domain') => 'fadeInLeft',
    					__('fadeInRight', 'ltheme_domain') => 'fadeInRight',
    					__('fadeInUp', 'ltheme_domain') => 'fadeInUp',
    					__('fadeOut', 'ltheme_domain') => 'fadeOut',
    					__('fadeOutDown', 'ltheme_domain') => 'fadeOutDown',
    					__('fadeOutLeft', 'ltheme_domain') => 'fadeOutLeft',
    					__('fadeOutRight', 'ltheme_domain') => 'fadeOutRight',
    					__('slideInUp', 'ltheme_domain') => 'slideInUp',
    					__('slideInDown', 'ltheme_domain') => 'slideInDown',
    					__('slideInLeft', 'ltheme_domain') => 'slideInLeft',
    					__('slideInRight', 'ltheme_domain') => 'slideInRight',
    					__('zoomIn', 'ltheme_domain') => 'zoomIn',
    					__('zoomInDown', 'ltheme_domain') => 'zoomInDown',
    					__('zoomInLeft', 'ltheme_domain') => 'zoomInLeft',
    					__('zoomInRight', 'ltheme_domain') => 'zoomInRight',
    					__('zoomInUp', 'ltheme_domain') => 'zoomInUp',
    					)
	        ),
	        array(
    			"type" => "dropdown",
		        "heading" => __("Hover effect", 'ltheme_domain'),
		        "param_name" => "hover",
		        "value" => array(
		        	__('None', 'ltheme_domain') => '',
		        	__('Zoom', 'ltheme_domain') => 'zoom',
	        	)
    		),
    		array(
	    			"type" => "dropdown",
	    			"heading" => __('Delay time animation for display', 'ltheme_domain'),
	    			"param_name" => "data_delay",
	    			"value" => array(
    					__('None', 'ltheme_domain') => '',
    					__('100ms', 'ltheme_domain') => '100ms',
    					__('200ms', 'ltheme_domain') => '200ms',
    					__('300ms', 'ltheme_domain') => '300ms',
    					__('400ms', 'ltheme_domain') => '400ms',
    					__('500ms', 'ltheme_domain') => '500ms',
    					__('600ms', 'ltheme_domain') => '600ms',
    					__('700ms', 'ltheme_domain') => '700ms',
    					__('800ms', 'ltheme_domain') => '800ms',
	    				)
    		),
	        array(
	          "type" => "textfield",
	          "heading" => __("Extra Class", 'ltheme_domain'),
	          "param_name" => "class",
	          "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'ltheme_domain')
	        ),
	        )
	    );  
	
	    vc_map($banner_params);

		// **********************************************************************// 
	    // ! Register New Element: Background
	    // **********************************************************************//

    	$background_params = array(
    		"name" => "Lee Background",
		    "base" => "background",
		    "icon" => "icon-wpb-leetheme",
		    "category" => "Lee Theme",
		    "as_parent" => array('except',''),
		    "params" => array(
		    	array(
	    			"type" => "textfield",
	    			"heading" => __('Background image / Background color ','ltheme_domain'),
	    			"param_name" => "bg",
	    			"value" => ""
	    		),
	    		array(
	    			"type" => "textfield",
	    			"heading" => __('Background video mp4 link','ltheme_domain'),
	    			"param_name" => "video_mp4",
	    			"value" => ""
	    		),
	    		array(
	    			"type" => "textfield",
	    			"heading" => __('Background video webm link','ltheme_domain'),
	    			"param_name" => "video_webm",
	    			"value" => ""
	    		),
	    		array(
	    			"type" => "dropdown",
	    			"heading" => __('Background Parallax', 'ltheme_domain'),
	    			"param_name" => "parallax",
	    			"value" => array(
    					__('None', 'ltheme_domain') => '',
    					__('Level 1', 'ltheme_domain') => '1',
    					__('Level 2', 'ltheme_domain') => '3',
    					__('Level 3', 'ltheme_domain') => '6',
    					__('Level 4', 'ltheme_domain') => '9',
	    				)
	    		),
	    		array(
	    			"type" => "textfield",
	    			"heading" => __('Margin','ltheme_domain'),
	    			"param_name" => "margin",
	    			"value" => ""
	    		),
	    		array(
	    			"type" => "textfield",
	    			"heading" => __('Padding','ltheme_domain'),
	    			"param_name" => "padding",
	    			"value" => ""
	    		),
		        
		    ),
		    "js_view" => 'VcColumnView'
    	);
	    vc_map($background_params);
		

		// **********************************************************************// 
	    // ! Register New Element: Best Sellers Products
	    // **********************************************************************//

	    $bestseller_params = array(
		    "name" => "Best Sellers Products",
		    "base" => "bery_bestseller_products",
		    "icon" => "icon-wpb-leetheme",
		    "category" => "Lee Theme",
		    "params" => array(
		        array(
		            "type" => "textfield",
		            "heading" => __('Title', 'ltheme_domain'),
		            "param_name" => "title"
		        ),
		        array(
		            "type" => "dropdown",
		            "heading" => __('Products Columns', 'ltheme_domain'),
		            "param_name" => 'columns',
		            "value" => array(
	          			"4" => '4',
	          			"5" => '5'
	          		)
		        ),
		        array(
		            "type" => "dropdown",
		            "heading" => __('Products number for display', 'ltheme_domain'),
		            "param_name" => 'products',
		            "value" => array(
	          			"6" => '6',
	          			"7" => '7',
	          			"8" => '8',
	          			"9" => '9',
	          			"10" => '10'
	          		)
		        )
	        )
		);

	    vc_map($bestseller_params);



	    // **********************************************************************// 
	    // ! Register New Element: Featured Products
	    // **********************************************************************//

	    $featured_products_params = array(
		    "name" => "Featured Products",
		    "base" => "bery_featured_products",
		    "icon" => "icon-wpb-leetheme",
		    "category" => "Lee Theme",
		    "params" => array(
		        array(
		            "type" => "textfield",
		            "heading" => __('Title', 'ltheme_domain'),
		            "param_name" => "title"
		        ),
		        array(
		            "type" => "dropdown",
		            "heading" => __('Products Columns', 'ltheme_domain'),
		            "param_name" => 'columns',
		            "value" => array(
	          			"4" => '4',
	          			"5" => '5'
	          		)
		        ),
		        array(
		            "type" => "dropdown",
		            "heading" => __('Products number for display', 'ltheme_domain'),
		            "param_name" => 'products',
		            "value" => array(
	          			"6" => '6',
	          			"7" => '7',
	          			"8" => '8',
	          			"9" => '9',
	          			"10" => '10'
	          		)
		        )
	        )
		);

	    vc_map($featured_products_params);



	    // **********************************************************************// 
	    // ! Register New Element: Sale Products
	    // **********************************************************************//

	    $sale_products_params = array(
		    "name" => "Sale Products",
		    "base" => "bery_sale_products",
		    "icon" => "icon-wpb-leetheme",
		    "category" => "Lee Theme",
		    "params" => array(
		        array(
		            "type" => "textfield",
		            "heading" => __('Title', 'ltheme_domain'),
		            "param_name" => "title"
		        ),
		        array(
		            "type" => "dropdown",
		            "heading" => __('Products Columns', 'ltheme_domain'),
		            "param_name" => 'columns',
		            "value" => array(
	          			"4" => '4',
	          			"5" => '5'
	          		)
		        ),
		        array(
		            "type" => "dropdown",
		            "heading" => __('Products number for display', 'ltheme_domain'),
		            "param_name" => 'products',
		            "value" => array(
	          			"6" => '6',
	          			"7" => '7',
	          			"8" => '8',
	          			"9" => '9',
	          			"10" => '10'
	          		)
		        )
	        )
		);

	    vc_map($sale_products_params);


	    // **********************************************************************// 
	    // ! Register New Element: Latest Products
	    // **********************************************************************//

	    $lastest_products_params = array(
		    "name" => "Latest Products",
		    "base" => "bery_latest_products",
		    "icon" => "icon-wpb-leetheme",
		    "category" => "Lee Theme",
		    "params" => array(
		        array(
		            "type" => "textfield",
		            "heading" => __('Title', 'ltheme_domain'),
		            "param_name" => "title"
		        ),
		        array(
		            "type" => "dropdown",
		            "heading" => __('Products Columns', 'ltheme_domain'),
		            "param_name" => 'columns',
		            "value" => array(
	          			"4" => '4',
	          			"5" => '5'
	          		)
		        ),
		        array(
		            "type" => "dropdown",
		            "heading" => __('Products number for display', 'ltheme_domain'),
		            "param_name" => 'products',
		            "value" => array(
	          			"6" => '6',
	          			"7" => '7',
	          			"8" => '8',
	          			"9" => '9',
	          			"10" => '10'
	          		)
		        )
	        )
		);

	    vc_map($lastest_products_params);



	    // **********************************************************************// 
	    // ! Register New Element: Categories name list
	    // **********************************************************************//

	    $products_categories_list_params = array(
		    "name" => "Categories name list",
		    "base" => "bery_product_categories",
		    "icon" => "icon-wpb-leetheme",
		    "category" => "Lee Theme",
		    "params" => array(
		        array(
		            "type" => "textfield",
		            "heading" => __('Title', 'ltheme_domain'),
		            "param_name" => 'title'
		        ),
		        array(
		            "type" => "textfield",
		            "heading" => __('Categories number for display', 'ltheme_domain'),
		            "param_name" => 'number'
		        ),
		        array(
		            "type" => "dropdown",
		            "heading" => __('Parent level', 'ltheme_domain'),
		            "param_name" => 'parent',
		            "value" => array(
	          			"0" => '0',
	          			"1" => '1',
	          			"2" => '2'
	          		)
		        ),
		        array(
		            "type" => "dropdown",
		            "heading" => __('Products Columns', 'ltheme_domain'),
		            "param_name" => 'columns',
		            "value" => array(
	          			"4" => '4',
	          			"5" => '5'
	          		)
		        )
	        )
		);

	    vc_map($products_categories_list_params);


	    // **********************************************************************// 
	    // ! Register New Element: Custom Products
	    // **********************************************************************//

	    $custom_products_params = array(
		    "name" => "Custom Products",
		    "base" => "bery_custom_products",
		    "icon" => "icon-wpb-leetheme",
		    "category" => "Lee Theme",
		    "params" => array(
		        array(
		            "type" => "textfield",
		            "heading" => __('Title', 'ltheme_domain'),
		            "param_name" => 'title'
		        ),
		        array(
		            "type" => "textfield",
		            "heading" => __('Categories name', 'ltheme_domain'),
		            "param_name" => 'category',
		            "description" => __("Enter categories name for display list products by categories name.", 'ltheme_domain'),
		        ),
		        array(
		            "type" => "dropdown",
		            "heading" => __('Products Columns', 'ltheme_domain'),
		            "param_name" => 'columns',
		            "value" => array(
	          			"4" => '4',
	          			"5" => '5'
	          		)
		        ),
		        array(
		            "type" => "dropdown",
		            "heading" => __('Products number for display', 'ltheme_domain'),
		            "param_name" => 'products',
		            "value" => array(
	          			"6" => '6',
	          			"7" => '7',
	          			"8" => '8',
	          			"9" => '9',
	          			"10" => '10'
	          		)
		        )
	        )
		);

	    vc_map($custom_products_params);


	    // **********************************************************************// 
	    // ! Register New Element: Client
	    // **********************************************************************//

    	$client_params = array(
	    	"name" => __("Client", 'ltheme_domain'),
		    "base" => "client",
		    "content_element" => true,
		    "category" => 'Lee Theme',
		    "params" => array(
		    	array(
		            "type" => "textfield",
		            "heading" => __("Client avatar image", 'ltheme_domain'),
		            "param_name" => "image",
		            "description" => __("Enter Avatar image.", 'ltheme_domain')
		        ),
		        array(
		            "type" => "textfield",
		            "heading" => __("Client name", 'ltheme_domain'),
		            "param_name" => "name",
		            "description" => __("Enter name.", 'ltheme_domain')
		        ),
		        array(
		            "type" => "textfield",
		            "heading" => __("Client job", 'ltheme_domain'),
		            "param_name" => "company",
		            "description" => __("Enter job.", 'ltheme_domain')
		        ),
		        array(
					"type" => "dropdown",
				    "heading" => "Stars number",
				    "param_name" => "stars",
				    "value" => array(
				    	__('1', 'ltheme_domain') => '1',
				    	__('2', 'ltheme_domain') => '2',
				    	__('3', 'ltheme_domain') => '3',
				    	__('4', 'ltheme_domain') => '4',
				    	__('5', 'ltheme_domain') => '5',
				    	)
				),
		        array(
	    			"type" => "textarea_html",
			        "holder" => "div",
			        "heading" => "Client content say",
			        "param_name" => "content_say",
			        "value" => "Some promo text",
			        "description" => __("Enter client content say.", 'ltheme_domain')
	    		),
		    )
	    );
    	vc_map($client_params);


	    // **********************************************************************// 
	    // ! Register New Element: Title
	    // **********************************************************************//

    	$title_params = array(
	    	"name" => __("Title", 'ltheme_domain'),
		    "base" => "title",
		    "content_element" => true,
		    "category" => 'Lee Theme',
		    "params" => array(
		    	array(
		            "type" => "textfield",
		            "heading" => __("Title", 'ltheme_domain'),
		            "param_name" => "text"
		        ),
		        array(
					"type" => "dropdown",
				    "heading" => "Title align",
				    "param_name" => "align",
				    "value" => array(
				    	__('Left', 'ltheme_domain') => '',
				    	__('Center', 'ltheme_domain') => 'center',
				    	)
				)
		    )
	    );
    	vc_map($title_params);


    	// **********************************************************************// 
	    // ! Register New Element: Share
	    // **********************************************************************//

    	$share_params = array(
	    	"name" => __("Share", 'ltheme_domain'),
		    "base" => "share",
		    "content_element" => true,
		    "category" => 'Lee Theme',
		    "params" => array(
			    array(
		            "type" => "dropdown",
		            "heading" => __('Size', 'ltheme_domain'),
		            "param_name" => 'size',
		            "value" => array(
	          			__('Normal', 'ltheme_domain') => '',
	          			__('Large', 'ltheme_domain') => 'large'
	          		)
		        ),
		        array(
		            "type" => "dropdown",
		            "heading" => __('Style', 'ltheme_domain'),
		            "param_name" => 'style',
		            "value" => array(
	          			__('Normal', 'ltheme_domain') => '',
	          			__('Light', 'ltheme_domain') => 'light'
	          		)
		        )
		    )
	    );
    	vc_map($share_params);


    	// **********************************************************************// 
	    // ! Register New Element: Brand
	    // **********************************************************************//

    	$share_params = array(
	    	"name" => __("Brand", 'ltheme_domain'),
		    "base" => "brand",
		    "content_element" => true,
		    "category" => 'Lee Theme',
		    "params" => array(
		    	array(
		            "type" => "textfield",
		            "heading" => __("Title", 'ltheme_domain'),
		            "param_name" => "text"
		        ),
		        array(
					"type" => "textfield",
					"heading" => __('Brand logo image','ltheme_domain'),
					"param_name" => "img" 
				),
		        array(
		            "type" => "textfield",
		            "heading" => __("Padding", 'ltheme_domain'),
		            "param_name" => "padding",
		            "value" => '15px'
		        ),
		        array(
		            "type" => "textfield",
		            "heading" => __("Link", 'ltheme_domain'),
		            "param_name" => "link",
		        ),
		        array(
		            "type" => "textfield",
		            "heading" => __("Height", 'ltheme_domain'),
		            "param_name" => "height"
		        )
		    )
	    );
    	vc_map($share_params);


    	// **********************************************************************// 
	    // ! Register New Element: Google Map
	    // **********************************************************************//

    	$map_params = array(
	    	"name" => __("Google Map", 'ltheme_domain'),
		    "base" => "map",
		    "content_element" => true,
		    "category" => 'Lee Theme',
		    "params" => array(
		    	array(
		            "type" => "textfield",
		            "heading" => __("Lat", 'ltheme_domain'),
		            "param_name" => "lat"
		        ),
		        array(
		            "type" => "textfield",
		            "heading" => __("Long", 'ltheme_domain'),
		            "param_name" => "long"
		        ),
		        array(
		            "type" => "textfield",
		            "heading" => __("Height", 'ltheme_domain'),
		            "param_name" => "height",
		            "value" => '400px'
		        ),
		        array(
		            "type" => "colorpicker",
		            "heading" => __("Color", 'ltheme_domain'),
		            "param_name" => "color"
		        ),
		        array(
					"type" => "dropdown",
				    "heading" => "Map type",
				    "param_name" => "type",
				    "value" => array(
				    	__('ROADMAP', 'ltheme_domain') => 'ROADMAP',
				    	__('SATELLITE', 'ltheme_domain') => 'SATELLITE',
				    	__('TERRAIN', 'ltheme_domain') => 'TERRAIN'
				    	)
				)
		    )
	    );
    	vc_map($map_params);


    	// **********************************************************************// 
	    // ! Register New Element: Recent Posts
	    // **********************************************************************//

    	$lastest_params = array(
	    	"name" => __("Latest posts", 'ltheme_domain'),
		    "base" => "recent_post",
		    "content_element" => true,
		    "category" => 'Lee Theme',
		    "params" => array(
		    	array(
		            "type" => "textfield",
		            "heading" => __("Title", 'ltheme_domain'),
		            "param_name" => "title"
		        ),
		        array(
					"type" => "dropdown",
				    "heading" => "Title align",
				    "param_name" => "align",
				    "value" => array(
				    	__('Left', 'ltheme_domain') => '',
				    	__('Center', 'ltheme_domain') => 'center',
				    	)
				),
		        array(
		            "type" => "textfield",
		            "heading" => __("Post number", 'ltheme_domain'),
		            "param_name" => "posts",
		            "value" => "8"
		        ),
		        array(
		            "type" => "textfield",
		            "heading" => __("Category", 'ltheme_domain'),
		            "param_name" => "category",
		            "value" => ''
		        )
		    )
	    );
    	vc_map($lastest_params);


		// **********************************************************************// 
	    // ! Register New Element: Lastest Tweets
	    // **********************************************************************//
    	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    	
	    	$recent_tweets_params = array(
		    	"name" => __("Recent Tweets", 'ltheme_domain'),
			    "base" => "recent_tweets_widget",
			    "content_element" => true,
			    "category" => 'Lee Theme',
			    "params" => array(
			    	array(
			            "type" => "textfield",
			            "heading" => __("Title", 'ltheme_domain'),
			            "param_name" => "title",
			            "value" => "Recent Tweets"
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Consumer Key", 'ltheme_domain'),
			            "param_name" => "consumerkey",
			            "value" => ""
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Consumer Secret", 'ltheme_domain'),
			            "param_name" => "consumersecret",
			            "value" => ""
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Access Token", 'ltheme_domain'),
			            "param_name" => "accesstoken",
			            "value" => ""
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Access Token Secret", 'ltheme_domain'),
			            "param_name" => "accesstokensecret",
			            "value" => ""
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Cache Tweets in every (hours)", 'ltheme_domain'),
			            "param_name" => "cachetime",
			            "value" => "1"
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Twitter Username", 'ltheme_domain'),
			            "param_name" => "username",
			            "value" => ""
			        ),
			        array(
						"type" => "dropdown",
					    "heading" => "Tweets to display",
					    "param_name" => "tweetstoshow",
					    "value" => array(
					    	__('1', 'ltheme_domain') => '1',
					    	__('2', 'ltheme_domain') => '2',
					    	__('3', 'ltheme_domain') => '3',
					    	__('4', 'ltheme_domain') => '4',
					    	__('5', 'ltheme_domain') => '5',
					    	__('6', 'ltheme_domain') => '6',
					    	__('7', 'ltheme_domain') => '7',
					    	__('8', 'ltheme_domain') => '8',
					    	__('9', 'ltheme_domain') => '9',
					    	__('10', 'ltheme_domain') => '10'
				    	)
					),
					array(
				      "type" => 'checkbox',
				      "heading" => __("Exclude replies?", 'ltheme_domain'),
				      "param_name" => "excludereplies",
				      "value" => Array(__("Yes, please", 'ltheme_domain') => 'true')
				    )
			    )
		    );
			if (is_plugin_active('recent-tweets-widget/recent-tweets.php')){
	    		vc_map($recent_tweets_params);
	    	}
	    // **********************************************************************// 
	    // ! Register New Element: Contact Us
	    // **********************************************************************//
    	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    	
	    	$contact_us_params = array(
		    	"name" => __("Contact Us", 'ltheme_domain'),
			    "base" => "contact_us",
			    "content_element" => true,
			    "category" => 'Lee Theme',
			    "params" => array(
			    	array(
			            "type" => "textfield",
			            "heading" => __("Title", 'ltheme_domain'),
			            "param_name" => "title",
			            "value" => "Contact Us"
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Conctact Address", 'ltheme_domain'),
			            "param_name" => "contact_address",
			            "value" => ""
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Conctact Email", 'ltheme_domain'),
			            "param_name" => "contact_email",
			            "value" => ""
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Contact Phone", 'ltheme_domain'),
			            "param_name" => "contact_phone",
			            "value" => ""
			        )
			    )
		    );
    		vc_map($contact_us_params);
	}
}


