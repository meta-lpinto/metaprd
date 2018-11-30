<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package primestudio
 */

get_header();

// Grab the metadata from the database
$prefix = '_primestudio_page_';
$main_layout=get_post_meta( get_the_ID(), $prefix . 'main_layout', true );
$sidebar_position_class = '';
$primary_grid_class='col-xs-12 col-md-12';


$classes = get_body_class();

//FULL PAGE ENABLED
if(get_post_meta( get_the_ID() , '_primestudio_page_enable_fullpage',1 )){
	$primary_grid_class = '';
}

?>


	<div id="primary" class="content-area <?php echo esc_attr($primary_grid_class); ?> <?php echo esc_attr($sidebar_position_class); ?>">

		<main id="main" class="site-main">

			<?php while ( have_posts() ) : the_post(); 	?>


				<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
