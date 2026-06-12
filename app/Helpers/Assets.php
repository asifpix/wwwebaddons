<?php

namespace Wwwebaddons\Helpers;

class Assets {
    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
    }

    public function enqueue_assets() {
        wp_register_script(
            'isotope',
            'https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js',
            ['jquery'],
            '3.0.6',
            true
        );

        wp_register_script(
            'wwwa-filter-gallery',
            WWWEBADDONS_ASSETS . 'js/filter-gallery.js',
            ['jquery', 'isotope'],
            WWWEBADDONS_VERSION,
            true
        );
        wp_register_script(
            'wwwa-burger-menu-icon',
            WWWEBADDONS_ASSETS . 'js/burger-menu-icon.js',
            ['jquery'],
            WWWEBADDONS_VERSION,
            true
        );

        wp_register_style(
            'wwwebaddons-styles',
            WWWEBADDONS_ASSETS . 'css/wwwebaddons.css',
            [],
            WWWEBADDONS_VERSION
        );
        wp_enqueue_style('wwwebaddons-styles');
    }
}
