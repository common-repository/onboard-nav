<?php
/**
 * @package onboard-nav
 */
/*
Plugin Name: Onboard Nav
Plugin URI: https://www.onboardinformatics.com/nav20
Description: The Nav Bar component features the most popular information on schools, amenities, market trends and more to engage, capture and nurture online visitors.  
Version: 2.0
Author: Onboard Informatics
Author URI: https://www.onboardinformatics.com/
Text Domain: Onboard Inc
*/

// File include using require_once from library folder
require_once(plugin_dir_path(__FILE__).'library/enqueuing.php' );

/*
Function name : obnv_onboard_nav_create
Discription : This function is used for display Onboard Nav as admin menu over the wordpress admin panel
*/
add_action('admin_menu', 'obnv_onboard_nav_create');
function obnv_onboard_nav_create() {
    $page_title = 'Onboard Nav';
    $menu_title = 'Onboard Nav';
    $capability = 'edit_posts';
    $menu_slug = 'onboard_nav';
    $function = 'obnv_custom_onboard_nav_display';
    $icon_url = 'dashicons-location';
    $position = 24;
    add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
}

/*
Function name : obnv_custom_onboard_nav_display
Discription : This function is used for display Nav form when someone click on "Onboard Nav" menu from wordpress admin panel, From this section user can save the script which is provided by Onboard Informatics to display property related lead on the website. 
*/
function obnv_custom_onboard_nav_display() {
	
	//Check form is posted or not
	if ( ! empty( $_POST ) ) {
		//Check for nonce field verification
		if (isset( $_POST['custom_onboard_nav_display_field'] ) && $_POST['custom_onboard_nav_display_field'] !="" || wp_verify_nonce( $_POST['custom_onboard_nav_display_field'], 'obnv_custom_onboard_nav_display' )){
			
			//Update Lead widget text script code, It will capture user email, Phone number and Cell number field through iframe and send the specific notification to that user.
			//Update address 1 field
			if (isset($_POST['navbar_address1']) && !empty($_POST['navbar_address1'])) {   
				$navbar_address1 = sanitize_text_field($_POST['navbar_address1']);
				update_option('navbar_address1', $navbar_address1);
			}
			//Update address 2 field
			if (isset($_POST['navbar_address2']) && !empty($_POST['navbar_address2'])) {
				$navbar_address2 = sanitize_text_field($_POST['navbar_address2']);
				update_option('navbar_address2', $navbar_address2); 
			}
			//Update nav bar zip code field
			if (isset($_POST['navbar_zip']) && !empty($_POST['navbar_zip'])) {
				$navbar_zip = sanitize_text_field($_POST['navbar_zip']);
				update_option('navbar_zip', $navbar_zip);
			}
			//Update nav text this contain our main script code which is used to display navigation bar of our property detail. This script create navigation bar that will open a iframe with the requested property address.
			if (isset($_POST['navbar_script']) && !empty($_POST['navbar_script'])) {
				$value = sanitize_text_field(json_encode($_POST['navbar_script']));
				update_option('navbar_script', $value); 
			} 
		}
	}
	
	$navbar_address1 	= get_option('navbar_address1', ''); // get value of address 1 to display pre-filled in html form
    $navbar_address2 	= get_option('navbar_address2', ''); // get value of address 2 to display pre-filled in html form
    $navbar_zip 		= get_option('navbar_zip', ''); // get value of zip to display pre-filled in html form
	$wd_set = get_option('navbar_script', ''); // get value of widget text script code to display pre-filled in html form
	
	if(!empty($wd_set)){
		//Get the saved value to pre-filled the data into form.
		$navbar_script 	= stripslashes(json_decode($wd_set));  	
	}else{
		$navbar_script 	= '';  	
	}
	
    //Get form from this file
    include 'nav-bar-form-file.php';
}

/*
Function name : obnv_custom_nav_shortcode
Discription : This function is used for generate shortcode so that user can easily use lead anywhere on his/her website. This lead widget display the form on your website to get the contact query which is related to property, It will capture user email, Phone number and Cell number field through iframe and send the specific notification to that user.
*/

function obnv_custom_nav_shortcode($atts) {
	
	if($atts['address1']=="" || $atts['address2']==""){
		return "Something went wrong, Please provide address1 and address2";
	}
	$report_widget 		= get_option('report_widget', '');
	
	$saveScript_set = get_option('navbar_script');
	if(!empty($saveScript_set)){
		$saveScript 	= stripslashes(json_decode($saveScript_set));  	
	}else{
		$saveScript 	= $saveScript_set;  	
	}
	

	$explodedScript     = explode("customer_id=",$saveScript); 
	$explodedScript1    = explode("&",$explodedScript[1]); 
	$cust_id            = $explodedScript1[0] ;

	
	if( strpos( $cust_id, "COMR" ) !== false ) {
			$nav2Script = '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script><script type="text/javascript">var frame_url=window.parent.location.origin;$onboardJquery=jQuery.noConflict();$onboardJquery(document).ready(function(){var src="http://onboard.rocks/admin/script.php?customer_id={{CUSTOMERID}}&address1={{ADDRESS1}}&address2={{ADDRESS2}}&zip=ZI{{ZIPCODE}}&frame_url="+frame_url;$onboardJquery("#iframe_id").attr("src",src)});</script><iframe width="100%" id="iframe_id" style="height: 120px;" frameborder="0" scrolling="auto" src="" allowfullscreen="true"></iframe><script type="text/javascript">var isMobile={Android:function(){return navigator.userAgent.match(/Android/i)},BlackBerry:function(){return navigator.userAgent.match(/BlackBerry/i)},iOS:function(){return navigator.userAgent.match(/iPhone|iPad|iPod/i)},Opera:function(){return navigator.userAgent.match(/Opera Mini/i)},Windows:function(){return navigator.userAgent.match(/IEMobile/i)||navigator.userAgent.match(/WPDesktop/i)},any:function(){return(isMobile.Android()||isMobile.BlackBerry()||isMobile.iOS()||isMobile.Opera()||isMobile.Windows())}};var iframeMobHeight="120px";var iframeMobOpenHeight="750px";if(isMobile.any()){iframeMobHeight="170px";var iframeMobOpenHeight="350px";$onboardJquery("#iframe_id").css("height",iframeMobHeight)}
	var eventMethod=window.addEventListener?"addEventListener":"attachEvent";var eventer=window[eventMethod];var messageEvent=eventMethod=="attachEvent"?"onmessage":"message";eventer(messageEvent,function(e){if(e.data=="open"){$onboardJquery("#iframe_id").css("height",iframeMobOpenHeight)}else if(e.data=="close"){$onboardJquery("#iframe_id").css("height",iframeMobHeight)}else if(e.data=="closeOpenTab"){$onboardJquery("#iframe_id").css("height",iframeMobOpenHeight)}
e.data=""},!1);$onboardJquery("html").on("click","body",function(){var iframeCustom=document.getElementById("iframe_id");var iWindow=iframeCustom.contentWindow;iWindow.postMessage("closeOnBgClick","*")})</script>'; 
		$navScriptCode = str_replace(array("{{CUSTOMERID}}","{{ADDRESS1}}","{{ADDRESS2}}","{{ZIPCODE}}"),array($cust_id,$atts['address1'],$atts['address2'],$atts['zip']),$nav2Script);
		
		return $navScriptCode;
		
	}else{
		return "Something went wrong, unable to find customer id in your saved script";
	}
	
}
add_shortcode( 'onboard-nav', 'obnv_custom_nav_shortcode' );


function obnv_custom_navbar_action_links( $links ) {
 $links = array_merge( array(
  '<a href="' . esc_url( admin_url( 'admin.php?page=onboard_nav' ) ) . '">' . __( 'Settings', 'textdomain' ) . '</a>'
 ), $links );
 return $links;
}
add_action( 'plugin_action_links_' . plugin_basename( __FILE__), 'obnv_custom_navbar_action_links' );