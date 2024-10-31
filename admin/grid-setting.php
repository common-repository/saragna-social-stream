<?php 
if ( ! defined( 'ABSPATH' ) ) { exit; }
$grid = $difault_grid_array;
if(isset($_GET['sid'])){
$id = intval($_GET['sid']);
$grid_data = $wpdb->get_row("select * from ".self::$table_prefix.self::TABLE_FB_YOU_VIMEO_NAME." where id=".$id);
$grid_ori = unserialize($grid_data->slider_params);
$grid = array_merge($difault_grid_array,$grid_ori);
}?>
<ul class="post-list-tabs-menu">
	<li data-tab-index="fb_tab" class="spl_active"><i class="fa fa-facebook"></i></li>
	<li data-tab-index="you_tab" class=""><i class="fa fa-youtube"></i></li>
	<li data-tab-index="vimeo_tab" class=""><i class="fa fa-vimeo-square"></i></li>
    <li data-tab-index="twit_tab" class=""><i class="fa fa-twitter"></i></li>
	<li data-tab-index="insta_tab" class=""><i class="fa fa-instagram"></i></li>
	<li data-tab-index="general_tab" class=""><?php _e('General','svc_social_feed');?></li>
	<li data-tab-index="color_tab" class=""><?php _e('Color Setting','svc_social_feed');?></li>
</ul>

<div id="fb_tab" class="spl_tabs displayb">
	<div class="metabox-holder width100" id="dashboard-widgets">
		<div class="postbox-container width100">	
			<div class="meta-box-sortables ui-sortable mar0">	
				<div class="postbox">
				<div class="inside">
				<table class="anew_slider_setting">	
                	<tr>	
						<th><strong class="afl"><?php _e('Select Type','svc_social_feed');?> :</strong></th>	
						<td>	
						<select name="fb_type">
                        	<option value="@" <?php selected( $grid['fb_type'], '@' ); ?>>For Page/User</option>
                            <option value="#" <?php selected( $grid['fb_type'], '#' ); ?>>For Group</option>
                        </select>
						<p class="description"><?php _e('Select facebook User feed type.','svc_social_feed');?></p>	
						</td>	
					</tr>
					<tr>	
						<th><strong class="afl"><?php _e('Page Username','svc_social_feed');?>:</strong></th>	
						<td>	
						<input type="text" value="<?php echo $grid['fb_id'];?>" name="fb_id">
						<p class="description"><?php _e('Enter Facebook Page or Username. Example : https://www.facebook.com/VinDiesel/ only add <strong>VinDiesel</strong> in field','svc_social_feed');?></p>	
						</td>	
					</tr>
					<tr>	
						<th><strong class="afl"><?php _e('Count per page limit','svc_social_feed');?>:</strong></th>	
						<td>
						<input type="number" step="1" value="<?php echo $grid['fb_num'];?>" name="fb_num" max="5" min="1" data-check-depen="yes" id="spost_car_display_item">
						<p class="description"><?php _e('Set Limit for feed par page. Maximum 5 Feed Available in free version. Pro version buy for more option. <a href="https://codecanyon.net/item/saragna-social-stream-wordpress/20693264?ref=saragna" target="_blank">PRO Version</a>','svc_social_feed');?></p>	
						</td>	
					</tr>
				</table>
				</div>	
				</div>	
			</div>	
		</div>
	</div>
</div>

<div id="you_tab" class="spl_tabs">
	<div class="metabox-holder width100" id="dashboard-widgets">
		<div class="postbox-container width100">	
			<div class="meta-box-sortables ui-sortable mar0">	
				<div class="postbox">
				<div class="inside">	
				<table class="anew_slider_setting">					
					<tr>	
						<th><strong class="afl"><?php _e('User name','svc_social_feed');?>:</strong></th>	
						<td>	
						<input type="text" value="<?php echo $grid['youtube_id'];?>" name="youtube_id">
						<p class="description"><?php _e('Enter Youtube User id. Example : https://www.youtube.com/user/vevo  only add <strong>vevo</strong> in field. please add only one field for youtube feed. User ID Or Playlist ID or Channel ID. not need 3 field fillup.','svc_social_feed');?></p>	
						</td>	
					</tr>
                    <tr>	
						<th><strong class="afl"><?php _e('Enter Playlist ID','svc_social_feed');?>:</strong></th>	
						<td>	
						<input type="text" value="<?php echo $grid['youtube_playlist_id'];?>" name="youtube_playlist_id">
						<p class="description"><?php _e('Enter Youtube Playlist id. Example : https://www.youtube.com/watch?v=9Pc81i6XOz0&list=LL2pmfLm7iq6Ov1UwYrWYkZA&spfreload=10 only add <strong>LL2pmfLm7iq6Ov1UwYrWYkZA</strong> in field','svc_social_feed');?></p>	
						</td>	
					</tr>
                    <tr>	
						<th><strong class="afl"><?php _e('Enter Channel ID','svc_social_feed');?>:</strong></th>	
						<td>	
						<input type="text" value="<?php echo $grid['youtube_channel_id'];?>" name="youtube_channel_id">
						<p class="description"><?php _e('Enter Youtube Channel id. Example : https://www.youtube.com/channel/UCY14-R0pMrQzLne7lbTqRvA?spfreload=10  only add <strong>UCY14-R0pMrQzLne7lbTqRvA</strong> in field','svc_social_feed');?></p>	
						</td>	
					</tr>
					<tr>	
						<th><strong class="afl"><?php _e('Count per page limit','svc_social_feed');?>:</strong></th>	
						<td>
						<input type="number" step="1" value="<?php echo $grid['youtube_num'];?>" name="youtube_num" max="5" min="1">
						<p class="description"><?php _e('Set Limit for feed par page.  Maximum 5 Feed Available in free version. Pro version buy for more option. <a href="https://codecanyon.net/item/saragna-social-stream-wordpress/20693264?ref=saragna" target="_blank">PRO Version</a>','svc_social_feed');?></p>	
						</td>	
					</tr>
				</table>
				</div>	
				</div>	
			</div>	
		</div>
	</div>
</div>

<div id="vimeo_tab" class="spl_tabs">
	<div class="metabox-holder width100" id="dashboard-widgets">
		<div class="postbox-container width100">	
			<div class="meta-box-sortables ui-sortable mar0">	
				<div class="postbox">
				<div class="inside">	
				<table class="anew_slider_setting">
					<tr>	
						<th><strong class="afl"><?php _e('User ID','svc_social_feed');?>:</strong></th>	
						<td>	
						<input type="text" value="<?php echo $grid['vimeo_id'];?>" name="vimeo_id">
						<p class="description"><?php _e('Enter Vimeo User id.Example : https://vimeo.com/sonyprofessional only add <strong>sonyprofessional</strong> in field','svc_social_feed');?></p>	
						</td>	
					</tr>
					<tr>	
						<th><strong class="afl"><?php _e('Count per page limit','svc_social_feed');?>:</strong></th>	
						<td>
						<input type="number" step="1" value="<?php echo $grid['vimeo_num'];?>" name="vimeo_num" max="5" min="1">
						<p class="description"><?php _e('Set Limit for feed par page.  Maximum 5 Feed Available in free version. Pro version buy for more option. <a href="https://codecanyon.net/item/saragna-social-stream-wordpress/20693264?ref=saragna" target="_blank">PRO Version</a>','svc_social_feed');?></p>	
						</td>	
					</tr>
				</table>
				</div>	
				</div>	
			</div>	
		</div>
	</div>
</div>

<div id="twit_tab" class="spl_tabs">
	<div class="metabox-holder width100" id="dashboard-widgets">
		<div class="postbox-container width100">	
			<div class="meta-box-sortables ui-sortable mar0">	
				<div class="postbox">
				<div class="inside">	
				<table class="anew_slider_setting">
					<tr>	
						<th><strong class="afl"><?php _e('Select Type','svc_social_feed');?> :</strong></th>	
						<td>	
						<select name="twitter_type">
                        	<option value="@" <?php selected( $grid['twitter_type'], '@' ); ?>><?php _e('For User','svc_social_feed')?></option>
                            <option value="#" <?php selected( $grid['twitter_type'], '#' ); ?>><?php _e('For Search Feed','svc_social_feed')?>"</option>
                        </select>
						<p class="description"><?php _e('Select Twitter User feed type.','svc_social_feed');?></p>	
						</td>	
					</tr>
					<tr>	
						<th><strong class="afl"><?php _e('User name','svc_social_feed');?>:</strong></th>	
						<td>	
						<input type="text" value="<?php echo $grid['twitter_id'];?>" name="twitter_id">
						<p class="description"><?php _e('Enter Twitter User name.','svc_social_feed');?></p>	
						</td>	
					</tr>
					<tr>	
						<th><strong class="afl"><?php _e('Count per page limit','svc_social_feed');?>:</strong></th>	
						<td>
						<input type="number" step="1" value="<?php echo $grid['twitter_num'];?>" name="twitter_num" max="5" min="1">
						<p class="description"><?php _e('Set Limit for feed par page. Maximum 5 Feed Available in free version. Pro version buy for more option. <a href="https://codecanyon.net/item/saragna-social-stream-wordpress/20693264?ref=saragna" target="_blank">PRO Version</a>','svc_social_feed');?></p>	
						</td>	
					</tr>
				</table>
				</div>	
				</div>	
			</div>	
		</div>
	</div>
</div>

<div id="insta_tab" class="spl_tabs">
	<div class="metabox-holder width100" id="dashboard-widgets">
		<div class="postbox-container width100">	
			<div class="meta-box-sortables ui-sortable mar0">	
				<div class="postbox">
				<div class="inside">	
				<table class="anew_slider_setting">
					<tr>	
						<th><strong class="afl"><?php _e('User ID','svc_social_feed');?>:</strong></th>	
						<td>	
						<input type="text" value="<?php echo $grid['instagram_id'];?>" name="instagram_id">
						<p class="description"><?php _e('Enter Instagram UserID.It is only numeric id. create User ID <a href="https://smashballoon.com/instagram-feed/find-instagram-user-id/" target="_blank">here</a>.','svc_social_feed');?></p>	
						</td>	
					</tr>
					<tr>	
						<th><strong class="afl"><?php _e('Count per page limit','svc_social_feed');?>:</strong></th>	
						<td>
						<input type="number" step="1" value="<?php echo $grid['instagram_num'];?>" name="instagram_num" max="5" min="1">
						<p class="description"><?php _e('Set Limit for feed par page. Maximum 5 Feed Available in free version. Pro version buy for more option. <a href="https://codecanyon.net/item/saragna-social-stream-wordpress/20693264?ref=saragna" target="_blank">PRO Version</a>','svc_social_feed');?></p>	
						</td>	
					</tr>
				</table>
				</div>	
				</div>	
			</div>	
		</div>
	</div>
</div>

<div id="general_tab" class="spl_tabs">
	<div class="metabox-holder width100" id="dashboard-widgets">
		<div class="postbox-container width100">	
			<div class="meta-box-sortables ui-sortable mar0">	
				<div class="postbox">
				<div class="inside">	
				<table class="anew_slider_setting">
                	<tr>
						<th><strong class="afl"><?php _e('Title','svc_social_feed');?> :</strong></th>	
						<td>
						<input type="text" name="title" value="<?php echo $grid['title'];?>">
						<p class="description"><?php _e('Enter Post grid title','svc_social_feed');?></p>	
						</td>
					</tr>
					<tr>	
						<th><strong class="afl"><?php _e('Social Grid Type','svc_social_feed');?> :</strong></th>	
						<td>	
						<select name="post_type" id="spost_grid_type" data-check-depen="yes">
							<option value="post_layout" <?php selected( $grid['post_type'], 'post_layout' ); ?>><?php _e('Feed Layout','svc_social_feed');?></option>
							<option value="carousel" <?php selected( $grid['post_type'], 'carousel' ); ?>><?php _e('Carousel','svc_social_feed');?></option>
						</select>
						<p class="description">Select Feed Grid Type.</p></td>	
					</tr>
					<tr>		
						<th><strong class="afl"><?php _e('Skin type','svc_social_feed');?>:</strong></th>	
						<td>
						<div class="skin_div">
							<div>
							<input type="radio" name="skin_type" value="template" <?php checked( $grid['skin_type'], 'template' ); ?> id="radio1"/>
							<img src="<?php echo plugins_url('../assets/image/l1.png',__FILE__ );?>" for="radio1"/>
							</div>
							<div class="sssw_pro_label">
								<input type="radio" name="skin_type" value="template1" <?php checked( $grid['skin_type'], 'template1' ); ?> id="radio2" disabled="disabled"/>
								<div class="sssw_pro_img">
								<img src="<?php echo plugins_url('../assets/image/l2.png',__FILE__ );?>" for="radio2"/>
								<span>PRO Version</span>
								</div>
							</div>
							<div class="sssw_pro_label">
								<input type="radio" name="skin_type" value="template1" <?php checked( $grid['skin_type'], 'template1' ); ?> id="radio2" disabled="disabled"/>
								<div class="sssw_pro_img">
								<img src="<?php echo plugins_url('../assets/image/l3.png',__FILE__ );?>" for="radio2"/>
								<span>PRO Version</span>
								</div>
							</div>
							<div class="sssw_pro_label">
								<input type="radio" name="skin_type" value="template1" <?php checked( $grid['skin_type'], 'template1' ); ?> id="radio2" disabled="disabled"/>
								<div class="sssw_pro_img">
								<img src="<?php echo plugins_url('../assets/image/l4.png',__FILE__ );?>" for="radio2"/>
								<span>PRO Version</span>
								</div>
							</div>
							<div class="sssw_pro_label">
								<input type="radio" name="skin_type" value="template1" <?php checked( $grid['skin_type'], 'template1' ); ?> id="radio2" disabled="disabled"/>
								<div class="sssw_pro_img">
								<img src="<?php echo plugins_url('../assets/image/l5.png',__FILE__ );?>" for="radio2"/>
								<span>PRO Version</span>
								</div>
							</div>
							<div class="sssw_pro_label">
								<input type="radio" name="skin_type" value="template1" <?php checked( $grid['skin_type'], 'template1' ); ?> id="radio2" disabled="disabled"/>
								<div class="sssw_pro_img">
								<img src="<?php echo plugins_url('../assets/image/l6.png',__FILE__ );?>" for="radio2"/>
								<span>PRO Version</span>
								</div>
							</div>
							<div class="sssw_pro_label">
								<input type="radio" name="skin_type" value="template1" <?php checked( $grid['skin_type'], 'template1' ); ?> id="radio2" disabled="disabled"/>
								<div class="sssw_pro_img">
								<img src="<?php echo plugins_url('../assets/image/l7.png',__FILE__ );?>" for="radio2"/>
								<span>PRO Version</span>
								</div>
							</div>
						</div>
					</td>	
					</tr>
					<tr data-depen-set="true" data-value="carousel" data-id="spost_grid_type" data-attr="select">	
						<th><strong class="afl"><?php _e('Items Display','svc_social_feed');?> :</strong></th>	
						<td>	
						<input type="number" step="1" value="<?php echo $grid['car_display_item'];?>" name="car_display_item" max="100" min="1" data-check-depen="yes" id="spost_car_display_item">
						<p class="description"><?php _e('This variable allows you to set the maximum amount of items displayed at a time with the widest browser width','svc_social_feed');?></p>
						</td>	
					</tr>
                    <tr data-depen-set="true" data-value="carousel" data-id="spost_grid_type" data-attr="select">	
						<th><strong class="afl"><?php _e('Show pagination','svc_social_feed');?> :</strong></th>
						<td>	
						<input type="checkbox" name="car_pagination" value="yes" id="spost_car_pagination" data-check-depen="yes" <?php checked( $grid['spost_car_pagination'], 'yes' ); ?>><?php _e('Yes','svc_social_feed');?>
						<p class="description"><?php _e('Show pagination','svc_social_feed');?></p>	
						</td>
					</tr>
                    <tr data-depen-set="true" data-value="yes" data-id="spost_car_pagination" data-attr="checkbox">	
						<th><strong class="afl"><?php _e('Show pagination Numbers','svc_social_feed');?> :</strong></th>	
						<td>	
						<input type="checkbox" name="car_pagination_num" value="yes" <?php checked( $grid['car_pagination_num'], 'yes' ); ?>><?php _e('Yes','svc_social_feed');?>
						<p class="description"><?php _e('Show numbers inside pagination buttons.','svc_social_feed');?></p>	
						</td>	
					</tr>
                    <tr data-depen-set="true" data-value="carousel" data-id="spost_grid_type" data-attr="select">	
						<th><strong class="afl"><?php _e('Hide navigation','svc_social_feed');?> :</strong></th>	
						<td>	
						<input type="checkbox" name="car_navigation" value="yes" <?php checked( $grid['car_navigation'], 'yes' ); ?>><?php _e('Yes','svc_social_feed');?>
						<p class="description"><?php _e('Display "next" and "prev" buttons.','svc_social_feed');?></p>	
						</td>	
					</tr>
                    <tr data-depen-set="true" data-value="carousel" data-id="spost_grid_type" data-attr="select">	
						<th><strong class="afl"><?php _e('AutoPlay','svc_social_feed');?> :</strong></th>	
						<td>	
						<input type="checkbox" name="car_autoplay" value="yes" id="spost_car_autoplay" data-check-depen="yes" <?php checked( $grid['car_autoplay'], 'yes' ); ?>><?php _e('Yes','svc_social_feed');?>
						<p class="description"><?php _e('Set Slider Autoplay.','svc_social_feed');?></p>	
						</td>	
					</tr>
                    <tr data-depen-set="true" data-value="yes" data-id="spost_car_autoplay" data-attr="checkbox">	
						<th><strong class="afl"><?php _e('autoPlay Time','svc_social_feed');?> :</strong></th>	
						<td>	
						<input type="number" step="1" value="<?php echo $grid['car_autoplay_time'];?>" name="car_autoplay_time" max="100" min="1"><?php _e('seconds','svc_social_feed');?>
						<p class="description"><?php _e('Set Autoplay slider speed.','svc_social_feed');?></p>	
						</td>
					</tr>
					<tr data-depen-set="true" data-value="post_layout" data-id="spost_grid_type" data-attr="select">	
						<th><strong class="afl"><?php _e('Desktop Columns Count','svc_social_feed');?> :</strong></th>	
						<td>	
						<select name="grid_columns_count_for_desktop">
                        	<option value="vcfti-col-md-12" <?php selected( $grid['grid_columns_count_for_desktop'], 'vcfti-col-md-12' ); ?>><?php _e('1 Column','svc_social_feed');?></option>
                            <option value="vcfti-col-md-6" <?php selected( $grid['grid_columns_count_for_desktop'], 'vcfti-col-md-6' ); ?>><?php _e('2 Columns','svc_social_feed');?></option>
                            <option value="vcfti-col-md-4" <?php selected( $grid['grid_columns_count_for_desktop'], 'vcfti-col-md-4' ); ?>><?php _e('3 Columns','svc_social_feed');?></option>
                            <option value="vcfti-col-md-3" <?php selected( $grid['grid_columns_count_for_desktop'], 'vcfti-col-md-3' ); ?>><?php _e('4 Columns','svc_social_feed');?></option>
                            <option value="vcfti-col-md-15" <?php selected( $grid['grid_columns_count_for_desktop'], 'vcfti-col-md-15' ); ?>><?php _e('5 Columns','svc_social_feed');?></option>
                        </select>
						<p class="description"><?php _e('Choose Desktop(PC Mode) Columns Count','svc_social_feed');?></p>	
						</td>	
					</tr>
                    <tr data-depen-set="true" data-value="post_layout" data-id="spost_grid_type" data-attr="select">	
						<th><strong class="afl"><?php _e('Tablet Columns Count','svc_social_feed');?> :</strong></th>	
						<td>	
						<select name="grid_columns_count_for_tablet">
                        	<option value="vcfti-col-sm-12" <?php selected( $grid['grid_columns_count_for_tablet'], 'vcfti-col-sm-12' ); ?>><?php _e('1 Column','svc_social_feed');?></option>
                            <option value="vcfti-col-sm-6" <?php selected( $grid['grid_columns_count_for_tablet'], 'vcfti-col-sm-6' ); ?>><?php _e('2 Columns','svc_social_feed');?></option>
                            <option value="vcfti-col-sm-4" <?php selected( $grid['grid_columns_count_for_tablet'], 'vcfti-col-sm-4' ); ?>><?php _e('3 Columns','svc_social_feed');?></option>
                            <option value="vcfti-col-sm-4" <?php selected( $grid['grid_columns_count_for_tablet'], 'vcfti-col-sm-4' ); ?>><?php _e('3 Columns','svc_social_feed');?></option>
                            <option value="vcfti-col-sm-3" <?php selected( $grid['grid_columns_count_for_tablet'], 'vcfti-col-sm-3' ); ?>><?php _e('4 Columns','svc_social_feed');?></option>
                            <option value="vcfti-col-sm-15" <?php selected( $grid['grid_columns_count_for_tablet'], 'vcfti-col-sm-15' ); ?>><?php _e('5 Columns','svc_social_feed');?></option>
                        </select>
						<p class="description"><?php _e('Choose Tablet Columns Count','svc_social_feed');?></p>	
						</td>	
					</tr>
                    <tr data-depen-set="true" data-value="post_layout" data-id="spost_grid_type" data-attr="select">	
						<th><strong class="afl"><?php _e('Mobile Columns Count','svc_social_feed');?> :</strong></th>	
						<td>
						<select name="grid_columns_count_for_mobile">
                        	<option value="vcfti-col-xs-12" <?php selected( $grid['grid_columns_count_for_mobile'], 'vcfti-col-xs-12' ); ?>><?php _e('1 Column','svc_social_feed');?></option>
                            <option value="vcfti-col-xs-6" <?php selected( $grid['grid_columns_count_for_mobile'], 'vcfti-col-xs-6' ); ?>><?php _e('2 Columns','svc_social_feed');?></option>
                            <option value="vcfti-col-xs-4" <?php selected( $grid['grid_columns_count_for_mobile'], 'vcfti-col-xs-4' ); ?>><?php _e('3 Columns','svc_social_feed');?></option>
                            <option value="vcfti-col-xs-3" <?php selected( $grid['grid_columns_count_for_mobile'], 'vcfti-col-xs-3' ); ?>><?php _e('4 Columns','svc_social_feed');?></option>
                            <option value="vcfti-col-xs-15" <?php selected( $grid['grid_columns_count_for_mobile'], 'vcfti-col-xs-15' ); ?>><?php _e('5 Columns','svc_social_feed');?></option>
                        </select>
						<p class="description"><?php _e('Choose Mobile Columns Count','svc_social_feed');?></p>	
						</td>	
					</tr>
                    <tr>
                    	<th><strong class="afl"><?php _e('Description Length','svc_social_feed');?></strong></th>
                        <td>
							<input type="number" step="1" value="<?php echo $grid['excerpt_length'];?>" name="excerpt_length" max="900" min="10">
                            <p class="description"><?php _e('set Description length.default:150.If you set 0 no display Discription in fronted site','svc_social_feed');?></p>
                        </td>
                    </tr>
                    <tr>	
						<th><strong class="afl"><?php _e('Hide Media','svc_social_feed');?>:</strong></th>	
						<td>	
						<input type="checkbox" value="yes" name="hide_media" <?php checked( $grid['hide_media'], 'yes' ); ?>/><?php _e('Yes','svc_social_feed');?>
						<p class="description"><?php _e('If you check not display Media Image in feed.','svc_social_feed');?></p>	
						</td>	
					</tr>
					<tr data-depen-set="true" data-value="post_layout" data-id="spost_grid_type" data-attr="select" class="sssw_pro_hide">	
						<th><strong class="afl"><?php _e('Show filter','svc_social_feed');?>:</strong></th>	
						<td>	
						<input type="checkbox" value="yes" name="filter" id="swp_filter" data-check-depen="yes" disabled="disabled"/><?php _e('Yes, Please','svc_social_feed');?>
						<p class="description"><?php _e('Add Social Filter to top of the page. Pro version buy for more option. <a href="https://codecanyon.net/item/saragna-social-stream-wordpress/20693264?ref=saragna" target="_blank">PRO Version</a>','svc_social_feed');?></p>	
						</td>	
					</tr>
					<tr>	
						<th><strong class="afl"><?php _e('Popup Content Style','svc_social_feed');?>:</strong></th>	
						<td>
						<select name="popup">
                        	<option value="p1" <?php selected( $grid['popup'], 'p1' ); ?>><?php _e('Only Image/Video','svc_social_feed');?></option>
                            <option value="p2" <?php selected( $grid['popup'], 'p2' ); ?> disabled="disabled"><?php _e('Image/Video with Content (PRO Version)','svc_social_feed');?></option>
                        </select>
						<p class="description"><?php _e('Display Popup Content Style. Pro version buy for more option. <a href="https://codecanyon.net/item/saragna-social-stream-wordpress/20693264?ref=saragna" target="_blank">PRO Version</a>','svc_social_feed');?></p>	
						</td>	
					</tr>
					<tr data-depen-set="true" data-value="post_layout" data-id="spost_grid_type" data-attr="select" class="sssw_pro_hide">	
						<th><strong class="afl"><?php _e('Show more','swp-social');?>:</strong></th>	
						<td>	
						<input type="checkbox" value="yes" name="loadmore" id="swp_loadmore" data-check-depen="yes" disabled="disabled"/><?php _e('Yes','swp-social');?>
						<p class="description"><?php _e('add Show more feed button. Pro version buy for more option. <a href="https://codecanyon.net/item/saragna-social-stream-wordpress/20693264?ref=saragna" target="_blank">PRO Version</a>','swp-social');?></p>	
						</td>	
					</tr>
					<tr data-depen-set="true" data-value="post_layout" data-id="spost_grid_type" data-attr="select" class="sssw_pro_hide">
						<th><strong class="afl"><?php _e('Onload Date sorting','swp-social');?> :</strong></th>	
						<td>
						<input type="checkbox" value="yes" name="date_sorting" disabled="disabled"/><?php _e('Yes','swp-social');?>
						<p class="description"><?php _e('set Onload feed Date sorting. Pro version buy for more option. <a href="https://codecanyon.net/item/saragna-social-stream-wordpress/20693264?ref=saragna" target="_blank">PRO Version</a>','swp-social');?></p>	
						</td>
					</tr>
                    <tr data-depen-set="true" data-value="post_layout" data-id="spost_grid_type" data-attr="select">	
						<th><strong class="afl"><?php _e('Feed load Effect','svc_social_feed');?> :</strong></th>	
						<td>
						<select name="effect">
                        <?php foreach($animations as $animation){?>
                        	<option value="<?php echo $animation;?>" <?php selected( $grid['effect'], $animation ); ?>><?php echo $animation;?></option>
						<?php }?>
                        </select>
						<p class="description"><?php _e('Select Feed load effect.','svc_social_feed');?>.</p>	
						</td>	
					</tr>
					<tr>	
						<th><strong class="afl"><?php _e('Cache Time','svc_social_feed');?>:</strong></th>	
						<td>
						<input type="number" step="1" value="<?php echo $grid['cache_time'];?>" name="cache_time" max="1000" min="1" data-check-depen="yes">
						<p class="description"><?php _e('Set Cache Time for Reducing the number of API calls.','svc_social_feed');?></p>	
						</td>	
					</tr>
                    <tr>
                    	<th><strong class="afl"><?php _e('Extra class name','svc_social_feed');?></strong></th>
                        <td>
                            <input type="text" name="svc_class" value="<?php echo $grid['svc_class'];?>"/>
                            <p class="description"><?php _e('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.','svc_social_feed');?></p>
                        </td>
                    </tr>
				</table>
				</div>	
				</div>	
			</div>	
		</div>
	</div>
</div>

<div id="color_tab" class="spl_tabs">
	<div class="metabox-holder width100" id="dashboard-widgets">
		<div class="postbox-container width100">	
			<div class="meta-box-sortables ui-sortable mar0">	
				<div class="postbox">
				<div class="inside">	
				<table class="vertical-top">	
					<tr>
						<th><strong class="afl"><?php _e('Post Background Color','svc_social_feed');?> :</strong></th>
						<td>	
							<input type="text" class="my-color-field" name="pbgcolor" data-default-color="" value="<?php echo $grid['pbgcolor'];?>"/>	
						<p class="description"><?php _e('set post background color.','svc_social_feed');?></p></td>
					</tr>	
					<tr>	
						<th><strong class="afl"><?php _e('Post hover Background Color','svc_social_feed');?> :</strong></th>
						<td>	
						<input type="text" class="my-color-field" name="pbghcolor" data-default-color="" value="<?php echo $grid['pbghcolor'];?>"/>	
						<p class="description"><?php _e('set post hover background color','svc_social_feed');?>.</p>	
						</td>	
					</tr>
					<tr>	
						<th><strong class="afl"><?php _e('Title Color','svc_social_feed');?> :</strong></th>	
						<td>	
							<input type="text" class="my-color-field" name="tcolor" data-default-color="" value="<?php echo $grid['tcolor'];?>"/>	
							<p class="description"><?php _e('Set Title Color','svc_social_feed');?>.</p>	
						</td>	
					</tr>
					<tr data-depen-set="true" data-value="yes" data-id="swp_filter" data-attr="checkbox">
						<th><strong class="afl"><?php _e('Filter text color','svc_social_feed');?> :</strong></th>	
						<td>	
							<input type="text" class="my-color-field" name="ftcolor" data-default-color="" value="<?php echo $grid['ftcolor'];?>"/>	
							<p class="description"><?php _e('Set Filter text and border color','svc_social_feed');?>.</p>	
						</td>	
					</tr>
					<tr data-depen-set="true" data-value="yes" data-id="swp_filter" data-attr="checkbox">
						<th><strong class="afl"><?php _e('Active Filter text color','svc_social_feed');?> :</strong></th>	
						<td>	
							<input type="text" class="my-color-field" name="ftacolor" data-default-color="" value="<?php echo $grid['ftacolor'];?>"/>	
							<p class="description"><?php _e('Set Active Filter text color','svc_social_feed');?>.</p>	
						</td>	
					</tr>
					<tr data-depen-set="true" data-value="yes" data-id="swp_filter" data-attr="checkbox">
						<th><strong class="afl"><?php _e('Active Filter text background color','svc_social_feed');?> :</strong></th>	
						<td>	
							<input type="text" class="my-color-field" name="ftabgcolor" data-default-color="" value="<?php echo $grid['ftabgcolor'];?>"/>	
							<p class="description"><?php _e('Set Active Filter text background color','svc_social_feed');?>.</p>	
						</td>	
					</tr>
					<tr data-depen-set="true" data-value="yes" data-id="swp_loadmore" data-attr="checkbox">	
						<th><strong class="afl"><?php _e('Load more Loader and Text Color','svc_social_feed');?> :</strong></th>	
						<td>	
							<input type="text" class="my-color-field" name="loder_color" data-default-color="" value="<?php echo $grid['loder_color'];?>"/>	
							<p class="description"><?php _e('set Load More Loader and Text color.','svc_social_feed');?>.</p>	
						</td>	
					</tr>
					<tr data-depen-set="true" data-value="carousel" data-id="spost_grid_type" data-attr="select">	
						<th><strong class="afl"><?php _e('Navigation and Pagination color','svc_social_feed');?> :</strong></th>	
						<td>
						<input type="text" class="my-color-field" name="car_navigation_color" data-default-color="" value="<?php echo $grid['car_navigation_color'];?>"/>
						<p class="description"><?php _e('Set Navigation and Pagination color','svc_social_feed');?>.</p>	
						</td>
					</tr>
				</table>
				</div>	
				</div>	
			</div>	
		</div>
	</div>
</div>


<?php if(isset($_GET['sid'])){?>
<input type="hidden" name="social_sid" value="<?php echo esc_attr($_GET['sid']);?>">
<input type="hidden" name="action" value="sssw_Update_Setting">
<input type="submit" class="spost_button width100" value="<?php esc_html_e('Update Setting','svc_social_feed');?>" name="spost_Update_Setting">
<?php }else{?>
<input type="hidden" name="action" value="sssw_save_Setting">
<input type="submit" class="spost_button width100" value="<?php _e('Save Setting','svc_social_feed');?>" name="spost_save_Setting">
<?php }?>
