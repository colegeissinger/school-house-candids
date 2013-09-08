<?php
	
	/**
	 * Creates the Custom Post Type for the Testimonials
	 * @return void
	 *
	 * @version 0.1
	 * @since   0.1
	 */
	function testimonial_init() {
		register_post_type( 'testimonial', array(
			'hierarchical'        => false,
			'public'              => true,
			'show_in_nav_menus'   => true,
			'show_ui'             => true,
			'supports'            => array( 'title', 'editor' ),
			'has_archive'         => true,
			'query_var'           => true,
			'rewrite'             => true,
			'labels'              => array(
				'name'                => __( 'Testimonials', 'shc_ext' ),
				'singular_name'       => __( 'Testimonials', 'shc_ext' ),
				'add_new'             => __( 'Add new Testimonials', 'shc_ext' ),
				'all_items'           => __( 'Testimonials', 'shc_ext' ),
				'add_new_item'        => __( 'Add new Testimonials', 'shc_ext' ),
				'edit_item'           => __( 'Edit Testimonials', 'shc_ext' ),
				'new_item'            => __( 'New Testimonials', 'shc_ext' ),
				'view_item'           => __( 'View Testimonials', 'shc_ext' ),
				'search_items'        => __( 'Search Testimonials', 'shc_ext' ),
				'not_found'           => __( 'No Testimonials found', 'shc_ext' ),
				'not_found_in_trash'  => __( 'No Testimonials found in trash', 'shc_ext' ),
				'parent_item_colon'   => __( 'Parent Testimonials', 'shc_ext' ),
				'menu_name'           => __( 'Testimonials', 'shc_ext' ),
			),
		) );

	}
	add_action( 'init', 'testimonial_init' );


	/**
	 * Filters the "update messages" for the testimonial CPT
	 * @param  array $messages The indexed array that contains the default messages
	 * @return array
	 *
	 * @version 0.1
	 * @since   0.1
	 */
	function testimonial_updated_messages( $messages ) {
		global $post;

		$permalink = get_permalink( $post );

		$messages['testimonial'] = array(
			0 => '', // Unused. Messages start at index 1.
			1 => sprintf( __('Testimonials updated. <a target="_blank" href="%s">View Testimonials</a>', 'shc_ext'), esc_url( $permalink ) ),
			2 => __('Custom field updated.', 'shc_ext'),
			3 => __('Custom field deleted.', 'shc_ext'),
			4 => __('Testimonials updated.', 'shc_ext'),
			/* translators: %s: date and time of the revision */
			5 => isset($_GET['revision']) ? sprintf( __('Testimonials restored to revision from %s', 'shc_ext'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => sprintf( __('Testimonials published. <a href="%s">View Testimonials</a>', 'shc_ext'), esc_url( $permalink ) ),
			7 => __('Testimonials saved.', 'shc_ext'),
			8 => sprintf( __('Testimonials submitted. <a target="_blank" href="%s">Preview Testimonials</a>', 'shc_ext'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
			9 => sprintf( __('Testimonials scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Testimonials</a>', 'shc_ext'),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
			10 => sprintf( __('Testimonials draft updated. <a target="_blank" href="%s">Preview Testimonials</a>', 'shc_ext'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		);

		return $messages;
	}
	add_filter( 'post_updated_messages', 'testimonial_updated_messages' );
