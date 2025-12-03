<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Widget_Lc_Portfolio extends Widget_Base {

	public function get_name() {
		return 'lc-portfolio';
	}

	public function get_title() {
		return 'Portfolio';
	}

	public function get_icon() {
		return 'fa fa-folder-o';
	}

	public function get_categories() {
		return [ 'lc-elementor' ];
	}

	public function portfolio_taxonomy() {
		$terms = get_terms('portfolio-category');
		foreach ($terms as $term) {
			$taxonomy[$term->slug] = $term->name;
		}
		return $taxonomy;
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'tab_content',
			[
				'label' => 'Portfolio',
			]
		);

		$this->add_control(
			'category_name',
			[
				'type'			=> Controls_Manager::SELECT2,
				'label'			=> 'Category',
				'description'	=> 'Select the name of categories you want to pull posts from (optional)',
				'label_block'	=> true,
				'multiple'		=> true,
				'options'		=> $this->portfolio_taxonomy()
			]
		);

		$this->add_control(
			'order_by',
			[
				'type'			=> Controls_Manager::SELECT,
				'label'			=> 'Order by',
				'label_block'	=> true,
				'options'		=> [
					'ID'		=> 'Post ID',
					'author'	=> 'Author',
					'title'		=> 'Title',
					'name'		=> 'Post name (post slug)',
					'date'		=> 'Date',
					'modified'	=> 'Last modified date',
					'rand'		=> 'Random order'
				]
			]
		);

		$this->add_control(
			'order_post',
			[
				'type'			=> Controls_Manager::SELECT,
				'label'			=> 'Order post',
				'label_block'	=> true,
				'options'		=> [
					'ASC'		=> 'ASC',
					'DESC'		=> 'DESC'
				]
			]
		);

		$this->add_control(
			'filter',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => 'Filter'
			]
		);

		$this->add_control(
			'all_text',
			[
				'label' => '"All" Text',
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'condition' => [
					'filter' => 'yes'
				]	
			]
		);

		$this->add_control(
			'number_item',
			[
				'type'			=> Controls_Manager::SELECT,
				'label'			=> 'Items On Row',
				'label_block'	=> true,
				'options'		=> [
					'two-col'	=> '2 Items',
					'three-col'	=> '3 Items'
				],
				'default' => 'two-col'
			]
		);

		$this->add_control(
			'tc_hover',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => 'Title and Category on Hover'
			]
		);

		$this->add_control(
			'reveal_effect_disable',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => 'Reveal effect disable'
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        $arg = array(
            'post_type'   =>  'portfolio',
            'posts_per_page'  =>  -1,
        );
        if( $settings['order_by'] ){
            $arg['orderby'] = $settings['order_by'];
        }
        if( $settings['order_post'] ){
            $arg['order'] = $settings['order_post'];
        }
        if( $settings['category_name'] ){
            $arg['tax_query'] = array(
                'relation' => 'OR',
                array(
                    'taxonomy'   =>  'portfolio-category',
                    'field' => 'slug', 
                    'terms' => $settings['category_name']
                )
            );
        }
        $portfolio = new \WP_Query( $arg );
		?>

		<?php if ( $settings['filter'] === 'yes' ): ?>
        <div class="container filters text-right">
            <ul id="filters">
            	<?php if ($settings['all_text']): ?>
                <li class="active" data-filter="*"><?php echo $settings['all_text']; ?></li>
                <?php endif ?>
                <?php
                $term_slug = array();
                $term_name = array();
                while($portfolio->have_posts()) {
                    $portfolio->the_post();
                    $terms = get_the_terms(get_the_id(), 'portfolio-category');
                    if ( !empty( $terms ) ) {
                       	foreach ($terms as $term) {	
	                        if (!in_array($term->name, $term_name )) {
	                            $term_slug[] = $term->slug;
	                            $term_name[] = $term->name;
	                        }
	                    }
                    }
                }
                for ($i=0; $i<count($term_name); $i++) : ?>
                <li class="<?php echo (!$settings['all_text'] && $i==0) ? 'active' : '' ?>" data-filter=".<?php echo esc_attr($term_slug[$i]); ?>"><?php echo esc_html( $term_name[$i] ); ?></li>
                <?php endfor; ?>
            </ul>
        </div>
        <?php endif ?>
        <div class="container-fluid">
            <div id="portfolio-container" class="creative row mar-top-70 <?php echo $settings['number_item'] ?> <?php echo ($settings['tc_hover'] === 'yes') ? 'title-tooltip' : 'portfolio-overlay' ?>">
                <?php
                $row_no = 0; 
                while($portfolio->have_posts()) : $portfolio->the_post();
                $terms = get_the_terms(get_the_id(), 'portfolio-category');
                $term_slug = array();
                $term_name = array();
                if ( !empty( $terms ) ) {
                    foreach ($terms as $term) {
                      $term_slug[] = $term->slug;
                      $term_name[] = $term->name;
                    }                
                }
                ?>
                <?php 
                if ($settings['number_item'] == 'three-col') {
                	if ($portfolio->current_post % 2 != 0) {
                		$wide_class = 'wide';
                	}
                	else {
                			$wide_class = '';
                	}
                } 
                else {
                	if ($portfolio->current_post % 2 == 0) {
                		$row_no++;
                	}
                	if ($row_no % 2 == 0) {
                		if ($portfolio->current_post % 2 == 0) {
                			$wide_class = 'wide';
                		} 
                		else {
                			$wide_class = '';
                		}	
                	}
                	else {
                		if ($portfolio->current_post % 2 == 0) {
                			$wide_class = '';
                		} 
                		else {
                			$wide_class = 'wide';
                		}
                	}
                }
                ?>                                 
                <div class="portfolio-item <?php echo $wide_class ?> <?php echo join( " ", $term_slug) ?>">
                    <a class="ajax-link" href="<?php the_permalink() ?>" data-src="<?php the_post_thumbnail_url( 'full' ) ?>">
                        <div class="portfolio-content">
                            <div class="portfolio-parallax">
                                <div class="portfolio-img-content parallax-inner <?php echo ($settings['reveal_effect_disable'] === 'yes') ? '' : 'reveal-effect' ?>">
                                </div>
                            </div>
                            <?php if ($settings['tc_hover'] === 'yes'): ?>
							<div class="portfolio-text-content">
                                <div class="portfolio-text">
                                    <h3><span><?php the_title(); ?></span></h3>
                                    <span><?php echo join( " / ", $term_name) ?></span>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="portfolio-text-content left-top">
                                <div class="portfolio-text">
                                    <span><?php echo join( " / ", $term_name) ?></span>
                                    <h3><?php the_title(); ?></h3>
                                </div>
                            </div>
                            <?php endif ?>
                        </div>
                    </a>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
		<?php
	}	
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Lc_Portfolio() );