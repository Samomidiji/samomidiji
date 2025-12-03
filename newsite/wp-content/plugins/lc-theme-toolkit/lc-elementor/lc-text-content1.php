<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Widget_Lc_Text_Content1 extends Widget_Base {

	public function get_name() {
		return 'lc-text-content1';
	}

	public function get_title() {
		return 'Text Content 1';
	}

	public function get_icon() {
		return 'fa fa-align-right';
	}

	public function get_categories() {
		return [ 'lc-elementor' ];
	}


	protected function _register_controls() {
		$this->start_controls_section(
			'tab_content',
			[
				'label' => 'Text Content 1',
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
			'title_rotation',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => 'Title rotation'
			]
		);

		$this->add_control(
			'columnwise_contents',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => 'Columnwise contents'
			]
		);

		$this->add_control(
			'content1', 
			[
				'type' => Controls_Manager::TEXTAREA,
				'label' => 'Content 1'
			]
		);

		$this->add_control(
			'content2', 
			[
				'type' => Controls_Manager::TEXTAREA,
				'label' => 'Content 2'
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
            <div class="container">
                <div class="row">
                	<?php if ($settings['title_rotation'] === 'yes'): ?>
					<div class="col-md-8 offset-md-2 mar-top-30">
                        <div class="rotate-text">
                        	<h3 class="textFadeUp"><?php echo $settings['title']; ?></h3>
                        </div>
                	<?php else: ?>
                    <div class="col-md-3 mar-top-30">
                        <h3 class="textFadeUp"><?php echo $settings['title']; ?></h3>
                    </div>
                    <div class="col-md-8 offset-md-1">
                	<?php endif ?>
                    	<?php if ($settings['columnwise_contents'] === 'yes'): ?>
                    	<div class="row">
                            <div class="col-md-6 <?php echo $settings['title_rotation'] === 'yes' ? '' : 'mar-top-30' ?>">
                            	<p class="summary-text"><?php echo $settings['content1']; ?></p>
                            </div>
							<div class="col-md-6 <?php echo $settings['title_rotation'] === 'yes' ? '' : 'mar-top-30' ?>">
                                <p><?php echo $settings['content2']; ?></p>
                            </div>
                        </div>
                    	<?php else: ?>
                    	<p class="summary-text <?php echo $settings['title_rotation'] === 'yes' ? '' : 'mar-top-30' ?>"><?php echo $settings['content1']; ?></p>
                    	<p class="mar-top-30"><?php echo $settings['content2']; ?></p>
                    	<?php endif ?>
                    </div>
                </div>
            </div>
		<?php
	}	
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Lc_Text_Content1() );