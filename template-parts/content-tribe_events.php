<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'primestudio' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<div class="below-post-content">
			<div>
				<?php

					if( class_exists('Ze_VC_Addons') )
            		{
						if( primestudio_get_option('primestudio-share-checkbox') == 1 || 
							primestudio_get_option('primestudio-share-checkbox') == '' )
						{
							$share_it_text = primestudio_get_option('social-share-text');
					?>
							<div class="primestudio-share-options">
								<?php
									if( $share_it_text != '' )
									{
								?>
								<h6 class="share_it"><?php printf('%s',esc_html($share_it_text)); ?></h6>
								<?php
									}
								?>
								<?php printf(__('%s','primestudio'),primestudio_SocialMeta()); ?>
							</div>
					<?php
						}
					}
				?>
			</div>
		</div>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->