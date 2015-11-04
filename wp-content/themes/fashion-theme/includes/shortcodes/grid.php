<?php
function backgroundShortcode($atts, $content = null) {
$bgid = rand();
extract( shortcode_atts( array(
    'bg' => '',
    'bg_link' => '',
    'padding' =>'',
    'dark' => 'true',
    'boxed' => 'false',
    'class' => '',
    'video_mp4' => '',
    'video_ogv' => '',
    'video_webm' => '',
    'parallax' => '',
    'parallax_text' => '',
    'margin' => '',
    'title' => '',
    ), $atts ) );
    
    ob_start();

   $background = "";
   $background_color = "";
   $padding_row = "";
   $dark_text = "";
   if($dark == 'true') $dark_text = "dark";

    if($padding){ $padding_row = 'padding:'.$padding.' 0;';}

    if (strpos($bg,'http://') !== false || strpos($bg,'https://') !== false) {
      $background = $bg;
    }

    elseif (strpos($bg,'#') !== false) {
      $background_color = 'background-color:'.$bg.'!important;';
    }

   $parallax_class = '';
   if($parallax){$parallax_class = 'bery_parallax'; $parallax='data-velocity='.(intval($parallax)/10);} 
 
   $text_parallax_class = '';
   if($parallax_text){$text_parallax_class = 'parallax_text'; $parallax_text='data-velocity="'.(intval($parallax_text)/10).'"';} 

  ?>

 <?php if($title){ ?>
       <h3 class="bery-bg-title"><span><?php echo esc_attr($title); ?></span></h3>
      <?php } ?> 
  <div class="bery_bg <?php echo esc_attr($dark_text); ?> <?php echo esc_attr($class); ?>" style="position:relative; <?php echo esc_attr($background_color); ?> <?php echo esc_attr($padding_row); ?> <?php if($margin){ echo 'margin-bottom:'.$margin.'!important;';}?>">  
    <div class="banner-bg <?php echo esc_attr($parallax_class); ?>" <?php echo esc_attr($parallax); ?> style="background-image:url(<?php echo esc_attr($background); ?>); <?php echo esc_attr($background_color); ?>"></div>
     <div class="bery_bg_content <?php echo esc_attr($text_parallax_class); ?> parallax_text" <?php echo esc_attr($parallax_text); ?>><?php echo do_shortcode($content); ?></div>
     
    <?php if($video_mp4 || $video_webm || $video_ogv){ ?>
     <div class="video-overlay" style="position:absolute;top:0;bottom:0;right:0;left:0;z-index:2;background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAIAAAACCAYAAABytg0kAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6N0IxQjNGRDQ0QUMxMTFFMzhBQzM5OUZBMEEzN0Y1RUUiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6N0IxQjNGRDU0QUMxMTFFMzhBQzM5OUZBMEEzN0Y1RUUiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpFN0M5QzFENzRBQTcxMUUzOEFDMzk5RkEwQTM3RjVFRSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpFN0M5QzFEODRBQTcxMUUzOEFDMzk5RkEwQTM3RjVFRSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PhPF5GwAAAAYSURBVHjaYmJgYPD6//8/AyOIAAGAAAMAPRIGSKhmMMMAAAAASUVORK5CYII=');"></div>
     <video class="bery-banner-video hide-for-small" style="position:absolute;top:0;left:0;bottom:0;right:0;min-width: 100%;min-height: 100%;z-index:1;" poster="<?php echo esc_attr($background); ?>" preload="auto" autoplay="" loop="loop" muted="muted">
          <source src="<?php echo esc_url($video_mp4); ?>" type="video/mp4">
          <source src="<?php echo esc_url($video_webm); ?>" type="video/webm">
          <source src="<?php echo esc_url($video_ogg); ?>" type="video/ogg">
      </video>
      <?php } ?>

  </div>

  <?php
  $content = ob_get_contents();
  ob_end_clean();
  return $content;

} 

function rowShortcode($atts, $content = null) {
  extract( shortcode_atts( array(
    'style' => '',
    'margin' => '',
    'padding' => '' 
  ), $atts ) );

  $margin_html ='';
  if($margin){
    $margin_html = 'margin-top:'.$margin.'!important;margin-bottom:'.$margin.'!important;';
  }

  $padding_html = '';
  if ($padding) {
    $padding_html = 'padding-left: '.$padding.' !important; padding-right: '.$padding.' !important;';
  }

	$content = do_shortcode($content);
	$container = '<div class="row container '.$style.' " style=" '.$margin_html. ' '.$padding_html.'">'.$content.'</div>';
	return $container;
} 

function bannergridShortCode($atts, $content = null) {
    extract( shortcode_atts( array(
    'padding' => '',
    'width' => '',
    ), $atts ) );
    $shortcode_id = rand();
    ob_start();
  ?>
  <?php if($padding){ $padding_w = $padding/2; ?>
          <style scoped>#banner_grid_<?php echo esc_attr($shortcode_id); ?> .bery_banner-grid .columns > div{margin-left: <?php echo esc_attr($padding_w); ?>px !important; margin-right: <?php echo esc_attr($padding_w) ?>px !important;} #banner_grid_<?php echo esc_attr($shortcode_id); ?> .bery_banner{margin-bottom: <?php echo esc_attr($padding); ?>px;} </style>
  <?php } ?>
  <?php if($width){ ?>
          <style scoped>#banner_grid_<?php echo esc_attr($shortcode_id); ?> > .row {max-width:<?php echo esc_attr($width); ?>} <?php if($width == '100%') {?> #banner_grid_<?php echo esc_attr($shortcode_id); ?> > .row > .large-12{padding:0!important;} <?php } ?></style>
  <?php } ?>

  <div id="banner_grid_<?php echo esc_attr($shortcode_id); ?>">
  <div class="row">
      <div class="large-12 columns">
        <div class="row collapse bery_banner-grid"><?php echo do_shortcode($content); ?></div>
      </div>
    </div>
    <script>
  jQuery(document).ready(function ($) {
      var $container = $("#banner_grid_<?php echo esc_attr($shortcode_id) ?> .bery_banner-grid");
      $container.packery({
        itemSelector: ".columns",
        gutter: 0
      });
   });
  </script>
  </div><!-- .banner-grid -->
	
	<?php
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
} 

function colShortcode($atts, $content = null) {	
	extract( shortcode_atts( array(
    'span' => '3',
    'animate' => '',
  	), $atts ) );

  	switch ($span) {
    case "1/1":
        $span = "12"; break;
    case "1/4":
        $span = '3'; break;
    case "2/4":
         $span ='6'; break;
    case "3/4":
        $span = '9'; break;
    case "1/3":
        $span = '4'; break;
    case "2/3":
         $span = '8'; break;
    case "1/2":
        $span = '6'; break;
    case "1/6":
        $span = '2'; break;
    case "2/6":
        $span = '4'; break;
    case "3/6":
        $span = '6'; break;
    case "4/6":
        $span = '8'; break;
    case "5/6":
        $span = '10'; break;
    case "1/12":
        $span = '1'; break;
    case "2/12":
        $span = '2'; break;
    case "3/12":
        $span = '3'; break;
    case "4/12":
        $span = '4'; break;
    case "5/12":
        $span = '5'; break;
    case "6/12":
        $span = '6'; break;
    case "7/12":
        $span = '7'; break;
    case "8/12":
        $span = '8'; break;
    case "9/12":
        $span = '9'; break;
    case "10/12":
        $span = '10'; break;
     case "11/12":
        $span = '11'; break;
	}

	$content = do_shortcode($content);
	$column = '<div class="large-'.$span.' columns">'.$content.'</div>';
	return $column;
}
add_shortcode('bery_banner_grid', 'bannergridShortcode');
add_shortcode('col', 'colShortcode');
add_shortcode('row', 'rowShortcode');
add_shortcode('background', 'backgroundShortcode');
add_shortcode('section', 'backgroundShortcode');