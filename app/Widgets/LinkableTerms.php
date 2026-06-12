<?php

namespace Wwwebaddons\Widgets;

class LinkableTerms extends \Elementor\Widget_Base {

	public function get_name() {
		return 'linkable_terms';
	}

	public function get_title() {
		return __('Linkable Terms', 'wwwebsolutions');
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public function get_categories() {
		return ['wwwebaddons'];
	}

	public function get_style_depends() {
		return ['wwwebaddons-styles'];
	}

	public function get_keywords() {
		return ['wwwebaddons', 'filters'];
	}

	// public function get_script_depends() {
	// 	return ['jquery', 'isotope', 'wwwa-filter-gallery'];
	// }

	protected function register_controls() {
		$this->start_controls_section(
			'filter_styels_section',
			[
				'label' => __('Filter Styles', 'wwwebaddons'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .wwwa-filter-buttons a.filter-button',
			]
		);

		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__('Normal', 'wwwebaddons'),
			]
		);
		$this->add_control(
			'text_normal_color',
			[
				'label' => esc_html__( 'Text Color', 'wwwebaddons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wwwa-filter-buttons a.filter-button' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'btn_normal_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wwwebaddons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wwwa-filter-buttons a.filter-button' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__('Hover', 'wwwebaddons'),
			]
		);
		$this->add_control(
			'text_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'wwwebaddons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wwwa-filter-buttons a.filter-button:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'btn_hover_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wwwebaddons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wwwa-filter-buttons a.filter-button:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'padding',
			[
				'label' => esc_html__( 'Padding', 'wwwebaddons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .wwwa-filter-buttons a.filter-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'border-radius',
			[
				'label' => esc_html__( 'Border Radius', 'wwwebaddons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .wwwa-filter-buttons a.filter-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$terms = get_terms([
			'taxonomy'   => 'portfolio-category',
			'hide_empty' => true,
		]);
?>
		<div class="wwwa-filter-gallery-wrapper">
			<div class="wwwa-filter-buttons">
				<!-- <button class="active" data-filter="*">
					<?php //esc_html_e('All', 'wwwebaddons'); 
					?>
				</button> -->
				<?php foreach ($terms as $term) : ?>
					<a href="<?php echo esc_url(get_term_link($term)); ?>" class="filter-button">
						<?php echo esc_html($term->name); ?>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
<?php
		wp_reset_postdata();
	}
}
