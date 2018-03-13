jQuery(document).ready(function () {
    jQuery('.mg-group').hide();
    jQuery('#post_design_panel').css("display", "block");

    jQuery('#post_design_tab').click(function () {
        jQuery('.mg-group').hide();
        jQuery('.nav-tab').removeClass('nav-tab-active');
        jQuery(this).addClass('nav-tab-active');
        jQuery('#post_design_panel').css("display", "block");
    });

    jQuery('#post_subscribe_tab').click(function () {
        jQuery('.mg-group').hide();
        jQuery('.nav-tab').removeClass('nav-tab-active');
        jQuery(this).addClass('nav-tab-active');
        jQuery('#post_subscribe_panel').css("display", "block");
    });

     function post_error_popup(mg_id, mg_time) {
        var success = jQuery(mg_id);
        success.fadeIn().css('display','inline-table');
        window.setTimeout(function () {
            success.fadeOut();
        }, mg_time);
    }
   	
jQuery("#post_email_post_cnt").keyup(function() {
	var numericExpression = /^[0-9]+$/;
	var elem = jQuery("#post_email_post_cnt");
    if(jQuery.isNumeric(elem.val())){
		return true;
	}else{
		post_error_popup("#post_email_post_cnt_err",3000);
		return false;
	}
});

	jQuery('#checkbox_custom').change(function() {
   if(this.checked) {
	   jQuery("#import_div").slideDown(1000);
   }
   else{
	   jQuery("#import_div").slideUp(500);
   }
   });
    jQuery('#submit_mg_options').click(function () {

        var checkedValues = jQuery('input[name=post_email_chk_box]:checkbox:checked').map(function () {
            return this.value;
        }).get();
		
       console.log(checkedValues);
	   if(checkedValues.length != 0){
		 var data = {
            'action': 'post_to_email_save_user_type',
            'selected_types': checkedValues,
            'post_email_option_nonce': post_email_option.post_email_option_nonce
        };
	    // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        jQuery.post(ajaxurl, data, function (response) {
			console.log(response);
			var success = jQuery('#mg_msg_popup_option_2');
            var maskWidth = jQuery(window).width();
            var maskHeight = jQuery(window).height();
            var dialogLeft = (maskWidth / 2) - (success.width()) / 2;
            var dialogTop = (maskHeight / 2) - (success.width()) / 2;
            success.css({top: dialogTop, left: dialogLeft, position: 'fixed'});
            post_error_popup(success, 2000);
        });
	   }
	   else{
		  post_error_popup("#post_email_user_role", 2000); 
	   }
    });
	
    jQuery('#submit_mg_setting').click(function () {
 	 var data = {
            'action': 'post_email_save_design',
			'post_comp_name': jQuery('#post_email_comp_name').val(),
            'post_comp_add': jQuery('#post_email_comp_add').val(),
			'post_email_subject': jQuery('#post_email_subject').val(),
			'post_cnt': jQuery('#post_email_post_cnt').val(),
			'post_email_option_nonce': post_email_option.post_email_option_nonce
        };
	
        jQuery.post(ajaxurl, data, function (response) {
		
			if(response == "empty"){
			 post_error_popup("#post_email_post_cnt_err", 3000);	
			}
			else if(response == "sub-empty"){
		     post_error_popup("#post_email_subject_err", 3000);	
			}
			else{
			var success = jQuery('#mg_msg_popup_option');
            var maskWidth = jQuery(window).width();
            var maskHeight = jQuery(window).height();
            var dialogLeft = (maskWidth / 2) - (success.width()) / 2;
            var dialogTop = (maskHeight / 2) - (success.width()) / 2;
            success.css({top: dialogTop, left: dialogLeft, position: 'fixed'});
            post_error_popup(success, 2000);
			jQuery("#submit_mg_preview").css("display","block");
			}
        });
    });
	
	jQuery("#logo_upload").change(function() {
    var upload_file = this.files[0];
	var postfile = new FormData();	
	postfile.append('action', 'post_to_email_upload');
    postfile.append("logo_upload", upload_file);
	postfile.append('upload', 'upload');
    postfile.append('post_email_option_nonce', post_email_option.post_email_option_nonce);
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: postfile,
        processData: false,
        contentType: false,
        beforeSend: function() {
			          
        },
        complete: function(res) {
       if(jQuery.trim(res.responseText) == "incorrect_format"){
		  
	      jQuery("#post_email_head_img_err").text("Invalaid File Format.");
		  jQuery("#post_email_head_img_err").css({"color":"#da0000", "background-color":"#ffcfd1"});
		  post_error_popup("#post_email_head_img_err",3000);
       }else{
		  jQuery("#post_email_head_img_err").text("File Uploaded Successfully."); 
		  jQuery("#post_email_head_img_err").css({"color":"#268429", "background-color":"#dae8c8"});
		  post_error_popup("#post_email_head_img_err",3000);
	   }
        }
    });
	
});

});

	
var importExist = false;
function import_contacts() {
            if (importExist) {
                alert("Please Wait another list is importing.");
            } else {
                var uploadfile = document.getElementById('up_file');
                var import_emails_textarea = document.getElementById("import_emails_textarea").value;
                var upload_file = uploadfile.files[0];
				 if (upload_file != 'null' && upload_file != null && upload_file != '') {
					if (typeof upload_file !== "undefined") {
						var file_extention = (/[.]/.exec(upload_file.name)) ? /[^.]+$/.exec(upload_file.name) : 'undefined';
						} else {
						var file_extention = 'undefined';
                    }
                } else {
					  var file_extention = 'undefined';
                }
				
                if ((file_extention == 'csv') || (import_emails_textarea != '' && file_extention == 'undefined') || (import_emails_textarea != '' && file_extention == 'csv')) {
                    var postfile = new FormData();
                    postfile.append("up_file", upload_file);
                    postfile.append("import_emails_textarea", import_emails_textarea);
                    postfile.append('action', 'post_to_email_import');
                    postfile.append('post_email_option_nonce', post_email_option.post_email_option_nonce);
                    jQuery.ajax({
                        url:  ajaxurl,
                        type: "POST",
                        data: postfile,
                        processData: false,
                        contentType: false,
                        beforeSend: function() {
                            importExist = true;
                            //jQuery('#show_to_block .fg-full-overlay').fadeIn('slow');
                        },
                        xhr: function()
                        {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function(evt) {
                                if (evt.lengthComputable) {
                                    }
                            }, false);
                            return xhr;
                        },
                        complete: function(res) {
                            importExist = false;
                            console.log((res.responseText).trim());
                            if ((res.responseText).trim() == 'list_updated') {
								jQuery("#post_email_txt_import").text("List imported successfully");
								jQuery("#post_email_txt_import").css({"color":"#268429", "background-color":"#dae8c8"});
		              		    jQuery("#post_email_txt_import").fadeIn().css('display','inline-table');
								window.setTimeout(function () {
								jQuery("#post_email_txt_import").fadeOut();
								}, 2000);
                               
                            } else if ((res.responseText).trim() == 'error') {
								jQuery("#post_email_txt_import").text("Please enter valid format of contacts");
								jQuery("#post_email_txt_import").css({"color":"#da0000", "background-color":"#ffcfd1"});
								jQuery("#post_email_txt_import").fadeIn().css('display','inline-table');
								window.setTimeout(function () {
								jQuery("#post_email_txt_import").fadeOut();
								}, 2000);
                            } 
                           jQuery('#up_file').val('');
                           jQuery('#import_file_text').val('');
                           jQuery('#import_emails_textarea').val('');
                            }
                    });
                } else {
						jQuery("#post_email_import_csv").fadeIn().css('display','inline-table');
						window.setTimeout(function () {
						jQuery("#post_email_import_csv").fadeOut();
						}, 2000);
						jQuery('#up_file').val('');
					
	             }
            }
        }
		
		
	var post_temp_prev = function(elem) {
		var data = {
            'action': 'post_email_temp_preview',
			'id':'1',
            'post_email_option_nonce': post_email_option.post_email_option_nonce
        };
     jQuery.post(ajaxurl, data, function (response) {
	 jQuery("#tempPreview").html(response);

    jQuery("#tempPreview").find('.mg-body').addClass('prev-mg-body');
    jQuery("#tempPreview").find('.bottom-button').remove();
    jQuery('#send-confirm').fadeIn('slow', function() {
            jQuery('.post-email-inner-prev').slideDown('600', function() {
            });
        });
    
	    });
	};

	
	var post_default_prev = function(elem) {
		var data = {
            'action': 'post_email_default_preview',
		    'post_email_option_nonce': post_email_option.post_email_option_nonce
        };
     jQuery.post(ajaxurl, data, function (response) {
	 jQuery("#tempPreview").html(response);

    jQuery("#tempPreview").find('.mg-body').addClass('prev-mg-body');
    jQuery("#tempPreview").find('.bottom-button').remove();
    jQuery('#send-confirm').fadeIn('slow', function() {
            jQuery('.post-email-inner-prev').slideDown('600', function() {
            });
        });
    
	    });
	};

	var close_temp_prev = function(elem) {
    jQuery(elem).parents('.post-email-inner-prev').slideUp('600', function() {
        jQuery(this).parent().fadeOut('slow');
        jQuery("#tempPreview").html("");
        jQuery('#frameHolder').css('display', 'block');
        jQuery('#sendDetails').addClass('fg-hidden');
        jQuery('#allWrapper').css('height', 'auto');
    });
};
