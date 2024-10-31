<?php
function sssw_grid_shortcode_data($attr,$content=null){
	global $wpdb,$sssw_table;
	$grid_table = $wpdb->base_prefix.$sssw_table;	
	extract(shortcode_atts( array(
		'id' => ''
	), $attr));
	$grid_data = $wpdb->get_row("select * from ".$grid_table." where id=".$id);
	if(count($grid_data) == 1){
		$grid = unserialize($grid_data->slider_params);

		return do_shortcode('[fb_you_vimeo_twit_insta_grid fb_type="'.$grid["fb_type"].'" fb_id="'.$grid["fb_id"].'" fb_num="'.$grid["fb_num"].'" youtube_id="'.$grid["youtube_id"].'" youtube_playlist_id="'.$grid["youtube_playlist_id"].'" youtube_channel_id="'.$grid["youtube_channel_id"].'" youtube_num="'.$grid["youtube_num"].'" vimeo_id="'.$grid["vimeo_id"].'" vimeo_num="'.$grid["vimeo_num"].'" twitter_type="'.$grid["twitter_type"].'" twitter_id="'.$grid["twitter_id"].'" twitter_num="'.$grid["twitter_num"].'" instagram_id="'.$grid["instagram_id"].'" instagram_num="'.$grid["instagram_num"].'" post_type="'.$grid["post_type"].'" skin_type="'.$grid["skin_type"].'" car_display_item="'.$grid["car_display_item"].'" car_pagination="'.$grid["car_pagination"].'" car_pagination_num="'.$grid["car_pagination_num"].'" car_navigation="'.$grid["car_navigation"].'" car_autoplay="'.$grid["car_autoplay"].'" car_autoplay_time="'.$grid["car_autoplay_time"].'" grid_columns_count_for_desktop="'.$grid["grid_columns_count_for_desktop"].'" grid_columns_count_for_tablet="'.$grid["grid_columns_count_for_tablet"].'" grid_columns_count_for_mobile="'.$grid["grid_columns_count_for_mobile"].'" excerpt_length="'.$grid["excerpt_length"].'" hide_media="'.$grid["hide_media"].'" effect="'.$grid["effect"].'" cache_time="'.$grid["cache_time"].'" svc_class="'.$grid["svc_class"].'" pbgcolor="'.$grid["pbgcolor"].'" pbghcolor="'.$grid["pbghcolor"].'" tcolor="'.$grid["tcolor"].'" popup="'.$grid["popup"].'" ftcolor="'.$grid["ftcolor"].'" ftacolor="'.$grid["ftacolor"].'" ftabgcolor="'.$grid["ftabgcolor"].'" car_navigation_color="'.$grid["car_navigation_color"].'"]');
	}else{
		_e('Not Found Social Feed.','swp-social');
	}

}

function sssw_grid_shortcode_data_read($attr,$content=null){
	extract(shortcode_atts( array(
		'fb_type' => '@',
		'fb_id' => '',
		'fb_num' => '5',
		'youtube_id' => '',
		'youtube_playlist_id' => '',
		'youtube_channel_id' => '',
		'youtube_num' => '5',
		'vimeo_id' => '',
		'vimeo_num' => '5',
		'twitter_type' => '@',
		'twitter_id' => '',
		'twitter_num' => '5',
		'instagram_type' => '@',
		'instagram_id' => '',
		'instagram_num' => '5',
		'post_type' => 'post_layout',
		'skin_type' => 'template',
		'car_display_item' => '4',
		'car_pagination' => '',
		'car_pagination_num' => '',
		'car_navigation' => '',
		'car_autoplay' => '',
		'car_autoplay_time' => '5',
		'grid_columns_count_for_desktop' => 'vcfti-col-md-3',
		'grid_columns_count_for_tablet' => 'vcfti-col-sm-4',
		'grid_columns_count_for_mobile' => 'vcfti-col-xs-12',
		'excerpt_length' => '150',
		'hide_media' => '',
		'popup' => 'p1',
		'effect' => '',
		'cache_time' => '360',
		'svc_class' => '',
		'pbgcolor' => '',
		'pbghcolor' => '',
		'tcolor' => '',
		'ftcolor' => '',
		'ftacolor' => '',
		'ftabgcolor' => '',
		'car_navigation_color' => ''
	), $attr));
	
	if($fb_num > 5){
		$fb_num = 5;
	}
	if($youtube_num > 5){
		$youtube_num = 5;
	}
	if($vimeo_num > 5){
		$vimeo_num = 5;
	}
	if($twitter_num > 5){
		$twitter_num = 5;
	}
	if($instagram_num > 5){
		$instagram_num = 5;
	}

	wp_enqueue_style( 'sssw-social-css');
	wp_enqueue_style( 'sssw-vcfti-bootstrap-css' );
	wp_enqueue_style( 'sssw-megnific-css' );
	wp_enqueue_style( 'sssw-animate-css');

	wp_enqueue_script('sssw-megnific-js');
	wp_enqueue_script('sssw-carousel-js');
	$svc_social_id = rand(100,7000);
	ob_start();
	
	$fb_token = get_option( 'fb_token' );
	$youtube_token = get_option( 'youtube_token' );
	$vimeo_token = get_option( 'vimeo_token' );
	$instagram_token = get_option( 'instagram_token' );
	?>
<style type="text/css">
<?php if($skin_type == 'template'){$skint = '1';}elseif($skin_type == 'template1')
if($pbgcolor != ''){?>
.vc_social_tm<?php echo $skint;?> .svc_margin_container{ background:<?php echo $pbgcolor;?> !important;}
<?php }
if($pbghcolor != ''){?>
.vc_social_tm<?php echo $skint;?> .svc_margin_container:hover{ background:<?php echo $pbghcolor;?> !important;}
<?php }
if($tcolor != ''){?>
.vc_social_tm<?php echo $skint;?> .svc-author-title,
.vc_social_tm<?php echo $skint;?> .svc-text-title{ color:<?php echo $tcolor;?>  !important;}
<?php }
if($car_navigation_color != ''){?>
.owl-theme .owl-controls .owl-buttons div{ background:<?php echo $car_navigation_color;?> !important;}
.owl-theme .owl-controls .owl-page span{ background:<?php echo $car_navigation_color;?> !important;}
<?php }?>
</style>
    <div class="svc_skin_type_<?php echo $skin_type;?>">
    	<div class="svc_mask <?php echo $svc_class;?>" id="svc_mask_<?php echo $svc_social_id;?>">
            <div id="loader"></div>
        </div>
        <section class="feed svc_social_stream_container svc_social_stream_container_<?php echo $svc_social_id;?> <?php echo $svc_class;?>">
			<div class="social-feed-container social-feed-container_<?php echo $svc_social_id;?>" id="svc_social_stream_<?php echo $svc_social_id;?>">
			</div>
        </section>
    </div>
	<script>
    jQuery(document).ready(function() {
		var iso_cont = jQuery('.social-feed-container_<?php echo $svc_social_id;?>');
		
		<?php 
		if($post_type != 'carousel' && $skin_type != 's7'){?>
		iso_cont.isotope({
			itemSelector: '.svc-social-item',
			getSortData: {
				date: function (elem) {
					return jQuery(elem).attr('dt-create');
				}
			},
			transformsEnabled: false,
			  isResizeBound: false,
			  transitionDuration: '0',
			  filter: '*',
			  layoutMode: 'masonry',
			  masonry: {
				columnWidth: 1
			  }
		});
		jQuery(window).resize(function(){
				iso_cont.isotope();
		});
		<?php }else{?>
		iso_cont.owlCarousel({
			<?php if($car_autoplay == 'yes'){?>
			autoPlay: <?php echo $car_autoplay_time*1000;?>,
			<?php }?>
			items : <?php echo $car_display_item;?>,
			<?php if($car_display_item == 1){?>
			itemsDesktop : [1199,4],
			itemsDesktopSmall : [979,1],
			itemsTablet : [768,1],
			<?php }?>
			pagination:<?php if($car_pagination == 'yes'){echo 'true';}else{echo 'false';}?>,
			navigation: <?php if($car_navigation == 'yes'){echo 'false';}else{echo 'true';}?>,
			<?php if($car_pagination == 'yes' && $car_pagination_num == 'yes'){?>
			paginationNumbers:true,
			<?php }
			if($synced == 'yes' && $car_display_item == 1){?>
			afterAction : svc_syncPosition_<?php echo $svc_grid_id;?>,
			responsiveRefreshRate : 200,
			<?php }?>
			navigationText: [
				"<i class='fa fa-chevron-left'></i>",
				"<i class='fa fa-chevron-right'></i>"
			]
		});
		<?php }?>
        var vc_fb_you_vimeo_twit_insta_social_updateFeed_<?php echo $svc_social_id;?> = function() {
            jQuery('.social-feed-container_<?php echo $svc_social_id;?>').svc_fb_you_vimeo_twit_insta_social_stream({
				<?php if($fb_id != ''){?>
                facebook: {
                    accounts: ["<?php echo $fb_type.$fb_id;?>"],
                    limit: <?php echo $fb_num;?>,
                    access_token: '<?php echo $fb_token;?>'
                },
				<?php }
				if($youtube_id != '' || $youtube_playlist_id != '' || $youtube_channel_id != ''){
					if($youtube_id == ''){
						$youtube_id = 'apple';
					}?>
				youtube: {
					accounts: ["<?php echo $youtube_id;?>"],
                    limit: <?php echo $youtube_num;?>,
					<?php if($youtube_playlist_id != ''){?>
					playlistid: '<?php echo $youtube_playlist_id;?>',
					<?php }
					if($youtube_channel_id != ''){?>
					channel_id: '<?php echo $youtube_channel_id;?>',
					<?php }?>
                    access_token: '<?php echo $youtube_token;?>'
				},
				<?php }
				if($vimeo_id != ''){?>
				vimeo: {
                    accounts: ["<?php echo $vimeo_id;?>"],
					limit: <?php echo $vimeo_num;?>,
					access_token: '<?php echo $vimeo_token;?>'
                },
				<?php }
				if($twitter_id != ''){?>
                twitter: {
                    accounts: ["<?php echo $twitter_type.$twitter_id;?>"],
                    limit: <?php echo $twitter_num;?>
                },
				<?php }
				if($instagram_id != ''){?>
				instagram: {
                    accounts: ["@<?php echo $instagram_id;?>"],
                    limit: <?php echo $instagram_num;?>,
                    client_id: 'c47fb3449fbf4dcea3d52aab52630556',
                    instagram_access_token: '<?php echo $instagram_token;?>'
                },
				<?php }
				if($post_type != 'carousel'){?>
				grid_columns_count_for_desktop:'<?php echo $grid_columns_count_for_desktop;?>',
				grid_columns_count_for_tablet:'<?php echo $grid_columns_count_for_tablet;?>',
				grid_columns_count_for_mobile:'<?php echo $grid_columns_count_for_mobile;?>',
				<?php }else{?>
				grid_columns_count_for_desktop:'',
				grid_columns_count_for_tablet:'',
				grid_columns_count_for_mobile:'',
				<?php }?>
				popup: '<?php echo $popup;?>',
				stream_id:'<?php echo $svc_social_id;?>',
				cache_time : <?php echo $cache_time;?>,
                length: <?php echo $excerpt_length;?>,
				<?php if($effect != ''){?>
				effect:'<?php echo $effect;?>',
				<?php }?>
                show_media: <?php echo ($hide_media == 'yes') ? 'false' : 'true';?>,
				template: '<?php echo plugins_url( ltrim( 'template/'.$skin_type.'.html', '/' ), __FILE__ );?>',
                // Moderation function - if returns false, template will have class hidden
                moderation: function(content) {
                    return (content.text) ? content.text.indexOf('fuck') == -1 : true;
                },
				popup: '<?php echo $popup;?>',
                callback: function(dataa_social) {
                    console.log('all posts are collected');
				<?php if($post_type != 'carousel'){?>
					var dd = 0;
					var sdasd = jQuery( dataa_social );
					iso_cont.isotope( 'insert',sdasd);
					iso_cont.imagesLoaded( function() {
						setTimeout(function(){
							
							var sdi = setInterval(function(){
								iso_cont.isotope();
								if(dd>10){
									clearInterval(sdi);
								}
								dd++;
							},800);
							
							iso_cont.isotope();
							setTimeout(function(){
								jQuery('.svc_social_stream_container_<?php echo $svc_social_id;?>').show();
								jQuery('#svc_mask_<?php echo $svc_social_id;?>').hide();
								jQuery("[vc-social-effect]").viewportChecker({
									classToAdd: '<?php echo $effect;?>', // Class to add to the elements when they are visible
									classToRemove: 'opacity0', // Class to remove before adding 'classToAdd' to the elements
									callbackFunction: function(elem, action){
										if(action == 'add'){
											elem.removeAttr('vc-social-effect');
										}
									},
								});
							},1000);
						},1000);
						
					});
					<?php }else{?>
					iso_cont.data('owlCarousel').addItem(dataa_social);
					jQuery('.svc_social_stream_container_<?php echo $svc_social_id;?>').show();
					jQuery('#svc_mask_<?php echo $svc_social_id;?>').hide();
					jQuery("[vc-social-effect]").each(function(index, element) {
						var ef = jQuery(this).attr('vc-social-effect');
						jQuery(this).addClass(ef).removeClass('opacity0').removeAttr('vc-social-effect');
					});
					<?php }?>
                }
            });
        };
        vc_fb_you_vimeo_twit_insta_social_updateFeed_<?php echo $svc_social_id;?>();
    });
    </script>
	
	<?php
	$message = ob_get_clean();
	return $message;
}
?>
