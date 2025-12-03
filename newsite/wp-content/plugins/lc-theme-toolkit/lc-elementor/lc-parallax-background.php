<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Widget_Lc_Parralax_Background extends Widget_Base {

	public function get_name() {
		return 'lc-parralax-background';
	}

	public function get_title() {
		return 'Parralax background';
	}

	public function get_icon() {
		return 'fa fa-image';
	}

	public function get_categories() {
		return [ 'lc-elementor' ];
	}


	protected function _register_controls() {
		$this->start_controls_section(
			'tab_content',
			[
				'label' => 'Parralax background',
			]
		);

		$this->add_control(
		    'parralax_background',
		    [
		    	'type'          => Controls_Manager::MEDIA,
		        'label'         => 'Parralax Background',
		        'label_block'   => true
		    ]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( $settings['parralax_background']['url'] ) :
		?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="fixed-bg">
                        <div class="parallax-inner" style="background-image: url('<?php echo $settings['parralax_background']['url'] ?>'); background-size: cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
		endif;
	}	
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Lc_Parralax_Background() );