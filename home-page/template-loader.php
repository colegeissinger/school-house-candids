<?php

	
    /**
     * Registers our meta box with WordPress
     * @return void
     *
     * @version 0.1
     * @since   0.1
     */
    function shc_home_page_meta_box() {
    	global $post;

    	$front_page = get_option( 'page_on_front' );
    	
		// We only want to load our meta box when our front page is being edited
		if ( $post->ID == $front_page )
	    	add_meta_box( 'shc-homepage', 'Home Page Title', 'shc_hp_mb', 'page', 'normal', 'high' );
    }
    add_action( 'add_meta_boxes', 'shc_home_page_meta_box' );


    /**
     * Contains our HTML code that has the textarea so we can input our custom text
     * @param  object $post The post object
     * 
     * @version 0.1
     * @since   0.1
     */
    function shc_hp_mb( $post ) { 
    	$values = get_post_meta( $post->ID, 'shc-homepage-title', true ); ?>
		<label for="shc-homepage-title"></label>
		<textarea name="shc-homepage-title" id="shc-homepage-title" style="width:100%; height:100px;"><?php echo ( ! empty( $values ) ) ? esc_textarea( $values ) : ''; ?></textarea>
		<?php wp_nonce_field( 'shc-save-homepage-title', 'shc-nonce' ); ?>
    <?php }


    /**
     * Saves our cute little meta box
     * @param  integer $post_id The ID of the post we are saving
     * @return voi
     */
    function shc_home_page_save_meta_box( $post_id ) {
    	// Make sure we're not auto saving..
    	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
    		return;

    	// Make sure we sent our nonce and it validates
    	if ( ! isset( $_POST['shc-nonce'] ) || ! wp_verify_nonce( $_POST['shc-nonce'], 'shc-save-homepage-title' ) )
    		return;

    	// Lastly, we'll make sure our user has the right privileges
    	if ( ! current_user_can( 'edit_post' ) )
    		return;

    	// Check that we actual passed some data to our textarea and save it
    	if ( isset( $_POST['shc-homepage-title'] ) && ! empty( $_POST['shc-homepage-title'] ) ) {
    		update_post_meta( $post_id, 'shc-homepage-title', wp_kses_post( $_POST['shc-homepage-title'] ) );
    	}
    }
    add_action( 'save_post', 'shc_home_page_save_meta_box' );  