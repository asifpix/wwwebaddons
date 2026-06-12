<?php
namespace Wwwebaddons\Traits;

trait MenuTraits {

    public function get_menus() {
        $list  = [];
        $menus = wp_get_nav_menus();

        foreach ( $menus as $menu ) {
            $list[$menu->slug] = $menu->name;
        }

        return $list;
    }

    public function select_menu_control() {
        
        $this->add_control(
            'wwwa_selected_menu',
            [
                'label'   => esc_html__( 'Select menu', 'wwwebaddons' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_menus(),
            ]
        );
    }

}
