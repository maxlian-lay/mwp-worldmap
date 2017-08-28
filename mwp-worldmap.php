<?php

/*
*	Plugin Name: MWP Slider
*	Description: Simple Wordpress plugin for creating a Slider with indicator
*	Version: 1.0.0
*	Author: Maxlian Lay
*	Author URI: Contact at maxlian.lay@gmail.com
*	Tested up to: 4.8.1
*/

if ( !defined('ABSPATH') ) die('-1');

require_once __DIR__ . '/includes/class-mwp-wm-loads.php';
require_once __DIR__ . '/includes/class-mwp-wm-metabox.php';

class Mwp_World_Map extends WP_Widget {

  function __construct() {
    parent::__construct( 'mwp_world_map_', __('MWP World Map', 'Maxlian Lay'),
      array(
        'description' => __( 'A simple world map with pop-up on click.' )
      ));
  }

	function get_slider(){
		$posts_args= array(
								'numberposts' => 1,
								'post_type' => 'mwp_world_map',
	              'post_status' => 'publish',
								'orderby' => 'date',
								'order' => 'DESC'
								);
		$posts_list = get_posts($posts_args);
		?>

	  <div class="content">
	    <h1>World Map</h1>
	  </div>

		<?php
	}

  /*
		 ____________________
		|
		| --- Create Widget interface for Backend
		|____________________
  */

	public function form( $instance ){
	}

	public function widget( $args, $instance ){
	}

} //Closing bracket for the class
new Mwp_World_Map;

add_action( 'widgets_init', function(){
	register_widget( 'mwp_world_map' );
});
