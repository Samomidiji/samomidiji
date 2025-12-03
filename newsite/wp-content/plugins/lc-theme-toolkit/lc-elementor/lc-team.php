<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Widget_Lc_Team extends Widget_Base {

	public function get_name() {
		return 'lc-team';
	}

	public function get_title() {
		return 'Team';
	}

	public function get_icon() {
		return 'fa fa-users';
	}

	public function get_categories() {
		return [ 'lc-elementor' ];
	}


	protected function _register_controls() {
		$this->start_controls_section(
			'tab_content',
			[
				'label' => 'Team',
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

		$repeater = new Repeater();

		$repeater->add_control(
			'member_avatar', 
			[
				'type' => Controls_Manager::MEDIA,
				'label' => 'Member avatar',
				'label_block' => true
			]
		);

		$repeater->add_control(
			'member_name', 
			[
				'type' => Controls_Manager::TEXT,
				'label' => 'Member name',
				'label_block' => true
			]
		);
		$repeater->add_control(
			'member_position', 
			[
				'type' => Controls_Manager::TEXT,
				'label' => 'Member position',
				'label_block' => true
			]
		);

		$repeater->add_control(
			'social1_name', 
			[
				'type' => Controls_Manager::TEXT,
				'label' => 'Social name',
				'label_block' => true
			]
		);
		$repeater->add_control(
			'social1_link', 
			[
				'type' => Controls_Manager::URL,
				'label' => 'Social link'
			]
		);

		$repeater->add_control(
			'social2_name', 
			[
				'type' => Controls_Manager::TEXT,
				'label' => 'Social name',
				'label_block' => true
			]
		);
		$repeater->add_control(
			'social2_link', 
			[
				'type' => Controls_Manager::URL,
				'label' => 'Social link'
			]
		);

		$repeater->add_control(
			'social3_name', 
			[
				'type' => Controls_Manager::TEXT,
				'label' => 'Social name',
				'label_block' => true
			]
		);
		$repeater->add_control(
			'social3_link', 
			[
				'type' => Controls_Manager::URL,
				'label' => 'Social link'
			]
		);

		$this->add_control(
			'team_member',
			[
				'type' => Controls_Manager::REPEATER,
				'label' => 'Team member',
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ member_name }}}',
				'prevent_empty' => false
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <h3 class="textFadeUp"><?php echo $settings['title']?></h3>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="row">

                    	<?php foreach ($settings['team_member'] as $t_mem): ?>
                        <div class="col-sm-4">
                            <div class="team-member">
                                <div class="team-avatar reveal-effect">
                                    <img src="<?php echo $t_mem['member_avatar']['url'] ?>" alt="<?php echo get_the_title($t_mem['member_avatar']['id']); ?>"/>
                                </div>
                                <div class="team-info">
                                    <h5 class="team-name"><?php echo $t_mem['member_name']?></h5>
                                    <h6 class="team-job"><?php echo $t_mem['member_position']?></h6>
                                    <ul class="team-social">
                                    	<?php if ($t_mem['social1_name']): ?>
                                        <li><a <?php echo $t_mem['social1_link']['is_external'] ? 'target="_blank"' : ''; ?> <?php echo $t_mem['social1_link']['nofollow'] ? 'rel="nofollow"' : ''; ?> href="<?php echo $t_mem['social1_link']['url'] ?>"><?php echo $t_mem['social1_name']?></a></li>
                                    	<?php endif ?>
                                    	<?php if ($t_mem['social2_name']): ?>
                                        <li><a <?php echo $t_mem['social2_link']['is_external'] ? 'target="_blank"' : ''; ?> <?php echo $t_mem['social2_link']['nofollow'] ? 'rel="nofollow"' : ''; ?> href="<?php echo $t_mem['social2_link']['url'] ?>"><?php echo $t_mem['social2_name']?></a></li>
                                        <?php endif ?>
                                        <?php if ($t_mem['social3_name']): ?>
                                        <li><a <?php echo $t_mem['social3_link']['is_external'] ? 'target="_blank"' : ''; ?> <?php echo $t_mem['social3_link']['nofollow'] ? 'rel="nofollow"' : ''; ?> href="<?php echo $t_mem['social3_link']['url'] ?>"><?php echo $t_mem['social3_name']?></a></li>
                                        <?php endif ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}	
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Lc_Team() );