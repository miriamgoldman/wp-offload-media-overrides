<?php
/**
 * Plugin Name: WP Offload Media Overrides.
 * Description: Overrides the wp_unique_filename filter in WP Offload Media.
 * Version: 1.0
 * Author: Pantheon
 */

 add_action( 'init', function() {

    if ( isset( $_ENV['PANTHEON_ENVIRONMENT'] ) && 'live' != $_ENV['PANTHEON_ENVIRONMENT'] ) {
        global $wp_filter;

        if ( class_exists( 'DeliciousBrains\WP_Offload_Media\Integrations\Media_Library' ) ) {
            global $as3cf;

            // Access the media library integration instance
            $media_library_integration = new DeliciousBrains\WP_Offload_Media\Integrations\Media_Library( $as3cf );

            // Remove the wp_unique_filename filter
            remove_filter( 'wp_unique_filename', [ $media_library_integration, 'wp_unique_filename' ], 10 );
            

        } 

        // Check if wp_unique_filename filter exists and if there's a callback at priority 10
        if ( isset( $wp_filter['wp_unique_filename']->callbacks[10] ) ) {
            // Clear all filters at priority 10
            unset( $wp_filter['wp_unique_filename']->callbacks[10] );

        }
    } 


});

