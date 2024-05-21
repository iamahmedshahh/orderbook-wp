<?php

/*
Plugin Name: Orderbooks Wordpress Plugin
Description: Live Orders from AtomicDex.
Version: 1.0
Author: Ahmed Shah
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function orderbook_admin_menu_page() {
    add_menu_page(
        __('Orderbooks'),  // Page title
        __('Latest Orders'), // Menu title
        'manage_options',  // Capability required to access
        'orderbook-vue',   // Menu slug
        'orderbook_render_content', // Callback function to render content
        'dashicons-admin-plugins', // Icon URL or dashicon class
        10 // Menu position
    );
}
add_action('admin_menu', 'orderbook_admin_menu_page');

function orderbook_render_content() {
    ?>
    <h1>OrderBook</h1>
    <div class="orderbook-vue-wrapper">
    <div id="plugin-orderbook">
    </div>
    </div>
    <?php
}

function orderbook_render_frontend() {
    return '<div id="plugin-orderbook"></div>';
}
add_shortcode('order-book', 'orderbook_render_frontend'); // Shortcode usage: [order-book]

function admin_enqueue_orderbook_scripts( $hook ) {
    if ( 'toplevel_page_orderbook-vue' === $hook ) {
        wp_enqueue_script('app-script', plugins_url('/dist/js/app.ae2d6dc5.js', __FILE__), array('jquery'), '1.0.0', true);
        wp_enqueue_script('vendors-script', plugins_url('dist/js/chunk-vendors.2dead338.js', __FILE__), array('jquery'), '1.0.0', true);
        wp_enqueue_style('app-style', plugins_url('/dist/css/app.cccafb64.css', __FILE__), array(), '1.0.0');
        if ( defined('WP_DEBUG') && WP_DEBUG ) {
            error_log($hook); // For testing (to be removed in production)
        }
    }
}
add_action('admin_enqueue_scripts', 'admin_enqueue_orderbook_scripts');

function front_enqueue_orderbook_scripts() {
    wp_enqueue_script('app-script', plugins_url('/dist/js/app.ae2d6dc5.js', __FILE__), array('jquery'), '1.0.0', true);
    wp_enqueue_script('vendors-script', plugins_url('dist/js/chunk-vendors.2dead338.js', __FILE__), array('jquery'), '1.0.0', true);
    wp_enqueue_style('app-style', plugins_url('/dist/css/app.cccafb64.css', __FILE__), array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'front_enqueue_orderbook_scripts');
