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

        function add_your_shipping_method( $methods ) {
        $methods['your_shipping_method'] = 'WC_Your_Shipping_Method';
        return $methods;
    }
    add_filter( 'woocommerce_shipping_methods', 'add_your_shipping_method' );
    // Создайте функцию для размещения своего класса
    function tutsplus_shipping_method() {
        require_once dirname(__FILE__) . '/TutsPlus_Shipping_Method.php';
    }
    add_action( 'woocommerce_shipping_init', 'tutsplus_shipping_method' );
    function add_tutsplus_shipping_method( $methods ) {
        $methods[] = 'TutsPlus_Shipping_Method';
        return $methods;
    }
    add_filter( 'woocommerce_shipping_methods', 'add_tutsplus_shipping_method' );
    
}