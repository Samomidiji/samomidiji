<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Widget_Lc_Slider extends Widget_Base {

	public function get_name() {
		return 'lc-slider';
	}

	public function get_title() {
		return 'Slider';
	}

	public function get_icon() {
		return 'fa fa-clone';
	}

	public function get_categories() {
		return [ 'lc-elementor' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'tab_content',
			[
				'label' => 'Slider',
			]
		);

		$this->add_control(
			'slider_style',
			[
				'type'			=> Controls_Manager::SELECT,
				'label'			=> 'Slider style',
				'label_block'	=> true,
				'options'		=> [
					'1'	=> 'Slider 1',
					'2'	=> 'Slider 2'
				]
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
		    'slider',
		    [
		    	'type'          => Controls_Manager::GALLERY,
		        'label'         => 'Slider',
		        'label_block'   => true
		    ]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<?php if ($settings['slider_style'] == 2): ?>
        <div class="project-slider">
        	<div class="container">
	            <div class="row">
	                <div class="col-md-3 offset-md-9 mar-top-30">
	                    <div class="rotate-text reverse">
	                        <h3 class="textFadeUp"><?php echo $settings['title'] ?></h3>
	                    </div>
	                </div>
	            </div>
	        </div>
            <div class="row">
                <div class="col-md-8 mar-top-30">
                    <div id="projectSlider2" class="swiper-container">
                        <div class="swiper-wrapper">
                        	<?php foreach ($settings['slider'] as $s): ?>
                            <div class="swiper-slide">
                            	<img src="<?php echo $s['url'] ?>" alt="<?php echo get_the_title($s['id']); ?>"/>
                            </div>
                            <?php endforeach ?>
                        </div>
                        <div class="swiper-button-next"><i class="ion ion-ios-arrow-right"></i></div>
                        <div class="swiper-button-prev"><i class="ion ion-ios-arrow-left"></i></div>
                    </div>
                </div>
            </div>
        </div>			
		<?php else: ?>
        <div class="project-slider">
            <div class="row">
                <div class="container">
                    <div class="col-md-3 mar-top-30">
                        <h3 class="textFadeUp"><?php echo $settings['title'] ?></h3>
                    </div>
                </div>
                <div class="col-md-8 offset-md-4 mar-top-30">
                    <div id="projectSlider1" class="swiper-container reveal-effect">
                        <div class="swiper-wrapper">
                        	<?php foreach ($settings['slider'] as $s): ?>
                            <div class="swiper-slide">
                            	<img src="<?php echo $s['url'] ?>" alt="<?php echo get_the_title($s['id']); ?>"/>
                            </div>
                            <?php endforeach ?>
                        </div>
                        <div class="swiper-scrollbar"></div>
                    </div>
                </div>
            </div>
        </div>			
		<?php endif ?>

		<?php
	}	
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Lc_Slider() );