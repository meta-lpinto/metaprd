<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package primestudio
 */

?>
				</div> <!-- #Row -->
			</div> <!-- container end -->
		</div><!-- #content -->
		<?php
			if(!primestudio_is_no_header_footer() && !is_404()) //not for landing template
	    	{
    ?>
		<footer id="colophon" class="site-footer">
				<?php do_action('primestudio_footer_block_action'); ?>
				<?php do_action('primestudio_copyright_block_action'); ?>
		</footer><!-- #colophon -->
		<?php
			}
		?>
</div><!-- #page -->
<div class="search-loader-wrapper">
	<div class="search-loader-backdrop"></div>
		<div class="search-loader-image">
			<form method="get" class="search-form" action="<?php echo esc_url( site_url( '/' ) ); ?>">
					<div class="search-box">
						<input type="search" class="search-field"  value="" name="s">
						<span class="search-close"><i class="fa fa-times" aria-hidden="true"></i></span>
					</div>
			</form>
	</div>
</div>
<?php
	if ( primestudio_get_option( 'footer-back-to-top' ) == 1 )
	{
?>
	<div class="scrollToTop">
	<i class="fa fa-fw fa-chevron-up"></i>
	</div>
<?php
	}
	wp_footer();
?>
</body>
</html>
