<?php global $ros_opt; ?>
<?php do_action( 'before' ); ?>
		<?php if(!isset($ros_opt['topbar_show']) || $ros_opt['topbar_show']){ ?>
	<div id="top-bar">
		<div class="row">
			<div class="large-12 columns">

				<div class="left-text left">
					<div class="html"><?php if(isset($ros_opt['topbar_left'])){echo esc_attr($ros_opt['topbar_left']);}?></div>
				</div>
				<div class="right-text right"> 
					 <?php if ( has_nav_menu( 'top_bar_nav' ) ) : ?>
					<?php  
							wp_nav_menu(array(
								'theme_location' => 'top_bar_nav',
								'menu_class' => 'top-bar-nav',
								'before' => '',
								'after' => '',
								'link_before' => '',
								'link_after' => '',
								'depth' => 2,
								'fallback_cb' => false,
								'walker' => new LeethemeNavDropdown
							));
					?>
					
					 <?php else: ?>
					 	<?php _e('Define your top bar navigation in <b>Apperance > Menus</b>','ltheme_domain') ?>
                    <?php endif; ?>
				</div>
				
				

			</div>
		</div>
	</div>
<?php }?>
