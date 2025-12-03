<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Widget_Lc_Client extends Widget_Base {

	public function get_name() {
		return 'lc-client';
	}

	public function get_title() {
		return 'Client';
	}

	public function get_icon() {
		return 'fa fa-star-o';
	}

	public function get_categories() {
		return [ 'lc-elementor' ];
	}


	protected function _register_controls() {
		$this->start_controls_section(
			'tab_content',
			[
				'label' => 'Client',
			]
		);

		$this->add_control(
			'title', 
			[
				'type' => Controls_Manager::TEXT,
				'label' => 'Title',
				'label_block' => true
			]
		);
		
		$this->add_control(
		    'client',
		    [
		    	'type'          => Controls_Manager::GALLERY,
		        'label'         => 'Client',
		        'label_block'   => true
		    ]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h3 class="textFadeUp"><?php echo $settings['title'] ?></h3>
                </div>
                <div class="col-md-9 col-sm-12 clients-list">
                    <div class="row">
                    	<?php foreach ($settings['client'] as $c): ?>
                        <div class="col-sm-3">
                        	<img src="<?php echo $c['url'] ?>" alt="<?php echo get_the_title($c['id']); ?>"/>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}	
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Lc_Client() );