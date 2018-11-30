<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package primestudio
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php
	primestudio_get_favicon();
	wp_head();
	$event_id = get_the_ID();
?>
</head>
<body <?php body_class(); ?>>
<?php
	printf(__('%s','primestudio'),primestudio_site_loader());
?>

<div id="page" class="hfeed site">
	<header id="masthead" class="site-header <?php echo esc_attr(primestudio_menu_class()); ?>" >
		<div class="<?php echo esc_attr(primestudio_layout_settings()); ?>"><!-- container start-->
				<?php do_action('primestudio_child_header_block_action'); ?>
		</div> <!-- container end -->
	</header><!-- #masthead -->
	<div id="title-holder" >
		<?php 
		if( has_post_thumbnail() )
	 		echo '<div id="title-bg" style="background-image: url(\'' . get_the_post_thumbnail_url( $event_id, 'full' ) . '\')"></div>';
	 	$terms = get_the_terms( $event_id, 'meta_category' );
		$event_cat =  ( !$terms ) ?  [ 'name' => [], 'slug' => [] ]  : array_reduce( $terms , function( $c, $v )
			{
				$c['name'][] = $v->name;
				return $c;
			});
	 	?>
		<div class="container">
			<h3><?php the_title(); ?></h3>
			<p><?php echo implode( ' ', $event_cat['name'] ) ?></p>
		</div>
		<svg version="1.2" baseProfile="tiny" id="title-path" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1517 180" xml:space="preserve">
			<path fill="#FFFFFF" d="M0,59c0,0,69.4,32.2,118,49c208,72,171.6,51.9,712.1,14.7C1350,80,1517,59,1517,59v121H0V59z"/>
		</svg>
	</div>
	<div id="content" class="site-content <?php printf('%s',$content_class);?>" style="background-image: url('<?php echo get_theme_file_uri( 'images/meta.png' ) ?>')" >
		<div id="meta-event" class="<?php echo esc_attr(primestudio_layout_settings()); ?>"><!-- container start-->
			<!--div class="<?php echo esc_attr($row_class); ?>"-->
				<?php primestudio_custom_breadcrumbs(); ?>
