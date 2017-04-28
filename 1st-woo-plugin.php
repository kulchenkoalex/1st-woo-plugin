/**
 * Plugin Name: 1st-woo
 * Plugin URI: https://github.com/kulchenkoalex/1st-woo-plugin
 * Description: A brief description of the Plugin.
 * Version: 1.0.0
 * Author: Alexey Kulchenko
 * Author URI: https://vk.com/kulchenko_alexey
 * Developer: Alexey Kulchenko
 * Developer URI: https://vk.com/kulchenko_alexey
 * Text Domain: woocommerce-extension
 * Domain Path: /languages
 * Copyright: © 2009-2017 WooCommerce.
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */


<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

 if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    
    function your_shipping_method_init() {
        require_once dirname(__FILE__) . '/WC_Your_Shipping_Method.php';
    }
    add_action( 'woocommerce_shipping_init', 'your_shipping_method_init' );
}