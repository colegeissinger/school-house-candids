<?php
	class SHC_Slider_Shortcode {

		public function __construct() {
			add_shortcode( 'testimonials', array( $this, 'shc_testimonial_slider' ) );

			add_action( 'wp_print_scripts', array( $this, 'print_resources' ) );
		}

		public function shc_testimonial_slider( $atts ) {

			extract( shortcode_atts( array(
				'id' => 'main-slider',
				'class' => '',
				'hide' => '',
				'max' => 5,
				'show_title' => false,
			), $atts ) );

			$args = array(
				'post_type' => 'testimonial',
				'posts_per_page'  => intval( $max ),
				'post__not_in' => array( intval( $hide ) ),
			);
			$testimonials = new WP_Query( $args );
			$output = '';
			$output .= '<div class="liquid-slider' . ( ! empty( $class ) ? ' ' . esc_attr( $class ) : '' ) . '" id="' . esc_attr( $id ) . '">';
				while( $testimonials->have_posts() ) : $testimonials->the_post();
					$output .= '<div>';
						if ( $show_title ) :
							$output .= '<h2 class="title">' . get_the_title() . '</h2>';
						endif;
						$output .= get_the_content();
					$output .= '</div>';
				endwhile;
			$output .= '</div>';

			return $output;
		}

		public function print_resources() {

			wp_enqueue_style( 'shc-slider-animate', plugins_url( 'resources/css/animate.css', dirname( __FILE__ ) ), null, '0.1' );
			wp_enqueue_style( 'shc-slider-slider', plugins_url( 'resources/css/liquid-slider.css', dirname( __FILE__ ) ), null, '0.1' );

			wp_enqueue_script( 'shc-slider-easing', plugins_url( 'resources/js/jquery.easing.1.3.js', dirname( __FILE__ ) ), array( 'jquery' ), '1.3', true );
			wp_enqueue_script( 'shc-slider-touch', plugins_url( 'resources/js/jquery.touchSwipe.min.js', dirname( __FILE__ ) ), array( 'jquery' ), '0.1', true );
			wp_enqueue_script( 'shc-slider-liquid', plugins_url( 'resources/js/jquery.liquid-slider-custom.min.js', dirname( __FILE__ ) ), array( 'jquery' ), '2.0.8', true );
		}
	}

	new SHC_Slider_Shortcode();