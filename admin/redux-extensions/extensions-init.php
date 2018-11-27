<?php

    // All extensions placed within the extensions directory will be auto-loaded for your Redux instance.
    Redux::setExtensions( 'theme_options', trailingslashit( get_template_directory()) . 'admin/redux-extensions/extensions/' );

    // Any custom extension configs should be placed within the configs folder.
    if ( file_exists( trailingslashit( get_template_directory()) . 'admin/redux-extensions/configs/' ) ) {
        $files = glob( trailingslashit( get_template_directory()) . 'admin/redux-extensions/configs/*.php' );
        if ( ! empty( $files ) ) {
            foreach ( $files as $file ) {
                include $file;
            }
        }
    }
   
