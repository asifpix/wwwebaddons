<?php

namespace Wwwebaddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Wwwebaddons\Traits\MenuTraits;

class BurgerMenuIcon extends \Elementor\Widget_Base {
	use MenuTraits;

	public function get_name() {
		return 'burger_menu_icon';
	}

	public function get_title() {
		return __('Burger Menu Icon', 'wwwebsolutions');
	}

	public function get_icon() {
		return 'eicon-menu-bar';
	}

	public function get_categories() {
		return ['wwwebaddons'];
	}

	public function get_style_depends() {
		return ['wwwebaddons-styles'];
	}

	public function get_keywords() {
		return ['wwwebaddons', 'burger', 'menu', 'icon'];
	}

	public function get_script_depends() {
		return ['jquery', 'wwwa-burger-menu-icon'];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'menu_section',
			[
				'label' => __('Menu Settings', 'wwwebaddons'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'wwwa_logo',
			[
				'label' => esc_html__( 'Choose Logo', 'wwwebaddons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->select_menu_control();

		$repeater = new Repeater();

		$repeater->add_control(
			'social_icon',
			[
				'label' => __('Icon', 'wwwebaddons'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fab fa-facebook-f',
					'library' => 'fa-brands',
				],
			]
		);

		$repeater->add_control(
			'social_link',
			[
				'label' => __('Link', 'wwwebaddons'),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://',
				'default' => [
					'url' => '',
				],
			]
		);

		$this->add_control(
			'social_icons',
			[
				'label' => __('Social Icons', 'wwwebaddons'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'social_icon' => [
							'value' => 'fab fa-facebook-f',
							'library' => 'fa-brands',
						],
					],
					[
						'social_icon' => [
							'value' => 'fab fa-instagram',
							'library' => 'fa-brands',
						],
					],
				],
				'title_field' => '{{{ social_icon.value }}}',
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => __('Menu Styles', 'wwwebaddons'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'header_normal_bg_color',
			[
				'label' => esc_html__( 'Header BG Color', '' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'body #wwwa-header' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'header_active_bg_color',
			[
				'label' => esc_html__( 'Header Active BG Color', '' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'body.no-scroll #wwwa-header' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'burger_color',
			[
				'label' => esc_html__('Burger Color', 'wwwebaddons'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .burger-inner .top-bun' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .burger-inner .bottom-bun' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'menu_typography',
				'selector' => '{{WRAPPER}} .wwwa-off-canvas-menu-content ul li a',
			]
		);

		$this->add_control(
			'menu_container_color',
			[
				'label' => __('Menu ContainerColor', 'wwwebaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#111111',
				'selectors' => [
					'{{WRAPPER}} .wwwa-off-canvas-menu-inner' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'menu_color',
			[
				'label' => __('Menu Color', 'wwwebaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .wwwa-off-canvas-menu-content ul li a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'menu_hover_color',
			[
				'label' => __('Menu Hover Color', 'wwwebaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#dad4c9',
				'selectors' => [
					'{{WRAPPER}} .wwwa-off-canvas-menu-content ul li a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'social_style_section',
			[
				'label' => __('Social Icons', 'wwwebaddons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'social_color',
			[
				'label' => __('Color', 'wwwebaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .wwwa-off-canvas-menu-social a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'social_hover_color',
			[
				'label' => __('Hover Color', 'wwwebaddons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#FF0000',
				'selectors' => [
					'{{WRAPPER}} .wwwa-off-canvas-menu-social a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'social_size',
			[
				'label' => __('Size', 'wwwebaddons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wwwa-off-canvas-menu-social a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		$container_id = 'wwwa-menu-list-' . uniqid();
		$container_class = 'wwwa-menu-list';
		$menu_args = array(
			'menu'              => $settings['wwwa_selected_menu'],
			'depth'                => 1,
			'container'         => 'div',
			'container_class'   => $container_class,
			'container_id'      => $container_id,
			'menu_class'        => 'menu_class',
		);
?>
		<div class="wwwa-header">
			<div class="wwwa-header-logo">
				<?php
				if(!empty($settings['wwwa_logo']['url'])) {
					echo '<a href="' . esc_url(home_url('/')) . '"><img src="' . esc_url($settings['wwwa_logo']['url']) . '" alt="' . get_bloginfo('name') . '"></a>';
				} else {
					echo '<a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a>';
				}
				// if (has_custom_logo()) {
				// 	the_custom_logo();
				// } else {
				// 	echo '<a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a>';
				// }
				?>
			</div>
			<div class="header-burger">
				<button class="header-burger-btn burger" data-test="header-burger">
					<!-- <span class="js-header-burger-open-title visually-hidden">Open Menu</span>
					<span class="js-header-burger-close-title visually-hidden" hidden="">Close Menu</span> -->
					<div class="burger-box">
						<div class="burger-inner header-menu-icon-doubleLineHamburger">
							<div class="top-bun"></div>
							<div class="patty"></div>
							<div class="bottom-bun"></div>
						</div>
					</div>
				</button>
			</div>
		</div>
		<div id="wwwa-off-canvas-menu-wrapper" class="wwwa-off-canvas-menu-wrapper">
		<div id="wwwa-off-canvas-menu" class="wwwa-off-canvas-menu">
			<div class="wwwa-off-canvas-menu-inner">
				<div class="wwwa-off-canvas-menu-content">
					<!-- <div class="wwwa-off-canvas-menu-close">
						<div class="wwwa-off-canvas-menu-close-inner">
							<span class="close-icon">&times;</span>
						</div>
					</div> -->
					<?php
					wp_nav_menu($menu_args);
					?>
				</div>
				<?php if (!empty($settings['social_icons'])) : ?>
					<div class="wwwa-off-canvas-menu-social">
						<ul>
							<?php foreach ($settings['social_icons'] as $item) : ?>
								<li>
									<a href="<?php echo esc_url($item['social_link']['url']); ?>"
										<?php echo $item['social_link']['is_external'] ? 'target="_blank"' : ''; ?>
										<?php echo $item['social_link']['nofollow'] ? 'rel="nofollow"' : ''; ?>>

										<?php Icons_Manager::render_icon(
											$item['social_icon'],
											['aria-hidden' => 'true']
										); ?>

									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
			</div>
		</div>
		</div>
<?php

	}
}
