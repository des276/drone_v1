<?php 
	global $woocommerce;
	global $woo_options;
	global $ros_opt;
?>


	<div class="header-wrapper header-type-1">
		<!-- Top bar -->
		<?php get_template_part('headers/top-bar'); ?>

		<!-- Masthead -->
		<div class="sticky-wrapper">
			<header id="masthead" class="site-header " role="banner">
				
				<div class="row header-container"> 
					<div class="small-2 columns mobile-menu show-for-small"><a href="#open-menu"><span class="icon-menu"></span></a></div><!-- end mobile menu -->
					
					<!-- Logo -->
					<div class="large-2 small-8 columns">
						<?php leetheme_logo(); ?>
					</div>
					<!-- Search -->
					<div class="large-5 small-2 push-1 columns hide-for-small">
						<div class="wide-nav-search">
							<?php if(function_exists('get_product_search_form')) {
									get_product_search_form();
								} else {
									get_search_form();
							} ?>		
						</div>
					</div>

					<!-- Mini cart -->
					<div class="large-3 small-2 columns">
						<ul class="header-nav cart-wishlist">
							<!-- HEADER/Show mini cart -->
							<?php if(function_exists('wc_print_notices')) { ?> 
								<li class="wish-list-link">
									<a href="<?php echo get_permalink(5);?>" title="">
										<ul class="wish-list-inner">
											<li class="wish-list-icon"><i class="fa fa-star-o"></i></li>
							            </ul>
						            </a>
								</li>
								<li class="mini-cart">
									<?php leetheme_mini_cart(); ?>
								</li><!-- .mini-cart -->
							<?php } ?>
						</ul><!-- .header-nav -->
					</div>


				</div>


			</header>
		</div>

		<!-- Main navigation - Full width style -->
		<div class="wide-nav light-header nav-left">
			<div class="row">
				<div class="large-12 columns">
					<?php leetheme_get_main_menu(); ?>
				</div><!-- .large-12 -->
			</div><!-- .row -->
		</div><!-- .wide-nav -->
	</div>