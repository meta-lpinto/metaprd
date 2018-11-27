<?php

		/**
		 * For full documentation, please visit: http://docs.reduxframework.com/
		 * For a more extensive sample-config file, you may look at:
		 * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
		 */

		if ( ! class_exists( 'Redux' ) ) {
			return;
		}

		// This is your option name where all the Redux data is stored.
		$opt_name = "theme_options";
		//if changed please change the same in admin/redux-extensions/extensions-init.php

		/**
		 * ---> SET ARGUMENTS
		 * All the possible arguments for Redux.
		 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
		 * */

		$theme = wp_get_theme(); // For use with some settings. Not necessary.
		$inc_assets = get_template_directory_uri().'/inc/assets';
		$inc_images = $inc_assets . '/images/';

		$args = array(
			'opt_name' => 'theme_options',
			'footer_credit'  => '0effortthemes Options panel v1',
			'use_cdn' => false,
			'display_name' => '<div class="option_panel_class"><img src="'.get_template_directory_uri().'/images/theme-option-logo.png"></div><div class="text-left">'.esc_html__('Theme Options','primestudio').'</div>',
			'display_version' => $theme->get('Version') ,
			'page_title' => 'Theme Options Panel',
			'update_notice' => TRUE,
			'admin_bar' => TRUE,
			'menu_type' => 'menu',
			'menu_title' => 'Theme Options',
			'allow_sub_menu' => TRUE,
			'page_parent_post_type' => 'your_post_type',
			'default_mark' => '*',
			'customizer' => true,
				// Options need to true for developer
			'dev_mode' => false,
			'show_options_object' => false,
				//
			'hints' => array(
				'icon_position' => 'right',
				'icon_size' => 'normal',
				'tip_style' => array(
					'color' => 'light',
				),
				'tip_position' => array(
					'my' => 'top left',
					'at' => 'bottom right',
				),
				'tip_effect' => array(
					'show' => array(
						'duration' => '500',
						'event' => 'mouseover',
					),
					'hide' => array(
						'duration' => '500',
						'event' => 'mouseleave unfocus',
					),
				),
			),
			'output' => TRUE,
			'output_tag' => TRUE,
			'settings_api' => TRUE,
			'cdn_check_time' => '1440',
			'compiler' => TRUE,
			'page_permissions' => 'manage_options',
			'page_slug'            => 'theme_options',
			'save_defaults' => TRUE,
			'show_import_export' => TRUE,
			'database' => 'options',
			'transient_time' => '3600',
			'network_sites' => TRUE,
		);


		Redux::setArgs( $opt_name, $args );



		/*
		 *
		 * ---> START SECTIONS
		 *
		 */


		/****************  GENERAL SETTINGS STARTS *******/
		Redux::setSection( $opt_name, array(
			'title'  => esc_html__( 'General Settings', 'primestudio' ),
			'id'     => 'general-settings',
			'icon'   => 'el el-cog',
		) );

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__( 'Site Options', 'primestudio' ),
			'id'         => 'site-layout-section',
			'icon'       => 'el-icon-list',
			'subsection'=> true,
			'fields'     => array(

				array(
					'id'        => 'layout-settings',
					'type'      => 'button_set',
					'title'     => esc_html__('Layout', 'primestudio'),
					'options' => array(
						'1' => 'Full Width',
						'2' => 'Default Width',
						'3' => 'Box Layout'
					),
					'default'   => 2
				),
				array(
					'id'        => 'default-width-start',
					'type'      => 'section',
					'title'     => esc_html__('Default Layout Settngs', 'primestudio'),
					'indent'    => true,
					'required'  => array('layout-settings', "=", 2),
				),

				array(
					'id' => 'default-layout-content-width',
					'type' => 'slider',
					'title' => esc_html__('Container Width', 'primestudio'),
					"default" => 1170,
					"min" => 960,
					"step" => 10,
					"max" => 1200,
					'display_value' => 'text'
				),


				array(
					'id'        => 'default-width-end',
					'type'      => 'section',
					'indent'    => false,
					'required'  => array('layout-settings', "=", 2),
				),
				array(
					'id'        => 'box-width-start',
					'type'      => 'section',
					'title'     => esc_html__('Box Layout Settngs', 'primestudio'),
					'indent'    => true,
					'required'  => array('layout-settings', "=", 3),
				),

				array(
					'id' => 'box-layout-content-width',
					'type' => 'slider',
					'title' => esc_html__('Container Width', 'primestudio'),
					"default" => 1170,
					"min" => 960,
					"step" => 50,
					"max" => 1200,
					'display_value' => 'text'
				),


				array(
					'id'        => 'box-width-end',
					'type'      => 'section',
					'indent'    => false,
					'required'  => array('layout-settings', "=", 3),
				),

				

				array(
					'id' => 'opt-searchoption-switch',
					'type' => 'switch',
					'title' => esc_html__('Search', 'primestudio'),
					'subtitle' => esc_html__('Add search option to menu.[ Only Appear if Primary Menu is set ]', 'primestudio'),
					'on' => 'Enable',
					'off' => 'Disable',
				),
				array(
					'id'        => 'opt-breadcrumb',
					'type' => 'switch',
					'title'     => esc_html__('Breadcrumb in Pages and Posts', 'primestudio'),
					'subtitle'  => esc_html__('can be overriden by page and post settings', 'primestudio'),
					'on' => 'Enable',
					'off' => 'Disable',
					'default'   => 0
				),
				array(
					'id'        => 'site-loader',
					'type'      => 'switch',
					'title'     => esc_html__('Site Loader', 'primestudio'),
					'on'       => 'Yes',
					'off'        => 'No',
					'default'   => 0
				),
				array(
					'id'        => 'site-loader-start',
					'type'      => 'section',
					'title'     => esc_html__('Site Loader Settings', 'primestudio'),
					'indent'    => true,
					'required'  => array('site-loader', "=", 1),
				),
				array(
					'id'        => 'site-loader-bgcolor',
					'type'      => 'color',
					'title'     => esc_html__('Loader Background Color', 'primestudio'),
					'default'  => '#000000',
					'validate' => 'color',
					'transparent'=>false,
				),
				
				array(
					'id'       => 'site-loader-type',
					'type'     => 'button_set',
					'options' => array(
						'1' => 'Predefined CSS Loader',
						'2' => 'Image Loader',
						'3' => 'Custom Loader Code'
					),
					'default' => 1,
				),

				array(
					'id'        => 'site-loader-css',
					'type'      => 'select',
					'title'     => esc_html__('Predefined CSS Loader', 'primestudio'),
					'subtitle'  => esc_html__('All Css loader has been taken fron Spinkit', 'primestudio'),
					'options'   => array(
						'1' => 'Rotate Plane',
						'2' =>'Single Bounce',
						'3' => 'Double Bounce',
						'4' => 'Rectangle',
						'5'=>'Cube',
						'6'=>'Cube Grid',
						'7'=>'Cube Folding',
						'8'=>'Scaleout',
					),
					'default' => 1,
					'required'  => array('site-loader-type', "=", '1'),
				),
				array(
					'id'        => 'site-loader-fgcolor',
					'type'      => 'color',
					'title'     => esc_html__('Loader Foreground Color', 'primestudio'),
					'default'  => '#ffffff',
					'validate' => 'color',
					'transparent'=>false,
					'required'  => array('site-loader-type', "=", '1'),
				),
				array(
					'id'       => 'site-loader-image',
					'type'     => 'media',
					'url'      => true,
					'title'    => esc_html__('Site Loader Image', 'primestudio'),
					'required'  => array('site-loader-type', "=", '2'),
				),

				array(
					'id'        => 'site-loader-custom-css',
					'type'      => 'ace_editor',
					'title'     => esc_html__('Custom CSS Code for Loader', 'primestudio'),
					'subtitle'  => esc_html__('Paste your CSS code here.', 'primestudio'),
					'mode'      => 'css',
					'theme'     => 'monokai',
					'required'  => array('site-loader-type', "=", '3'),
				),
				array(
					'id'        => 'site-loader-custom-html',
					'type'      => 'textarea',
					'title'     => esc_html__('Custom HTML Code for Loader', 'primestudio'),
					'subtitle'  => esc_html__('Paste your HTML code here.', 'primestudio'),
					'required'  => array('site-loader-type', "=", '3'),
				),

				array(
					'id'        => 'site-loader-end',
					'type'      => 'section',
					'indent'    => false,
					'required'  => array('site-loader', "=", 1),
				),

			),

));


Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Logo', 'primestudio' ),
	'desc'  => 'Can be overriden by page settings',
	'id'         => 'logo-section',
	'icon'       => 'el-icon-list',
	'subsection'=> true,
	'fields'     => array(

		array(
			'id'        => 'logo-settings',
			'type'      => 'switch',
			'title'     => esc_html__('Logo Options', 'primestudio'),
			'on'       => 'Image Logo',
			'off'        => 'Text Logo',
			'default'   => 1
		),
		array(
			'id'        => 'logo-image-start',
			'type'      => 'section',
			'title'     => esc_html__('Image Logo', 'primestudio'),
			'indent'    => true,
			'required'  => array('logo-settings', "=", 1),
		),
		array(
			'id'       => 'opt-main-logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__('Logo', 'primestudio'),
		),
		array(
			'id'       => 'opt-retina-main-logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__('Retina Logo', 'primestudio'),
		),

		array(
			'id'        => 'mobile-logo-settings',
			'type'      => 'switch',
			'title'     => esc_html__('Show Logo in Mobile', 'primestudio'),
			'on'       => 'Show',
			'off'        => 'Hide',
			'default'   => 1
		),

		array(
			'id'        => 'mobile-logo-start',
			'type'      => 'section',
			'indent'    => true,
			'required'  => array(array('logo-settings', "=", 1),array('mobile-logo-settings', "=", 1)),
		),
		array(
			'id'    => 'opt-mobile-logo',
			'type'  => 'media',
			'url'      => true,
			'indent'    => true,
			'title' => esc_html__('Mobile Logo', 'primestudio'),
		),
		array(
			'id'        => 'mobile-logo-end',
			'type'      => 'section',
			'indent'    => false,
			'required'  => array(array('logo-settings', "=", 1),array('mobile-logo-settings', "=", 1)),
		),

		array(
			'id'        => 'logo-image-end',
			'type'      => 'section',
			'indent'    => false,
			'required'  => array('logo-settings', "=", 1),
		),
		array(
			'id'        => 'logo-text-start',
			'type'      => 'section',
			'title'     => esc_html__('Text Logo', 'primestudio'),
			'indent'    => true,
			'required'  => array('logo-settings', "=", 0),
		),
		array(
			'id'       => 'opt-text-main-logo',
			'type'     => 'text',
			'default'  => get_bloginfo('name'),
			'title'    => esc_html__('Text', 'primestudio'),
		),
		array(
			'id'          => 'logo-text-style',
			'type'        => 'typography',
			'title'       => esc_html__('Text Logo Font styles', 'primestudio'),
			'google'      => true,
			'font-backup' => true,
			'line-height' => false,
			'units'       =>'px',
			'preview'     => true,
			'text-align'  => false,
			'color'       => true,
		),
		array(
			'id'        => 'logo-text-end',
			'type'      => 'section',
			'indent'    => false,
			'required'  => array('logo-settings', "=", 0),
		),
	)
));
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Favicon', 'primestudio' ),
	'id'         => 'favicon-section',
	'icon'       => 'el-icon-list',
	'subsection'=> true,
	'fields'     => array(

		array(
			'id'       => 'opt-main-favicon',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__('Favicon', 'primestudio'),
			'desc'     => esc_html__('favicon.ico 32x32 pixels', 'primestudio'),
		),
		array(
			'id'       => 'opt-main-appletuch-favicon',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__('Apple Touch Icon', 'primestudio'),
			'desc'     => esc_html__('apple-touch-icon.png 180x180 pixels', 'primestudio'),
		),
	),

));

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Pagination', 'primestudio' ),
	'desc'			=> esc_html__('only for blog and archive pages','primestudio'),
	'id'         => 'pagination-section',
	'icon'       => 'el-icon-list',
	'subsection'=> true,
	'fields'     => array(

		array(
			'id'        => 'opt-pagination-style',
			'type'      => 'image_select',
			'title'     => esc_html__('Pagination Types', 'primestudio'),
			'desc'			=> esc_html__('WooCommerce pagination will be same if Option 1 or 2 is selected','primestudio'),
			'options'   => array(
				'1' => array('alt' => 'Default Pagination',   'title' => 'Default Pagination',     'img' =>get_template_directory_uri() . '/images/pagination/default.jpg'),
				'5' => array('alt' => 'Shapes',   'title' => 'Shapes',     'img' => get_template_directory_uri() . '/images/pagination/shapes.jpg'),
				'2' => array('alt' => 'Old Style Pagination',   'title' => 'Old Style Pagination',     'img' => get_template_directory_uri() . '/images/pagination/02.jpg'),
				'3' => array('alt' => 'Load More..',   'title' => 'Load More..',     'img' => get_template_directory_uri() . '/images/pagination/03.jpg'),
				'4' => array('alt' => 'Unlimited Scroll',   'title' => 'Unlimited Scroll',     'img' => get_template_directory_uri() . '/images/pagination/04.jpg'),
			),
			'default'   => '1'
		),
		array(
			'id'        => 'load-more-start',
			'type'      => 'section',
			'title'     => esc_html__('Pagination Styles', 'primestudio'),
			'indent'    => true,
		),
		array(
			'id'            => 'load-more-typography',
			'type'          => 'typography',
			'title'         => esc_html__('Font Styles and Size', 'primestudio'),
															//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
															'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
															//'font-backup'   => true,    // Select a backup non-google font in addition to a google font
															'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
															'subsets'       => false, // Only appears if google is true and subsets not set to false
															'font-size'     => true,
															'line-height'   => false,
															'text-align'=>false,
															'color'=>false,
															'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
															'compiler'      => array('.load-more-text,.pagination-style-2 a,span.page-numbers,a.page-numbers'), // An array of CSS selectors to apply this font style to dynamically
															'units'         => 'px', // Defaults to px
															'required'  => array('opt-pagination-style', "!=", 5),
														),
		array(
			'id'   => 'pagination-font-color',
			'type' => 'color',
			'title' => esc_html__('Pagination Font Color','primestudio'),
			'transparent' => false,
			'default'  => '#ffffff',
		),
		array(
			'id'   => 'pagination-bg-color',
			'type' => 'color',
			'title' => esc_html__('Pagination Backgorund Color','primestudio'),
			'transparent' => false,
			'default'  => '#f58752',
		),
		array(
			'id'   => 'pagination-hover-font-color',
			'type' => 'color',
			'title' => esc_html__('Pagination Hover Font Color','primestudio'),
			'transparent' => false,
			'default'  => '#f58752',
			'required'  => array('opt-pagination-style', "!=", array(5)),
		),
		array(
			'id'   => 'pagination-hover-bg-color',
			'type' => 'color',
			'title' => esc_html__('Pagination Hover Backgorund Color','primestudio'),
			'transparent' => false,
			'default'  => '#ffffff',
		),
		/*******  ACTIVE PAGE COLOR STARTS ****/
		array(
			'id'   => 'active-font-color',
			'type' => 'color',
			'title' => esc_html__('Active Page Font Color','primestudio'),
			'transparent' => false,
			'default'  => '#f58752',
			'required'  => array('opt-pagination-style', "=", array(1)),
		),
		array(
			'id'   => 'active-bg-color',
			'type' => 'color',
			'title' => esc_html__('Active Page Backgorund Color','primestudio'),
			'transparent' => false,
			'default'  => '#ffffff',
			'required'  => array('opt-pagination-style', "=", array(1,5)),
		),
		array(
			'id'   => 'active-hover-font-color',
			'type' => 'color',
			'title' => esc_html__('Active Page Hover Font Color','primestudio'),
			'transparent' => false,
			'default'  => '#f58752',
			'required'  => array('opt-pagination-style', "=", array(1)),
		),
		array(
			'id'   => 'active-hover-bg-color',
			'type' => 'color',
			'title' => esc_html__('Active Page Hover Background Color','primestudio'),
			'transparent' => false,
			'default'  => '#ffffff',
			'required'  => array('opt-pagination-style', "=", array(1,5)),
		),
		/*******  ACTIVE PAGE COLOR STARTS ****/
		array(
			'id'        => 'load-more-text',
			'type'      => 'text',
			'title'     => esc_html__('Load More Text', 'primestudio'),
			'default'		=> esc_html__('Load More..','primestudio'),
			'desc'			=> esc_html__('Only "i" tag and class attribute are allowed with texts','primestudio'),
			'required'  => array('opt-pagination-style', "=", 3),
		),
		/***** ONLY FOR SHAPES STARTS****/
		array(
			'id'       => 'shapes-choices',
			'type'     => 'select',
			'title'    => esc_html__('Shape Options', 'primestudio'),
			'desc'     => esc_html__('shape option to shown as pagination shapes', 'primestudio'),
			'options'  => array(
				'1' => 'Circle',
				'2' => 'Square',
			),
			'default'=>'1',
			'required'  => array('opt-pagination-style', "=", 5),
		),
		array(
			'id'        => 'shapes-more-text',
			'type'      => 'text',
			'title'     => esc_html__('Text with shapes', 'primestudio'),
			'default'		=> esc_html__('View more posts <i class="fa fa-long-arrow-right"></i>','primestudio'),
			'desc'			=> esc_html__('Only "i" tag and class attribute are allowed with texts','primestudio'),
			'required'  => array('opt-pagination-style', "=", 5),
		),
		/***** ONLY FOR SHAPES ENDS****/

		/****** FOR NUMERIC PAGINATION STARTS*****/
		array(
			'id'        => 'prev-text',
			'type'      => 'text',
			'title'     => esc_html__('Prev Text', 'primestudio'),
			'default'		=> esc_html__('Previous','primestudio'),
			'desc'			=> esc_html__('Only "i" tag and class attribute are allowed with texts','primestudio'),
			'required'  => array('opt-pagination-style', "=", 1),
		),
		array(
			'id'        => 'next-text',
			'type'      => 'text',
			'title'     => esc_html__('Next Text', 'primestudio'),
			'default'		=> esc_html__('Next','primestudio'),
			'desc'			=> esc_html__('Only "i" tag and class attribute are allowed with texts','primestudio'),
			'required'  => array('opt-pagination-style', "=", 1),
		),
		array(
			'id'   => 'prevnext-fg-color',
			'type' => 'color',
			'title' => esc_html__('Previous Next Font Color','primestudio'),
			'transparent' => false,
			'default'  => '#f58752',
			'required'  => array('opt-pagination-style', "=", 1),
		),
		array(
			'id'   => 'prevnext-bg-color',
			'type' => 'color',
			'title' => esc_html__('Previous Next Background Color','primestudio'),
			'transparent' => false,
			'default'  => '#ffffff',
			'required'  => array('opt-pagination-style', "=", 1),
		),
		/****** FOR NUMERIC PAGINATION END*****/

		array(
			'id'        => 'older-text',
			'type'      => 'text',
			'title'     => esc_html__('Older Posts Text', 'primestudio'),
			'default'		=> esc_html__('Older Entries','primestudio'),
			'desc'			=> esc_html__('Only "i" tag and class attribute are allowed with texts','primestudio'),
			'required'  => array('opt-pagination-style', "=", 2),
		),
		array(
			'id'        => 'newer-text',
			'type'      => 'text',
			'title'     => esc_html__('Newer Posts Text', 'primestudio'),
			'default'		=> esc_html__('Newer Entries','primestudio'),
			'desc'			=> esc_html__('Only "i" tag and class attribute are allowed with texts','primestudio'),
			'required'  => array('opt-pagination-style', "=", 2),
		),
		array(
			'id'        => 'load-more-end',
			'type'      => 'section',
			'indent'    => false,
		),
	),

));


if(count(primestudio_available_languages())>1)
{
	Redux::setSection( $opt_name, array(
		'title'      => esc_html__( 'Languages', 'primestudio' ),
		'id'         => 'available-language',
		'icon'       => 'el-icon-list',
		'subsection'=> true,
		'fields'     => array(
			primestudio_languages_dropdown('site-lang'),
		),

	));
}


Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Widget Area', 'primestudio' ),
	'id'         => 'widget-area',
	'icon'       => 'el-icon-list',
	'subsection'=> true,
	'fields'     => array(
		array(
			'id'       => 'opt-widget-area',
			'type'     => 'multi_text',
			'title'    => esc_html__( 'Widget Area', 'primestudio' ),
			'subtitle' => esc_html__( 'Add widget areas name', 'primestudio' ),
			'validate' => 'unique_slug',
			'add_text' => esc_html__('Add New Widget Area','primestudio'),

		),
	),

));




/****************  GENERAL SETTINGS ENDS *******/



/****** FONT AND STYILING STARTS *****/
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Fonts & Styling', 'primestudio' ),
	'id'         => 'section-styling-settings',
	'icon'       => 'el-icon-fontsize',
	'fields'     => array(

		array(
			'id'            => 'opt-typography-h1',
			'type'          => 'typography',
			'title'         => esc_html__('H1 Font, size and color', 'primestudio'),
							'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
							'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
							'subsets'       => false, // Only appears if google is true and subsets not set to false
							'line-height'   => false,
							'text-align'=>false,
							'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
							'output'        => array('h2.site-description, .entry-title'), // An array of CSS selectors to apply this font style to dynamically
							'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
							'units'         => 'px', // Defaults to px
							'subtitle'      => esc_html__('Typography option with each property can be called individually.', 'primestudio'),

						),


		array(
			'id'            => 'opt-typography-h2',
			'type'          => 'typography',
			'title'         => esc_html__('H2 Font, size and color', 'primestudio'),
							'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
							'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
							'subsets'       => false, // Only appears if google is true and subsets not set to false
							'line-height'   => false,
							'text-align'=>false,
							'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
							'output'        => array('h2'), // An array of CSS selectors to apply this font style to dynamically
							'compiler'      => array('h2'), // An array of CSS selectors to apply this font style to dynamically
							'units'         => 'px', // Defaults to px
							'subtitle'      => esc_html__('Typography option with each property can be called individually.', 'primestudio'),

						),

		array(
			'id'            => 'opt-typography-h3',
			'type'          => 'typography',
			'title'         => esc_html__('H3 Font, size and color', 'primestudio'),
							'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
							'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
							'subsets'       => false, // Only appears if google is true and subsets not set to false
							'line-height'   => false,
							'text-align'=>false,
							'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
							'output'        => array('h3.site-description, .entry-title'), // An array of CSS selectors to apply this font style to dynamically
							'compiler'      => array('h3.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
							'units'         => 'px', // Defaults to px
							'subtitle'      => esc_html__('Typography option with each property can be called individually.', 'primestudio'),

						),

		array(
			'id'            => 'opt-typography-h4',
			'type'          => 'typography',
			'title'         => esc_html__('H4 Font, size and color', 'primestudio'),
							'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
							'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
							'subsets'       => false, // Only appears if google is true and subsets not set to false
							'line-height'   => false,
							'text-align'=>false,
							'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
							'output'        => array('h4.site-description, .entry-title'), // An array of CSS selectors to apply this font style to dynamically
							'compiler'      => array('h4.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
							'units'         => 'px', // Defaults to px
							'subtitle'      => esc_html__('Typography option with each property can be called individually.', 'primestudio'),

						),

		array(
			'id'            => 'opt-typography-h5',
			'type'          => 'typography',
			'title'         => esc_html__('H5 Font, size and color', 'primestudio'),
							'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
							'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
							'subsets'       => false, // Only appears if google is true and subsets not set to false
							'line-height'   => false,
							'text-align'=>false,
							'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
							'output'        => array('h5.site-description, .entry-title'), // An array of CSS selectors to apply this font style to dynamically
							'compiler'      => array('h5.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
							'units'         => 'px', // Defaults to px
							'subtitle'      => esc_html__('Typography option with each property can be called individually.', 'primestudio'),

						),
		array(
			'id'            => 'opt-typography-h6',
			'type'          => 'typography',
			'title'         => esc_html__('H6 Font, size and color', 'primestudio'),
							'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
							'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
							'subsets'       => false, // Only appears if google is true and subsets not set to false
							'line-height'   => false,
							'text-align'=>false,
							'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
							'output'        => array('h6.site-description, .entry-title'), // An array of CSS selectors to apply this font style to dynamically
							'compiler'      => array('h6.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
							'units'         => 'px', // Defaults to px
							'subtitle'      => esc_html__('Typography option with each property can be called individually.', 'primestudio'),

						),
	)
) );
/****** FONT AND STYILING ENDS *****/


/******** Social Link Starts Here  *******/


Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'Social Links', 'primestudio' ),
	'id'    => 'section-sociallinks-settings',
	'icon'  => 'el el-icon-link',
	'desc'  => 'has been used for specific purpose in vc extensions',
	'fields'=> array(

		/***** Social Media One Starts HERE **/

		array(
			'id'        => 'social-media-one-checkbox',
			'type'      => 'switch',
			'title'     => esc_html__('Social Media One', 'primestudio'),

		),
		array(
			'id'        => 'social-media-one-start',
			'type'      => 'section',
			'title'     => esc_html__('Social One', 'primestudio'),
						'indent'    => true, // Indent all options below until the next 'section' option is set.
						'required'  => array('social-media-one-checkbox', "=", 1),
					),
		array(
			'id'        => 'social-one-text',
			'type'      => 'text',
			'title'     => esc_html__('Social One Title', 'primestudio'),
			'desc'      => esc_html__('Please enter the title for Social One', 'primestudio'),
		),
		array(
			'id'        => 'social-one-url',
			'type'      => 'text',
			'title'     => esc_html__('Social One URL', 'primestudio'),
			'desc'      => esc_html__('Please enter your social one page', 'primestudio'),
			'validate'  => 'url',
		),
		array(
			'id'        => 'social-one-icon',
			'type'      => 'select',
			'title'     => esc_html__('Social Icons', 'primestudio'),
			'subtitle'  => esc_html__('Selected Icon will be shown in called sections', 'primestudio'),
			'class'    => ' font-icons',
			'placeholder'=>esc_html__('Select Social Icon','primestudio'),
			'options'   => primestudio_socialIconsArray(),
		),
		array(
			'id'        => 'social-media-one-end',
			'type'      => 'section',
						'indent'    => false, // Indent all options below until the next 'section' option is set.
						'required'  => array('social-media-one-checkbox', "=", 1),
					),
		array(
			'id'        => 'social-media-two-checkbox',
			'type'      => 'switch',
			'title'     => esc_html__('Social Media Two', 'primestudio'),
		),
		array(
			'id'        => 'social-media-two-start',
			'type'      => 'section',
			'title'     => esc_html__('Social Two', 'primestudio'),
						'indent'    => true, // Indent all options below until the next 'section' option is set.
						'required'  => array('social-media-two-checkbox', "=", 1),
					),
		array(
			'id'        => 'social-two-text',
			'type'      => 'text',
			'title'     => esc_html__('Social Two Title', 'primestudio'),
			'desc'      => esc_html__('Please enter the title for Social Two', 'primestudio'),
		),
		array(
			'id'        => 'social-two-url',
			'type'      => 'text',
			'title'     => esc_html__('Social Two URL', 'primestudio'),
			'desc'      => esc_html__('Please enter your social two page', 'primestudio'),
			'validate'  => 'url',
		),
		array(
			'id'        => 'social-two-icon',
			'type'      => 'select',
			'title'     => esc_html__('Social Icons', 'primestudio'),
			'subtitle'  => esc_html__('Selected Icon will be shown in called sections', 'primestudio'),
			'class'    => ' font-icons fa',
			'placeholder'=>'Select Social Icon',
			'options'   => primestudio_socialIconsArray(),
		),
		array(
			'id'        => 'social-media-two-end',
			'type'      => 'section',
						'indent'    => false, // Indent all options below until the next 'section' option is set.
						'required'  => array('social-media-two-checkbox', "=", 1),
					),
		array(
			'id'        => 'social-media-three-checkbox',
			'type'      => 'switch',
			'title'     => esc_html__('Social Media Three', 'primestudio'),

		),
		array(
			'id'        => 'social-media-three-start',
			'type'      => 'section',
			'title'     => esc_html__('Social Three', 'primestudio'),
						'indent'    => true, // Indent all options below until the next 'section' option is set.
						'required'  => array('social-media-three-checkbox', "=", 1),
					),
		array(
			'id'        => 'social-three-text',
			'type'      => 'text',
			'title'     => esc_html__('Social Three Title', 'primestudio'),
			'desc'      => esc_html__('Please enter the title for Social Three', 'primestudio'),
		),
		array(
			'id'        => 'social-three-url',
			'type'      => 'text',
			'title'     => esc_html__('Social Three URL', 'primestudio'),
			'desc'      => esc_html__('Please enter your social three page', 'primestudio'),
			'validate'  => 'url',
		),
		array(
			'id'        => 'social-three-icon',
			'type'      => 'select',
			'title'     => esc_html__('Social Icons', 'primestudio'),
			'subtitle'  => esc_html__('Selected Icon will be shown in called sections', 'primestudio'),
			'class'    => ' font-icons fa',
			'placeholder'=>'Select Social Icon',
			'options'   => primestudio_socialIconsArray(),
		),
		array(
			'id'        => 'social-media-three-end',
			'type'      => 'section',
						'indent'    => false, // Indent all options below until the next 'section' option is set.
						'required'  => array('social-media-three-checkbox', "=", 1),
					),
		array(
			'id'        => 'social-media-four-checkbox',
			'type'      => 'switch',
			'title'     => esc_html__('Social Media Four', 'primestudio'),
		),
		array(
			'id'        => 'social-media-four-start',
			'type'      => 'section',
			'title'     => esc_html__('Social Four', 'primestudio'),
						'indent'    => true, // Indent all options below until the next 'section' option is set.
						'required'  => array('social-media-four-checkbox', "=", 1),
					),
		array(
			'id'        => 'social-four-text',
			'type'      => 'text',
			'title'     => esc_html__('Social Four Title', 'primestudio'),
			'desc'      => esc_html__('Please enter the title for Social Four', 'primestudio'),
		),
		array(
			'id'        => 'social-four-url',
			'type'      => 'text',
			'title'     => esc_html__('Social Four URL', 'primestudio'),
			'desc'      => esc_html__('Please enter your social three page', 'primestudio'),
			'validate'  => 'url',
		),
		array(
			'id'        => 'social-four-icon',
			'type'      => 'select',
			'title'     => esc_html__('Social Icons', 'primestudio'),
			'subtitle'  => esc_html__('Selected Icon will be shown in called sections', 'primestudio'),
			'class'    => ' font-icons fa',
			'placeholder'=>'Select Social Icon',
			'options'   => primestudio_socialIconsArray(),
		),
		array(
			'id'        => 'social-media-four-end',
			'type'      => 'section',
						'indent'    => false, // Indent all options below until the next 'section' option is set.
						'required'  => array('social-media-four-checkbox', "=", 1),
					),

		array(
			'id'        => 'social-media-five-checkbox',
			'type'      => 'switch',
			'title'     => esc_html__('Social Media Five', 'primestudio'),
		),
		array(
			'id'        => 'social-media-five-start',
			'type'      => 'section',
			'title'     => esc_html__('Social Five', 'primestudio'),
						'indent'    => true, // Indent all options below until the next 'section' option is set.
						'required'  => array('social-media-five-checkbox', "=", 1),
					),
		array(
			'id'        => 'social-five-text',
			'type'      => 'text',
			'title'     => esc_html__('Social Five Title', 'primestudio'),
			'desc'      => esc_html__('Please enter the title for Social five', 'primestudio'),
		),
		array(
			'id'        => 'social-five-url',
			'type'      => 'text',
			'title'     => esc_html__('Social Five URL', 'primestudio'),
			'desc'      => esc_html__('Please enter your social three page', 'primestudio'),
			'validate'  => 'url',
		),
		array(
			'id'        => 'social-five-icon',
			'type'      => 'select',
			'title'     => esc_html__('Social Icons', 'primestudio'),
			'subtitle'  => esc_html__('Selected Icon will be shown in called sections', 'primestudio'),
			'class'    => ' font-icons fa',
			'placeholder'=>'Select Social Icon',
			'options'   => primestudio_socialIconsArray(),
		),
		array(
			'id'        => 'social-media-five-end',
			'type'      => 'section',
						'indent'    => false, // Indent all options below until the next 'section' option is set.
						'required'  => array('social-media-five-checkbox', "=", 1),
					),

		array(
			'id'        => 'social-media-six-checkbox',
			'type'      => 'switch',
			'title'     => esc_html__('Social Media Six', 'primestudio'),
		),
		array(
			'id'        => 'social-media-six-start',
			'type'      => 'section',
			'title'     => esc_html__('Social Six', 'primestudio'),
						'indent'    => true, // Indent all options below until the next 'section' option is set.
						'required'  => array('social-media-six-checkbox', "=", 1),
					),
		array(
			'id'        => 'social-six-text',
			'type'      => 'text',
			'title'     => esc_html__('Social Six Title', 'primestudio'),
			'desc'      => esc_html__('Please enter the title for Social six', 'primestudio'),
		),
		array(
			'id'        => 'social-six-url',
			'type'      => 'text',
			'title'     => esc_html__('Social Six URL', 'primestudio'),
			'desc'      => esc_html__('Please enter your social three page', 'primestudio'),
			'validate'  => 'url',
		),
		array(
			'id'        => 'social-six-icon',
			'type'      => 'select',
			'title'     => esc_html__('Social Icons', 'primestudio'),
			'subtitle'  => esc_html__('Selected Icon will be shown in called sections', 'primestudio'),
			'class'    => ' font-icons fa',
			'placeholder'=>'Select Social Icon',
			'options'   => primestudio_socialIconsArray(),
		),
		array(
			'id'        => 'social-media-six-end',
			'type'      => 'section',
						'indent'    => false, // Indent all options below until the next 'section' option is set.
						'required'  => array('social-media-six-checkbox', "=", 1),
					),



	),
) );
/******* Social Links ends here ******/

/********  PAGE SETTINGS STARTS ********/
Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Page Settings', 'primestudio' ),
	'id'     => 'page-settings',
	'fields' => array(
		array(
			'id'       => 'opt-page-comments',
			'type'     => 'switch',
			'title'    => esc_html__('Page comments', 'primestudio'),
			'subtitle'  => esc_html__('it will override indiviual page settings', 'primestudio'),
			'default'  => 1,
		),
	),

) );

/********  PAGE SETTINGS ENDS ********/

/********* 404 Page Settings STARTS ******/
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( '404 Page Settings', 'primestudio' ),
	'id'         => 'fourofour-page-settings',
	'icon'       => 'el-icon-list',
	'fields'     => array(
		array(
			'id'       => 'banner-404-image',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__('Banner Image for 404', 'primestudio'),
		),
		
		array(
			'id'               => '404-page-text',
			'type'             => 'editor',
			'title'            => esc_html__('Page Text', 'primestudio'),
			'default'          => '<h2>Oops! That page can&rsquo;t be found.</h2>',
			'args'   => array(
				'media_buttons'    => true,
				'teeny'            => true,
				'textarea_rows'    => 10
			)
		),

	)
) );
/********* 404 Page Settings ENDS ******/
/*********  UNDER CONSTRUCTIONS STARTS *****/
Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Maintainance Mode', 'primestudio' ),
	'id'     => 'page-maintainance',
	'fields' => array(
		array(
			'id'       => 'opt-undercon-status',
			'type'     => 'switch',
			'title'    => esc_html__('Maintainance Mode', 'primestudio'),
			'default'  => 0,
		),

		array(
			'id'        => 'opt-undercon-status-start',
			'type'      => 'section',
			'title'     => esc_html__('Maintainance Mode Page Settings', 'primestudio'),
						'indent'    => true, // Indent all options below until the next 'section' option is set.
						'required'  => array('opt-undercon-status', "=", 1),
					),
		array(
			'id'        => 'under-construction-page-id',
			'type'      => 'select',
			'title'    => esc_html__('Maintainance Mode Page', 'primestudio'),
			'placeholder'=>esc_html__('Select Under Construction Page','primestudio'),
			'options'   => primestudio_page_list(0),
		),

		array(
			'id'        => 'opt-undercon-status-end',
			'type'      => 'section',
						'indent'    => false, // Indent all options below until the next 'section' option is set.
						'required'  => array('opt-undercon-status', "=", 1),
					),
	)
) );
/*********  UNDER CONSTRUCTIONS ENDS *****/

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Blog Page Settings', 'primestudio' ),
	'desc'  => esc_html__('Settings will be implemented to all blog and post related page like Archive, Tags, Category etc.','primestudio'),
	'id'         => 'blog-page-settings',
	'icon'       => 'el-icon-list',
	'fields'     => array(

		array(
			'id'        => 'opt-blog-page',
			'type'      => 'image_select',
			'title'     => esc_html__('Blog Page Options', 'primestudio'),
			'options'   => array(

				'1' => array('alt' => '4 Column',   'img' =>get_template_directory_uri() . '/inc/assets/images/blog-settings/four-column.png'),
				'2' => array('alt' => '3 Column',   'img' =>get_template_directory_uri() . '/inc/assets/images/blog-settings/three-columns.png'),
				'3' => array('alt' => '2 Column',  'img' =>get_template_directory_uri() . '/inc/assets/images/blog-settings/two-columns.png'),
				'4' => array('alt' => 'Grid View',  'img' =>get_template_directory_uri() . '/inc/assets/images/blog-settings/one-column.png'),
				'5' => array('alt' => 'Masonary 2 col',  'img' =>get_template_directory_uri() . '/inc/assets/images/blog-settings/masonry-2-cols.png'),
				'6' => array('alt' => 'Masonary 3 col',  'img' =>get_template_directory_uri() . '/inc/assets/images/blog-settings/masonry-3-cols.png'),
				'7' => array('alt' => 'Masonary 4 col',  'img' =>get_template_directory_uri() . '/inc/assets/images/blog-settings/masonry-4-cols.png'),
			),
			'default' => '6'
		),
		array(
			'id'        => 'blog-page-sidebar',
			'type'      => 'image_select',
			'title'     => esc_html__('Sidebar Options', 'primestudio'),
			'options'  => array(
				'1'=> array('alt'   => '1 Column','img'   => ReduxFramework::$_url.'assets/img/1col.png'),
				'2'=> array('alt'   => '2 Column Left','img'   => ReduxFramework::$_url.'assets/img/2cl.png'),
				'3'=> array('alt'   => '2 Column Right','img'  => ReduxFramework::$_url.'assets/img/2cr.png',	),
			),
			'default' => '1'
		),
		array(
			'id'        => 'blog-page-excerpt',
			'type'      => 'text',
			'title'     => esc_html__('Exerpt Length', 'primestudio'),
			'desc'      => esc_html__('Post Excerpt Length for listing only', 'primestudio'),
			'default'=>15,
		),
		array(
			'id'        => 'blog-page-exclude-cat',
			'type'      => 'text',
			'title'     => esc_html__('Exclude Category Ids', 'primestudio'),
			'desc'      => esc_html__('Exclude post from categories [ ids only with comma seprator ]', 'primestudio'),
		),
		array(
			'id'        => 'blog-page-read-more',
			'type'      => 'switch',
			'title'     => esc_html__('Read More Option', 'primestudio'),
			'default'		=> '1'
		),
		array(
			'id'        => 'blog-page-read-more-text',
			'type'      => 'text',
			'title'     => esc_html__('Read More Text', 'primestudio'),
			'default'		=> esc_html__('Read More..','primestudio'),
			'required'	=> array('blog-page-read-more','=','1'),
		),
		array(
			'id'        => 'blog-page-no-posts',
			'type'      => 'text',
			'title'     => esc_html__('No.of Posts per page', 'primestudio'),
			'subtitle'  => esc_html__('To control the structure depending on column', 'primestudio'),
			'desc'      => esc_html__('For all archive pages, set blank or 0 for default wordpress settings', 'primestudio'),
			'default' 	=> get_option('posts_per_page')
		),

	
		/*****************************************************/
		
											)
) );

/********* BLOG PAGE SETTINGS ENDS *******/
/********* HEADER SETTINGS STARTS *******/
Redux::setSection( $opt_name,array(
	'icon'      => ' el el-screen',
	'title'     => esc_html__('Header', 'primestudio'),
	'desc'  => esc_html__( 'Header Settings can be overridden by indiviual page. This option will work for the basic pages of wordpress like : Category, Single Posts etc.', 'primestudio' ),

	'fields'    => array(

		array(
			'id'        => 'opt-sticky-header',
			'type'      => 'switch',
			'title'     => esc_html__('Sticky Menu', 'primestudio'),
			'on'       => 'Yes',
			'off'        => 'No',
			'default'   =>0
		),

		array(
				'id'       => 'header-layout-options',
				'type'      => 'switch',
				'title'     => esc_html__('Header Layout Options', 'primestudio'),
				'on'       => 'Default Header',
				'off'        => 'VC Predefined',
				'default'   =>1
		),
		array(
				'id'        => 'header-section-start',
				'type'      => 'section',
				'title'     => esc_html__('&nbsp;', 'primestudio'),
				'indent'    => true,
				'required'  => array('header-layout-options', "=", 0),
		),
				primestudio_vc_reduxFooter('header-layout-options-vc','ze_chf_headers'),
		array(
				'id'        => 'header-section-end',
				'type'      => 'section',
				'title'     => esc_html__('&nbsp;', 'primestudio'),
				'indent'    => true,
				'required'  => array('header-layout-options', "=", 0),
		),

	),
));
/********* HEADER SETTINGS ENDS *******/

Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Footer', 'primestudio' ),
	'id'     => 'footer-settings',
	'icon'   => 'el el-cog',
) );
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'General Options', 'primestudio' ),
	'id'         => 'footer-back-settings-section',
	'icon'       => 'el-icon-list',
	'subsection'=> true,
	'fields'     => array(
		
		
		array(
			'id'    => 'footer-back-to-top',
			'type'      => 'switch',
			'title' => esc_html__('Back to Top', 'primestudio'),
			'default'=>1,
		),
		array(
			'id'        => 'backtotop-section-start',
			'type'      => 'section',
			'title'     => esc_html__('&nbsp;', 'primestudio'),
			'indent'    => true,
			'required'  => array('footer-back-to-top', "=", 1),
		),
		array(
			'id'        => 'backtotop-shape',
			'type'      => 'select',
			'title'     => esc_html__('Back to Top Background Shape', 'primestudio'),
			'options'   => array(
				'1' => 'Circle',
				'2' => 'Square',
			),
			'default' => 1,
		),
		array(
			'id'   => 'backtotop-background',
			'type' => 'color_rgba',
			'title' => esc_html__('Back to Top Background','primestudio'),
			'default'   => array(
				'color'     => '#ff0000',
				'alpha'     => 0.5
			),
			'compiler' => array('background' => '.scrollToTop')
		),
		array(
			'id'   => 'backtotop-font-color',
			'type' => 'color',
			'title' => esc_html__('Back to Top Font Color','primestudio'),
			'transparent' => false,
			'default'  => '#ffffff',
			'compiler'    => array('color' => '.scrollToTop')
		),
		array(
			'id'        => 'backtotop-section-ends',
			'type'      => 'section',
			'title'     => esc_html__('&nbsp;', 'primestudio'),
			'indent'    => true,
			'required'  => array('footer-back-to-top', "=", 1),
		),

	)
));
Redux::setSection( $opt_name, array(
	'title' => esc_html__('Footer Widget Options', 'primestudio' ),
	'icon'      => 'el el-photo',
	'subsection'=> true,
	'fields' => array(

		array(
			'id'       => 'opt-footer-widget-4col',
			'type'     => 'multi_text',
			'title'    => esc_html__( 'Four Column Footer Widget', 'primestudio' ),
			'subtitle' => esc_html__( 'Add widget areas name', 'primestudio' ),
			'validate' => 'unique_slug',
			'add_text'=> esc_html__('Add New Widget Area','primestudio'),

		),

		array(
			'id'       => 'opt-footer-widget-3col',
			'type'     => 'multi_text',
			'title'    => esc_html__( 'Three Column Footer Widget', 'primestudio' ),
			'subtitle' => esc_html__( 'Add widget areas name', 'primestudio' ),
			'validate' => 'unique_slug',
			'add_text' => esc_html__('Add New Widget Area','primestudio'),

		),
		array(
			'id'       => 'footer-widget-options',
			'type'      => 'switch',
			'title'     => esc_html__('Footer Layout Options', 'primestudio'),
			'on'       => 'Default Widgets',
			'off'        => 'VC Predefined',
			'default'   =>1
		),
		array(
			'id'        => 'footer-widget-options-section-start',
			'type'      => 'section',
			'title'     => esc_html__('&nbsp;', 'primestudio'),
			'indent'    => true,
			'required'  => array('footer-widget-options', "=", 1),
		),
		array(
			'id'       => 'opt-footer-widgets',
			'type'     => 'select',
			'title'    => esc_html__('Default Footer Widgets', 'primestudio'),
			'add_text' => esc_html__('widget area for all archive pages','primestudio'),
			'data'			=> 'sidebars'
		),
		array(
			'id'        => 'footer-widget-options-section-end',
			'type'      => 'section',
			'title'     => esc_html__('&nbsp;', 'primestudio'),
			'required'  => array('footer-widget-options', "=", 1),
		),
		array(
			'id'        => 'footer-widget-options2-section-start',
			'type'      => 'section',
			'title'     => esc_html__('&nbsp;', 'primestudio'),
			'indent'    => true,
			'required'  => array('footer-widget-options', "=", 0),
		),
		primestudio_vc_reduxFooter('footer-widget-options-vc'),
		array(
			'id'        => 'footer-widget-options2-section-end',
			'type'      => 'section',
			'title'     => esc_html__('&nbsp;', 'primestudio'),
			'indent'    => true,
			'required'  => array('footer-widget-options', "=", 0),
		),
	)
));

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Copyright Settings', 'primestudio' ),
	'id'         => 'copyright-settings-section',
	'icon'       => 'el-icon-list',
	'subsection'=> true,
	'fields'     => array(
		array(
			'id'        => 'copyright-section',
			'type'      => 'switch',
			'title'     => esc_html__('Show Copyright section in footer', 'primestudio'),
			'subtitle'  => esc_html__('can be overriden by page and post settings', 'primestudio'),
			'default'   => 1
		),
		array(
			'id'        => 'copyright-section-start',
			'type'      => 'section',
			'title'     => esc_html__('&nbsp;', 'primestudio'),
			'indent'    => true,
			'required'  => array('copyright-section', "=", 1),
		),
		array(
			'id'        => 'footer-copyright-text',
			'type'      => 'text',
			'title'     => esc_html__('Footer Copyright Text', 'primestudio'),
			'desc'      => esc_html__('Will show only when value is set', 'primestudio'),
		),
		array(
			'id'   => 'footer-copyright-background',
			'type' => 'color_rgba',
			'title' => esc_html__('Copyright Section Background','primestudio'),
			'default'   => array(
				'color'     => '#fe8427',
				'alpha'     => 1
			),
		),
		array(
			'id'   => 'footer-copyright-font-color',
			'type' => 'color',
			'title' => esc_html__('Copyright Section Font Color','primestudio'),
			'transparent' => false,
			'default'   => '#152244'
		),
		array(
			'id'       => 'footer-social-icons',
			'type'      => 'switch',
			'title'     => esc_html__('Show Social Icons', 'primestudio'),
			'description'=> esc_html__('Only shows if the social links are set','primestudio'),
			'on'       => 'Yes',
			'off'        => 'No',
			'default'   =>1
		),

		array(
			'id'        => 'copyright-section-ends',
			'type'      => 'section',
			'indent'    => false,
			'required'  => array('copyright-section', "=", 1),
		),
	)
));




Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Post Settings', 'primestudio' ),
	'id'     => 'post-settings',
	'icon'   => 'el el-cog',
) );

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Posts Meta', 'primestudio' ),
	'id'         => 'post-settings-section',
	'icon'       => 'el-icon-list',
	'subsection'=> true,
	'fields'     => array(
		array(
			'id' => 'gn-author-checkbox',
			'type' => 'switch',
			'title'=> esc_html__('Author', 'primestudio'),
			'desc' => esc_html__('Applicable to post listing page only', 'primestudio'),
			'default'=> '1',
		),
		array(
			'id'        => 'gn-cat-checkbox',
			'type'      => 'switch',
			'title'     => esc_html__('Category', 'primestudio'),
			'default'=> '1',

		),
		array(
			'id'        => 'gn-comments-checkbox',
			'type'      => 'switch',
			'title'     => esc_html__('Comments', 'primestudio'),
			'desc' => esc_html__('Applicable to post listing page only', 'primestudio'),
			'default'=> '1',
		),
		array(
			'id'        => 'gn-tags-checkbox',
			'type'      => 'switch',
			'title'     => esc_html__('Tags', 'primestudio'),
			'default'=> '1',
		),
		array(
			'id'        => 'gn-like-checkbox',
			'type'      => 'switch',
			'title'     => esc_html__('Like', 'primestudio'),
			'desc' => __('Applicable to post single page only', 'primestudio'),
			'default'=> '1',
		),
		array(
			'id'        => 'gn-format-checkbox',
			'type'      => 'switch',
			'title'     => esc_html__('Post Format', 'primestudio'),
			'desc' => __('Applicable to post lists page only', 'primestudio'),
			'default'=> '0',

		),

		array(
			'id'        => 'gn-date-checkbox',
			'type'      => 'switch',
			'title'     => esc_html__('Date', 'primestudio'),
			'default'=> '1',
		),

		array(
			'id'        => 'gn-date-start',
			'type'      => 'section',
			'title'     => esc_html__('Date Format Settings', 'primestudio'),
																'indent'    => true, // Indent all options below until the next 'section' option is set.
																'required'  => array('gn-date-checkbox', "=", 1),
															),
		array(
			'id'        => 'date-format-text',
			'type'      => 'text',
			'title'     => esc_html__('Date Format', 'primestudio'),
			'desc'      => 'Please enter date format you want, to get the formats please check codex.wordpress.org/Formatting_Date_and_Time',
			'default'   => 'dS F, Y'
		),
		array(
			'id'        => 'gn-date-end',
			'type'      => 'section',
																'indent'    => false, // Indent all options below until the next 'section' option is set.
																'required'  => array('gn-date-checkbox', "=", 1),
															),

		/***********************************/



	)
) );
if(class_exists('Ze_VC_Addons'))
{
	Redux::setSection( $opt_name, array(
		'title'      => esc_html__( 'Post Share', 'primestudio' ),
		'id'         => 'post-share-settings',
		'icon'       => 'el-icon-list',
		'subsection'=> true,
		'fields'     => array(
			/************************************/

			array(
				'id'        => 'primestudio-share-checkbox',
				'type'      => 'switch',
				'title'     =>'Show Social Share',
				'default'   => 1

			),
			array(
				'id'        => 'social-share-start',
				'type'      => 'section',
				'title'     => esc_html__('Social Sharing', 'primestudio'),
					'indent'    => true, // Indent all options below until the next 'section' option is set.
					'required'  => array('primestudio-share-checkbox', "=", 1),
				),
			array(
				'id'        => 'social-share-text',
				'type'      => 'text',
				'title'     =>  esc_html__('Share It Text', 'primestudio'),
				'desc'      => 'Social Share Text, If not required make it blank',
				'default'   => 'Share It'
			),

			array(
				'id'        => 'twitter-share',
				'type'      => 'switch',
				'title'     => esc_html__('Share in Twitter', 'primestudio'),
				'default'   => 1

			),
			array(
				'id'        => 'fb-share',
				'type'      => 'switch',
				'title'     => esc_html__('Share in Facebook', 'primestudio'),
				'default'   => 1

			),
			array(
				'id'        => 'pinterest-share',
				'type'      => 'switch',
				'title'     => esc_html__('Share in Pinterest', 'primestudio'),
				'default'   => 1

			),

			array(
				'id'        => 'gp-share',
				'type'      => 'switch',
				'title'     => esc_html__('Share in Google Plus', 'primestudio'),
				'default'   => 1

			),

			array(
				'id'        => 'linkedin-share',
				'type'      => 'switch',
				'title'     => esc_html__('Share in Linkedin', 'primestudio'),
				'default'   => 1

			),

			array(
				'id'        => 'social-share-end',
				'type'      => 'section',
																			),
																			array(
																					'id'        => 'social-share-text',
																					'type'      => 'text',
																					'title'     =>  esc_html__('Share It Text', 'primestudio'),
																					'desc'      => 'Social Share Text, If not required make it blank',
																					'default'   => 'Share It'
																			),

																			array(
																					'id'        => 'twitter-share',
																					'type'      => 'switch',
																					'title'     => esc_html__('Share in Twitter', 'primestudio'),
																					'default'   => 1

																			),
																			 array(
																					'id'        => 'fb-share',
																					'type'      => 'switch',
																					'title'     => esc_html__('Share in Facebook', 'primestudio'),
																					'default'   => 1

																			),
																				array(
																					'id'        => 'pinterest-share',
																					'type'      => 'switch',
																					'title'     => esc_html__('Share in Pinterest', 'primestudio'),
																					'default'   => 1

																			),
																			array(
																				'id'        => 'instagram-share',
																				'type'      => 'switch',
																				'title'     => esc_html__('Share in Instagram', 'primestudio'),
																				'default'   => 1

																		),

																			array(
																					'id'        => 'gp-share',
																					'type'      => 'switch',
																					'title'     => esc_html__('Share in Google Plus', 'primestudio'),
																					'default'   => 1

																			),

																			array(
																					'id'        => 'linkedin-share',
																					'type'      => 'switch',
																					'title'     => esc_html__('Share in Linkedin', 'primestudio'),
																					'default'   => 1

																			),

																			array(
																					'id'        => 'social-share-end',
																					'type'      => 'section',
																					'indent'    => false, // Indent all options below until the next 'section' option is set.
																					'required'  => array('primestudio-share-checkbox', "=", 1),
																				),

			/***********************************/


			/***********************************/



		)
	) );
}

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Author Settings', 'primestudio' ),
	'id'         => 'author-settings-section',
	'icon'       => 'el-icon-list',
	'subsection'=> true,
	'desc' => esc_html__('For Single Post & Author Page Only', 'primestudio'),
	'fields'=> array(
		array(
			'id'        => 'primestudio-author-checkbox',
			'type'      => 'switch',
			'title'     =>'Show Author Box',
			'default'   => 1

		),
		array(
			'id'        => 'primestudio-author-start',
			'type'      => 'section',
			'title'     => esc_html__('Author Box Content', 'primestudio'),
																					 'indent'    => true, // Indent all options below until the next 'section' option is set.
																					 'required'  => array('primestudio-author-checkbox', "=", 1),
																					),
		array(
			'id'        => 'gn-auhtor-name-checkbox',
			'type'      => 'switch',
			'title'     => esc_html__('Show Name', 'primestudio'),
			'default'=> '1',

		),
		array(
			'id'        => 'gn-avatar-checkbox',
			'type'      => 'switch',
			'title'     => esc_html__('Show Avatar', 'primestudio'),
			'default'=> '1',
		),
		array(
			'id'        => 'primestudio-author-avatar-start',
			'type'      => 'section',
			'title'     => esc_html__('Avatar Settings', 'primestudio'),
																					 'indent'    => true, // Indent all options below until the next 'section' option is set.
																					 'required'  => array(array('primestudio-author-checkbox', "=", 1),array('gn-avatar-checkbox', "=", 1)),
																					),

		array(
			'id'        => 'gn-avatar-size',
			'type'      => 'slider',
			'title'     => esc_html__('Avatar Size', 'primestudio'),
			"min"       => 30,
			"step"      => 10,
			"max"       => 200,
			'display_value' => 'label'
		),
		array(
			'id'        => 'gn-avatar-border',
			'type'      => 'slider',
			'title'     => esc_html__('Avatar Border Radius(%)', 'primestudio'),
			"min"       => 0,
			"step"      => 1,
			"max"       => 50,
			'display_value' => 'label'
		),

		array(
			'id'        => 'primestudio-author-avatar-end',
			'type'      => 'section',
																					 'indent'    => false, // Indent all options below until the next 'section' option is set.
																					 'required'  => array(array('primestudio-author-checkbox', "=", 1),array('gn-avatar-checkbox', "=", 1)),
																					),
		array(
			'id'        => 'gn-auhtor-desc-checkbox',
			'type'      => 'switch',
			'title'     => esc_html__('Show Description', 'primestudio'),
			'default'=> '1',
			'required'=>array('primestudio-author-checkbox', "=", 1),

		),
		array(
			'id'        => 'gn-post-count-checkbox',
			'type'      => 'switch',
			'title'     => esc_html__('Show Post Count', 'primestudio'),
			'default'=> '1',
			'required'=>array('primestudio-author-checkbox', "=", 1),

		),
		array(
			'id'        => 'gn-author-follower-checkbox',
			'type'      => 'switch',
			'title'     => esc_html__('Show Follower', 'primestudio'),
			'default'=> '1',
			'required'=>array('primestudio-author-checkbox', "=", 1),


		),

		array(
			'id'        => 'primestudio-author-end',
			'type'      => 'section',
																					 'indent'    => false, // Indent all options below until the next 'section' option is set.
																					 'required'  => array('primestudio-author-checkbox', "=", 1),
																					),
	)
));


if ( class_exists( 'woocommerce' ) )
{

	Redux::setSection( $opt_name, array(
		'title'  => esc_html__( 'Woocommerce', 'primestudio' ),
		'id'     => 'shop-settings',
		'icon'       => 'el-icon-shopping-cart-sign',
	) );
	Redux::setSection( $opt_name, array(
		'title'      => esc_html__( 'Shop Settings', 'primestudio' ),
		'id'         => 'section-woocommerce-settings',
		'subsection'=> true,
		'icon'       => 'el-icon-shopping-cart-sign',
		'fields'     => array(


			array(
				'id'        => 'opt-cart-menu',
				'type'      => 'switch',
				'title'     => esc_html__('Cart in Top Menu', 'primestudio'),
				'on'       => 'Yes',
				'off'        => 'No',
				'default'   =>1
			),
			/****************************************************/
			array(
				'id'        => 'mini-cart-menu-start',
				'type'      => 'section',
				'title'     => esc_html__('Cart Menu Option For Top Menu', 'primestudio'),
				'indent'    => true,
				'required'  => array('opt-cart-menu', "=", 1),
			),
			array(
				'id'       => 'mini-cart-menu',
				'type'      => 'switch',
				'title'     => esc_html__('Cart Menu Options', 'primestudio'),
				'on'       => 'Cart Total',
				'off'        => 'Mini Cart',
				'default'   =>1,
				'required'  => array('opt-cart-menu', "=", 1),
			),

			array(
				'id'        => 'mini-cart-menu-end',
				'type'      => 'section',
				'indent'    => false,
				'required'  => array('opt-cart-menu', "=", 1),
			),

			/************************************************************/
			

			array(
				'id'        => 'opt-cart-off',
				'type'      => 'switch',
				'title'     => esc_html__('Catalogue Mode', 'primestudio'),
				'on'       => 'Yes',
				'off'        => 'No',
				'default'   =>0
			),

			array(
				'id'        => 'opt-woo-breadcrumb',
				'type' => 'switch',
				'title'     => esc_html__('Breadcrumb in Shop Page', 'primestudio'),
				'subtitle'  => esc_html__('will be same for other porduct related page like single products, category etc', 'primestudio'),
				'on' => 'Enable',
				'off' => 'Disable',
				'default'   => 0
			),

			array(
				'id'        => 'opt-products-number',
				'type'      => 'text',
																		'title'     => esc_html__('Number of products in shop page', 'primestudio'),                                    //
																		'validate'  => 'no_special_chars',
																		'default'   => '12'
																	),

			array(
				'id'        => 'opt-grid-number',
				'type'      => 'image_select',
				'title'     => esc_html__('Grid Column', 'primestudio'),

				'options'   => array(
					'1' => array('alt' => 'Two Column',   'title' => '2 Col',     'img' =>ReduxFramework::$_url.'assets/img/2-col-portfolio.png'),
					'2' => array('alt' => 'Three Column',   'title' => '3 Col',     'img' => ReduxFramework::$_url.'assets/img/3-col-portfolio.png'),
					'3' => array('alt' => 'Four Column', 'class'=>'col-4-shop',  'title' => '4 Col',     'img' => ReduxFramework::$_url.'assets/img/4-col-portfolio.png'),

				),
				'default'   => '3'
			),

			array(
				'id'        => 'opt-shop-layout',
				'type'      => 'image_select',
				'title'     => esc_html__('Shop Page Layout', 'primestudio'),
				'subtitle'  => esc_html__('will be same for woocommerce pages.Single product have option to ovreride it.', 'primestudio'),
				'options'  => array(
					'1'      => array(
						'alt'   => '1 Column',
						'img'   => ReduxFramework::$_url.'assets/img/1col.png'
					),
					'2'      => array(
						'alt'   => '2 Column Left',
						'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
					),
					'3'      => array(
						'alt'   => '2 Column Right',
						'img'  => ReduxFramework::$_url.'assets/img/2cr.png',

					),
				),
				'default' => '1'
			),

		)
) );

Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Cart Settings', 'primestudio' ),
	'id'     => 'cart-settings',
	'subsection'=> true,
	'icon'       => 'el-icon-shopping-cart-sign',
	'desc' => esc_html__('For cart page only', 'primestudio'),
	'fields'     => array(
		array(
			'id'        => 'opt-cart-sidebar',
			'type'      => 'switch',
			'title'     => esc_html__('Hide Sidebar', 'primestudio'),
			'on'       => 'Yes',
			'off'        => 'No',
			'default'   =>1
		),
		array(
			'id'        => 'opt-cart-continue-shopping',
			'type'      => 'switch',
			'title'     => esc_html__('Continue Shopping Option', 'primestudio'),
			'on'       => 'Yes',
			'off'        => 'No',
			'default'   =>1
		),
		array(
			'id'        => 'opt-cart-cross-sell',
			'type'      => 'switch',
			'title'     => esc_html__('Hide Cross & Up Sell', 'primestudio'),
			'subtitle'  => esc_html__('will work in single product page and other place where cross and up-sells comes', 'primestudio'),
			'on'       => 'Yes',
			'off'        => 'No',
			'default'   =>1
		),
	)
) );
Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Other Pages', 'primestudio' ),
	'id'     => 'other-settings',
	'subsection'=> true,
	'icon'       => 'el-icon-shopping-cart-sign',
	'desc' => esc_html__('For woocommerce pages except Shop, Single Product and Cart', 'primestudio'),
	'fields'     => array(
		array(
			'id'        => 'opt-woocommerce-sidebar',
			'type'      => 'switch',
			'title'     => esc_html__('Hide Sidebar', 'primestudio'),
			'on'       => 'Yes',
			'off'        => 'No',
			'default'   =>1
		),
		array(
			'id'        => 'opt-related-products-number',
			'type'      => 'text',
																		'title'     => esc_html__('Number of Related products in Single Product Page', 'primestudio'),                                    //
																		'subtitle'  => esc_html__('set -1 to get all the related products', 'primestudio'),
																		'validate'  => 'number',
																		'default'   => '4'
																	),
		array(
			'id'        => 'related-product-slider',
			'type'      => 'switch',
			'title'     => esc_html__('Related Product Slider', 'primestudio'),
			'on'       => 'Yes',
			'off'        => 'No',
			'default'   =>1
		),



	)
) );
			}//woocommerce end
				/*
				* Custom Code
				*/
				Redux::setSection( $opt_name, array(
					'title'  => esc_html__( 'Custom Codes', 'primestudio' ),
					'id'     => 'customcode',
				) );
				
				Redux::setSection( $opt_name, array(
					'title'  => esc_html__( 'Js', 'primestudio' ),
					'id'     => 'customcode-js',
					'subsection' => true,
					'fields' => array(
						array(
							'id'       => 'js_editor',
							'type'     => 'ace_editor',
							'title'    => esc_html__('Custom JS Code', 'primestudio'),
							'mode'     => 'js',
							'theme'    => 'monokai',
						),
					)
				) );
				/******  FOR DEMO OPTIONS STARTS ***/
				if(isset($_GET['ze_is_admin']))
				{
					if($_GET['ze_is_admin']=="tristup")
					{
						Redux::setSection( $opt_name, array(
							'title'      => esc_html__( 'Admin Settings', 'primestudio' ),
							'id'         => 'admin-settings-section',
							'icon'       => 'el-icon-list',
							'fields'     => array(

								array(
									'id'       => 'settings-sidebar',
									'type'      => 'switch',
									'title'     => esc_html__('Settings Sidebar', 'primestudio'),
									'default'   =>0
								),
								array(
									'id'        => 'settings-sidebar-start',
									'type'      => 'section',
									'title'     => esc_html__('Settings Options', 'primestudio'),
									'indent'    => true,
									'required'  => array('settings-sidebar', "=", 1),
								),
								array(
									'id'       => 'demo-settings',
									'type'      => 'switch',
									'title'     => esc_html__('Demo Options', 'primestudio'),
									'default'   =>0
								),
								array(
									'id'       => 'color-settings',
									'type'      => 'switch',
									'title'     => esc_html__('Color Options', 'primestudio'),
									'default'   =>0
								),
								array(
									'id'        => 'settings-sidebar-end',
									'type'      => 'section',
									'indent'    => false,
									'required'  => array('settings-sidebar', "=", 1),
								),
								array(
									'id'       => 'opt-text-woo-body-class',
									'type'     => 'text',
									'default'  => 'salon-demo',
									'title'    => esc_html__('Woocommerce Class', 'primestudio'),
								),
							),
						));
					}
				}
				/******  FOR DEMO OPTIONS ENDS ***/




		/*
		 * <--- END SECTIONS
		 */

	/// Save and update options into separate css file
		add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

		function compiler_action($options, $css, $changed_values) {
			global $wp_filesystem;

			$filename =  get_template_directory() . '/css/theme-options.css';

			if( empty( $wp_filesystem ) ) {

				require_once trailingslashit( ABSPATH) .'wp-admin/includes/file.php';
				WP_Filesystem();
			}

			if( $wp_filesystem ) {
				$wp_filesystem->put_contents(
					$filename,
					$css,
							0777 // predefined mode settings for WP files
						);
			}
		}
