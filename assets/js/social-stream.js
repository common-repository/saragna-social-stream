if (typeof Object.create !== 'function') {
    Object.create = function(obj) {
        function F() {}
        F.prototype = obj;
        return new F();
    };
}

function fb_you_vimeo_twit_insta_megnific_script(){
	jQuery('a.svc_big_img').magnificPopup({
	  type: 'image',
	  mainClass: 'ssocial-popup-close',
	  closeBtnInside:false
	});
	jQuery('.popup-youtube').magnificPopup({
	  type: 'iframe',
	  mainClass: 'mfp-fade',
	  preloader: false,
	  closeBtnInside:false,
	  mainClass: 'ssocial-popup-close',
	  iframe: {
		 patterns: {
		   youtube: {
			index: 'youtube.com', 
			id: 'v=', 
			src: '//www.youtube.com/embed/%id%?rel=0&autoplay=1'
		   }
		 }
	   }
	});
	jQuery('a.svc_twit_video').magnificPopup({
          type: 'ajax',
		  mainClass: 'ssocial-popup-close',
		  closeBtnInside:false,
		  closeOnBgClick: false
	});
	jQuery('.popup-vimeo').magnificPopup({
	  type: 'iframe',
	  mainClass: 'mfp-fade',
	  preloader: false,
	  closeBtnInside:false,
	  mainClass: 'ssocial-popup-close',
	  iframe: {
		 patterns: {
		   vimeo: {
			index: 'vimeo.com', 
			id: '/',
			src: '//player.vimeo.com/video/%id%?autoplay=1'
		   }
		 }
	   }
	});
}
function fb_you_vimeo_twit_insta_getSorted(selector, attrName) {
    return jQuery(jQuery(selector).toArray().sort(function(a, b){
        var aVal = parseInt(a.getAttribute(attrName)),
            bVal = parseInt(b.getAttribute(attrName));
        return bVal - aVal;
    }));
}
var sv = 0;
var si = 0;
var social_dataa = '';
(function($, window, document, undefined) {
    $.fn.svc_fb_you_vimeo_twit_insta_social_stream = function(_options) {


        var defaults = {
            plugin_folder: '', // a folder in which the plugin is located (with a slash in the end)
            template: 'template.html', // a path to the template file
            show_media: false, // show images of attachments if available
            media_min_width: 300,
            length: 150, // maximum length of post message shown
			effect:'',
            insta_access_token:'',
			grid_columns_count_for_desktop:'',
			grid_columns_count_for_tablet:'',
			grid_columns_count_for_mobile:'',
			popup:'',
			stream_id:''
        };
        moment.locale('en');
        console.log(svc_ajax_url.laungage);
        moment.locale(svc_ajax_url.laungage);
        //---------------------------------------------------------------------------------
        var options = $.extend(defaults, _options),
            container = $(this),
            template,
            social_networks = ['facebook','youtube','vimeo','instagram','twitter'];
        //---------------------------------------------------------------------------------

        //---------------------------------------------------------------------------------
        // This function performs consequent data loading from all of the sources by calling corresponding functions

        function fireCallback(dataa_social) {
            var fire = true;
            if (fire && options.callback) {
                options.callback(dataa_social);
				social_dataa = '';
				if(options.popup == 'p1'){
					fb_you_vimeo_twit_insta_megnific_script();
				}
            }
        }

        var Utility = {
            request: function(url, callback) {
                $.ajax({
                    url: url,
                    dataType: 'jsonp',
                    success: callback
                });
            },
			request_json: function(url, callback) {
                $.ajax({
                    url: url,
                    dataType: 'json',
                    success: callback
                });
            },
            get_request: function(url, callback) {
                $.get(url, callback, 'json');
            },
            wrapLinks: function(string, social_network) {
                var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
                if (social_network === 'google-plus' || social_network === 'tumblr') {
                    string = string.replace(/(@|#)([a-z0-9_]+['])/ig, Utility.wrapGoogleplusTagTemplate);
                } else {
                    string = string.replace(exp, Utility.wrapLinkTemplate);
                }
                return string;
            },
            wrapLinkTemplate: function(string) {
                return '<a target="_blank" href="' + string + '">' + string + '<\/a>';
            },
            wrapGoogleplusTagTemplate: function(string) {
                return '<a target="_blank" href="https://plus.google.com/s/' + string + '" >' + string + '<\/a>';
            },
            shorten: function(string) {
                string = $.trim(string);
                if (string.length > options.length) {
                    return jQuery.trim(string).substring(0, options.length).split(" ").slice(0, -1).join(" ") + "...";
                } else {
                    return string;
                }
            },
            stripHTML: function(string) {
                if (typeof string === "undefined" || string === null) {
                    return '';
                }
                return string.replace(/(<([^>]+)>)|nbsp;|\s{2,}|/ig, "");
            },
			isotop_loop: function(){
				sv++;
				console.log(si+' = '+sv);
				if(si === sv){
					fireCallback(social_dataa);
				}
			},
			isotop_insert: function(rendered_html){
				jQuery('.social-feed-container_'+options.stream_id).isotope({transformsEnabled: false,isResizeBound: false,transitionDuration: 0}).isotope( 'insert',jQuery( rendered_html ) );
			}
        };

        function SocialFeedPost(social_network, data) {
            this.content = data;
            this.content.social_network = (social_network == 'vimeo') ? 'vimeo-square' : social_network;
            this.content.attachment = (this.content.attachment === undefined) ? '' : this.content.attachment;
            this.content.time_ago = data.dt_create.fromNow();
			var dp = this.content.dt_create.locale('en').format("YYYY-MM-DD, hh:mm:ss");
			var d = new Date(dp);
			this.content.dt_create = d.getTime();
            this.content.text = Utility.wrapLinks(Utility.shorten(data.message + ' ' + data.description), data.social_network);
            this.content.moderation_passed = (options.moderation) ? options.moderation(this.content) : true;
			this.content.effect = options.effect;
			this.content.grid_columns_count_for_desktop = options.grid_columns_count_for_desktop;
			this.content.grid_columns_count_for_tablet = options.grid_columns_count_for_tablet;
			this.content.grid_columns_count_for_mobile = options.grid_columns_count_for_mobile;
			this.content.popup = options.popup;
			this.content.popup_link = (social_network == 'youtube' || social_network == 'vimeo') ? data.popup_link : '';
			this.content.video_link = (social_network == 'youtube' || social_network == 'vimeo') ? data.video_link : '';
			

            Feed[social_network].posts.push(this);
        }
        SocialFeedPost.prototype = {
            render: function() {
                var rendered_html = Feed.template(this.content);
                var data = this.content;
                if ($(container).children('[social-feed-id=' + data.id + ']').length !== 0) {
                    return false;
                }

                if ($(container).children().length === 0) {
				   if($('.social-feed-container_'+options.stream_id).html() === ''){
					   social_dataa += rendered_html;
				   }else{
					   social_dataa += rendered_html;
					}
                } else {
                    var i = 0,
                        insert_index = -1;
                    $.each($(container).children(), function() {
                        if ($(this).attr('dt-create') < data.dt_create) {
                            insert_index = i;
                            return false;
                        }
                        i++;
                    });
					
					social_dataa += rendered_html;

                }
				
                if (options.media_min_width) {

					var query = '[social-feed-id=' + data.id + '] img.attachment';
					var image = $(query);

					// preload the image
					var height, width = '';
					var img = new Image();
					var imgSrc = image.attr("src");

					$(img).load(function () {
					    // garbage collect img
					    delete img;

					}).error(function () {
					    // image couldnt be loaded
					    image.hide();

					}).attr({ src: imgSrc });

				}
				
            }

        };

        var Feed = {
                template: false,
                init: function() {
                    Feed.getTemplate(function() {
                        social_networks.forEach(function(network) {
                            if (options[network]) {
                                options[network].accounts.forEach(function(account) {
									si++;
                                    Feed[network].getData(account);
                                });
                            }
                        });
						console.log(si);
                    });
                },
                getTemplate: function(callback) {
                    if (Feed.template){
                        return callback();
					}else {
                        if (options.template_html) {
                            Feed.template = doT.template(options.template_html);
                            return callback();
                        } else {
                            $.get(options.template, function(template_html) {
                                Feed.template = doT.template(template_html);
                                return callback();
                            });
                        }
                    }
                },
				twitter: {
                    posts: [],
                    loaded: false,
                    api: 'http://api.tweecool.com/',

                    getData: function(account) {
                        switch (account[0]) {
                            case '@':
								var userid = account.substr(1);
								$.ajax({
									url: svc_ajax_url.url,
									data : 'action=sssw_get_tweet&user_name='+userid+'&limit='+options.twitter.limit,
									dataType:"json",
									type: 'POST',
									success: function(response) {
										Feed.twitter.utility.getPosts(response,'');
									}
								});								
                                break;
                            case '#':
                                var hashtag = account.substr(1);
								if(typeof options.twitter.loadmore === 'undefined'){
									var main_lm = 'action=sssw_get_search_tweet&q='+hashtag+'&limit='+options.twitter.limit;
								}
								$.ajax({
									url: svc_ajax_url.url,
									data : main_lm,
									dataType:"json",
									type: 'POST',
									success: function(reply) {
										if (typeof reply['search_metadata'] === "undefined") {
											reply['search_metadata'] = "undefined";
											reply['search_metadata']['next_results'] = "undefined";
										}
										Feed.twitter.utility.getPosts(reply.statuses,'search');
									}
								});
                                break;
                            default:
                        }
                    },
                    utility: {
                        getPosts: function(json,searchh) {
                            if (json) {
								var tc = 0;
                                $.each(json, function() {
									tc++;							
                                    var element = this;
									if(searchh != 'search'){
										$('#social_load_more_btn_'+options.stream_id).attr('data-twitter',element['id']);
									}
                                    var post = new SocialFeedPost('twitter', Feed.twitter.utility.unifyPostData(element));
                                    post.render();
                                });
								
								if(json.length == tc){
									Utility.isotop_loop();	
								}
								
                            }
                        },
						unifyPostData: function(element) {
                            var post = {};
                            if (element.id) {
                                post.id = element.id;				
                                post.dt_create = moment(element.created_at, 'dd MMM DD HH:mm:ss ZZ YYYY', 'en');
                                post.author_link = 'http://twitter.com/' + element.user.screen_name;
                                if (location.protocol == 'https:'){
                                	post.author_picture = element.user.profile_image_url_https;
								}else{
									post.author_picture = element.user.profile_image_url;
								}
                                post.post_url = post.author_link + '/status/' + element.id_str;
                                post.author_name = element.user.name;
                                post.message = (element.full_text) ? element.full_text : element.text;
                                post.description = '';
                                post.link = 'http://twitter.com/' + element.user.screen_name + '/status/' + element.id_str;
								
								var video_url = '';
								//console.log(element);
								if (typeof element.retweeted_status !== "undefined" && typeof element.retweeted_status.extended_entities !== "undefined" && typeof element.retweeted_status.extended_entities.media !== "undefined") {
									var media_type = element.retweeted_status.extended_entities.media[0].type;
									if (typeof element.retweeted_status.extended_entities.media[0].video_info !== "undefined"){
										var each_video = element.retweeted_status.extended_entities.media[0].video_info.variants;
										//console.log(each_video);
										var bit_video = 0;
										$.each(each_video, function() {
											var vi = this;					  
											if (vi.content_type == "video/mp4" && bit_video < vi.bitrate){
												bit_video = vi.bitrate;
												video_url = vi.url;
											}
										});
									}
								}else if(typeof element.extended_entities !== "undefined" && typeof element.extended_entities.media !== "undefined"){
									var media_type = element.extended_entities.media[0].type;
									if (typeof element.extended_entities.media[0].video_info !== "undefined"){
										var each_video = element.extended_entities.media[0].video_info.variants;
										var bit_video = 0;
										$.each(each_video, function() {
											var vi = this;	
											if (vi.content_type == "video/mp4" && bit_video < vi.bitrate){
												bit_video = vi.bitrate;
												video_url = vi.url;
											}
										});
									}
								}else{
									var media_type = 'photo';
								}

                                if (options.show_media === true) {
									if (typeof element.retweeted_status !== "undefined" && typeof element.retweeted_status.entities.media !== "undefined") {
											if (location.protocol == 'https:'){
												var image_url = element.retweeted_status.entities.media[0].media_url_https;
											}else{
												var image_url = element.retweeted_status.entities.media[0].media_url;
											}
											if (image_url) {
												if(options.popup == 'p1'){
													if(media_type == 'video'){
														post.attachment = '<a href="'+image_url+'" class="svc_big_img svc_twit_video" data-mfp-src="'+svc_ajax_url.url+'?action=sssw_inline_twit_video_popup&video_url='+video_url+'"><img class="svc_attachment" src="' + image_url + '" /></a>';
													}else{
														post.attachment = '<a href="'+image_url+'" class="svc_big_img"><img class="svc_attachment" src="' + image_url + '" /></a>';
													}
												}
											}
                                    }
									
                                    if (typeof element.entities.media !== "undefined" && element.entities.media.length > 0) {
										if (location.protocol == 'https:'){
											var image_url = element.entities.media[0].media_url_https;
										}else{
											var image_url = element.entities.media[0].media_url;
										}
                                        if (image_url) {
											if(options.popup == 'p1'){
												if(media_type == 'video'){
													post.attachment = '<a href="'+image_url+'" class="svc_big_img svc_twit_video" data-mfp-src="'+svc_ajax_url.url+'?action=sssw_inline_twit_video_popup&video_url='+video_url+'"><img class="svc_attachment" src="' + image_url + '" /></a>';
												}else{
                                            		post.attachment = '<a href="'+image_url+'" class="svc_big_img"><img class="svc_attachment" src="' + image_url + '" /></a>';
												}
											}
                                        }
                                    }
                                }
                            }
							post.feed = "svc_twitter";
                            return post;
                        },
                    }

                },
                facebook: {
                    posts: [],
                    graph: 'https://graph.facebook.com/',
                    loaded: false,
                    getData: function(account) {
						var request_url, limit = 'limit=' + options.facebook.limit+'&fields=id,full_picture,created_time,from{id,name,picture},message,link,type,shares,object_id,attachments',
							query_extention = '&access_token=' + options.facebook.access_token + '&callback=?';
						if(typeof options.facebook.loadmore === 'undefined'){
							switch (account[0]) {
								case '@':
									var username = account.substr(1);
									$.ajax({
										url: svc_ajax_url.url,
										data : 'action=sssw_get_fb_post&username='+username+'&count='+options.facebook.limit+'&cache_time='+options.cache_time,
										dataType:"json",
										type: 'POST',
										success: function(response) {	
											Feed.facebook.utility.getPosts(response);
											//console.log(response);
										}
									});
									request_url = Feed.facebook.graph + 'v3.1/' + username + '/posts?' + limit + query_extention;
									console.log(request_url);
									break;
								case '#':
									var username = account.substr(1);
									request_url = Feed.facebook.graph + 'v3.1/' + username + '/feed?' + limit + query_extention;
									break;
								default:
									var username = account.substr(1);
									request_url = Feed.facebook.graph + 'v3.1/' + username + '/posts?' + limit + query_extention;
							}
						}
                    },
                    utility: {
                        prepareAttachment: function(element) {
							//console.log(element);
							var fb_type = element.type;
                            var image_url = element.full_picture;
                            if (element.full_picture) {
                                image_url = element.full_picture;//Feed.facebook.graph + element.object_id + '/picture/?type=normal';
                            }
							if(options.popup == 'p1'){
	                            return '<a href="'+image_url+'" class="svc_big_img"><img class="svc_attachment" src="' + image_url + '" /></a>';
							}
                        },
                        getExternalImageURL: function(image_url, parameter) {
                            image_url = decodeURIComponent(image_url).split(parameter + '=')[1];
                            if (image_url.indexOf('fbcdn-sphotos') === -1) {
                                return image_url.split('&')[0];
                            } else {
                                return image_url;
                            }

                        },
                        getPosts: function(json) {
							if (typeof json['paging'] === "undefined") {
								json['paging'] = "undefined";
								json['paging']['next'] = "undefined";
							}
                            if (json['data']){
								var c = 0;
                                json['data'].forEach(function(element) {
									c++;
                                    var post = new SocialFeedPost('facebook', Feed.facebook.utility.unifyPostData(element));
                                    post.render();
                                });
								if(json['data'].length == c){
									Utility.isotop_loop();	
								}
                            }
                        },
                        unifyPostData: function(element) {
							//console.log(element);
                            var post = {},
                                text = (element.message) ? element.message : '';

							if(text == '' || text == 'undefined' || typeof text == "undefined"){
								if(element.attachments.data[0].type == 'cover_photo'){
									text = 'cover photo';	
								}
							}
                            post.id = element.id;
                            post.dt_create = moment(element.created_time);
                            post.author_link = 'http://facebook.com/' + element.from.id;
							post.author_picture = element.from.picture.data.url;
                            post.author_name = element.from.name;
                            post.name = element.name || "";
                            post.message = (text) ? text : '';
                            post.description = (element.description) ? element.description : '';
                            post.link = (element.link) ? element.link : 'http://facebook.com/' + element.from.id;

                            if (options.show_media === true) {
                                if (element.full_picture) {
                                    var attachment = Feed.facebook.utility.prepareAttachment(element);
                                    if (attachment) {
                                        post.attachment = attachment;
                                    }
                                }
                            }
							post.feed = "svc_facebook";
                            return post;
                        }
                    }
                },
				instagram: {
                    posts: [],
                    api: 'https://api.instagram.com/v1/',
                    loaded: true,
                    getData: function(account) {
                        var url;
						if(typeof options.instagram.loadmore === 'undefined'){
                            if(options.instagram.instagram_access_token){
    							switch (account[0]) {
    								case '@@':
    									var username = account.substr(1);
                                        url = Feed.instagram.api + 'users/self/?access_token='+options.instagram.instagram_access_token;
    									Utility.request(url, Feed.instagram.utility.getUsers);
    									break;
    								case '#':
    									var hashtag = account.substr(1);
    									url = Feed.instagram.api + 'tags/' + hashtag + '/media/recent/?' + 'client_id=' + options.instagram.client_id + '&access_token='+options.instagram.instagram_access_token+'&' + 'count=' + options.instagram.limit + '&callback=?';
    									Utility.request(url, Feed.instagram.utility.getImages);
    									break;
									case '@':
										var id = account.substr(1);
										$.ajax({
											url: svc_ajax_url.url,
											data : 'action=sssw_get_insta_post&userid='+id+'&count='+options.instagram.limit+'&cache_time='+options.cache_time,
											dataType:"json",
											type: 'POST',
											success: function(response) {
												Feed.instagram.utility.getImages(response);
											}
										});
    								default:
    							}
                            }
						}
                    },
                    utility: {
                        getImages: function(json) {
							if (typeof json['pagination'] == "undefined") {
								json['pagination'] = 'undefined';
								json['pagination']['next_url'] = "undefined";
							}
                            if (json.data) {
								var ic = 0;
                                json.data.forEach(function(element) {
									ic++;
                                    var post = new SocialFeedPost('instagram', Feed.instagram.utility.unifyPostData(element));
                                    post.render();
                                });
								
								if(json.data.length == ic){
									Utility.isotop_loop();	
								}
                            }
                        },
                        getUsers: function(json) {
							if (typeof json['pagination'] === "undefined") {
								json['pagination'] = "undefined";
								json['pagination']['next_url'] = "undefined";
							}
							
                            if( ! jQuery.isArray(json.data)) json.data = [json.data]
                            json.data.forEach(function(user) {
                                var url = Feed.instagram.api + 'users/' + user.id + '/media/recent/?' + 'access_token='+options.instagram.instagram_access_token+'&' + 'count=' + options.instagram.limit + '&callback=?';
                                Utility.request(url, Feed.instagram.utility.getImages);
                            });
                        },
                        unifyPostData: function(element) {
                            var post = {};

                            post.id = element.id;
                            post.dt_create = moment(element.created_time * 1000);
                            post.author_link = 'http://instagram.com/' + element.user.username;
                            post.author_picture = element.user.profile_picture;
                            post.author_name = element.user.full_name;
                            post.message = (element.caption && element.caption) ? element.caption.text : '';
                            post.description = '';
                            post.link = element.link;
                            //console.log(element.images);
                            if (options.show_media) {
								if(options.popup == 'p1'){
                                	post.attachment = '<a href="'+element.images.standard_resolution.url+'" class="svc_big_img"><img class="svc_attachment" src="' + element.images.standard_resolution.url + '' + '" /></a>';
								}else{
									post.attachment = '<a href="'+element.images.standard_resolution.url+'" data-mfp-src="'+svc_ajax_url.url+'?action=svc_fb_you_vimeo_twit_insta_inline_social_popup&network=instagram&url='+element.link+'" class="svc_big_img"><img class="svc_attachment" src="' + element.images.standard_resolution.url + '' + '" /></a>';
								}
                            }
							post.feed = "svc_instagram";
                            return post;
                        }
                    }
                },
                youtube: {
                    posts: [],
                    graph: 'https://www.googleapis.com/youtube/v3/',
                    loaded: false,
                    getData: function(account) {
						var request_url = '';
                        if(typeof options.youtube.channel_id != 'undefined' && options.youtube.channel_id != ''){
                            //console.log('channel');
                            Feed.youtube.utility.getChannels_data(options.youtube.channel_id);
                        }else if(typeof options.youtube.loadmore === 'undefined'){
                            if(options.youtube.playlistid != '' && typeof options.youtube.playlistid != 'undefined'){
                                //console.log('playlist');
                                request_url = Feed.youtube.graph + 'playlistItems?part=snippet,contentDetails,id&playlistId='+options.youtube.playlistid+'&maxResults='+options.youtube.limit+'&key='+ options.youtube.access_token;
                                Utility.request(request_url, Feed.youtube.utility.getChannel_data_for_playlist);
                            }else{
								 request_url = Feed.youtube.graph + 'channels?part=id&forUsername='+account+'&key='+ options.youtube.access_token;
								 Utility.request(request_url, Feed.youtube.utility.getChannels);
                            }
						}
                    },
                    utility: {
                        prepareAttachment: function(element,videoId) {
							var video_url = 'https://www.youtube.com/watch?v='+videoId;
                            var image_url = element['medium']['url'];
                            if(options.popup == 'p1'){
                            	return '<a href="'+video_url+'" class="popup-youtube svc_video_play"><img class="svc_attachment" src="' + image_url + '" /></a>';
							}
							if(options.popup == 'p2'){
                            	return '<a href="'+video_url+'" data-mfp-src="'+svc_ajax_url.url+'?action=svc_fb_you_vimeo_twit_insta_inline_social_popup&network=youtube&videoId='+videoId+'" class="popup-youtube svc_video_play"><img class="svc_attachment" src="' + image_url + '" /></a>';
							}
                        },
                        getExternalImageURL: function(image_url, parameter) {
                            image_url = decodeURIComponent(image_url).split(parameter + '=')[1];
                            if (image_url.indexOf('fbcdn-sphotos') === -1) {
                                return image_url.split('&')[0];
                            } else {
                                return image_url;
                            }
                        },
                        getChannels_data: function(cid){
                            request_url = Feed.youtube.graph + 'channels?part=brandingSettings,snippet,statistics,contentDetails&id='+cid+'&key='+ options.youtube.access_token;
                            Utility.request(request_url, Feed.youtube.utility.getPlaylistid);
                        },
						getChannels: function(json){
							var cid = json['items'][0]['id'];
							request_url = Feed.youtube.graph + 'channels?part=brandingSettings,snippet,statistics,contentDetails&id='+cid+'&key='+ options.youtube.access_token;
							Utility.request(request_url, Feed.youtube.utility.getPlaylistid);
						},
						getPlaylistid: function(json){
							var author_logo = json['items'][0]['snippet']['thumbnails']['default']['url'];
							var playlistid = json['items'][0]['contentDetails']['relatedPlaylists']['uploads'];
							request_url = Feed.youtube.graph + 'playlistItems?part=snippet&playlistId='+playlistid+'&maxResults='+options.youtube.limit+'&key='+ options.youtube.access_token;
							$.ajax({
								url: request_url,
								dataType: 'jsonp',
								success: function(json){
									Feed.youtube.utility.getPosts(json,playlistid,author_logo);
								}
							});
						},
                        getChannel_data_for_playlist: function(json){
                            var cid = json['items'][0]['snippet']['channelId'];
                            request_url = Feed.youtube.graph + 'channels?part=brandingSettings,snippet,statistics,contentDetails&id='+cid+'&key='+options.youtube.access_token;
                            $.ajax({
                                url: request_url,
                                dataType: 'jsonp',
                                success: function(jsonn){
                                    var author_logo = jsonn['items'][0]['snippet']['thumbnails']['default']['url'];
                                    var playlistid = jsonn['items'][0]['contentDetails']['relatedPlaylists']['uploads'];
                                    Feed.youtube.utility.getPosts(json,playlistid,author_logo);
                                }
                            });
                        },
                        getPosts: function(json,playlistid,author_logo) {
                            if (json['items']){
								var yc = 0;
                                if(json['items'].length == 0){
                                    $('#svc_infinite').hide();
                                }
                                json['items'].forEach(function(element) {
									yc++;
                                    var post = new SocialFeedPost('youtube', Feed.youtube.utility.unifyPostData(element,author_logo));
                                    post.render();
                                });
								
								if(json['items'].length == yc){
									Utility.isotop_loop();	
								}
                            }
                        },
                        unifyPostData: function(element,author_logo) {
							var yid = element.id;
							element = element.snippet;
                            var post = {},
                                text = (element.description) ? element.description : element.description;
                            post.id = yid;
                            post.dt_create = moment(element.publishedAt,'YYYY-MM-DD hh:mm:ss');
                            post.author_link = 'http://www.youtube.com/user/'+element.channelTitle;
                            post.author_picture = author_logo;
                            post.author_name = element.channelTitle;
                            post.name = element.title || "";
                            post.message = (text) ? text : '';
                            post.description = '';//(element.caption) ? element.caption : '';
                            post.link = (element.resourceId) ? 'https://www.youtube.com/watch?v='+element.resourceId.videoId : 'http://www.youtube.com/user/'+element.channelTitle;
                            if (options.show_media === true) {
                                if (element.thumbnails) {
                                    var attachment = Feed.youtube.utility.prepareAttachment(element.thumbnails,element.resourceId.videoId);
                                    if (attachment) {
                                        post.attachment = attachment;
										post.popup_link = svc_ajax_url.url+'?action=svc_fb_you_vimeo_twit_insta_inline_social_popup&network=youtube&videoId='+element.resourceId.videoId;
										post.video_link = 'https://www.youtube.com/watch?v='+element.resourceId.videoId;
                                    }
                                }
                            }
							post.feed = "svc_youtube";
							
                            return post;
                        }
                    }
                },
				vimeo: {
                    posts: [],
					graph: 'https://api.vimeo.com',
                    loaded: false,
                    getData: function(account) {
						var request_url = '';
						if(typeof options.vimeo.loadmore === 'undefined'){
							request_url = Feed.vimeo.graph +'/users/'+ account +'/videos?per_page='+options.vimeo.limit+'&access_token='+options.vimeo.access_token;
							Utility.request_json(request_url, Feed.vimeo.utility.getPosts);
						}
                    },
                    utility: {
                        prepareAttachment: function(element,video_link,elementtt) {
							var video_id = video_link.split("/");
                            var image_url = element['sizes'][3]['link'];
							if(options.popup == 'p1'){
                            	return '<a href="'+video_link+'" class="popup-vimeo svc_video_play"><img class="svc_attachment" src="' + image_url + '" /></a>';
							}
                        },
                        getExternalImageURL: function(image_url, parameter) {
                            image_url = decodeURIComponent(image_url).split(parameter + '=')[1];
                            if (image_url.indexOf('fbcdn-sphotos') === -1) {
                                return image_url.split('&')[0];
                            } else {
                                return image_url;
                            }
                        },
                        getPosts: function(json) {
							
                            if (json['data']){
								var vc = 0;
                                json['data'].forEach(function(element) {
									vc++;
                                    var post = new SocialFeedPost('vimeo', Feed.vimeo.utility.unifyPostData(element));
                                    post.render();
                                });
								
								if(json['data'].length == vc){
									Utility.isotop_loop();	
								}
                            }
                        },
                        unifyPostData: function(element) {
							//console.log(element);
							var yid = element.duration;
							//element = element.snippet;
                            var post = {},
                                text = (element.description) ? element.description : element.description;
                            post.id = yid;
                            post.dt_create = moment(element.created_time,'YYYY-MM-DD hh:mm:ss');
                            post.author_link = element.user.link;
                            post.author_picture = element.user.pictures.sizes[1].link;
                            post.author_name = element.user.name;
                            post.name = element.name || "";
                            post.message = (text) ? text : '';
                            post.description = '';//(element.caption) ? element.caption : '';
                            post.link = element.link
                            if (options.show_media === true) {
                                if (element.pictures) {
                                    var attachment = Feed.vimeo.utility.prepareAttachment(element.pictures,element.link,element);
                                    if (attachment) {
                                        post.attachment = attachment;
										var video_idi = element.link.split("/");
										post.popup_link = svc_ajax_url.url+'?action=svc_fb_you_vimeo_twit_insta_inline_social_popup&network=vimeo&videoId='+video_idi[3]+'&userid='+options.vimeo.accounts[0]+'&from='+element.user.name+'&profileImg='+element.user.pictures.sizes[1].link;
										post.video_link = element.link;
                                    }
                                }
                            }
							post.feed = "svc_vimeo";
							
                            return post;
                        }
                    }
                },
                blogspot: {
                    loaded: true,
                    getData: function(account) {
                        var url;

                        switch (account[0]) {
                            case '@':
                                var username = account.substr(1);
                                url = 'http://' + username + '.blogspot.com/feeds/posts/default?alt=json-in-script&callback=?';
                                request(url, getPosts);
                                break;
                            default:
                        }
                    },
                    utility: {
                        getPosts: function(json) {
                            $.each(json.feed.entry, function() {
                                var post = {},
                                    element = this;
                                post.id = element.id['$t'].replace(/[^a-z0-9]/gi, '');
                                post.dt_create = moment((element.published['$t']));
                                post.author_link = element.author[0]['uri']['$t'];
                                post.author_picture = 'http:' + element.author[0]['gd$image']['src'];
                                post.author_name = element.author[0]['name']['$t'];
                                post.message = element.title['$t'] + '</br></br>' + stripHTML(element.content['$t']);
                                post.description = '';
                                post.link = element.link.pop().href;

                                if (options.show_media) {
                                    if (element['media$thumbnail']) {
                                        post.attachment = '<img class="svc_attachment" src="' + element['media$thumbnail']['url'] + '" />';
                                    }
                                }

                                post.render();

                            });
                        }
                    }
                }
            };
            // Initialization
        Feed.init();
        if (options.update_period) {
            setInterval(function() {
                return Feed.init();
            }, options.update_period);
        }
    };

})(jQuery);
