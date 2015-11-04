<?php 
function collapses($atts, $content=null, $code) {
	extract(shortcode_atts(array(
		'open' => '0',
		'title' => ''
	), $atts));

	if (!preg_match_all("/(.?)\[(collapses_item)\b(.*?)(?:(\/))?\](?:(.+?)\[\/collapses_item\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} 
	else {
		$output = '';
		if($title) $title = '<h3 class="collapses_title">'.$title.'</h3>';
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
			$matches[3][$i] = implode(' ', $matches[3][$i]);
			$matches[3][$i] = str_replace(array('#8221;', '&'), array('', ''), $matches[3][$i]);
			$count = strlen($matches[3][$i]);
			$output .= '<div class="collapses-title"><a href="#">' .  $matches[3][$i] . '</a></div><div class="collapses-inner">' . do_shortcode(trim($matches[5][$i])) .'</div>';
		}
		return $title.'<div class="collapses" rel="'.$open.'">' . $output . '</div>';
		
	}
}
add_shortcode('collapses', 'collapses');
?>