<?php
namespace Elementor;

class AnimationText_Widget extends Widget_Base {


	public function get_name() {
		return 'animationText';
	}

	public function get_title() {
		return __( 'AnimationText', 'dom' );
	}

	public function get_icon() {
		return 'eicon-animation-text';
	}

	public function get_categories() {
		return array( 'talib' );
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'content_section',
			array(
				'label' => __( 'Animation Text', 'dom' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'normal_text',
			array(
				'label'       => __( 'Normal Text', 'dom' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'We are ', 'dom' ),
				'placeholder' => __( 'We are', 'dom' ),
			)
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'animation_text',
			array(
				'label'   => __( 'Animation Text', 'dom' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Designer', 'dom' ),
			)
		);
		$this->add_control(
			'animation_text_list',
			array(
				'label'       => __( 'Animation Text List', 'dom' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'default' => __( 'Designer', 'dom' ),
					),
				),
				'title_field' => '{{{ animation_text }}}',
			)
		);
		$this->end_controls_section();

	}

	protected function render() {
		$settings               = $this->get_settings_for_display();
		$normalText             = $settings['normal_text'];
		$animation_text_list    = $settings['animation_text_list'];
		$animation_text_strings = '';
		if ( $animation_text_list ) {
			foreach ( $animation_text_list as $key => $text ) {
				// $animation_text_strings = '"'.$text['animation_text'].'",';
				$animation_text_strings .= $text['animation_text'] . ', ';
			}
		}
		?>
		<div class="typed_wrap">
			<h1><?php echo $normalText; ?><span data-animation_text="<?php print_r( $animation_text_strings ); ?>" class="typed"></span></h1>
	</div>
		<?php
	}
}

