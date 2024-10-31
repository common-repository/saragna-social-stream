<?php if ( ! defined( 'WPINC' ) ) die;
/**
 * Plugin Name: Saragna - Social Stream WordPress
 * Description:  Facebook,YouTube Channel,Vimeo Social Streams Grid With Carousel for WordPress
 * Version: 1.0
 * Author: saragna
 * Author URI: http://www.saragna.com/Hitesh-Khunt
 * Plugin URI: http://plugin.saragna.com/vc-addon
 * License: GPLv2 or later
 * Text Domain: svc_social_feed
 * Domain Path: /languages
 *
 */

$sssw_Version = "1.0";
$sssw_currentFile = __FILE__;
$sssw_currentFolder = dirname($sssw_currentFile);
$sssw_table = 'wp_fb_you_vimeo';
if ( ! defined( 'SSSW_PLUGIN_FILE' ) ) {
	define( 'SSSW_PLUGIN_FILE', __FILE__ );
}

require_once $sssw_currentFolder.'/inc/comman_class.php';
require_once $sssw_currentFolder.'/inc/admin_class.php';
require_once $sssw_currentFolder.'/inc/admin_function.php';
require_once $sssw_currentFolder.'/inc/all_function.php';
require_once $sssw_currentFolder.'/inc/social-stream-shortcode.php';

class SSSW_Social_Class extends SSSW_Admin_Class {

	function __construct() {
		parent::__construct();		
		add_action('admin_menu', array( $this, 'sssw_setting_page'));
		add_shortcode('fb_you_vimeo_twit_insta','sssw_grid_shortcode_data');
		add_shortcode('fb_you_vimeo_twit_insta_grid','sssw_grid_shortcode_data_read');
	}	
	
	function sssw_setting_page() {
		add_menu_page( 'Social Stream', 'Social Stream', 'manage_options', 'social-fb-you-vimeo-twit-insta', array( $this, 'sssw_admin_shortcode_page'), plugins_url( 'assets/image/icon.png',  __FILE__));
		add_submenu_page( 'social-fb-you-vimeo-twit-insta', 'General Shortcode', 'General Shortcode','manage_options', 'social-fb-you-vimeo-twit-insta',array( $this, 'sssw_admin_shortcode_page'));
		add_submenu_page( 'social-fb-you-vimeo-twit-insta', 'Social Setting', 'Social Setting','manage_options', 'fb-you-vimeo-twit-insta-social-setting',array( $this, 'sssw_token_setting_page'));
	}
	
	function sssw_admin_shortcode_page(){
		global $wpdb,$sssw_Version;
		include('admin/setting.php');
	}
	
	function sssw_token_setting_page(){
		global $wpdb;
		include('admin/social-setting.php');
	}

}
$sssw_social_class = new SSSW_Social_Class();


function sssw_AdminNoticeSuccess() {
	$fb_token = get_option( 'fb_token' );
	$youtube_token = get_option( 'youtube_token' );	
	$vimeo_token = get_option( 'vimeo_token' );
	$instagram_token = get_option( 'instagram_token' );
	
	$twit_api_key = get_option( 'twit_api_key' );
	$twit_api_secret = get_option( 'twit_api_secret' );
	$twit_access_token = get_option( 'twit_access_token' );
	$twit_access_token_secret = get_option( 'twit_access_token_secret' );
	if(!$fb_token && !$youtube_token && !$vimeo_token && !$instagram_token && !$twit_api_key){?>
    <div class="notice notice-success is-dismissible">
        <p><?php esc_html_e('Please add Social Credential in Social Setting.','svc_social_feed');?> <a href="<?php echo esc_url(get_site_url().'/wp-admin/admin.php?page=fb-you-vimeo-twit-insta-social-setting');?>"><?php esc_html_e('Setup here','svc_social_feed');?></a></p>
    </div>
    <?php }
}
add_action( 'admin_notices', 'sssw_AdminNoticeSuccess' );
?>
