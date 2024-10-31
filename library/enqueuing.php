<?php
	/*
	 * Function name : nurturebar_admin_enqueue_stuff
	 * Functionality : This function is add CSS and JS file on admin end when plugin get activated
	*/
	function obnv_navbar_admin_enqueue_stuff() { 
		wp_enqueue_media();
		wp_enqueue_style( 'nav-bar-style-admin', plugin_dir_url(dirname(__FILE__)).'css/obnv_nav_bar.css' );
		wp_enqueue_script('obnv_custom_developer_validation', plugin_dir_url(dirname(__FILE__)).'js/obnv_nav_bar_developer.js');
	}
	//Call the files function for include css and js stuff through admin_enqueue_scripts from library folder
	add_action( 'admin_enqueue_scripts', 'obnv_navbar_admin_enqueue_stuff' );