<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Widget_Lc_Contact extends Widget_Base {

	public function get_name() {
		return 'lc-contact';
	}

	public function get_title() {
		return 'Contact';
	}

	public function get_icon() {
		return 'fa fa-envelope-o';
	}

	public function get_categories() {
		return [ 'lc-elementor' ];
	}


	protected function contact_form_list() {
		$contact_forms = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

		$cf7_list = array();
		if ( $contact_forms ) {
			$cf7_list[] = 'Select Contact Form';
			foreach ( $contact_forms as $cform ) {
				$cf7_list[ $cform->ID ] = $cform->post_title;
			}
		} 
		else {
			$cf7_list[] = 'No contact forms found';
		}

		return $cf7_list;
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'tab_content',
			[
				'label' => 'Contact',
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
				'label' => 'Content',
				'description' => esc_html('Insert <br> for line break')
			]
		);

		$this->add_control(
			'contact_item',
			[
				'type' => Controls_Manager::REPEATER,
				'label' => 'Contact item',
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ item_title }}}',
				'prevent_empty' => false
			]
		);

		$this->add_control(
			'select_contact_form',
			[
				'type'			=> Controls_Manager::SELECT,
				'label'			=> 'Select contact form',
				'label_block'	=> true,
				'options'		=> $this->contact_form_list()
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="container">
            <div class="row">
            	<?php if ($settings['contact_item']): ?>
				<div class="<?php echo $settings['select_contact_form'] ? 'col-md-4' : 'col-md-12' ?>">
                    <div class="contact-info mar-top-70">
                    	<?php foreach ($settings['contact_item'] as $key => $c_item): ?>
                        <div class="details <?php echo $key == 0 ? '' : 'mar-top-30'  ?>">
                            <h3><?php echo $c_item['item_title']; ?></h3> 
                            <?php echo $c_item['item_content']; ?>
                        </div>            		
                    	<?php endforeach ?>
                    </div>
                </div>
            	<?php endif ?>
                <div class="<?php echo $settings['contact_item'] ? 'col-md-7 offset-md-1' : 'col-md-12' ?>">
				<?php 
				if ($settings['select_contact_form']) {
					echo do_shortcode( '[contact-form-7 id="'. $settings['select_contact_form'] .'" html_class="contact-form mar-top-70"]' );
				}
				?>
                </div>
            </div>
        </div>
		<?php
	}	
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Lc_Contact() );