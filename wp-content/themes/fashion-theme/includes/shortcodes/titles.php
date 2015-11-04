<?php
function title_shortcode( $atts, $content = null ){
  extract( shortcode_atts( array(
    'text' => '',
    'style' => '',
    'link' => '',
    'link_text' => '',
    'align' => '',
  ), $atts ) );

  $link_output = '';
  $style_output ='';

  if($style) $style_output = 'title_'.$style;
  if($link) $link_output = '<a href="'.$link.'">'.$link_text.'</a>';
  if ($align == 'center') $align = 'text-center';

return '<div class="row"><div class="large-12 columns"><div class="title-inner '.$align.'"><h3 class="section-title '.$style_output.'"><span>'.$atts['text'].'</span> '.$link_output.'</h3></div></div></div>';

}
add_shortcode('title', 'title_shortcode');


function divider_shortcode( $atts, $content = null ){
  extract( shortcode_atts( array(
    'width' => 'medium',
    'height' => '',
    'style' => '',
    'icon' => ''
  ), $atts ) );
  if ($height) $height = 'height: '.$height;
  $star = '';
  if ($icon == 'star') $star = '<div class="icon-wrapper"><i class="fa fa-star"></i><i class="fa fa-star large"></i><i class="fa fa-star"></i></div>';

  return '<div class="row"><div class="large-12 columns"><div class="bery-hr '.$width.' '.$style.' '.$icon.'" style="'.$height.'">'.$star.'</div></div></div><!-- end divider -->';

}
add_shortcode('divider', 'divider_shortcode');



