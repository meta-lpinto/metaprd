<?php

    // Load the embedded Redux Framework
    if ( file_exists( trailingslashit( get_template_directory() ).'admin/redux-framework/framework.php' ) )
    {
        require_once trailingslashit( get_template_directory() ).'admin/redux-framework/framework.php';
        add_action( 'wp_print_scripts', 'primestudio_admin_dequeue_stylesandscripts', 100 );
				add_action( 'admin_enqueue_scripts', 'primestudio_admin_dequeue_stylesandscripts', 100 );
    }
    // Load the theme/plugin options
    if ( file_exists(trailingslashit( get_template_directory() ).'admin/options-init.php' ) )
    {
        require_once trailingslashit( get_template_directory() ) . 'admin/options-init.php';
    }
    // Load Redux extensions
    if ( file_exists( trailingslashit( get_template_directory() ).'admin/redux-extensions/extensions-init.php' ) )
    {
        require_once trailingslashit( get_template_directory() ).'admin/redux-extensions/extensions-init.php';
    }
