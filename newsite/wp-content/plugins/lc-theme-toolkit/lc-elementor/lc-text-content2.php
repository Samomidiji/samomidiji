<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Widget_Lc_Text_Content2 extends Widget_Base {

	public function get_name() {
		return 'lc-text-content2';
	}

	public function get_title() {
		return 'Text Content 2';
	}

	public function get_icon() {
		return 'fa fa-align-center';
	}

	public function get_categories() {
		return [ 'lc-elementor' ];
	}


	protected function _register_controls() {
		$this->start_controls_section(
			'tab_content',
			[
				'label' => 'Text Content 2',
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

		$repeater = new Repeater();

		$repeater->add_control(
			'item_title', 
			[
				'type' => Controls_Manager::TEXT,
				'label' => 'Title',
				'label_block' => true
			]
		);

		$repeater->add_control(
			'item_content', 
			[
				'type' => Controls_Manager::TEXTAREA,
				'label' => 'Content'
			]
		);

		$this->add_control(
			'text_content2_item',
			[
				'type' => Controls_Manager::REPEATER,
				'label' => 'Text content item',
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ item_title }}}',
				'prevent_empty' => false
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => 'Content',
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'typography',
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_3,
				'selector' 	=> '{{WRAPPER}} p',
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
				<div class="col-md-8 offset-md-2">
                    <div class="rotate-text mar-top-30">
                    	<h3 class="textFadeUp <?php echo $settings['title_rotation'] === 'yes' ? 'mar-bot-30' : '' ?>"><?php echo $settings['title']; ?></h3>
                    </div>
            	<?php else: ?>
                <div class="col-md-3 mar-top-30">
                    <h3 class="textFadeUp"><?php echo $settings['title']; ?></h3>
                </div>
                <div class="col-md-8 offset-md-1">
                	<?php endif ?>
                    <div class="row">
                    	<?php foreach ($settings['text_content2_item'] as $tc_item): ?>
                        <div class="col-sm-6 mar-top-30">
	                        <h5><?php echo $tc_item['item_title']; ?></h5>
	                        <p><?php echo $tc_item['item_content']; ?></p>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}	
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Lc_Text_Content2() );