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
?>
</head>
<body <?php body_class(); ?>>
<?php
	/****** LOADER OPTION STARTS ***/
	$row_class='row';
	if(primestudio_get_option('site-loader')==1)
	{
		printf(__('%s','primestudio'),primestudio_site_loader());
	}
	if ( class_exists( 'WooCommerce' ) )
	{
		if(!is_cart() && !is_checkout())
		{
			printf(__('%s','primestudio'),primestudio_side_cart());
		}
	}
	/****** LOADER OPTION ENDS ***/

?>

<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text hidden" href="#content"><?php esc_html_e( 'Skip to content', 'primestudio' ); ?></a>

		<?php
			$id = get_the_ID();
			if(is_singular('product')){
				$id  = get_post_meta(get_the_ID(),'_product_layout',true);
			}

			if(!primestudio_is_no_header_footer() && !is_404()){


		    	$header_class = '';
		    	if(get_post_meta($id,'_primestudio_overlap_header',true)){
		    		$header_class .= 'overlapped-header';
		    	}
		    	if(get_post_meta($id,'_primestudio_hanging_header',true)){
		    		$header_class .= ' hanging_header';
		    	}
    	?>
					<header id="masthead" class="site-header <?php echo esc_attr(primestudio_menu_class()); ?> <?php printf('%s',$header_class);?>" >
						<div class="<?php echo esc_attr(primestudio_layout_settings()); ?>"><!-- container start-->
								<?php do_action('primestudio_header_block_action'); ?>
						</div> <!-- container end -->
					</header><!-- #masthead -->
		<?php
			}


			//check remove padding of content
			$id = get_the_ID();
			
			$content_class = '';
			if( get_post_meta( $id, '_primestudio_page_remove_top_bottom_padding',true) || 
				get_post_meta( $id, '_primestudio_post_remove_top_bottom_padding',true)){
				$content_class = 'remove-padding';
			}
		?>

<div id="content" class="site-content <?php printf('%s',$content_class);?>">
	<div class="<?php echo esc_attr(primestudio_layout_settings()); ?>"><!-- container start-->
		<div class="<?php echo esc_attr($row_class); ?>">
		<?php
					if (function_exists('primestudio_custom_breadcrumbs'))
					{
							primestudio_custom_breadcrumbs();
					}
		?>
