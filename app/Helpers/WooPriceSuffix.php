<?php

namespace Wwwebaddons\Helpers;

class WooPriceSuffix {
    public function __construct() {
        add_filter('woocommerce_settings_tabs_array', array($this, 'custom_price_suffix_tab'), 50);
        add_action('woocommerce_settings_tabs_price_suffix', array($this, 'custom_price_suffix_settings'));
        add_action('woocommerce_update_options_price_suffix', array($this, 'custom_price_suffix_save_settings'));
        add_filter('woocommerce_get_price_html', array($this, 'custom_add_price_suffix'), 99, 2);
    }

    /**
     * Add Price Suffix tab
     */
    public function custom_price_suffix_tab($tabs) {
        $tabs['price_suffix'] = __('Price Suffix', 'wwwebaddons');
        return $tabs;
    }
    /**
     * Tab content
     */
    public function custom_price_suffix_settings() {
        woocommerce_admin_fields($this->custom_price_suffix_settings_fields());
    }
    /**
     * Save settings
     */
    public function custom_price_suffix_save_settings() {
        woocommerce_update_options($this->custom_price_suffix_settings_fields());
    }
    /**
     * Settings fields
     */
    public function custom_price_suffix_settings_fields() {

        return array(
            array(
                'title' => __('Price Suffix Settings', 'wwwebaddons'),
                'type'  => 'title',
                'id'    => 'custom_price_suffix_section',
            ),

            array(
                'title'    => __('Price Suffix', 'wwwebaddons'),
                'desc'     => __('Example: /Day, /Hour, /Month', 'wwwebaddons'),
                'id'       => 'price_suffix',
                'type'     => 'text',
                'default'  => '/Day',
                'css'      => 'min-width:300px;',
            ),

            array(
                'type' => 'sectionend',
                'id'   => 'custom_price_suffix_section',
            ),
        );
    }

    /**
     * Add custom price suffix to product price
     */
    public function custom_add_price_suffix($price, $product) {

        $suffix = get_option('price_suffix', '');

        if (empty($suffix)) {
            return $price;
        }

        return $price . '<span class="custom-price-suffix">' . esc_html($suffix) . '</span>';
    }
}
