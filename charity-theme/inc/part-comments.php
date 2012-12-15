<div id="comments"  class="tab_content">
		<div id="comments-stream">
			<div class="comments-left">
			<?php
				global $post, $wp_query; ?>
				<?php $args = array(
					'post_id'   => $active_cause,
					'status' => 'approve',
					'order'   => 'ASC',
					'count'	 => true	
				);?>
				<?php $wp_query->comments = get_comments( $args ); ?>
				<h2 class="green_under"><span><?php echo $wp_query->comments; ?></span>Comments</h2>		
				<?php wp_reset_query();?>
			<?php $active_cause = get_option('active_cause'); 
				$args = array(
					'post_id'   => $active_cause,
					'status' => 'approve',
					'order'   => 'ASC'
				);
				$wp_query->comments = get_comments( $args );
				wp_list_comments(array('style' => 'div','avatar_size' => 64,'max_depth' => 3));
				
			?>
			</div>						
			
			<div class="comments-right">
				<h2 class="green_under">Social Chatter</h2>		
				<div id="result"></div>				
				
			</div>		
		
		</div>		
	</div>