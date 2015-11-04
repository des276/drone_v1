<?php
function berybanner_shortcode($atts, $content) {
    $image = $mask = '';
    $a = shortcode_atts(array(
        'align'  => 'left',
        'valign'  => 'top',
        'class'  => '',
        'link'  => '',
        'hover'  => '',
        'content'  => '',  
        'font_style'  => '',  
        'banner_style'  => '',  
        'img' => '',
        'img_src' => '',
        'height' => '300px',
        'text_color' => '',
        'parallax' => '0',
        'padding_text' => '',
        'effect_text' => '',
        'data_delay' => '0ms'
    ), $atts);
    ?>
    <?php
    $is_parallax = ($a['parallax']) != '0' ?' data-stellar-background-ratio="'.$a['parallax'].'"':'';
   
    $parallax = '';
    if ($a['banner_style'] != '') {
      $a['class'] .= ' style-'.$a['banner_style'];
    }

    if ($a['parallax'] != ''){
        $a['class'] .= ' banner-parallax';
    }

    if ($a['align'] != '') {
      $a['class'] .= ' align-'.$a['align'];
    }

    if ($a['valign'] != '') {
      $a['class'] .= ' valign-'.$a['valign'];
    }

    $onclick = '';
    if($a['link'] != '') {
        $a['class'] .= ' cursor-pointer';
        $onclick = 'onclick="window.location=\''.$a['link'].'\'"';
    }

    $style = '';
    if ($a['img_src'] != '') {
        if ($a['parallax'] != '0'){
            $style = 'background: url('.$a['img_src'].') center no-repeat fixed; -webkit-background-size:cover; -moz-background-size:cover; -o-background-size:cover; background-size:cover;';
        }else{
            $style = 'background-image: url('.$a['img_src'].'); background-repeat: no-repeat; -webkit-background-size:cover; -moz-background-size:cover; -o-background-size:cover; background-size:cover;';
        }
    }

    if ($a['height'] != '') {
        $style .= ' height: '.$a['height'].';';
    }

    $text_color = '';
    if ($a['text_color'] != ''){
        $text_color = $a['text_color'];
    }


    $hover = '';
    if ($a['hover'] != ''){
        $hover = 'hover-'.$a['hover'].'';
    }

    $padding_text = '';
    if ($a['padding_text'] != ''){
        $padding_text = 'padding: 0px '.$a['padding_text'].'';
    }

    $effect_text = '';
    if ($a['effect_text'] != ''){
        $effect_text = $a['effect_text'];
    }else{
        $effect_text = 'fadeIn';
    }

    $data_delay = '';
    if ($a['data_delay'] != ''){
        $data_delay = $a['data_delay'];
    }

    return '<div class="banner wow fadeInUp bery_banner '.$a['class'].' banner-font-'.$a['font_style'].' hover-'.$a['hover'].'"  data-wow-delay="'.$data_delay.'"  '.$onclick.'><div class="banner-background" '.$is_parallax.' style="'.$style.'"></div><div class="banner-content '.$text_color.'"><div class="banner-inner wow '.$effect_text.'" style="'.$padding_text.'">'.do_shortcode($content).'</div></div></div>';
}

$content = ob_get_contents();
ob_end_clean();

add_shortcode('berybanner','berybanner_shortcode');
