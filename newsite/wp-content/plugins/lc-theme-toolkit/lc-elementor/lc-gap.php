<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Widget_Lc_Gap extends Widget_Base {

	public function get_name() {
		return 'lc-gap';
	}

	public function get_title() {
		return 'Gap';
	}

	public function get_icon() {
		return 'eicon-spacer';
	}

	public function get_categories() {
		return [ 'lc-elementor' ];
	}


	protected function _register_controls() {
		$this->start_controls_section(
			'tab_content',
			[
				'label' => 'Gap',
			]
		);

		$this->add_responsive_control(
		    'gap',
		    [
		    	'type'          => Controls_Manager::SLIDER,
		        'label'         => 'Gap',
		        'default' => [
					'size' => 50,
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 600,
					],
				]
		    ]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
        <div style="height: <?php echo $settings['gap']['size'] . $settings['gap']['unit']; ?>">
        </div>
		<?php
	}	
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Lc_Gap() );