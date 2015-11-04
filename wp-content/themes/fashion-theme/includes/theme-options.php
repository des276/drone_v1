<?php

// **********************************************************************// 
// ! Header Type
// **********************************************************************// 
function get_header_type() {
    global $ros_opt;
    if (isset($ros_opt['header-type'])) {return $ros_opt['header-type'];}
}

add_filter('custom_header_filter', 'get_header_type',10);

function bery_get_header_structure($ht) {

    switch ($ht) {
        case 1:
            return 1;
            break;
        case 2:
            return 2;
            break;
        case 3:
            return 3;
            break;
        case 4:
            return 4;
            break;
        default:
            return 1;
            break;
    }
}

// **********************************************************************// 
// ! Mini cart
// **********************************************************************// 

if(!function_exists('leetheme_mini_cart')) {
    function leetheme_mini_cart() {
        global $woocommerce;
        global $ros_opt;
        //ob_start(); 
        ?>
        <div class="cart-inner">
            <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="cart-link">
                <ul>
                    <li class="cart-icon">
                        <div class="fa fa-shopping-cart">
                            
                        </div>
                    </li>
                    <li>
                        <div class="cart-count">
                            <span><strong><?php _e('My ','ltheme_domain'); ?></strong><?php _e('Cart','ltheme_domain'); ?> (<?php echo $woocommerce->cart->cart_contents_count;?>)</span><br>
                            <?php echo $woocommerce->cart->get_cart_total(); ?>
                        </div>
                     </li>
                        <!--  <span class="cart-icon-handle"></span> -->
                </ul>   

            </a>
            <div class="nav-dropdown">
                <div class="nav-dropdown-inner">
                <!-- Add a spinner before cart ajax content is loaded -->
                    <?php if ($woocommerce->cart->cart_contents_count == 0) {
                        echo '<p class="empty">'.__('No products in the cart.','woocommerce').'</p>';
                        ?> 
                    <?php } else { //add a spinner ?> 
                        <div class="loading"><i></i><i></i><i></i><i></i></div>
                    <?php } ?>
                    </div><!-- nav-dropdown-innner -->
            </div><!-- .nav-dropdown -->
        </div><!-- .cart-inner -->
        <?php
    }
}

// **********************************************************************// 
// ! Get logo
// **********************************************************************// 

if (!function_exists('leetheme_logo')){
    function leetheme_logo(){
        global $ros_opt;
        ?>
        <div class="logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
                <?php if($ros_opt['site_logo']){
                    $site_title = esc_attr( get_bloginfo( 'name', 'display' ) );
                    echo '<img src="'.$ros_opt['site_logo'].'" class="header_logo" alt="'.$site_title.'"/>';
                } else {bloginfo( 'name' );}?>
            </a>
        </div>
    <?php
    }
}


// **********************************************************************// 
// ! Get main menu
// **********************************************************************// 
if (!function_exists('leetheme_get_main_menu')){
    function leetheme_get_main_menu(){
        ?>
        <div class="nav-wrapper">
            <ul id="site-navigation" class="header-nav">
                <?php if ( has_nav_menu( 'primary' ) ) : ?>
                    <?php  
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container'       => false,
                        'items_wrap'      => '%3$s',
                        'depth'           => 3,
                        'walker'          => new LeethemeNavDropdown
                    ));
                ?>
              <?php else: ?>
                  <li><?php _e('Please Define main navigation in <b>Apperance > Menus</b>','ltheme_domain'); ?></li>
              <?php endif; ?>                               
            </ul>
        </div><!-- nav-wrapper -->
    <?php
    }
}

// **********************************************************************// 
// ! Get main menu
// **********************************************************************// 
if (!function_exists('leetheme_get_shop_by_category_menu')){
    function leetheme_get_shop_by_category_menu(){
        ?>
        <div class="nav-wrapper">
            <ul id="" class="shop-by-category">
                <?php if ( has_nav_menu( 'shop_by_category' ) ) : ?>
                    <?php  
                    wp_nav_menu(array(
                        'theme_location' => 'shop_by_category',
                        'container'       => false,
                        'items_wrap'      => '%3$s',
                        'depth'           => 3,
                        'walker'          => new LeethemeNavDropdown
                    ));
                ?>
              <?php else: ?>
                  <li><?php _e('Please Define Shop by Category menu in <b>Apperance > Menus</b>','ltheme_domain') ?></li>
              <?php endif; ?>                               
            </ul>
        </div><!-- nav-wrapper -->
    <?php
    }
}


/**
 * Initialize the meta boxes for pages. 
 */
add_action( 'admin_init', 'page_meta_boxes' );


function page_meta_boxes() {
    global $wpdb;
    $page_options = array(
        array(
            'id'          => 'custom_header',
            'label'       => 'Use custom header for this page<br>',
            'type'        => 'select',
            'choices'     => array(
                array( 
                    'value' => '',
                    'label' => 'Default' 
                ),
                array( 
                    'value' => '1',
                    'label' => 'Header type 1' 
                ),
                array( 
                    'value' => '2',
                    'label' => 'Header type 2' 
                ),
                array( 
                    'value' => '3',
                    'label' => 'Header type 3' 
                )                
            )
        )
    );

  $my_meta_box = array(
    'id'        => 'page_layout',
    'title'     => 'Page Layout',
    'desc'      => '',
    'pages'     => array( 'page', 'post' ),
    'context'   => 'side',//side normal
    'priority'  => 'low',
    'fields'    => $page_options
  );
  
  ot_register_meta_box( $my_meta_box ); 

}


// **********************************************************************// 
// ! Get breadcrumb
// **********************************************************************// 
if (!function_exists('leetheme_get_breadcrumb')){
    function leetheme_get_breadcrumb(){
         if (is_plugin_active( 'woocommerce/woocommerce.php' )){
        ?>
            <div class="bread">
                <div class="row">
                    <div class="large-12 columns">
                        <div class="breadcrumb-row">
                            <?php 
                                $defaults = array(
                                    'delimiter'  => '<span>/</span>',
                                    'wrap_before'  => '<h3 class="breadcrumb">',
                                    'wrap_after' => '</h3>',
                                    'before'   => '',
                                    'after'   => '',
                                    'home'    => 'Home'
                                );
                                $args = wp_parse_args(  $defaults  );
                                woocommerce_get_template( 'global/breadcrumb.php', $args );
                                
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }
}

function leetheme_body_classes( $classes ) {
    global $ros_opt;

    $classes[] = 'antialiased';
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    if ($ros_opt['site_layout'] == 'boxed'){
        $classes[] = 'boxed';
    }

    if($ros_opt['promo_popup'] == 1){
        $classes[] = 'open-popup';
    }

    return $classes;
}
add_filter( 'body_class', 'leetheme_body_classes' );


function leetheme_enhanced_image_navigation( $url, $id ) {
    if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
        return $url;

    $image = get_post( $id );
    if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
        $url .= '#main';

    return $url;
}
add_filter( 'attachment_link', 'leetheme_enhanced_image_navigation', 10, 2 );


if(function_exists('get_term_meta')){
function pippin_taxonomy_edit_meta_field($term) {
    $t_id = $term->term_id;
    $term_meta = get_term_meta($t_id,'cat_meta');
    if(!$term_meta){$term_meta = add_term_meta($t_id, 'cat_meta', '');}
     ?>
    <tr class="form-field">
    <th scope="row" valign="top"><label for="term_meta[cat_header]"><?php _e( 'Top Content', 'pippin' ); ?></label></th>
        <td>                
                <?php 

                $content = esc_attr( $term_meta[0]['cat_header'] ) ? esc_attr( $term_meta[0]['cat_header'] ) : ''; 
                echo '<textarea id="term_meta[cat_header]" name="term_meta[cat_header]">'.$content.'</textarea>'; ?>
            <p class="description"><?php _e( 'Enter a value for this field. Shortcodes are allowed. This will be displayed at top of the category.','pippin' ); ?></p>
        </td>
    </tr>
<?php
}
add_action( 'product_cat_edit_form_fields', 'pippin_taxonomy_edit_meta_field', 10, 2 );

function save_taxonomy_custom_meta( $term_id ) {
    if ( isset( $_POST['term_meta'] ) ) {
        $t_id = $term_id;
        $term_meta = get_term_meta($t_id,'cat_meta');
        $cat_keys = array_keys( $_POST['term_meta'] );
        foreach ( $cat_keys as $key ) {
            if ( isset ( $_POST['term_meta'][$key] ) ) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        update_term_meta($term_id, 'cat_meta', $term_meta);

    }
}  
add_action( 'edited_product_cat', 'save_taxonomy_custom_meta', 10, 2 );  
}

function fixShortcode($content){
      $fix = array (
                                '_____' => '<div class="bery-hr large"></div>',
                            '____' => '<div class="bery-hr medium"></div>',
                            '___' => '<div class="bery-hr small"></div>',
                        '<br>' => '', 
                        '<br/>' => '', 
                        '&nbsp;' => '', 
                        '<p>' => '', 
                        '</p>' => '', 
                        '<p></p>' => '', 
                        '<p>[' => '[', 
                        ']</p>' => ']', 
                        ']<br />' => ']',
                        '////' => '<div class="clearfix"></div>',
                        '///' => '<div class="clearfix"></div>',
       );
    $content = strtr($content, $fix);
    echo do_shortcode( $content );
}


if(!is_home()) {
function share_meta_head() {
    global $post; ?>
    <meta property="og:title" content="<?php the_title(); ?>" />
    <?php if (isset($post->ID)){ ?>
        <?php if (has_post_thumbnail( $post->ID ) ): ?>
            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
            <meta property="og:image" content="<?php echo $image[0]; ?>" />
        <?php endif; ?>
    <?php } ?>
    <meta property="og:url" content="<?php the_permalink(); ?>" />
<?php 
}
add_action('wp_head', 'share_meta_head');
}


function short_excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      return $excerpt;
    }

    function content($limit) {
      $content = explode(' ', get_the_content(), $limit);
      if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
      } else {
        $content = implode(" ",$content);
      } 
      $content = preg_replace('/\[.+\]/','', $content);
      $content = apply_filters('the_content', $content); 
      $content = str_replace(']]>', ']]&gt;', $content);
      return $content;
}


function hex2rgba($color, $opacity = false) {
    $default = 'rgb(0,0,0)';
    if(empty($color))
          return $default; 
        if ($color[0] == '#' ) {
            $color = substr( $color, 1 );
        }

        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }


        $rgb =  array_map('hexdec', $hex);


        if($opacity){
            if(abs($opacity) > 1)
                $opacity = 1.0;
            $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
            $output = 'rgb('.implode(",",$rgb).')';
        }

        return $output;
}



add_filter('sod_ajax_layered_nav_product_container', 'bery_product_container');
function bery_product_container($product_container){
return 'ul.products';
}


?>