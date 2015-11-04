<?php global $ros_opt; ?>
<div class="fixed-header-area hide-for-small">
	<div class="fixed-header">
		<div class="row header-container"> 
		
			<!-- Logo -->
			<div class="large-2 columns">
				<?php leetheme_logo(); ?>
			</div>
			<!-- Main navigation - Full width style -->
			<div class="large-7 columns">
				<div class="wide-nav light-header nav-left">
					<div class="row">
						<div class="large-12 columns">
							<?php leetheme_get_main_menu(); ?>
						</div><!-- .large-12 -->
					</div><!-- .row -->
				</div><!-- .wide-nav -->
			</div>

			<!-- Mini cart -->
			<div class="large-3 columns">
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
		</div>
		<!-- </header> -->
	</div>
</div>