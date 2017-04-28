<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
if ( ! class_exists( 'TutsPlus_Shipping_Method' ) ) {
    class TutsPlus_Shipping_Method extends WC_Shipping_Method
    {
        /**
         * Constructor for your shipping class
         *
         * @access public
         * @return void
         */
        public function __construct() {
            $this->id  = 'tutsplus_shipping_method';
            $this->method_title = __( 'TutsPlus Shipping', 'tutsplus' );
            $this->method_description = __( 'Custom Shipping Method for TutsPlus', 'tutsplus' );
            // Availability & Countries
            /*$this->availability = 'including';
            $this->countries = array(
                'US', // Unites States of America
                'CA', // Canada
                'DE', // Germany
                'GB', // United Kingdom
                'IT',   // Italy
                'ES', // Spain
                'HR'  // Croatia
            );
            $this->enabled = isset( $this->settings['enabled'] ) ? $this->settings['enabled'] : 'yes';*/
            $this->enabled  = "yes";
            $this->title = isset( $this->settings['title'] ) ? $this->settings['title'] : __( 'TutsPlus Shipping', 'tutsplus' );
            $this->init();
        }
        /**
         * Init your settings
         *
         * @access public
         * @return void
         */
        function init() {
            // Load the settings API
            $this->init_form_fields();
            $this->init_settings();
            // Save settings in admin if you have any defined
            add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
        }
        /**
         * Define settings field for this shipping
         * @return void
         */
        function init_form_fields() {
            // We will add our settings here
            $this->form_fields = array(
                'enabled' => array(
                    'title' => __( 'Enable', 'tutsplus' ),
                    'type' => 'checkbox',
                    'description' => __( 'Enable this shipping.', 'tutsplus' ),
                    'default' => 'yes'
                ),
                'title' => array(
                    'title' => __( 'Title', 'tutsplus' ),
                    'type' => 'text',
                    'description' => __( 'Title to be display on site', 'tutsplus' ),
                    'default' => __( 'TutsPlus Shipping', 'tutsplus' )
                ),
                'weight' => array(
                    'title' => __( 'Weight (kg)', 'tutsplus' ),
                    'type' => 'number',
                    'description' => __( 'Maximum allowed weight', 'tutsplus' ),
                    'default' => 100
                ),
            );
        }
        /**
         * This function is used to calculate the shipping cost. Within this function we can check for weights, dimensions and other parameters.
         *
         * @access public
         * @param mixed $package
         * @return void
         */
        public function calculate_shipping( $package = array()  ) {
            // We will add the cost, rate and logics in here
            $weight = 0;
            $cost = 0;
            $country = $package["destination"]["country"];
            foreach ( $package['contents'] as $item_id => $values )
            {
                $_product = $values['data'];
                $weight = $weight + $_product->get_weight() * $values['quantity'];
            }
            $weight = wc_get_weight( $weight, 'kg' );
            if( $weight <= 10 ) {
                $cost = 0;
            } elseif( $weight <= 30 ) {
                $cost = 5;
            } elseif( $weight <= 50 ) {
                $cost = 10;
            } else {
                $cost = 20;
            }
        }
    }
}