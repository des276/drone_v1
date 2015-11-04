<?php 
	global $woocommerce;
	global $woo_options;
	global $ros_opt;
?>


<div class="header-wrapper">
	<div class="header-type-3">
		<!-- Top bar -->
		<!-- Masthead -->
		<div class="sticky-wrapper">

			<header id="masthead" class="site-header " role="banner">

				<div class="row header-container"> 
					<div class="mobile-menu show-for-small"><a href="#open-menu"><span class="icon-menu"></span></a></div><!-- end mobile menu -->
					<!-- Mini cart -->
					<div class="">
						<ul class="header-nav cart-wishlist">
							<!-- HEADER/Show mini cart -->
							<?php if(function_exists('wc_print_notices')) { ?> 
								<li class="wish-list-link">
									<a href="<?php echo get_permalink(5);?>" title="">
										<ul class="wish-list-inner">
											<li class="wish-list-icon"><i class="fa fa-star-o"></i></li>
								            <li class="wish-list-text"></li>
							            </ul>
						            </a>
								</li>
								<li class="mini-cart">
									<?php leetheme_mini_cart(); ?>
								</li><!-- .mini-cart -->
							<?php } ?>
						</ul><!-- .header-nav -->
					</div>
					<!-- Logo -->
					<div>
						<?php leetheme_logo(); ?>
					</div>
					<!-- Main navigation - Full width style -->
					<div class="wide-nav light-header nav-left">
								<?php leetheme_get_main_menu(); ?>
					</div><!-- .wide-nav -->
					<div class="footer-vertical">
						<?php echo do_shortcode('[share style="transparent"]'); ?>
						<div class="copyright-footer">
							<?php if(isset($ros_opt['footer_left_text']))
								{
									echo esc_attr($ros_opt['footer_left_text']);
								}else{
									echo 'Define left footer text / navigation in Theme Option Panel';
								}
							?>
						</div>
					</div>
				</div>
			</header>
		</div>
	</div>
</div>