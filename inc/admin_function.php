<?php 
if ( ! defined( 'ABSPATH' ) ) { exit; }

function sssw_token_setting() {
	$fb_token = sanitize_text_field($_POST['fb_token']);
	update_option( 'fb_token', $fb_token);
	$youtube_token = sanitize_text_field($_POST['youtube_token']);
	update_option( 'youtube_token', $youtube_token);	
	$vimeo_token = sanitize_text_field($_POST['vimeo_token']);
	update_option( 'vimeo_token', $vimeo_token);
	$instagram_token = sanitize_text_field($_POST['instagram_token']);
	update_option( 'instagram_token',$instagram_token);
	
	$twit_api_key = sanitize_text_field($_POST['twit_api_key']);
	$twit_api_secret = sanitize_text_field($_POST['twit_api_secret']);
	$twit_access_token = sanitize_text_field($_POST['twit_access_token']);
	$twit_access_token_secret = sanitize_text_field($_POST['twit_access_token_secret']);
	update_option( 'twit_api_key',$twit_api_key );
	update_option( 'twit_api_secret',$twit_api_secret );
	update_option( 'twit_access_token',$twit_access_token );
	update_option( 'twit_access_token_secret',$twit_access_token_secret);
	wp_redirect( 'admin.php?page=fb-you-vimeo-twit-insta-social-setting' );exit;
}
add_action( 'admin_post_nopriv_sssw_token_setting', 'sssw_token_setting' );
add_action( 'admin_post_sssw_token_setting', 'sssw_token_setting' );

function sssw_Update_Setting() {
	global $wpdb,$sssw_table;
	$social_table = $wpdb->base_prefix.$sssw_table;
	extract($_POST);
	$ins = array(
		'slider_title' => sanitize_text_field($title),
		'slider_params' => serialize($_POST)
	);
	$loadmore = sanitize_text_field($_POST['loadmore']);
	if(!isset($loadmore)){ $loadmore = '0';}
	delete_transient("saragna_fbs_stream_".sanitize_text_field($fb_id));
	delete_transient("saragna_tweets_stream_".sanitize_text_field($twitter_id));
	delete_transient("saragna_tweets_hash_stream_".sanitize_text_field($twitter_id));
	delete_transient("saragna_instas_stream_".sanitize_text_field($userid));
	
	$wpdb->update( $social_table, $ins, array('id' => intval($social_sid)) );
	wp_redirect( 'admin.php?page=social-fb-you-vimeo-twit-insta&view=setting&sid='.intval($social_sid) );exit;
}
add_action( 'admin_post_nopriv_sssw_Update_Setting', 'sssw_Update_Setting' );
add_action( 'admin_post_sssw_Update_Setting', 'sssw_Update_Setting' );

function sssw_save_Setting() {
	global $wpdb,$sssw_table;
	$social_table = $wpdb->base_prefix.$sssw_table;
	extract($_POST);
	$ins = array(
		'slider_title' => sanitize_text_field($title),
		'slider_params' => serialize($_POST)
	);
	$wpdb->insert( $social_table, $ins );
	wp_redirect( 'admin.php?page=social-fb-you-vimeo-twit-insta' );exit;
}
add_action( 'admin_post_nopriv_sssw_save_Setting', 'sssw_save_Setting' );
add_action( 'admin_post_sssw_save_Setting', 'sssw_save_Setting' );
?>