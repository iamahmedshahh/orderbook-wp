<?php

/*
Plugin Name: Verus Vue Plugin
Description: This plugin displays verus staked block data .
Version: 2.0
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
        'Orderbooks',   // Menu slug
        'orderbook_render_content', // Callback function to render content
        'dashicons-admin-plugins', // Icon URL or dashicon class
        10 // Menu position
    );
}
add_action('admin_menu', 'verus_vue_admin_menu_page');

function orderbook_render_content() {
    ?>
    <h1>Verus Blocks</h1>
    <div id="plugin-orderbook">
    </div>
    <?php
}

function orderbook_render_frontend() {

    return '<div id="plugin-orderbook"></div>';
}
add_shortcode('order-book', 'orderbook_render_frontend'); // Short code usage: [verus-vue]


function admin_enqueue_orderbook_scripts( $hook ) {
    if ( 'toplevel_page_verus-vue' === $hook ) {
        wp_enqueue_script('app-script', plugins_url('/dist/js/app.a58f637f.js', __FILE__), array(), null, true);
        wp_enqueue_style('app-style', plugins_url('/dist/css/app.7f5d4a7b.css', __FILE__));
        error_log($hook); // For testing (to be removed)
    }
}
add_action('admin_enqueue_scripts', 'admin_enqueue_orderbook_scripts');

function front_enqueue_orderbook_scripts() {
    wp_enqueue_script('app-script', plugins_url('/dist/js/app.a58f637f.js', __FILE__), array(), null, true);
    wp_enqueue_style('app-style', plugins_url('/dist/css/app.7f5d4a7b.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'front_enqueue_orderbook_scripts');