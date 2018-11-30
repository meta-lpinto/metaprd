<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package primestudio
 */

get_header(); ?>
	<div id="primary" class="content-area col-xs-12 col-md-8">
		<main id="main" class="site-main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>
			<div class="custome-nav">
					  <?php previous_post_link('%link', 'Older', TRUE); ?>

					  <?php if(get_option( 'page_for_posts' )!=0)
					  {
					  ?>
						 <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>"><?php esc_html_e('Our Blog','primestudio'); ?></a>
					  <?php
						 }
							next_post_link('%link', 'Newer', TRUE);
						?>
		  </div>
			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'primestudio' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>