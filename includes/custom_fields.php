<?php


/**
 * Category thumbnail fields.
 */
function add_events_cat() 
{ ?>
	<div class="form-field term-position-wrap">
		<label><?php _e( 'Background Position', 'primestudio' ); ?></label>
		<select id="tribe_events_cat_position" name="tribe_events_cat_position" class="postform">
			<option value=""><?php _e( 'Default', 'woocommerce' ); ?></option>
			<option value="left top">Left Top</option>
			<option value="left center">Left Center</option>
			<option value="left bottom">Left Bottom</option>
			<option value="center top">Center Top</option>
			<option value="center">Center</option>
			<option value="center bottom">Center Bottom</option>
			<option value="right top">Right Top</option>
			<option value="right center">Right Center</option>
			<option value="right bottom">Right Bottom</option>
		</select>
	</div>
	<div class="form-field term-background-wrap">
		<label><?php _e( 'Background', 'primestudio' ); ?></label>
		<input type="text" id="tribe_events_cat_background" name="tribe_events_cat_background" class="color-field" />
	</div>
	<div class="form-field term-color-wrap">
		<label><?php _e( 'Text Color', 'primestudio' ); ?></label>
		<input type="text" id="tribe_events_cat_color" name="tribe_events_cat_color" class="color-field" />
	</div>
	<div class="form-field term-thumbnail-wrap">
		<label><?php _e( 'Thumbnail', 'primestudio' ); ?></label>
		<div id="tribe_events_cat_thumbnail" style="float: left; margin-right: 10px;">
			<img src="<?php echo get_stylesheet_directory_uri() . '/images/placeholder.png' ?>" width="60px" height="60px" />
		</div>
		<div style="line-height: 60px;">
			<input type="hidden" id="tribe_events_cat_thumbnail_id" name="tribe_events_cat_thumbnail_id" />
			<button type="button" class="upload_image_button button"><?php _e( 'Upload/Add image', 'primestudio' ); ?></button>
			<button type="button" class="remove_image_button button"><?php _e( 'Remove image', 'primestudio' ); ?></button>
		</div>
		<script type="text/javascript">

			// Only show the "remove image" button when needed
			if ( ! jQuery( '#tribe_events_cat_thumbnail_id' ).val() ) {
				jQuery( '.remove_image_button' ).hide();
			}

			// Uploading files
			var file_frame;

			jQuery( document ).on( 'click', '.upload_image_button', function( event ) {

				event.preventDefault();

				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					file_frame.open();
					return;
				}

				// Create the media frame.
				file_frame = wp.media.frames.downloadable_file = wp.media({
					title: '<?php _e( 'Choose an image', 'primestudio' ); ?>',
					button: {
						text: '<?php _e( 'Use image', 'primestudio' ); ?>'
					},
					multiple: false
				});

				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					var attachment           = file_frame.state().get( 'selection' ).first().toJSON();
					var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

					jQuery( '#tribe_events_cat_thumbnail_id' ).val( attachment.id );
					jQuery( '#tribe_events_cat_thumbnail' ).find( 'img' ).attr( 'src', attachment_thumbnail.url );
					jQuery( '.remove_image_button' ).show();
				});

				// Finally, open the modal.
				file_frame.open();
			});

			jQuery( document ).on( 'click', '.remove_image_button', function() {
				jQuery( '#tribe_events_cat_thumbnail' ).find( 'img' ).attr( 'src', '<?php echo esc_js( get_stylesheet_directory_uri() . '/images/placeholder.png' ); ?>' );
				jQuery( '#tribe_events_cat_thumbnail_id' ).val( '' );
				jQuery( '.remove_image_button' ).hide();
				return false;
			});

			jQuery( document ).ajaxComplete( function( event, request, options ) {
				if ( request && 4 === request.readyState && 200 === request.status
					&& options.data && 0 <= options.data.indexOf( 'action=add-tag' ) ) {

					var res = wpAjax.parseAjaxResponse( request.responseXML, 'ajax-response' );
					if ( ! res || res.errors ) {
						return;
					}
					// Clear Thumbnail fields on submit
					jQuery( '#tribe_events_cat_thumbnail' ).find( 'img' ).attr( 'src', '<?php echo esc_js( get_stylesheet_directory_uri() . '/images/placeholder.png' ); ?>' );
					jQuery( '#tribe_events_cat_thumbnail_id' ).val( '' );
					jQuery( '.remove_image_button' ).hide();
					// Clear Display type field on submit
					jQuery( '#display_type' ).val( '' );
					return;
				}
			} );

		</script>
		<div class="clear"></div>
	</div>
	<?php
}

/**
 * Edit category thumbnail field.
 *
 * @param mixed $term Term (category) being edited
 */
function edit_events_cat( $term )
{
	$background 	= get_term_meta( $term->term_id, 'background', true );
	$color 			= get_term_meta( $term->term_id, 'color', true );
	$thumbnail_id 	= get_term_meta( $term->term_id, 'thumbnail_id', true );

	$image = ( $thumbnail_id ) ? 
		 wp_get_attachment_thumb_url( absint( $thumbnail_id ) ) : get_theme_file_uri( '/images/placeholder.png' ) ;

	?>
	<tr class="form-field term-background-wrap">
		<th scope="row" valign="top">
			<label><?php _e( 'Background Position', 'primestudio' ); ?></label>
		</th>
		<td>
			<select id="tribe_events_cat_position" name="tribe_events_cat_position" class="postform">
				<option value=""><?php _e( 'Default', 'woocommerce' ); ?></option>
				<option value="left top">Left Top</option>
				<option value="left center">Left Center</option>
				<option value="left bottom">Left Bottom</option>
				<option value="center top">Center Top</option>
				<option value="center">Center</option>
				<option value="center bottom">Center Bottom</option>
				<option value="right top">Right Top</option>
				<option value="right center">Right Center</option>
				<option value="right bottom">Right Bottom</option>
			</select>
		</td>
	</tr>	
	<tr class="form-field term-background-wrap">
		<th scope="row" valign="top"><label><?php _e( 'Background', 'primestudio' ); ?></label></th>
		<td>
			<input type="text" class="color-field" id="tribe_events_cat_background" name="tribe_events_cat_background" value="<?php echo $background; ?>" />
		</td>
	</tr>
	<tr class="form-field term-color-wrap">
		<th scope="row" valign="top"><label><?php _e( 'Text Color', 'primestudio' ); ?></label></th>
		<td>
			<input type="text" id="tribe_events_cat_color" name="tribe_events_cat_color" class="color-field" value="<?php echo $color; ?>"/>
		</td>
	</tr>
	<tr class="form-field term-thumbnail-wrap">
		<th scope="row" valign="top"><label><?php _e( 'Thumbnail', 'primestudio' ); ?></label></th>
		<td>
			<div id="tribe_events_cat_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( $image ); ?>" width="60px" height="60px" /></div>
			<div style="line-height: 60px;">
				<input type="hidden" id="tribe_events_cat_thumbnail_id" name="tribe_events_cat_thumbnail_id" value="<?php echo $thumbnail_id; ?>" />
				<button type="button" class="upload_image_button button"><?php _e( 'Upload/Add image', 'primestudio' ); ?></button>
				<button type="button" class="remove_image_button button"><?php _e( 'Remove image', 'primestudio' ); ?></button>
			</div>
			<script type="text/javascript">

				// Only show the "remove image" button when needed
				if ( '0' === jQuery( '#tribe_events_cat_thumbnail_id' ).val() ) {
					jQuery( '.remove_image_button' ).hide();
				}

				// Uploading files
				var file_frame;

				jQuery( document ).on( 'click', '.upload_image_button', function( event ) {

					event.preventDefault();

					// If the media frame already exists, reopen it.
					if ( file_frame ) {
						file_frame.open();
						return;
					}

					// Create the media frame.
					file_frame = wp.media.frames.downloadable_file = wp.media({
						title: '<?php _e( 'Choose an image', 'primestudio' ); ?>',
						button: {
							text: '<?php _e( 'Use image', 'primestudio' ); ?>'
						},
						multiple: false
					});

					// When an image is selected, run a callback.
					file_frame.on( 'select', function() {
						var attachment           = file_frame.state().get( 'selection' ).first().toJSON();
						var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

						jQuery( '#tribe_events_cat_thumbnail_id' ).val( attachment.id );
						jQuery( '#tribe_events_cat_thumbnail' ).find( 'img' ).attr( 'src', attachment_thumbnail.url );
						jQuery( '.remove_image_button' ).show();
					});

					// Finally, open the modal.
					file_frame.open();
				});

				jQuery( document ).on( 'click', '.remove_image_button', function() {
					jQuery( '#tribe_events_cat_thumbnail' ).find( 'img' ).attr( 'src', '<?php echo esc_js( get_stylesheet_directory_uri() . '/images/placeholder.png' ); ?>' );
					jQuery( '#tribe_events_cat_thumbnail_id' ).val( '' );
					jQuery( '.remove_image_button' ).hide();
					return false;
				});

			</script>
			<div class="clear"></div>
		</td>
	</tr>
	<?php
}

/**
 * store_events_cat function.
 *
 * @param mixed  $term_id Term ID being saved
 * @param mixed  $tt_id
 */
function store_events_cat( $term_id, $tt_id = '' )
{
	add_term_meta( $term_id, 'background', 	 esc_attr( $_POST['tribe_events_cat_background'] ) );
	add_term_meta( $term_id, 'position', 	 esc_attr( $_POST['tribe_events_cat_position'] ) );
	add_term_meta( $term_id, 'color', 		 esc_attr( $_POST['tribe_events_cat_color'] ) );
	add_term_meta( $term_id, 'thumbnail_id', esc_attr( $_POST['tribe_events_cat_thumbnail_id'] ) );
}


/**
 * update_events_cat function.
 *
 * @param mixed  $term_id Term ID being saved
 * @param mixed  $tt_id
 */
function update_events_cat( $term_id, $tt_id = '' )
{
	update_term_meta( $term_id, 'background', 	esc_attr( $_POST['tribe_events_cat_background'] ) );
	update_term_meta( $term_id, 'position', 	esc_attr( $_POST['tribe_events_cat_position'] ) );
	update_term_meta( $term_id, 'color', 		esc_attr( $_POST['tribe_events_cat_color'] ) );
	update_term_meta( $term_id, 'thumbnail_id', esc_attr( $_POST['tribe_events_cat_thumbnail_id'] ) );
}

/**
 * Thumbnail column added to category admin.
 *
 * @param mixed $columns
 * @return array
 */
function events_cat_columns( $columns )
{
	$columns['thumb'] = __( 'Image', 'primestudio' );
	return $columns;
}

/**
 * Thumbnail column value added to category admin.
 *
 * @param string $columns
 * @param string $column
 * @param int    $id
 *
 * @return string
 */
function events_cat_column( $content, $column_name, $term_id )
{
	if ( 'thumb' === $column_name ) 
	{
		$thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true );

		$image = ( $thumbnail_id ) ? 
			wp_get_attachment_thumb_url( $thumbnail_id ) : get_theme_file_uri( '/images/placeholder.png' );

		$content ='<img src="' . esc_url( str_replace( ' ', '%20', $image ) ) . '" alt="' . esc_attr__( 'Thumbnail', 'primestudio' ) . '" class="wp-post-image" height="48" width="48" />';
	}
	return $content;
}

//Add forms
add_action( 'tribe_events_cat_edit_form_fields', 'edit_events_cat');
add_action( 'tribe_events_cat_add_form_fields',  'add_events_cat');

//Save values
add_action( 'created_tribe_events_cat', 'store_events_cat' );
add_action( 'edited_tribe_events_cat',  'update_events_cat' );

// Add columns
add_filter( 'manage_edit-tribe_events_cat_columns',  'events_cat_columns' );
add_filter( 'manage_tribe_events_cat_custom_column', 'events_cat_column', 10, 3 ); 

?>