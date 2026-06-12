<?php
namespace Wwwebaddons\Helpers;
use Wwwebaddons\Widgets as Widgets;

class ElementorWidgets {

    public function __construct() {

        add_action( 'elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories'] );
        add_action( 'elementor/widgets/register', [$this, 'register_elementor_widgets'] );
        
    }

    public function add_elementor_widget_categories( $elements_manager ) {

        $elements_manager->add_category(
            'wwwebaddons',
            [
                'title' => __( 'WWWeb Addons', 'wwwebsolutions' ),
                'icon'  => 'fa fa-plug',
            ]
        );

    }

    public function register_elementor_widgets( $widgets_manager ) {

        $widgets_manager->register_widget_type( new Widgets\FilterableGallery() );
        $widgets_manager->register_widget_type( new Widgets\BurgerMenuIcon() );
        $widgets_manager->register_widget_type( new Widgets\LinkableTerms() );

    }

}