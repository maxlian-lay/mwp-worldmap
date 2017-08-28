<?php
	/*
		 ____________________
		|
		| --- This class is used to load necessary data. (Eg: Categories, Sub-categories, etc..)
		|____________________
  */
	class Mwp_Wm_Loads{

	  function __construct(){
	  	add_action( 'admin_enqueue_scripts', array( $this, 'mwp_wm_load_admin_scripts' ) );
	  	add_action( 'enqueue_scripts', array( $this, 'mwp_wm_load_scripts' ) );
	  	add_action('init', array($this, 'mwp_wm_register_custom_post_type'));
	  }

	  public function mwp_wm_load_admin_scripts(){
	  	if ( is_active_widget( false, false, 'mwp_wm_slider_', true ) ) {
		  	// wp_register_script('mwp_scripts', plugin_dir_url(__FILE__).'includes/js/product-banner.js', $deps = array(), $ver = false, $in_footer = true);
		    wp_enqueue_script('mwp_scripts');
		    wp_register_style( 'materialize_css', 'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css');
				wp_enqueue_style( 'materialize_css' );
				wp_register_script('materialize_scripts', 'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js', $deps = array(), $ver = false, $in_footer = true);
		    wp_enqueue_script('materialize_scripts');
	  	}
	  }

	  public function mwp_wm_load_scripts(){
	  	wp_register_style( 'jvectormap_css', plugin_dir_url(__FILE__).'includes/mwp-wmjs/jquery-jvectormap.css');
			wp_enqueue_style( 'jvectormap_css' );

	  	wp_register_script('jquery_jvectormap', plugin_dir_url(__FILE__).'includes/mwp-wmjs/jquery-jvectormap.js', $deps = array(), $ver = false, $in_footer = true);
			wp_enqueue_script('jquery_jvectormap');

			wp_register_script('jquery_mousewheel_js', plugin_dir_url(__FILE__).'includes/mwp-wmjs/jquery-mousewheel.js', $deps = array(), $ver = false, $in_footer = true);
			wp_enqueue_script('jquery_mousewheel_js');

			wp_register_script('jvectormap', plugin_dir_url(__FILE__).'includes/mwp-wmjs/jvectormap.js', $deps = array(), $ver = false, $in_footer = true);
			wp_enqueue_script('jvectormap');

			wp_register_script('abstract_element', plugin_dir_url(__FILE__).'includes/mwp-wmjs/abstract-element.js', $deps = array(), $ver = false, $in_footer = true);
			wp_enqueue_script('abstract_element');

	  	wp_register_script('abstract_canvas_element', plugin_dir_url(__FILE__).'includes/mwp-wmjs/abstract-canvas-element.js', $deps = array(), $ver = false, $in_footer = true);
			wp_enqueue_script('abstract_canvas_element');

			wp_register_script('abstract_shape_element', plugin_dir_url(__FILE__).'includes/mwp-wmjs/abstract-shape-element.js', $deps = array(), $ver = false, $in_footer = true);
			wp_enqueue_script('abstract_shape_element');

			wp_register_script('svg_element', plugin_dir_url(__FILE__).'includes/mwp-wmjs/svg-element.js', $deps = array(), $ver = false, $in_footer = true);
			wp_enqueue_script('svg_element');

			wp_register_script('svg_group_element', plugin_dir_url(__FILE__).'includes/mwp-wmjs/svg-group-element.js', $deps = array(), $ver = false, $in_footer = true);
			wp_enqueue_script('svg_group_element');

			wp_register_script('svg_canvas_element', plugin_dir_url(__FILE__).'includes/mwp-wmjs/svg-canvas-element.js', $deps = array(), $ver = false, $in_footer = true);
			wp_enqueue_script('svg_canvas_element');

			wp_register_script('svg_shape_element', plugin_dir_url(__FILE__).'includes/mwp-wmjs/svg-shape-element.js', $deps = array(), $ver = false, $in_footer = true);
			wp_enqueue_script('svg_shape_element');

			wp_register_script('svg_path_element', plugin_dir_url(__FILE__).'includes/mwp-wmjs/svg-path-element.js', $deps = array(), $ver = false, $in_footer = true);
			wp_enqueue_script('svg_path_element');

			wp_register_script('svg_circle_element', plugin_dir_url(__FILE__).'includes/mwp-wmjs/svg-circle-element.js', $deps = array(), $ver = false, $in_footer = true);
			wp_enqueue_script('svg_circle_element');

			wp_register_script('svg_text_element', plugin_dir_url(__FILE__).'includes/mwp-wmjs/svg-text-element.js', $deps = array(), $ver = false, $in_footer = true);
			wp_enqueue_script('svg_text_element');

			wp_register_script('map_object', plugin_dir_url(__FILE__).'includes/mwp-wmjs/map-object.js', $deps = array(), $ver = false, $in_footer = true);
			wp_enqueue_script('map_object');

			wp_register_script('region', plugin_dir_url(__FILE__).'includes/mwp-wmjs/region.js', $deps = array(), $ver = false, $in_footer = true);
			wp_enqueue_script('region');

			wp_register_script('marker', plugin_dir_url(__FILE__).'includes/mwp-wmjs/marker.js', $deps = array(), $ver = false, $in_footer = true);
			wp_enqueue_script('marker');

			wp_register_script('vector_canvas', plugin_dir_url(__FILE__).'includes/mwp-wmjs/vector-canvas.js', $deps = array(), $ver = false, $in_footer = true);
			wp_enqueue_script('vector_canvas');

			wp_register_script('legend', plugin_dir_url(__FILE__).'includes/mwp-wmjs/legend.js', $deps = array(), $ver = false, $in_footer = true);
			wp_enqueue_script('legend');

			wp_register_script('data_series', plugin_dir_url(__FILE__).'includes/mwp-wmjs/data-series.js', $deps = array(), $ver = false, $in_footer = true);
			wp_enqueue_script('data_series');

			wp_register_script('proj', plugin_dir_url(__FILE__).'includes/mwp-wmjs/proj.js', $deps = array(), $ver = false, $in_footer = true);
			wp_enqueue_script('proj');

			wp_register_script('map', plugin_dir_url(__FILE__).'includes/mwp-wmjs/map.js', $deps = array(), $ver = false, $in_footer = true);
			wp_enqueue_script('map');

			wp_register_script('jvectormap_world_mill', plugin_dir_url(__FILE__).'includes/mwp-wmjs/jvectormap-world-mill.js', $deps = array(), $ver = false, $in_footer = true);
			wp_enqueue_script('jvectormap_world_mill');
	  }

	  public function mwp_wm_register_custom_post_type(){
	  	$labels = array(
			"name" => "MWP World Map",
			"singular_name" => "MWP World Map",
			);

			$args = array(
				"labels" => $labels,
				"description" => "",
				"public" => true,
				"show_ui" => true,
				"has_archive" => false,
				"show_in_menu" => true,
				"exclude_from_search" => false,
				"capability_type" => "post",
				'supports' => array('title'),
				"map_meta_cap" => true,
				"hierarchical" => false,
				"rewrite" => array( "slug" => "mwp_world_map", "with_front" => true ),
				"query_var" => true,
			);
			register_post_type( "mwp_world_map", $args );
	  }
	  
	}
	new Mwp_Wm_Loads;
