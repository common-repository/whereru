<?php
if( !defined( 'ABSPATH') && !defined('WP_UNINSTALL_PLUGIN') )
    exit();
 
function whereru_delete_plugin() {
	global $wpdb;
	delete_option('whereru_prev_header');
	delete_option('whereru_prev_loc' );
	delete_option('whereru_prev_link');	
	delete_option('whereru_curr_header');
	delete_option('whereru_curr_loc' );	
	delete_option('whereru_curr_link');
	delete_option('whereru_next_header');
	delete_option('whereru_next_loc' );
	delete_option('whereru_next_link');	
	delete_option('whereru_use_css');
	delete_option('whereru_show_prev');
	delete_option('whereru_show_curr');
	delete_option('whereru_show_next');  
	delete_option('whereru_activity_pic_option');
	delete_option('whereru_activity_pic');
}

whereru_delete_plugin();

?>
