<?php

namespace Wwwebaddons\Widgets;

class FilterableGallery extends \Elementor\Widget_Base {

	public function get_name() {
		return 'filterable_gallery';
	}

	public function get_title() {
		return __('Filterable Gallery', 'wwwebsolutions');
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return ['wwwebaddons'];
	}

	public function get_style_depends() {
		return ['wwwebaddons-styles'];
	}

	public function get_keywords() {
		return ['wwwebaddons', 'gallery', 'portfolio'];
	}

	public function get_script_depends() {
		return ['jquery', 'isotope', 'wwwa-filter-gallery'];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __('Settings', 'wwwebaddons'),
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label'   => __('Posts Per Page', 'wwwebaddons'),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 12,
			]
		);

		$this->add_control(
			'show_filter',
			[
				'label'        => __('Show Filter', 'wwwebaddons'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'wwwebaddons'),
				'label_off'    => __('Hide', 'wwwebaddons'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$args = [
			'post_type'      => 'portfolio',
			'posts_per_page' => $settings['posts_per_page'],
			'post_status'    => 'publish',
			'orderby'        => 'menu_order',
			'order'          => 'DESC',
		];

		$query = new \WP_Query($args);

		if (!$query->have_posts()) {
			return;
		}

		$terms = get_terms([
			'taxonomy'   => 'portfolio-category',
			'hide_empty' => true,
		]);
?>
		<div class="wwwa-filter-gallery-wrapper">
			<?php if ('yes' === $settings['show_filter']) : ?>
				<div class="wwwa-filter-buttons">
					<button class="active" data-filter="*">
						<?php esc_html_e('All', 'wwwebaddons'); ?>
					</button>
					<?php foreach ($terms as $term) : ?>
						<button data-filter=".<?php echo esc_attr($term->slug); ?>">
							<?php echo esc_html($term->name); ?>
						</button>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<div class="wwwa-filter-gallery-grid">
				<?php while ($query->have_posts()) : $query->the_post();
					$post_terms = get_the_terms(get_the_ID(), 'portfolio-category');
					$term_classes = [];
					if ($post_terms && !is_wp_error($post_terms)) {
						foreach ($post_terms as $post_term) {
							$term_classes[] = $post_term->slug;
						}
					}
				?>
					<div class="gallery-item <?php echo esc_attr(implode(' ', $term_classes)); ?>">
						<div class="gallery-image">
							<a href="<?php the_permalink(); ?>">
								<?php if (has_post_thumbnail()) : ?>
									<?php the_post_thumbnail('large'); ?>
								<?php endif; ?>
							</a>
						</div>
						<div class="gallery-content">
							<h3 class="gallery-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<?php
							$post_terms = get_the_terms(get_the_ID(), 'portfolio-category');
							if ($post_terms && ! is_wp_error($post_terms)) :
								$first_term = $post_terms[0];
								$term_link = get_term_link($first_term);
								if (! is_wp_error($term_link)) :
							?>
									<a class="gallery-term" href="<?php echo esc_url($term_link); ?>">
										<?php echo esc_html($first_term->name); ?>
									</a>
							<?php
								endif;
							endif;
							?>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
<?php
		wp_reset_postdata();
	}
}
