<?php
$output = $title = $interval = $el_class = $collapsible = $active_tab = '';
global $pgl_accordion_item;
$pgl_accordion_item = array();
//
extract(shortcode_atts(array(
    'title' => '',
    'interval' => 0,
    'el_class' => '',
    'collapsible' => 'no',
    'active_tab' => '1'
), $atts));
$id = rand();
wpb_js_remove_wpautop($content);
?>
<div class="collapses-group">
	<?php
	foreach($pgl_accordion_item as $key => $acc){
		$itemid = rand();
	?>
	<div class="collapses" rel="0">
		<div class="collapses-title">
			<a href="#"><?php echo esc_attr($acc['title']); ?></a>
		</div>
		<div class="collapse-inner"><?php echo $acc['content']; ?></div>
	</div>
	<?php } ?>
</div>