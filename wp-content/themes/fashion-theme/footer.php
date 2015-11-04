<?php
/**
 * The template for displaying the footer.
 *
 * @package leetheme
 */

global $ros_opt;
?>

</div>

	<!-- TOP FOOTER -->

	<div class="pre-footer text-center">
		<?php if(isset($ros_opt['pre_footer'])) {?>
				<img src="<?php echo esc_url($ros_opt['pre_footer']); ?>" alt="" />
			<?php } else {?>
				<span><?php _e('Define pre footer image in Theme Option Panel','ltheme_domain') ?></span>
			<?php } ?>
	</div>	

	<!-- END TOP FOOTER -->

	<!-- MAIN FOOTER -->
	<footer class="footer-wrapper" role="contentinfo">	
		<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
			<div class="footer footer-1"  style="background-color:#fff">
				<div class="row">
			   		<?php dynamic_sidebar('sidebar-footer'); ?>        
				</div>
			</div>
		<?php endif; ?>
	<!-- END MAIN FOOTER -->
	<!-- BOTTOM FOOTER -->
		<div class="absolute-footer">
			<div class="row">
				<div class="large-12 columns">
					<div class="left">
					<div class="copyright-footer"><?php if(isset($ros_opt['footer_left_text'])) {echo esc_attr($ros_opt['footer_left_text']);} else{ _e('Define left footer text / navigation in Theme Option Panel','ltheme_domain');} ?></div>
					</div>
					<div class="right">
						<?php if(isset($ros_opt['footer_right_text'])) {?>
							<img src="<?php echo esc_attr($ros_opt['footer_right_text']); ?>" alt="" />
						<?php } else {?>
							<span><?php _e('Define right footer image in Theme Option Panel','ltheme_domain'); ?></span>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	<!-- END BOTTOM FOOTER -->
	


</footer>

</div>


<a href="#top" id="top-link" class="wow bounceIn"><span class="icon-angle-up"></span></a>
<div class="scroll-to-bullets"></div>

<?php wp_footer(); ?>

</body>
</html>