<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$fb_token = get_option( 'fb_token' );
$youtube_token = get_option( 'youtube_token' );
$vimeo_token = get_option( 'vimeo_token' );
$instagram_token = get_option( 'instagram_token' );

$twit_api_key = get_option( 'twit_api_key' );
$twit_api_secret = get_option( 'twit_api_secret' );
$twit_access_token = get_option( 'twit_access_token' );
$twit_access_token_secret = get_option( 'twit_access_token_secret' );
?>
<style type="text/css">
.sa-setting{ border-bottom:1px solid #ccc; padding-bottom:15px; padding-top:15px;}
a,a:focus,a:active{ outline:none !important; box-shadow:none !important;}
.animate_slider_popup_loader{background:url(<?php echo plugins_url('assets/image/default.gif',  __FILE__);?>) no-repeat center #fff;}
.h2_logo{
	background:url(<?php echo plugins_url('../assets/image/round.png',  __FILE__);?>) !important;
	background-repeat:no-repeat !important;
	box-shadow:none !important;
	background-size:42px 42px;
	display:table;
	font-size: 23px;
    font-weight: 400;
    line-height: 29px;
    padding: 6px 15px 7px 48px !important;
	margin:0 !important;
	border-bottom:0px !important;
}
.widefat td{border-bottom: 1px solid #f1f1f1;}
.aslider_required{ color:red; font-size:18px; vertical-align:middle; margin-left:2px;}
.help_btn{position: absolute; right: 15px; top: 7px;}
.afr{ float:right;}.afl{ float:left;}.apadl0{padding-left:0px !important;}.atal{text-align:left;}
.anew_slider{ margin-bottom:10px;}
.anew_slider th{ width:200px; vertical-align:top; text-align:left;}
.anew_slider1 th{ width:175px; text-align:left; vertical-align:top;}
.anew_slider_setting th{ width:230px; vertical-align:top; text-align:left;}
.delete_level,.delete_level:hover {
    background-color: #fb6f6f;
    border: 1px solid #c10f0f;
    border-radius: 3px;
    color: #fff;
	display:inline-table;
    font-size: 12px;
    font-weight: bold;
    padding: 1px 10px;
    text-shadow: 0 1px #100f0f;
}
.edit_layers,.edit_layers:hover {
    background-color: #37c536;
    border: 1px solid green;
    border-radius: 3px;
    color: #fff;
	cursor:pointer;
    font-size: 12px;
    font-weight: bold;
    padding: 2px 10px;
    text-shadow: 0 1px #5f5959;
}
.spl_tabs{ display:none;}
#grid_query{
	border: 1px solid #ccc;
    border-radius: 3px;
    cursor: pointer;
    font-size: 13px;
    padding: 5px 18px;
    text-shadow: 1px 1px #f2f2f2;
}
#grid_query_div:before{
	border-bottom: 8px solid #ccc;
    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
    content: "";
    height: 0;
    left: 48px;
    position: absolute;
    top: -9px;
    width: 0;
}
#grid_query_div{
	background: #f2f2f2 none repeat scroll 0 0;
    border: 1px solid #ccc;
    border-radius: 3px;
    display: none;
    padding: 10px;
	position:relative;
}
.vertical-top th{vertical-align:top;}
.spost_hidden{ display:none;}
</style>

<div class="wrap">
<div class="meta-box-sortables ui-sortable">
	<div class="postbox" style="margin-bottom:10px;">
		<div class="inside" style="padding:0 12px;">
			<h3 class="h2_logo"><a href="javascript:;" style="text-decoration:none; color:#222;"><?php echo esc_html( 'Social Stream Setting' ); ?></a></h3>
		</div>
	</div>
</div>

<form method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
<div id="social_tab" class="spl_tabs" style="display:block;">
	<div class="metabox-holder" id="dashboard-widgets" style="width:100%;">
		<div class="postbox-container" style="width:100%;">	
			<div class="meta-box-sortables ui-sortable" style="margin:0">	
				<div class="postbox">
				<div class="inside">
				<table class="anew_slider_setting">
					<tr>
                    	<th class="sa-setting"><strong class="afl"><?php _e('Facebook Access Token','swp-social');?></strong></th>
                        <td class="sa-setting">
                            <input type="text" name="fb_token" value="<?php echo $fb_token;?>"/>
                            <p class="description"><?php _e('Add Facebook Access Token for get facebook feed. <a href="http://plugin.saragna.com/blog/how-to-get-a-facebook-access-token/" target="_blank">How To Get</a>','swp-social');?></p>
                        </td>
                    </tr>
					<tr>
                    	<th class="sa-setting"><strong class="afl"><?php _e('Youtube API key','swp-social');?></strong></th>
                        <td class="sa-setting">
                            <input type="text" name="youtube_token" value="<?php echo $youtube_token;?>"/>
                            <p class="description"><?php _e('Add Youtube API key for get Youtube feed. <a href="http://plugin.saragna.com/blog/get-api-key-for-youtube-google-plus/" target="_blank">How To Get</a>','swp-social');?></p>
                        </td>
                    </tr>
					<tr>
						<th class="sa-setting"><strong class="afl"><?php _e('Vimeo Access Token','swp-social');?></strong></th>
                        <td class="sa-setting">
                            <input type="text" name="vimeo_token" value="<?php echo $vimeo_token;?>"/>
                            <p class="description"><?php _e('Add Vimeo Access Token for get Vimeo feed. <a href="http://valvepress.com/how-to-generate-a-vimeo-access-token-to-post-from-vimeo-to-wordpress/" target="_blank">How To Get</a>','swp-social');?></p>
                        </td>
                    </tr>
                    <tr>
                    	<th class="sa-setting"><strong class="afl"><?php _e('Instagram Access Token','swp-social');?></strong></th>
                        <td class="sa-setting">
                            <input type="text" name="instagram_token" value="<?php echo $instagram_token;?>"/>
                            <p class="description"><?php _e('You can use your own token or get token authorizing our app. Follow setup guide.<a href="http://plugin.saragna.com/vc-addon/how-to-generate-an-instagram-access-token/" target="_blank">Follow setup guide</a>. also direct access token generate <a href="http://instagram.pixelunion.net/" target="_blank">here</a>','swp-social');?></p>
                        </td>
                    </tr>
					<tr>
						<th style="padding-top: 15px;"><strong>Twitter API Token</strong></th>
						<td style="padding-top: 15px;">If you keep seeing the message 'sorry twitter is down and will be right back', it may be a good idea to add your own tokens below. See how to <a href="http://plugin.saragna.com/blog/how-to-get-api-keys-and-tokens-for-twitter/" target="_blank">get API Keys and Tokens for Twitter</a>. Leave the fields below empty to use our Default API access tokens.</td>
					</tr>
					<tr>
                    	<th><strong class="afl"><?php _e('Consumer Key (API Key)','swp-social');?></strong></th>
                        <td>
                            <input type="text" name="twit_api_key" value="<?php echo $twit_api_key;?>"/>
                        </td>
                    </tr>
					<tr>
                    	<th><strong class="afl"><?php _e('Consumer Secret (API Secret)','swp-social');?></strong></th>
                        <td>
                            <input type="text" name="twit_api_secret" value="<?php echo $twit_api_secret;?>"/>
                        </td>
                    </tr>
					<tr>
                    	<th><strong class="afl"><?php _e('Access Token','swp-social');?></strong></th>
                        <td>
                            <input type="text" name="twit_access_token" value="<?php echo $twit_access_token;?>"/>
                        </td>
                    </tr>
					<tr>
                    	<th><strong class="afl"><?php _e('Access Token Secret','swp-social');?></strong></th>
                        <td>
                            <input type="text" name="twit_access_token_secret" value="<?php echo $twit_access_token_secret;?>"/>
                        </td>
                    </tr>
				</table>
				</div>	
				</div>	
			</div>	
		</div>
	</div>
</div>
<input type="hidden" name="action" value="sssw_token_setting">
<input type="submit" class="button-primary spost_button" value="<?php _e('Save Setting','swp-social');?>" name="ssocial_all_save_social_Setting" style="width:100%;">
</form>
</div>
