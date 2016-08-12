<?php

    if ( file_exists( get_template_directory() . '/admin/options-init.php' ) ) {
        require_once get_template_directory() . '/admin/options-init.php';
    }

	// Load Metabox
    if ( file_exists( get_template_directory() . '/admin/metabox-init.php' ) ) {
        require_once get_template_directory() . '/admin/metabox-init.php';
    }
