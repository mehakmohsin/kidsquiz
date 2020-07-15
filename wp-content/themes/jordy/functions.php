<?php

if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) || PHP_VERSION_ID < 50600 ) {
	require_once get_template_directory() . '/xtheme/compat.php';
} else {
	require_once get_template_directory() . '/xtheme/loader.php';
}
