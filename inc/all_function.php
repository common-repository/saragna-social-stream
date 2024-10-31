<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
function ssswLangInit() {
	load_plugin_textdomain( 'svc_social_feed', false, dirname( plugin_basename( SSSW_PLUGIN_FILE ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'ssswLangInit' );

add_action('wp_enqueue_scripts','sssw_register_style_script');
function sssw_register_style_script(){
	wp_register_style( 'sssw-social-css', plugins_url('../assets/css/css.css', __FILE__));
	wp_register_style( 'sssw-animate-css', plugins_url('../assets/css/animate.css', __FILE__));	
	wp_enqueue_style( 'sssw-font-awesome-css', plugins_url('../assets/css/font-awesome.min.css', __FILE__));
	wp_register_style( 'sssw-vcfti-bootstrap-css', plugins_url('../assets/css/bootstrap.css', __FILE__));
	wp_register_style( 'sssw-megnific-css', plugins_url('../assets/css/magnific-popup.css', __FILE__));
	wp_enqueue_style( 'sssw-timeline-css', plugins_url('../assets/css/timeline.css', __FILE__));
	
	wp_enqueue_script('moment-locale-js', plugins_url('../assets/js/moment-with-locales.min.js', __FILE__), array("jquery"), false, false);
	wp_register_script('sssw-megnific-js', plugins_url('../assets/js/megnific.js', __FILE__), array("jquery"), false, false);	
	wp_enqueue_script('sssw-isotop-js', plugins_url('../assets/js/isotope.pkgd.min.js', __FILE__), array("jquery"), false, false);
	wp_enqueue_script('svc-imagesloaded-js', plugins_url('../assets/js/imagesloaded.pkgd.min.js', __FILE__), array("jquery"), false, false);
	wp_register_script('sssw-carousel-js', plugins_url('../assets/js/owl.carousel.min.js', __FILE__), array("jquery"), false, false);
	wp_enqueue_script('viewportchecker-js', plugins_url('../assets/js/jquery.viewportchecker.js', __FILE__), array("jquery"), false, false);
	wp_enqueue_script('sssw-timeline-js', plugins_url('../assets/js/timeline.js', __FILE__), array("jquery"), false, false);
	wp_enqueue_script('doT-js', plugins_url('../assets/js/doT.min.js', __FILE__), array("jquery"), false, false);	
	wp_enqueue_script('sssw-social-stream-js', plugins_url('../assets/js/social-stream.js', __FILE__), array("jquery"), false, false);
	wp_localize_script('sssw-social-stream-js', 'svc_ajax_url', array('url' => admin_url( 'admin-ajax.php' ),'laungage' => get_locale()));
}


add_action('wp_ajax_sssw_get_fb_post','sssw_get_fb_post');
add_action('wp_ajax_nopriv_sssw_get_fb_post','sssw_get_fb_post');
function sssw_get_fb_post(){
	extract($_POST);
	$fb_token = get_option( 'fb_token' );
	
	$fbs = get_transient("saragna_fbs_stream_".$username);	
	if( !$fbs ) {
		$api_url1 = 'https://graph.facebook.com/v3.1/'.$username.'/posts?limit='.$count.'&access_token='.$fb_token.'&fields=id,full_picture,created_time,from{id,name,picture},message,link,type,shares,object_id,attachments';
		$fbs_get = wp_remote_get($api_url1);
		$fbs = $fbs_get['body'];
		$fbs_decode = json_decode($fbs);

		if (empty($fbs_decode->error)) {
			set_transient('saragna_fbs_stream_'.$username, $fbs, 60 * $cache_time);
		}		
	}

	echo $fbs;	
wp_die();
}

add_action('wp_ajax_sssw_get_tweet','sssw_get_tweet');
add_action('wp_ajax_nopriv_sssw_get_tweet','sssw_get_tweet');
function sssw_get_tweet(){
	require_once('twitter_proxy.php');
	extract($_POST);
	$twit_api_key = get_option( 'twit_api_key' );
	$twit_api_secret = get_option( 'twit_api_secret' );
	$twit_access_token = get_option( 'twit_access_token' );
	$twit_access_token_secret = get_option( 'twit_access_token_secret' );
	// Twitter OAuth Config options
	$oauth_access_token = $twit_access_token;
	$oauth_access_token_secret = $twit_access_token_secret;
	$consumer_key = $twit_api_key;
	$consumer_secret = $twit_api_secret;

	$user_id = '78884300';
	$screen_name = $user_name;
	$count = $limit;
	
	$twitter_url = 'statuses/user_timeline.json';
	$twitter_url .= '?tweet_mode=extended';
	$twitter_url .= '&exclude_replies=true';
	$twitter_url .= '&include_rts=true';
	$twitter_url .= '&screen_name=' . $screen_name;
	$twitter_url .= '&count=' . $count;
	if($max_id != ''){
		$twitter_url .= '&max_id=' . $max_id;
	}
	
	// Create a Twitter Proxy object from our twitter_proxy.php class
	$twitter_proxy = new TwitterProxy(
		$oauth_access_token,			// 'Access token' on https://apps.twitter.com
		$oauth_access_token_secret,		// 'Access token secret' on https://apps.twitter.com
		$consumer_key,					// 'API key' on https://apps.twitter.com
		$consumer_secret,				// 'API secret' on https://apps.twitter.com
		$user_id,						// User id (http://gettwitterid.com/)
		$screen_name,					// Twitter handle
		$count							// The number of tweets to pull out
	);
	$tweets = get_transient("saragna_tweets_stream_".$screen_name);
	if( !$tweets ) {
		// Invoke the get method to retrieve results via a cURL request
		$tweets = $twitter_proxy->get($twitter_url);
		set_transient('saragna_tweets_stream_'.$screen_name, $tweets, 60 * $cache_time);
	}
	
	echo $tweets;
wp_die();
}

add_action('wp_ajax_sssw_get_search_tweet','sssw_get_search_tweet');
add_action('wp_ajax_nopriv_sssw_get_search_tweet','sssw_get_search_tweet');
function sssw_get_search_tweet(){
	require_once('twitter_proxy.php');
	extract($_POST);
	$twit_api_key = get_option( 'twit_api_key' );
	$twit_api_secret = get_option( 'twit_api_secret' );
	$twit_access_token = get_option( 'twit_access_token' );
	$twit_access_token_secret = get_option( 'twit_access_token_secret' );
	// Twitter OAuth Config options
	$oauth_access_token = $twit_access_token;
	$oauth_access_token_secret = $twit_access_token_secret;
	$consumer_key = $twit_api_key;
	$consumer_secret = $twit_api_secret;
	
	$user_id = '78884300';
	$screen_name = $user_name;
	$count = $limit;
	
	$twitter_url = 'search/tweets.json';
	if($other == 'yes'){
		$twitter_url .= '?q=' . $q;
		$twitter_url .= '&count=' . $limit;
		$twitter_url .= '&' . $que;
		$twitter_url .= '&include_entities' . $include_entities;
		$twitter_url .= '&tweet_mode=extended';
		$twitter_url .= '&exclude_replies=true';
		$twitter_url .= '&include_rts=true';
		
	}else{
		$twitter_url .= '?q=' . $q;
		$twitter_url .= '&tweet_mode=extended';
		$twitter_url .= '&exclude_replies=true';
		$twitter_url .= '&include_rts=true';
		$twitter_url .= '&count=' . $count;
	}
	
	// Create a Twitter Proxy object from our twitter_proxy.php class
	$twitter_proxy = new TwitterProxy(
		$oauth_access_token,			// 'Access token' on https://apps.twitter.com
		$oauth_access_token_secret,		// 'Access token secret' on https://apps.twitter.com
		$consumer_key,					// 'API key' on https://apps.twitter.com
		$consumer_secret,				// 'API secret' on https://apps.twitter.com
		$user_id,						// User id (http://gettwitterid.com/)
		$screen_name,					// Twitter handle
		$count							// The number of tweets to pull out
	);
	
	$tweets = get_transient("saragna_tweets_hash_stream_".$screen_name); 
	if( !$tweets ) {
		// Invoke the get method to retrieve results via a cURL request
		$tweets = $twitter_proxy->get($twitter_url);
		set_transient('saragna_tweets_hash_stream_'.$screen_name, $tweets, 60 * $cache_time);
	}
	
	echo $tweets;
wp_die();		
}

add_action('wp_ajax_nopriv_sssw_get_insta_post','sssw_get_insta_post');
add_action('wp_ajax_sssw_get_insta_post','sssw_get_insta_post');
function sssw_get_insta_post(){
	extract($_POST);
	$instagram_token = get_option( 'instagram_token' );
	$userid = esc_html($userid);
	$insta_posts = get_transient("saragna_instas_stream_".$userid);
	
	if( !$insta_posts ) {
		$api_url1 = 'https://api.instagram.com/v1/users/'.$userid.'/media/recent/?access_token='.$instagram_token.'&count='.intval($count);
		$insta_posts_get = wp_remote_get(esc_url_raw($api_url1));
		$insta_posts = $insta_posts_get['body'];
		
		set_transient('saragna_instas_stream_'.$userid, $insta_posts, 60 * $cache_time);
	}
	
	echo $insta_posts;
wp_die();
}

add_action('wp_ajax_nopriv_sssw_inline_twit_video_popup','sssw_inline_twit_video_popup');
add_action('wp_ajax_sssw_inline_twit_video_popup','sssw_inline_twit_video_popup');
function sssw_inline_twit_video_popup(){?>
		<div class="svc_tweet_conatiner">
			<div class="tweet_img_video">
			<?php if($_GET['video_url']){?>
			<div id="video-01" class="video-popup">
				<video preload="auto" controls autoplay>
					<source src="<?php echo $_GET['video_url'];?>" type="video/mp4">
				</video>
			</div>
			<?php }?>
			</div>
		</div>	
	<?php
	wp_die();
}


if(!function_exists('sssw_parseRGBA_color')){
function sssw_parseRGBA_color($str){
    //match the rgba string and get it's part
    if(preg_match('/rgba\( *([\d\.-]+), *([\d\.-]+), *([\d\.-]+), *([\d\.-]+) *\)/i', $str, $m)){
		if($m[4] == '0.01'){
			$m[4] = '0';	
		}
        $out = array(
            'r'=>intval($m[1]), //get the red
            'g'=>intval($m[2]), //get the green
            'b'=>intval($m[3]), //get the blue
            'a'=>intval($m[4]), //get the alpha and scale to 0-255
        );

        return 'rgba('.$m[1].','.$m[2].','.$m[3].','.$m[4].')';
    }else{
		return $str;	
	}
    return false;
}
}

function sssw_admin_grid_delete(){
	global $wpdb,$sssw_table;
	$slider_table = $wpdb->base_prefix.$sssw_table;
	$id = intval($_POST['id']);
	$wpdb->delete($slider_table,array('id'=>$id));
wp_die();
}
add_action('wp_ajax_sssw_admin_grid_delete', 'sssw_admin_grid_delete' );
?>