<?php
function shortcode_recent_post($atts, $content = null) {
	global $ros_opt;
	extract(shortcode_atts(array(
		"title" => '',
		"align" => '',
		"posts" => '3',
		"columns" => '4',
		"category" => '',
		"style" => '',
		"image_height" => 'auto',
		"show_date" => 'true'
	), $atts));
	ob_start();
	?>
	<?php if ($align == 'center') $align = 'text-center'; ?>

		<?php if($title){?> 
			<div class="row">
				<div class="large-12 columns <?php echo esc_attr($align); ?>">
					<h3 class="section-title"><span><?php echo esc_attr($title); ?></span></h3>
					<div class="bery-hr medium"></div>
				</div>
			</div>
		<?php } ?>
    	<div class="row group-slider">
            <ul class="blog-group">

				<?php
                $args = array(
                    'post_status' => 'publish',
                    'post_type' => 'post',
					'category_name' => $category,
                    'posts_per_page' => $posts
                );

                $recentPosts = new WP_Query( $args );

                if ( $recentPosts->have_posts() ) : ?>

                    <?php while ( $recentPosts->have_posts() ) : $recentPosts->the_post(); ?>
					<?php if($style == 'horizontal') { ?>
					  <li class="blog_shortcode_item">
					  	<div class="row">
						 <div class="large-6 columns">
							 <a href="<?php the_permalink() ?>" style="padding-right:0;">
							 	<div class="entry-blog">
                       		 		<div class="entry-image">
		                       		 	<div class="entry-image-attachment nd-style-1" style="max-height:<?php echo  esc_attr($image_height); ?>;overflow:hidden;">
							           		 <?php the_post_thumbnail('medium'); ?>
							           		 <div class="image-overlay"></div>
							      	    </div>
				         			</div>
				         		</div>
				          	</a>
						 </div>
						 <div class="large-6 columns">
						 	 <a href="<?php the_permalink() ?>" style="padding:0">
							    <div class="blog_shortcode_text" style="padding-right:30px;">
	                   		      <div class="from_the_blog_title"><h3><?php the_title(); ?></h3></div>
	                   		      <div class="from_the_blog_excerpt">
	                                <?php
	                                    $excerpt = get_the_excerpt();
	                                    echo string_limit_words($excerpt,15) . '[...]';
	                                ?>
	                               </div>
	                                <?php if($show_date != 'false') {?>
						            <div class="post-date">
							                <span class="post-date-day"><?php echo get_the_time('d', get_the_ID()); ?></span>
							                <span class="post-date-month"><?php echo get_the_time('M', get_the_ID()); ?></span>
							         </div>
						         <?php } ?>
	                   		      <div class="from_the_blog_comments"><?php echo get_comments_number( get_the_ID() ); ?> comments</div>
	                   		  	</div>
                   		 	 </a>
						 </div>
						</div>
                        </li>

					<?php } else { ?>
					  <li class="blog_shortcode_item">
                      
                      	<div class="entry-blog">
    						<div class="blog_shortcode_text">
	    							<h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
	               		      		<div class="from_the_blog_excerpt">
		                                <?php
		                                    $excerpt = get_the_excerpt();
		                                    echo string_limit_words($excerpt,9) .'<a href="'.get_permalink().'"> [Read more]</a>';
		                                ?>
	                           		</div>
               		  			</div>
							</div>
                	  
                        </li>
					<?php } ?>
                      
                    <?php endwhile;?>

                <?php

                endif;
				wp_reset_query();

                ?>
            </ul> 
        </div> 
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode("recent_post", "shortcode_recent_post");


function string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

add_shortcode("latest_post", "shortcode_latest_from_blog");
