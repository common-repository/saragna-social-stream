(function($){
	"use strict";
	//on-off start
	$(".on_off label").click(function(){
		var id = $(this).attr('id');
		var data = $(this).attr('data');
		if(data == 'y'){
			$('.'+id).show();
		}
		if(data == 'n'){
			$('.'+id).hide();
		}
        $(this).parent('div').children('label').removeClass("on");
        $(this).addClass("on");
    });
	//on-off end

	$('.post-list-tabs-menu li').click(function(){
		var tab = $(this).attr('data-tab-index');
		$('.post-list-tabs-menu li').removeClass('spl_active');
		$(this).addClass('spl_active');
		$('.spl_tabs').hide();
		$('#'+tab).show();
	});
	
	$('#grid_query').click(function(){
		$('#grid_query_div').slideToggle();	
	});


	$('.my-color-field').wpColorPicker();
	$(".handlediv,.hndle").click(function(){
		$(this).next('h3').next('.inside').toggle();
		if($(this).parent('.postbox').hasClass('closed')){
			$(this).parent('.postbox').removeClass('closed');
		}else{
			$(this).parent('.postbox').addClass('closed');
		}
	});

	$('.social_timeline_delete_level').click(function(){
		var r = confirm("Confirm Delete this Post grid!");
		if (r == true) {
			var id = $(this).attr('id');
			$.ajax({
				type:'POST',
				url: svc_ajax_url.url,
				data: "action=social_timeline_grid_delete&id="+id,
				success: function(m){
					$('#field_id_'+id).slideUp().remove();
				}
			});
		}
	});

	function social_timeline_dependency_check(){
		$('[data-depen-set]').each(function(index, element) {
			var this_tr = $(this);
			var field_value = '';
			var data_attr = this_tr.attr('data-attr');
			var data_id = this_tr.attr('data-id');
			var data_value = this_tr.attr('data-value');
			var data_value1 = this_tr.attr('data-value1');
			var data_value2 = this_tr.attr('data-value2');
			
			if(data_attr == 'checkbox'){
				if ($('#'+data_id).is(":checked")){
					field_value = $('#'+data_id).val();
				}
				if(field_value == data_value){
					this_tr.removeClass('spost_hidden');	
				}else{
					this_tr.addClass('spost_hidden');	
				}
			}
			
			if(data_attr == 'select'){
				field_value = $('#'+data_id).val();
				if(field_value == data_value || field_value == data_value1 || field_value == data_value2){
					this_tr.removeClass('spost_hidden');	
				}else{
					this_tr.addClass('spost_hidden');
				}
			}
			
			if(data_attr == 'number'){
				field_value = $('#'+data_id).val();
				if(field_value == data_value){
					this_tr.removeClass('spost_hidden');	
				}else{
					this_tr.addClass('spost_hidden');	
				}
			}
		});
		
		setTimeout(function(){
			$('.spost_hidden').each(function(index, element) {
				var this_input = $(this);
				var closesr_id = this_input.children('td').children('input').attr('id');
				$('[data-id]').each(function(index, element) {
					var this_sss = $(this);
					if(this_sss.attr('data-id') == closesr_id){
						this_sss.addClass('spost_hidden');
					}
				});						
			});
		},800);
	}
	social_timeline_dependency_check();
	
	$('[data-check-depen]').not('select').click(function(){
		social_timeline_dependency_check();
	});
	$('[data-check-depen]').change(function(){
		social_timeline_dependency_check();
	});
})(jQuery);