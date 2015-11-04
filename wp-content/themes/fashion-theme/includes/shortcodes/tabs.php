<?php
function tabgroup( $params, $content = null ) {
	$GLOBALS['tabs'] = array();
	$GLOBALS['tab_count'] = 0;
	$i = 1;
	$randomid = rand();

	extract(shortcode_atts(array(
		'title' => '',
		'style' => 'normal',
		'align' => '',
	), $params));

	$content = do_shortcode($content);
	if ($align == 'center') $align = 'text-center';
	if ($align == 'right') $align = 'text-right';

	if( is_array( $GLOBALS['tabs'] ) ){
		
		foreach( $GLOBALS['tabs'] as $key => $tab ){
			$active = $key == 0 ? ' active' : ''; // Set first tab active by default.
			$tabs[] = '<li class="tab'.$active.'"><a href="#panel'.$randomid.$i.'">'.$tab['title'].'</a></li><li class="separator">/</li>';
			$panes[] = '<div class="panel'.$active.'" id="panel'.$randomid.$i.'">'.do_shortcode($tab['content']).'</div>';
			$i++;
		}
		if (!empty($title)){
			$return = '
			<div class="row"><div class="large-12 columns"><div class="title-inner"><h3 class="section-title title-tabs"><span>'.$title.'</span></h3></div></div></div>
			<div class="row">
			<div class="large-12 columns tabbed-content shortcode_tabgroup pos_'.$style.'">
				<ul class="tabs '.$align.'">'.implode( "\n", $tabs ).'</ul><div class="panels">'.implode( "\n", $panes ).'</div><div class="clr"></div></div></div>';
		}else{
			$return = '
			<div class="row">
			<div class="large-12 columns tabbed-content shortcode_tabgroup pos_'.$style.'">
				<ul class="tabs '.$align.'">'.implode( "\n", $tabs ).'</ul><div class="panels">'.implode( "\n", $panes ).'</div><div class="clr"></div></div></div>';
		}
	}
	return $return;
}

function tabgroup_vertical( $params, $content = null ) {
	$GLOBALS['tabs'] = array();
	$GLOBALS['tab_count'] = 0;
	$i = 1;
	$randomid = rand();

	extract(shortcode_atts(array(
		'title' => '',
		'style' => 'normal',
	), $params));

	$content = do_shortcode($content);

	if( is_array( $GLOBALS['tabs'] ) ){
	
		foreach( $GLOBALS['tabs'] as $key => $tab ){
			$current = $key == 0 ? ' current-menu-item' : '';
			$active = $key == 0 ? ' active' : '';
			$tabs[] = '<li class="tab'.$current.'"><a href="#panel'.$randomid.$i.'">'.$tab['title'].'</a></li>';
			$panes[] = '<div class="tabs-inner'.$active.'" id="panel'.$randomid.$i.'"><p>'.do_shortcode($tab['content']).'</p></div>';
			$i++;
		}
		if (!empty($title)){
			$return = '
				<div class="row collapse vertical-tabs shortcode_tabgroup_vertical pos_'.$style.'">
				<h3>'.$title.'</h3>
				<div class="large-3 columns"><ul class="tabs-nav">'.implode( "\n", $tabs ).'</ul></div><div class="large-9 columns">'.implode( "\n", $panes ).'</div></div>';
		}else{
			$return = '
				<div class="row collapse vertical-tabs shortcode_tabgroup_vertical pos_'.$style.'">
				<div class="large-3 columns"><ul class="tabs-nav">'.implode( "\n", $tabs ).'</ul></div><div class="large-9 columns">'.implode( "\n", $panes ).'</div></div>';
		}
	}
	return $return;
}


function tab( $params, $content = null) {
	extract(shortcode_atts(array(
			'title' => '',
			'title_small' => ''
	), $params));
	
	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );
	$GLOBALS['tab_count']++;
}


add_shortcode('tabgroup', 'tabgroup');
add_shortcode('tabgroup_vertical', 'tabgroup_vertical');
add_shortcode( 'tab', 'tab' );

?>