<?php 
function bery_brand( $atts, $content = null ){
  extract( shortcode_atts( array(
    'img' => '#',
    'padding' => '15px',
    'title' => '',
    'link' => '#',
    'height' => '50px',
  ), $atts ) );

    if (strpos($img,'http://') !== false || strpos($img,'https://') !== false) {
      $img = $img;
    }
    else {
      $img = wp_get_attachment_image_src($img, 'large');
      $img = $img[0];
    }

    $content = '<div class="bery_brand" style="padding-left: '.$padding.'; padding-right:'.$padding.';"><a title="'.$title.'" href="'.$link.'" ><img src="'.$img.'" alt="'.$title.'" style="max-height:'.$height.';min-height:'.$height.'" /></a></div>';
    return $content;
}
add_shortcode('brand', 'bery_brand');

function bery_category_banner( $atts, $content = null){
  extract(shortcode_atts(array(
      'img' => '#',
      'padding' => '15px',
      'link' => '#',
      'height' => '365px',
      'title' => '',
    ), $atts));

  if (strpos($img,'http://') !== false || strpos($img,'https://') !== false) {
        $img = $img;
      }
  else {
    $img = wp_get_attachment_image_src($img, 'large');
    $img = $img[0];
  }


  $content = '<div class="bery_category_banner"><a title="'.$title.'" href="'.$link.'" style="padding:0px '.$padding.';"><img src="'.$img.'" alt="'.$title.'" style="max-height:'.$height.';min-height:'.$height.'" /></a></div>';
    return $content;
}

add_shortcode('category_banner', 'bery_category_banner');

function support_footer($atts, $content = null){
  extract(shortcode_atts(array(
    'title1' => '',
    'title2' => '',
    'title3' => '',
    'content1' => '',
    'content2' => '',
    'content3' => '',
    'bg' => '#f0f0f0',
  ), $atts));
  ob_start();
  ?>

  <div class="support-footer" style="background-color: <?php echo esc_attr($bg); ?>">
    <div class="row">
      <div class="support-footer-inner">
        <div class="large-4 small-12 columns">
          <div class="row">
                <div class="large-2 small-2 columns">
                  <div class="support-icon square-round"><span class="fa fa-car"></span></div>
                </div>
                <div class="large-10 small-10 columns">
                  <div class="support-info">
                    <div class="info-title"><?php echo esc_attr($title1); ?></div>
                    <div class="info-details"><?php echo esc_attr($content1); ?>
                     </div>
                  </div>
                </div>
              </div>
        </div>

        <div class="large-4 small-12 columns">
          <div class="row">
                <div class="large-2 small-2 columns">
                  <div class="support-icon square-round"><span class="fa fa-life-buoy"></span></div>
                </div>
                <div class="large-10 small-10 columns">
                  <div class="support-info">
                    <div class="info-title"><?php echo esc_attr($title2); ?></div>
                    <div class="info-details"><?php echo esc_attr($content2); ?> 
                     </div>
                  </div>
                </div>
              </div>
        </div>

        <div class="large-4 small-12 columns">
          <div class="row">
                <div class="large-2 small-2 columns">
                  <div class="support-icon square-round"><span class="fa fa-money"></span></div>
                </div><!-- .large-2 -->
                <div class="large-10 small-10 columns">
                  <div class="support-info">
                    <div class="info-title"><?php echo esc_attr($title3); ?></div>
                    <div class="info-details"><?php echo esc_attr($content3); ?>
                     </div>
                  </div>
                </div>
              </div>
        </div>
      </div>
      

    </div>
  </div>

  <?php 
  $content = ob_get_contents();
  ob_end_clean();
  return $content;

}

add_shortcode("support_footer","support_footer");


function shortcode_client($params = array(), $content = null) {
  extract(shortcode_atts(array(
    "image" => '',
    "name" => '',
    "company" => '',
    "stars" => '',
    "content_say" => '',


  ), $params));
  $content = preg_replace('#<br\s*/?>#', "", $content);

  $star_row = '';
  if ($stars == '1'){$star_row = '<div class="star-rating"><span style="width:25%"><strong class="rating"></strong></span></div>';}
  else if ($stars == '2'){$star_row = '<div class="star-rating"><span style="width:35%"><strong class="rating"></strong></span></div>';}
  else if ($stars == '3'){$star_row = '<div class="star-rating"><span style="width:55%"><strong class="rating"></strong></span></div>';}
  else if ($stars == '4'){$star_row = '<div class="star-rating"><span style="width:75%"><strong class="rating"></strong></span></div>';}
  else if ($stars == '5'){$star_row = '<div class="star-rating"><span style="width:100%"><strong class="rating"></strong></span></div>';}


  $client='

    <div class="client large-12 columns">
      <div class="client-inner">
        
        <img class="wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1s" src="'.esc_url($image).'" alt="" />
        <div class="client-content wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1s">
            <span>'.$content_say.'</span>
        </div>
        <div class="wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1s">'.$star_row.'</div>
        
        <div class="client-info wow fadeInUp" data-wow-delay="800ms" data-wow-duration="1s">
          <span class="client-name">'.esc_attr($name).'  -  </span>
          <span class="client-pos">'.esc_attr($company).'</span>
        </div>
      </div>
    </div>
  ';

  return $client;
}

add_shortcode('client','shortcode_client');


