<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Widget_Lc_Video extends Widget_Base {

	public function get_name() {
		return 'lc-video';
	}

	public function get_title() {
		return 'Video';
	}

	public function get_icon() {
		return 'fa fa-youtube-square';
	}

	public function get_categories() {
		return [ 'lc-elementor' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'tab_content',
			[
				'label' => 'Video',
			]
		);

		$this->add_control(
			'video_placeholder_image', 
			[
				'type' => Controls_Manager::MEDIA,
				'label' => 'Video placeholder image',
				'label_block' => true
			]
		);

		$this->add_control(
		    'video_url',
		    [
		    	'type'          => Controls_Manager::TEXT,
		        'label'         => 'Youtube video url',
		        'label_block'   => true
		    ]
		);

		$this->add_control(
		    'play_button_text',
		    [
		    	'type'          => Controls_Manager::TEXT,
		        'label'         => 'Play button text',
		        'label_block'   => true
		    ]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
         <div class="container">
            <div class="project-video">
                <div class="row">
                    <div class="col-md-12">
                        <div class="video-container reveal-effect">
                        	<img src="<?php echo $settings['video_placeholder_image']['url'] ?>" alt="<?php echo get_the_title($settings['video_placeholder_image']['id']); ?>"/>
                            <a class="video-play-btn hvr-ripple-out popup-video" href="<?php echo $settings['video_url'] ?>">
                                <i class="ion-play"></i>
                                <span><?php echo $settings['play_button_text'] ?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		<?php
	}	
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Lc_Video() );