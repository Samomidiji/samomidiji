<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Widget_Lc_Map extends Widget_Base {

	public function get_name() {
		return 'lc-map';
	}

	public function get_title() {
		return 'Map';
	}

	public function get_icon() {
		return 'fa fa-map-marker';
	}

	public function get_categories() {
		return [ 'lc-elementor' ];
	}


	protected function _register_controls() {
		$this->start_controls_section(
			'tab_content',
			[
				'label' => 'Map',
			]
		);

		$this->add_control(
			'latitude',
			[
				'type' => Controls_Manager::TEXT,
				'label' => 'Latitude',
				'label_block' => true,
				'description' => '<a href="http://labs.mondeca.com/geo/anyplace.html" target="_blank"> Here is a tool</a> where you can find Latitude & Longitude of your location'
			]
		);

		$this->add_control(
			'longitude',
			[
				'type' => Controls_Manager::TEXT,
				'label' => 'Longitude',
				'label_block' => true,
				'description' => '<a href="http://labs.mondeca.com/geo/anyplace.html" target="_blank"> Here is a tool</a> where you can find Latitude & Longitude of your location'
			]
		);

		$this->add_control(
		    'marker_icon',
		    [
		    	'type'          => Controls_Manager::MEDIA,
		        'label'         => 'Marker Icon',
		        'label_block'   => true
		    ]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( $settings['latitude'] && $settings['longitude'] ) :
		?>
        <div class="container">
            <div id="mapid" class="listing-thump-map" data-lat="<?php echo $settings['latitude'] ?>" data-lang="<?php echo $settings['longitude'] ?>" data-markericon="<?php echo $settings['marker_icon']['url'] ?>">
            </div>
        </div>
		<?php
		endif;
	}	
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Lc_Map() );