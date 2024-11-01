<?php
/**
 * @package WhereRU
 * @author Ray Gomez
 * @version .01
 */
/*
Plugin Name: WhereRU
Description: A sidebar widget that displays user modifiable location
Author: Ray Gomez
Version: .1.0
Author URI: http://www.thetravelingcoder.com/
License: GPL2

    Copyright 2010  Ray Gomez

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_action('admin_menu', 'whereru_create_menu');

//add_action( 'wp_print_scripts', 'enqueue_whereru_scripts' );
add_action( 'wp_print_styles', 'enqueue_whereru_styles' );

//Admin options
add_action('admin_print_styles', 'enqueue_whereru_admin_styles');
add_action('admin_print_scripts', 'enqueue_whereru_admin_scripts');

function enqueue_whereru_styles(){
    if ( (bool) get_option('whereru_use_css') ){
        wp_enqueue_style( 'whereru-style', '/wp-content/plugins/whereru/css/whereru-style.css');    
    }
}

function enqueue_whereru_admin_styles(){
    //don't load style if not on admin page
    if(!isset($_GET['page']))
			return;
			
    wp_enqueue_style( 'whereru-admin-style','/wp-content/plugins/whereru/css/whereru-admin.css');
}

function enqueue_whereru_admin_scripts(){
    //don't load scrypts if not on admin page
    if(!isset($_GET['page']))
			return;
    wp_enqueue_script( 'jquery-script', '/wp-content/plugins/whereru/js/jquery-1.4.2.js', array( 'jquery' ));
    wp_enqueue_script( 'jquery-ui-script','/wp-content/plugins/whereru/js/jquery-ui-1.8.js', array( 'jquery-script'));
}


function whereru_create_menu() {

	//create new top-level menu
	add_menu_page('WhereRU Plugin Settings', 'WhereRU Settings', 'administrator', __FILE__, 'whereru_settings_page',plugins_url('/images/icon.png', __FILE__));

	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}

function register_mysettings() {
	//register our settings
	register_setting( 'whereru-settings-group', 'whereru_prev_header');
	register_setting( 'whereru-settings-group', 'whereru_prev_loc' );
	register_setting( 'whereru-settings-group', 'whereru_prev_link');
	
	register_setting( 'whereru-settings-group', 'whereru_curr_header');
	register_setting( 'whereru-settings-group', 'whereru_curr_loc' );	
	register_setting( 'whereru-settings-group', 'whereru_curr_link');

	register_setting( 'whereru-settings-group', 'whereru_next_header');
	register_setting( 'whereru-settings-group', 'whereru_next_loc' );
	register_setting( 'whereru-settings-group', 'whereru_next_link');

	//plugin options
	register_setting('whereru-settings-group', 'whereru_use_css');
	register_setting( 'whereru-settings-group', 'whereru_show_prev');
	register_setting( 'whereru-settings-group', 'whereru_show_curr');
	register_setting( 'whereru-settings-group', 'whereru_show_next');  
	register_setting( 'whereru-settings-group', 'whereru_activity_pic_option');
	register_setting( 'whereru-settings-group', 'whereru_activity_pic');
	
	  
}

function whereru_settings_page() {
?>

<div class="wrap">
<h2>WhereRU!?</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'whereru-settings-group' ); ?>

<script type="text/javascript">
	$(function() {
		$("#whereru_tabs").tabs();
	});
</script>

	<div id="whereru_tabs">	
		<ul class="tabs">
			<li><a href="#previous_form"><?php _e("Previous"); ?></a></li>
			<li><a href="#current_form"><?php _e("Current"); ?></a></li>
			<li><a href="#next_form"><?php _e("Next"); ?></a></li>
			<li><a href="#options_form"><?php _e("Options"); ?></a></li>
			<li><a href="#about_form"><?php _e("About"); ?></a></li>
		</ul>

       <div id="whereru_container">
       <div id="previous_form">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e("Previous Header"); ?></th>
                    <td><input type="text" size="30" name="whereru_prev_header" value="<?php echo get_option('whereru_prev_header'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Previous Location"); ?></th>
                    <td><input type="text" size="30" name="whereru_prev_loc" value="<?php echo get_option('whereru_prev_loc'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Previous Link"); ?></th>
                    <td><input type="text" size="30" name="whereru_prev_link" value="<?php echo get_option('whereru_prev_link'); ?>" /></td>
                </tr>
            </table>
        </div>
        
        <div id="current_form">
            <table class="form-table">
                <tr>
                    <th scope="row"><?php _e("Current Header"); ?></th>
                    <td><input type="text" size="30" name="whereru_curr_header" value="<?php echo get_option('whereru_curr_header'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Current Location"); ?></th>
                    <td><input type="text" size="30" name="whereru_curr_loc" value="<?php echo get_option('whereru_curr_loc'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Current Link"); ?></th>
                    <td><input type="text" size="30" name="whereru_curr_link" value="<?php echo get_option('whereru_curr_link'); ?>" /></td>
                </tr>
            </table>
        </div>
        <div id="next_form">
            <table class="form-table">
                <tr>
                    <th scope="row"><?php _e("Next Header"); ?></th>
                    <td><input type="text" size="30" name="whereru_next_header" value="<?php echo get_option('whereru_next_header'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Next Location"); ?></th>
                    <td><input type="text" size="30" name="whereru_next_loc" value="<?php echo get_option('whereru_next_loc'); ?>" /></td>
                </tr>
                <tr valign="top">
                   <th scope="row"><?php _e("Next Link"); ?></th>
                   <td><input type="text" size="30" name="whereru_next_link" value="<?php echo get_option('whereru_next_link'); ?>" /></td>
                   </tr>
            </table>
        </div>
        
        <div id="options_form">
            <table class="form-table">
                <tr valign="top">
                    <td>
		        <h2><?php _e("Default Options:"); ?></h2>
			<input type="checkbox" name="whereru_use_css" <?php 
                        checked( (bool) get_option('whereru_use_css')); ?> /> 
                        <?php _e("Use Default Style?"); ?> <span class="setting-description"> 
                        <?php _e("(If unchecked you will need to copy style settings for WhereRU!? to your theme's main style)"); ?> 
                        </span></td>
                </tr>          
                <tr valign="top"><td>
			<div id="whereru_activity_pic">
	                        <input type="checkbox" name="whereru_activity_pic_option" <?php 
        	                	checked( (bool) get_option('whereru_activity_pic_option')); ?> /> 
					<?php _e("Include Activity Picture?"); ?>
				<div id="whereru_activity_wrap">
  	      		    		<div class="whereru_activity_image">
        			                <?php _e("Business"); ?><br />
        		        		<input type="radio" name="whereru_activity_pic" value="briefcase.png" <?php 
        		                	checked( get_option('whereru_activity_pic') == "briefcase.png" ); ?>> <br />
        		            		<img src="<?php echo plugins_url('/css/images', __FILE__);?>/briefcase.png" />
        		    		</div>
        		    		<div class="whereru_activity_image">
        			                <?php _e("Backpacking"); ?><br />
        		        		<input type="radio" name="whereru_activity_pic" value="rucksack.png" <?php 
        		                	checked( get_option('whereru_activity_pic') == "rucksack.png"); ?>> <br />
        		            		<img src="<?php echo plugins_url('/css/images', __FILE__);?>/rucksack.png" />
        		    		</div>
        		    		<div class="whereru_activity_image">
        			                <?php _e("Holiday"); ?><br />
        		        		<input type="radio" name="whereru_activity_pic" value="pinacolada.png" <?php 
        		         	        checked( get_option('whereru_activity_pic') == "pinacolada.png"); ?>> <br />
        		             		<img src="<?php echo plugins_url('/css/images', __FILE__);?>/pinacolada.png" />
        		    		</div>
				</div>
			</div>
		</td>
		</tr>		              
                <tr valign="top">
                    <td> 
			    <span class="setting-description"> 
                            <h2><?php _e("Custom location:"); ?></h2>
                            <?php _e("Please add the following to your theme:"); ?> </span><br />
                            <div class="whereru_code">
                            if(function_exists('print_whereru')) { <br />
                                &nbsp; print_whereru(); <br /> 
                            }</div>
                            <span class="setting-description"> 
                            <?php _e("Select which locations you wish to show in your customized position:"); ?> </span><br />
                            <input type="checkbox" name="whereru_show_prev" <?php 
                                        checked( (bool) get_option('whereru_show_prev')); ?> /> 
                                        <?php _e("Show Previous Location?"); ?><br />
                                    
                            <input type="checkbox" name="whereru_show_curr" <?php 
                                        checked( (bool) get_option('whereru_show_curr')); ?> /> 
                                        <?php _e("Show Current Location?"); ?><br />          
                                                            
                            <input type="checkbox" name="whereru_show_next" <?php 
                                        checked( (bool) get_option('whereru_show_next')); ?> /> 
                                        <?php _e("Show Next Location?"); ?>
                   </td>                   
                </tr>    
            </table>    
        </div>
        <div id="about_form">
            <div id="whereru_about_info">
            <h2><?php _e("About"); ?></h2>
            <?php _e("WhereRU!? is developed by a traveling coder on a three-year trip around Asia. You can find more information about that trip"); ?> <a href="http://www.operationbackpackasia.com/about">here</a> <?php _e(" or you can jump right into reading about some of our"); ?> <a href="http://www.operationbackpackasia.com">experiences around Asia</a>.<br /><br />
            <?php _e("Information regarding this plugin, as well as reviews, tips, and advice on being a traveling coder can be found at") ?> <a href="http://www.thetravelingcoder.com">The Traveling Coder</a>. 
            <h2><?php _e("Please Help"); ?></h2>
            <?php _e("If you like this plugin, please consider a small donation to help fund our travels. Maybe even make it into a dare? Please know that every little bit goes a long way!! (ie a single beer in Laos costs about $.40) You can donate"); ?> <a href="http://www.operationbackpackasia.com/donate">here</a><br /><br /> 
            <?php _e("If you have any suggestions for the plugin, please feel free to contact the developer on"); ?> <a href="http://www.thetravelingcoder.com/contact"><?php _e("my contact page."); ?> </a>
            </div>            
        </div>
                
    </div> <!-- end of options whereru container -->
    </div> <!-- end of options div wrap -->
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

</form>
</div><?php 
}

function print_whereru() {

	$prev_loc = get_option('whereru_prev_loc');
	$prev_header = get_option('whereru_prev_header');
	$prev_link = get_option('whereru_prev_link');	
		
	$curr_loc = get_option('whereru_curr_loc');
	$curr_header = get_option('whereru_curr_header');
	$curr_link = get_option('whereru_curr_link');	

	$next_loc = get_option('whereru_next_loc');
	$next_header = get_option('whereru_next_header');
	$next_link = get_option('whereru_next_link');	

        $activity_option = get_option('whereru_activity_pic_option');
	$activity_pic = get_option('whereru_activity_pic');

	echo '<div id="whereru_content_wrap">';

        if ( $activity_option ) {
		if ( $activity_pic == "pinacolada.png" ) 
		        echo '<div id="whereru_content" class="whereru_holiday">';
                else if ( $activity_pic == "briefcase.png" )
		        echo '<div id="whereru_content" class="whereru_business">';
                else
		        echo '<div id="whereru_content" class="whereru_backpacking">';
	}
	else{
	        echo '<div id="whereru_content">';
	}
        
	/* Show previous location */
	if ( get_option('whereru_show_prev') ) {
	    echo '<div class="whereru_prev_location">';
		echo '<h2>' . $prev_header . '</h2>';
		echo '<div class="whereru_loc">';
		if($prev_link)
		    echo '<a href="' . $prev_link . '">' . $prev_loc . '</a>';
		else
		    echo $prev_loc;
        echo '</div>';
        echo '</div>';

    }

	/* Show current location */
	if ( get_option('whereru_show_curr') ){
	    echo '<div class="whereru_curr_location">';
		echo '<h2>' . $curr_header . '</h2>';
		echo '<div class="whereru_loc">';
		if($curr_link)
		    echo '<a href="' . $curr_link . '">' . $curr_loc . '</a>';
		else
		    echo $curr_loc;
        echo '</div>';
        echo '</div>';
	}

	/* Show next location */
	if ( get_option('whereru_show_next') ){
	    echo '<div class="whereru_next_location">';
		echo '<h2>' . $next_header . '</h2>';
		echo '<div class="whereru_loc">';
		if($next_link)
		    echo '<a href="' . $next_link . '">' . $next_loc . '</a>';
		else
		    echo $next_loc;			
        echo '</div>';
        echo '</div>';
	}
    echo '</div></div>';
}

/* XML-RPC Support 
add_filter('xmlrpc_methods', 'whereru_xmlrpc_methods');

function whereru_xmlrpc_methods($methods){
	$methods['whereru_set_locs'] = 'whereru_set_locs';
	return $methods;
}

/* */

	/**
	 * Log user in.
	 *
	 * @since 2.8
	 *
	 * @param string $username User's username.
	 * @param string $password User's password.
	 * @return mixed WP_User object if authentication passed, false otherwise
	 */
	function login($username, $password) {
		if ( !get_option( 'enable_xmlrpc' ) ) {
			$this->error = new IXR_Error( 405, sprintf( __( 'XML-RPC services are disabled on this blog.  An admin user can enable them at %s'),  admin_url('options-writing.php') ) );
			return false;
		}

		$user = wp_authenticate($username, $password);

		if (is_wp_error($user)) {
			$this->error = new IXR_Error(403, __('Bad login/pass combination.'));
			return false;
		}

		set_current_user( $user->ID );
		return $user;
	}

function whereru_set_locs($args){

	$blog_ID	= (int) $args[0];
	$username	= $wpdb->escape($args[1]);
	$password	= $wpdb->escape($args[2]);
	$data		= $args[3];
 
	global $wp_xmlrpc_server;
 
    // Check if user is allowed
	$user = wp_authenticate($username, $password);

	if (is_wp_error($user)) {
		$this->error = new IXR_Error(403, __('Bad login/pass combination.'));
			return false;
	}

	/*if ( !current_user_can('NextGEN Upload images') ) {
		logIO('O', '(NGG) User does not have upload_files capability');
		$this->error = new IXR_Error(401, __('You are not allowed to upload files to this site.'));
		return $this->error;
	}*/

    // Check if user is Admin
    //$is_admin = current_user_can('level_8');

	// Grab custom info
    $prev_header = $data["prev_header"];
    $prev_loc = $data["prev_loc"];
    $prev_link = $data["prev_link"];
    
    $curr_header = $data["curr_header"];
    $curr_loc = $data["curr_loc"];
    $curr_link = $data["curr_link"];
    
    $next_header = $data["next_header"];
    $next_loc = $data["next_loc"];
    $next_link = $data["next_link"];
  
	return "Success!";
} 

/* Widget support */
add_action('widgets_init', create_function('', 'return register_widget("WhereRU_Widget");'));

class WhereRU_Widget extends WP_Widget {
	function WhereRU_Widget() {
    	$widget_ops = array( 'classname' => 'widget_WhereRU', 'description' => __( "Show your previous, current, and next location with people!" ) );
	    $this->WP_Widget('whereru', __('WhereRU!?'), $widget_ops);
	}
	
    // This code displays the widget on the screen.
    function widget($args, $instance) {
	    extract($args);
	    
        /* User-selected settings. */
	$title = apply_filters('widget_title', $instance['title'] );
        
 	$prev_loc = get_option('whereru_prev_loc');
    	$prev_header = get_option('whereru_prev_header');
	$prev_link = get_option('whereru_prev_link');	
		
    	$curr_loc = get_option('whereru_curr_loc');
	$curr_header = get_option('whereru_curr_header');
	$curr_link = get_option('whereru_curr_link');	

	$next_loc = get_option('whereru_next_loc');
	$next_header = get_option('whereru_next_header');
	$next_link = get_option('whereru_next_link');	
    
        $activity_option = get_option('whereru_activity_pic_option');
	$activity_pic = get_option('whereru_activity_pic');

	    echo $before_widget;
	    if( !empty($instance['title']) && $instance['show_title'] ) {
		    echo $before_title . $instance['title'] . $after_title;
	    }

	echo '<div id="whereru_content_wrap">';

        if ( $activity_option ) {
		if ( $activity_pic == "pinacolada.png" ) 
		        echo '<div id="whereru_content" class="whereru_holiday">';
                else if ( $activity_pic == "briefcase.png" )
		        echo '<div id="whereru_content" class="whereru_business">';
                else
		        echo '<div id="whereru_content" class="whereru_backpacking">';
	}
	else{
	        echo '<div id="whereru_content">';
	}

    	/* Show previous location */
    	if ( $instance['show_prev'] ) {
	        echo '<div class="whereru_prev_location">';
	    	echo '<h2>' . $prev_header . '</h2>';
	    	echo '<div class="whereru_loc">';
	    	if($prev_link)
	    	    echo '<a href="' . $prev_link . '">' . $prev_loc . '</a>';
	    	else
	    	    echo $prev_loc;
            echo '</div>';
            echo '</div>';
        }

	    /* Show current location */
	    if ( $instance['show_curr'] ){
	        echo '<div class="whereru_curr_location">';
	    	echo '<h2>' . $curr_header . '</h2>';
	      	echo '<div class="whereru_loc">';
	    	if($curr_link)
		    echo '<a href="' . $curr_link . '">' . $curr_loc . '</a>';
	    	else
	    	    echo $curr_loc;
            echo '</div>';
            echo '</div>';
	    }

	    /* Show next location */
	    if ( $instance['show_next'] ){
	        echo '<div class="whereru_next_location">';
	    	echo '<h2>' . $next_header . '</h2>';
	        echo '<div class="whereru_loc">';
	    	if($next_link)
	    	    echo '<a href="' . $next_link . '">' . $next_loc . '</a>';
	    	else
	    	    echo $next_loc;			
            echo '</div>';
            echo '</div>';
	    }

        echo '</div></div>';
	    echo $after_widget;
    }       
    
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show_title'] = $new_instance['show_title'];
		$instance['show_prev'] = $new_instance['show_prev'];
		$instance['show_curr'] = $new_instance['show_curr'];
		$instance['show_next'] = $new_instance['show_next'];
		return $instance;
	}
	
	function form($instance) {
		// Our Form Function
		// Only have check boxes available for Past, Current, Next locations 
		/* Set up some default widget settings. */
		
		$defaults = array( 'title' => 'WhereRU!?', 'show_title'=> true, 'show_prev' => true, 'show_curr' => true, 'show_next' => true );
		$instance = wp_parse_args( (array) $instance, $defaults );	
		?>

		<p><input type="checkbox" id="<?php echo $this->get_field_id( 'show_title' ); ?>" name="<?php echo $this->get_field_name( 'show_title' ); ?>" <?php checked( (bool) $instance['show_title'] ); ?> /> <?php _e("Show Title"); ?>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" /> 
		</p>
        <p><input type="checkbox" id="<?php echo $this->get_field_id( 'show_prev' ); ?>" name="<?php echo $this->get_field_name( 'show_prev' ); ?>" <?php checked( (bool) $instance['show_prev'] ); ?> /> <?php _e("Show Previous Location?"); ?> </p>
        <p><input type="checkbox" id="<?php echo $this->get_field_id( 'show_curr' ); ?>" name="<?php echo $this->get_field_name( 'show_curr' ); ?>" <?php checked( (bool) $instance['show_curr'] ); ?> /> <?php _e("Show Current Location?"); ?> </p>
        <p><input type="checkbox" id="<?php echo $this->get_field_id( 'show_next' ); ?>" name="<?php echo $this->get_field_name( 'show_next' ); ?>" <?php checked( (bool) $instance['show_next'] ); ?> /> <?php _e("Show Next Location?"); ?> </p>
        <?php
	}
}

?>
