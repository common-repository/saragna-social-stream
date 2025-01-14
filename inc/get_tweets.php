<?php

require_once('twitter_proxy.php');
$twit_api_key = get_option( 'twit_api_key' );
$twit_api_secret = get_option( 'twit_api_secret' );
$twit_access_token = get_option( 'twit_access_token' );
$twit_access_token_secret = get_option( 'twit_access_token_secret' );
// Twitter OAuth Config options
$oauth_access_token = $twit_access_token;
$oauth_access_token_secret = $twit_access_token_secret;
$consumer_key = $twit_api_key;
$consumer_secret = $twit_api_secret;

/*$oauth_access_token = '531871187-jA1LUzuKOBMYy9FTHNS8Lrq3tHFtGQxCMeJMdjwY';
$oauth_access_token_secret = '3qQgkYWzexuLoGKMnFpIoh3MZ5UEPmiRvysBBgEDIqLBn';
$consumer_key = 'UaXiG364zfkqhkkK6ckFSRtoy';
$consumer_secret = 'l0Ymtqh9JnuqiGULl3uvMfnqePzA03YOV9YtdAc9b6km5orW9V';*/
$user_id = '78884300';
$screen_name = 'flipkart';
$count = 5;

$twitter_url = 'statuses/user_timeline.json';
$twitter_url .= '?user_id=' . $user_id;
$twitter_url .= '&screen_name=' . $screen_name;
$twitter_url .= '&count=' . $count;

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

// Invoke the get method to retrieve results via a cURL request
$tweets = $twitter_proxy->get($twitter_url);

echo $tweets;
?>