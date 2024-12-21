<?php
/**
 * Plugin Name: Plugin Dependency Manager
 * Description: A simple plugin to manage plugin dependencies using the WP_Plugin_Dependencies class.
 * Version: 1.0.0
 * Author: Widerman
 * License: GPL2+
 * Requires Plugins: contact-form-7, woocommerce, regenerate-thumbnails, advanced-custom-fields-pro, query-monitor, safe-svg
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register plugin dependencies using the WP_Plugin_Dependencies class.
 */
add_action( 'admin_init', 'register_plugin_dependencies' );
function register_plugin_dependencies() {
    // Check if WP_Plugin_Dependencies class exists (available in WordPress 6.5+).
    if ( ! class_exists( 'WP_Plugin_Dependencies' ) ) {
        add_action( 'admin_notices', function() {
            echo '<div class="notice notice-error"><p><strong>Plugin Dependency Manager:</strong> This plugin requires WordPress 6.5 or higher.</p></div>';
        });
        return;
    }

    // Register dependencies.
    add_filter( 'plugin_dependency_requirements', function( $dependencies ) {
        // $dependencies[] = array(
        //     'slug'    => 'contact-form-7',
        // );

        $dependencies[] = array(
            'slug'    => 'woocommerce',
        );

        $dependencies[] = array(
            'slug'    => 'regenerate-thumbnails',
        );

        $dependencies[] = array(
            'slug'    => 'query-monitor',
        );

        return $dependencies;
    });
}

/**
 * Display admin notices for missing or incompatible dependencies.
 */
add_action( 'admin_notices', 'display_dependency_notices' );
function display_dependency_notices() {
    $plugin_dependencies = apply_filters( 'plugin_dependency_requirements', array() );

    foreach ( $plugin_dependencies as $dependency ) {
        $slug = $dependency['slug'];
        $version = isset( $dependency['version'] ) ? $dependency['version'] : null;

        if ( ! is_plugin_active( $slug . '/' . $slug . '.php' ) ) {
            echo '<div class="notice notice-warning"><p><strong>Plugin Dependency Manager:</strong> The required plugin <em>' . esc_html( $slug ) . '</em> is not active. Please install and activate it.</p></div>';
        } elseif ( $version && version_compare( get_plugin_data( WP_PLUGIN_DIR . '/' . $slug . '/' . $slug . '.php' )['Version'], $version, '<' ) ) {
            echo '<div class="notice notice-error"><p><strong>Plugin Dependency Manager:</strong> The active plugin <em>' . esc_html( $slug ) . '</em> must be updated to version ' . esc_html( $version ) . ' or higher.</p></div>';
        }
    }
}
