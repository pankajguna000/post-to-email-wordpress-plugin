<?php
/*
  Plugin Name: Post to Email
  Plugin URI: http://www.formget.com/mailget/
  Description: WP Post to Email plugin allows you to send emails to all your audiences whenever a new post is published. 
  Version: 1.0.0
  Author: MailGet
  Author URI: http://www.formget.com/mailget/
 */

global $wpdb;

function post_to_email_get_header($param = ""){

$temp_top = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml" style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0"><head><meta name="viewport" content="width=device-width" /><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><!--fgmgMediaReplacePlaceholder--><meta name="robots" content="noindex, nofollow" /><meta charset="UTF-8" /><title>Email Template</title></head><body align="center" style="-webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; background: #01191D; box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; height: 100%; line-height: 1.7; margin: 0; padding: 0; width: 100% !important" width="100%" height="100%" bgcolor="#01191D"><table align="center" class="body-wrap" style="background: #01191D; box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0; width: 100%; word-break: break-word" width="100%" bgcolor="#01191D"><tr style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0"><td align="center" style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0 auto; padding: 0; vertical-align: top" valign="top">
<table style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0"><tr style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0"><td class="container" width="600" style="box-sizing: border-box; clear: both !important; display: block !important; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0 auto; max-width: 600px !important; padding: 0; vertical-align: top" valign="top"><div class="content" style="box-sizing: border-box; display: block; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0 auto; max-width: 600px; padding: 20px"><table class="main" width="100%" cellpadding="0" cellspacing="0" style="background: #FFFFFF; box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0" bgcolor="#FFFFFF">';
$img_src = "";
if(isset($param) && $param == "default"){ 
	  $img_src = esc_url(plugins_url('image/', __FILE__)."default-header.jpg");
	  $css = "";
  } 
else{
$data = get_option("post_to_email_sub_options");
 
 if(isset($data["post_email_head_img"]) && $data["post_email_head_img"] != ""){
	  $img_src = esc_url($data["post_email_head_img"]);
	  $css = "";
  }
  else{
	  $css = "display:none;";
  }
}
$temp_head =  '<tr style="box-sizing: border-box; font-family: Helvetica Neue,Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0"><td class="aligncenter" style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0 auto; padding: 0; text-align: center; vertical-align: top" align="center" valign="top"><div align="center" style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0"><img width="560" src="'.$img_src.'" style="box-sizing: border-box; display: block; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; max-width: 100%; padding: 0; '.$css.'" /></div></td></tr>';
return $temp_top. $temp_head;
}



function post_to_email_get_footer(){
$temp_footer = 	' <div class="footer ta-center" style="box-sizing: border-box; clear: both; color: #999; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 20px 0; width: 100%"><table width="100%" style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0"> <tr style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0"><td class="aligncenter footer-td" style="box-sizing: border-box; color: #FFFFFF; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0 auto; padding: 0 20px; text-align: center; vertical-align: top" align="center" valign="top"><p class="unsubscribe" style="box-sizing: border-box; color: #FFFFFF; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: normal; line-height: 1.7; margin: 0; padding: 0"><a href="#" class="unsubscribelink" style="box-sizing: border-box; color: #FFFFFF; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; font-size: 12px; margin: 0; padding: 0; text-decoration: underline"></a></p><p class="powered" style="box-sizing: border-box; color: #FFFFFF; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: bold; line-height: 1.7; margin: 0; padding: 0; text-transform: uppercase"> Email via <a href="http://www.formget.com/mailget/" style="box-sizing: border-box; color: #FDBE37; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: bold; margin: 0; padding: 0; text-decoration: none; text-transform: uppercase">MailGet</a></p></td></tr></table></div>';		 
 
$temp_bottom = '</div></td></tr></table></td></tr></table></body></html>'; 
return $temp_footer. $temp_bottom;
}

function post_to_email_ajax() {
	add_action('wp_ajax_post_email_save_design', 'post_email_save_design');
	add_action('wp_ajax_post_to_email_upload','post_to_email_upload');
	add_action('wp_ajax_post_to_email_save_user_type','post_to_email_save_user_type');
	add_action('wp_ajax_post_to_email_import','post_to_email_import');
	add_action('wp_ajax_post_email_temp_preview','post_email_temp_preview');
	add_action('wp_ajax_post_email_default_preview','post_email_default_preview');
	}

add_action('admin_init', 'post_to_email_ajax');


function html_content_type(){
	return "text/html";
}		



function post_to_email_post_content($post_arr, $type){
	global $wpdb;
	
	if(isset($type) && $type == "mail"){	
	if(count($post_arr)> 1){
		$inClause = '"' . implode('","', $post_arr) . '"';
	$post_data = $wpdb->get_results("SELECT ID, post_title, post_excerpt FROM $wpdb->posts WHERE (post_type = 'post' AND post_status = 'publish' AND ID in ($inClause))");
	}else{
	$pid = $post_arr;
	$post_data = $wpdb->get_results("SELECT ID, post_title, post_excerpt FROM $wpdb->posts WHERE (post_type = 'post' AND post_status = 'publish' AND ID = $pid)");
	}
	// $inClause = '"' . implode('","', $post_arr) . '"';
	// $post_data = $wpdb->get_results("SELECT ID, post_title, post_excerpt FROM $wpdb->posts WHERE (post_type = 'post' AND post_status = 'publish' AND ID in ($inClause))");
	$post_cont = "";
	 if(isset($post_data) && !empty($post_data)){
				foreach($post_data as $data){
					$link = get_permalink($data->ID);
					$post_cont .= '<tr style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0" id="post_data" class="post_content"><td class="content-wrap" style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0 auto; padding: 0 20px 20px; vertical-align: top" valign="top"><table width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0"><tr style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0"><td class="content-block" style="box-sizing: border-box; color: #545454; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 16px; line-height: 1.7; margin: 0 auto; padding: 20px 0; vertical-align: top" valign="top"><h2 style="box-sizing: border-box; color: rgb(63, 63, 63); font-family: Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif; font-size: 24px; font-weight: bold; line-height: 1.7; margin: 0; padding: 0">'. esc_attr($data->post_title) .'</h2><div id="post_con">'. esc_attr($data->post_excerpt) .'</div></td></tr><tr style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0"><td class="content-block alignleft" style="box-sizing: border-box; color: #545454; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 16px; line-height: 1.7; margin: 0 auto; padding: 20px 0; text-align: left; vertical-align: top" align="left" valign="top"><a href="'. esc_url($link) .'" target="_blank" class="btn-primary btn-inline" style="background: #62A30C; border-radius: 5px; box-sizing: border-box; color: #FFFFFF; cursor: pointer; display: inline-block; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; font-weight: bold; line-height: 2; margin: 0; padding: 10px 35px; text-align: center; text-decoration: none">Read More</a></td></tr></table></td></tr>';
				}
				return $post_cont;
	}}
	elseif(isset($type) && $type == "prev"){
		$post_data = $wpdb->get_results("SELECT ID, post_title, post_excerpt FROM $wpdb->posts WHERE (post_type = 'post' AND post_status = 'publish') order by ID DESC limit 1");
	    $post_cont = "";
	    if(isset($post_data) && !empty($post_data)){
				foreach($post_data as $data){
					$link = get_permalink($data->ID);
					$post_cont .= '<tr style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0" id="post_data" class="post_content"><td class="content-wrap" style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0 auto; padding: 0 20px 20px; vertical-align: top" valign="top"><table width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0"><tr style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0"><td class="content-block" style="box-sizing: border-box; color: #545454; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 16px; line-height: 1.7; margin: 0 auto; padding: 20px 0; vertical-align: top" valign="top"><h2 style="box-sizing: border-box; color: rgb(63, 63, 63); font-family: Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif; font-size: 24px; font-weight: bold; line-height: 1.7; margin: 0; padding: 0">'. esc_attr($data->post_title) .'</h2><div id="post_con">'. esc_attr($data->post_excerpt) .'</div></td></tr><tr style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0"><td class="content-block alignleft" style="box-sizing: border-box; color: #545454; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 16px; line-height: 1.7; margin: 0 auto; padding: 20px 0; text-align: left; vertical-align: top" align="left" valign="top"><a href="'. esc_url($link) .'" target="_blank" class="btn-primary btn-inline" style="background: #62A30C; border-radius: 5px; box-sizing: border-box; color: #FFFFFF; cursor: pointer; display: inline-block; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; font-weight: bold; line-height: 2; margin: 0; padding: 10px 35px; text-align: center; text-decoration: none">Read More</a></td></tr></table></td></tr>';
				}
				return $post_cont;
	}
	
	else{
		$post_cont .= '<tr style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, 
		Helvetica, Arial, sans-serif; margin: 0; padding: 0" id="post_data" class="post_content">
		<td class="content-wrap" style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica,
		Helvetica, Arial, sans-serif; margin: 0 auto; padding: 0 20px 20px; vertical-align: top" 
		valign="top"><table width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; 
		font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0">
		<tr style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, 
		sans-serif; margin: 0; padding: 0"><td class="content-block" style="box-sizing: border-box; 
		color: #545454; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 16px; 
		line-height: 1.7; margin: 0 auto; padding: 20px 0; vertical-align: top" valign="top">
		<h2 style="box-sizing: border-box; color: rgb(63, 63, 63); font-family: Helvetica Neue, 
		Helvetica, Arial, Lucida Grande, sans-serif; font-size: 24px; font-weight: bold; 
		line-height: 1.7; margin: 0; padding: 0">Sample Post</h2><div id="post_con">Sample Post exert would be displayed over here in the actual email template.</div></td></tr><tr style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0"><td class="content-block alignleft" style="box-sizing: border-box; color: #545454; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 16px; line-height: 1.7; margin: 0 auto; padding: 20px 0; text-align: left; vertical-align: top" align="left" valign="top"><a href="#" target="_blank" class="btn-primary btn-inline" style="background: #62A30C; border-radius: 5px; box-sizing: border-box; color: #FFFFFF; cursor: pointer; display: inline-block; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; font-weight: bold; line-height: 2; margin: 0; padding: 10px 35px; text-align: center; text-decoration: none">Read More</a></td></tr></table></td></tr>';

		return $post_cont;
	}
	}
	elseif(isset($type) && $type == "default"){
		$post_cont .= '<tr style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0" id="post_data" class="post_content"><td class="content-wrap" style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0 auto; padding: 0 20px 20px; vertical-align: top" valign="top"><table width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0"><tr style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0"><td class="content-block" style="box-sizing: border-box; color: #545454; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 16px; line-height: 1.7; margin: 0 auto; padding: 20px 0; vertical-align: top" valign="top"><h2 style="box-sizing: border-box; color: rgb(63, 63, 63); font-family: Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif; font-size: 24px; font-weight: bold; line-height: 1.7; margin: 0; padding: 0">POST TITLE</h2><div id="post_con">Here we will display <b>POST EXCERPT</b> and it <b>Read More </b>button contain link to the post url and on click redirect to that particular post.</div></td></tr><tr style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0"><td class="content-block alignleft" style="box-sizing: border-box; color: #545454; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 16px; line-height: 1.7; margin: 0 auto; padding: 20px 0; text-align: left; vertical-align: top" align="left" valign="top"><a href="http://www.formget.com/mailget" target="_blank" class="btn-primary btn-inline" style="background: #62A30C; border-radius: 5px; box-sizing: border-box; color: #FFFFFF; cursor: pointer; display: inline-block; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; font-weight: bold; line-height: 2; margin: 0; padding: 10px 35px; text-align: center; text-decoration: none">Read More</a></td></tr></table></td></tr>';
		return $post_cont;
	}
	else{		
		$post_cont .= '<tr style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, 
		Helvetica, Arial, sans-serif; margin: 0; padding: 0" id="post_data" class="post_content">
		<td class="content-wrap" style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica,
		Helvetica, Arial, sans-serif; margin: 0 auto; padding: 0 20px 20px; vertical-align: top" 
		valign="top"><table width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; 
		font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0">
		<tr style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, 
		sans-serif; margin: 0; padding: 0"><td class="content-block" style="box-sizing: border-box; 
		color: #545454; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 16px; 
		line-height: 1.7; margin: 0 auto; padding: 20px 0; vertical-align: top" valign="top">
		<h2 style="box-sizing: border-box; color: rgb(63, 63, 63); font-family: Helvetica Neue, 
		Helvetica, Arial, Lucida Grande, sans-serif; font-size: 24px; font-weight: bold; 
		line-height: 1.7; margin: 0; padding: 0">Sample Post</h2><div id="post_con">Sample Post exert would be displayed over here in the actual email template.</div></td></tr><tr style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0"><td class="content-block alignleft" style="box-sizing: border-box; color: #545454; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 16px; line-height: 1.7; margin: 0 auto; padding: 20px 0; text-align: left; vertical-align: top" align="left" valign="top"><a href="#" target="_blank" class="btn-primary btn-inline" style="background: #62A30C; border-radius: 5px; box-sizing: border-box; color: #FFFFFF; cursor: pointer; display: inline-block; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; font-weight: bold; line-height: 2; margin: 0; padding: 10px 35px; text-align: center; text-decoration: none">Read More</a></td></tr></table></td></tr>';

		return $post_cont;
	}
			
}


function post_to_email_comp_content($para, $called=""){
	$comp_name = $comp_add = "";
	if(isset($called) && $called == "default"){
		$comp_name = "Company Name";
		$comp_add = "Company Address";
	}
	else{
	if(isset($para['post_comp_name']) && $para['post_comp_name'] != ""){
		$comp_name = $para['post_comp_name'];
	}
	if(isset($para['post_comp_add']) && $para['post_comp_add'] != ""){
		$comp_add = $para['post_comp_add'];
	}}
	
	$temp_comp = ' <tr style="box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; margin: 0; padding: 0"><td class="aligncenter mailer-info" style="background: #F5F5F5; border-top-color: #DBDADA; border-top-style: solid; border-top-width: 1px; box-sizing: border-box; color: #545454; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: normal; line-height: 1.7; margin: 0 auto; padding: 15px 20px 20px; text-align: center; vertical-align: top" align="center" bgcolor="#F5F5F5" valign="top"><h2 class="wysiwyg-text-align-center" id="comp_name" style="box-sizing: border-box; color: rgb(84, 84, 84); font-family: Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif; font-size: 18px; font-weight: bold; line-height: 1.7; margin: 0; padding: 0; text-align: center !important" align="center">'.esc_attr($comp_name).'</h2><div class="wysiwyg-text-align-center" id= "comp_address" style="box-sizing: border-box; color: #545454; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: normal; line-height: 1.7; margin: 0; padding: 0; text-align: center !important" align="center">'.esc_attr($comp_add).'</div></td></tr></table>';
	return $temp_comp;
}

function post_email_run_on_publish_only( $new_status, $old_status, $post ) {
	$types = array('post');
	$types = apply_filters('types', $types);
    $after_post  = get_option('post_to_email_sub_options');
	
	if(isset($after_post) && !empty($after_post['post_cnt'])){
    if ( ( 'publish' === $new_status && 'publish' !== $old_status ) && in_array($post->post_type, $types)) {
         $post_cnt = $after_post["post_cnt"];
       	$options = get_option('post_to_email_post_detail');
		if (isset($options["post_id"])) {
            $post_id_arr = $options["post_id"];
    
		$post_id_arr[] =  filter_var( $post->ID, FILTER_SANITIZE_NUMBER_INT );
		$options["post_id"] = $post_id_arr;
		update_option('post_to_email_post_detail', $options);
		}
		else{
		$pid = filter_var( $post->ID, FILTER_SANITIZE_NUMBER_INT );
		update_option('post_to_email_post_detail', array("post_id"=>$pid));	
		}
		$new_options = get_option('post_to_email_post_detail');

		if(isset($new_options["post_id"]) && isset($post_cnt) && count($new_options["post_id"]) == $post_cnt + 1){
			$temp_cont = post_to_email_post_content($new_options["post_id"],"mail");
			$temp_comp =  post_to_email_comp_content($after_post);
			//$template = post_to_email_get_temp_full_design();
			$footer = post_to_email_get_footer();
			$header = post_to_email_get_header();
			$template = $header. $temp_cont. $temp_comp. $footer;		
		  	$user_roles = get_option('post_email_user_type');
			
			if(isset($user_roles) && !empty($user_roles)){
				$email_list = post_email_get_users_list($user_roles);
			}else{
				$user_roles = array("Admin","Author","Contributor","Subscriber","Editor");
				$email_list = post_email_get_users_list($user_roles);
			}
             $headers = array('Content-Type: text/html; charset=UTF-8');
			 add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
	         if(isset($after_post['post_email_subject']) && $after_post['post_email_subject'] != ""){
			 $subject = $after_post['post_email_subject'];
			 }
			 else{
				 $subject = "New post published notification";
			 }
			foreach($email_list as $email){
				wp_mail($email, $subject, $template,$headers);
			}	
		 delete_option('post_to_email_post_detail');
		
		}
		else{
			$pid = filter_var( $post->ID, FILTER_SANITIZE_NUMBER_INT );
		    $new_options["post_id"] = array($pid);
		    update_option('post_to_email_post_detail', $new_options);
		}
		
       }
	}
	   }
	   

add_action( 'transition_post_status', 'post_email_run_on_publish_only', 10, 3 );
	
	function post_email_get_users_list( $roles ) {
		global $wpdb;
		$emails = array();

		if ( is_array( $roles ) && ! empty( $roles ) ) {
			// Get emails by user role.
			foreach ( $roles as $role ) {
				// Get the emails.
				$user = new WP_User_Query(
					array(
						'role'   => $role,
						'fields' => array( 'user_email' )
					)
				);
				$user_results = $user->get_results();
               	// Add the emails in $mails variable.
				if ( ! empty( $user_results ) ) {
					foreach ( $user_results as $email ) {
						$emails[] = $email->user_email;
					}
				}
			}
			
			if(in_array("Custom", $roles)){
				 $sub_data = $wpdb->get_results("SELECT email FROM ". $wpdb->prefix ."post_email_subscriber"); 
                 if(isset($sub_data) && !empty($sub_data)){
					 foreach($sub_data as $val){
						 $emails[] = $val->email;	
        			 }
				 }
			}
		}

		// Merge all emails list.
		$emails = array_unique( $emails );
       	return $emails;
	}
	register_activation_hook(__FILE__, 'post_to_email_add_activate_entry');
	
	function post_to_email_add_activate_entry(){
		global $wpdb;
		$table_prefix=$wpdb->prefix;
        define('TBL_PREFIX', $table_prefix);
		$table = TBL_PREFIX ."post_email_subscriber";
        $tbl_structure =  "CREATE TABLE $table (
					   sub_id INT PRIMARY KEY AUTO_INCREMENT, 
					   name varchar(255) NOT NULL, 
					   email varchar(255) NOT NULL
					   );";
					    $wpdb->query($tbl_structure); 
		}
   
/**
  * css loaded for dashboard page
  */

if (is_admin() && isset($_GET['page']) && ($_GET['page'] == 'post_to_email')) {

    function formget_mailget_add_style() {
		 wp_enqueue_style('mg_admin_stylesheet', plugins_url('css/post_email_style.css', __FILE__));
    }

    add_action("admin_head", "formget_mailget_add_style");

    function formget_mailget_wordpress_style() {
        wp_enqueue_style('stylesheet_menu', admin_url('load-styles.php?c=1&amp;dir=ltr&amp;load=admin-bar,wp-admin,buttons,wp-auth-check&amp'));
        wp_enqueue_style('style_menu', admin_url('css/colors-fresh.min.css'));
    }

    //add_action('admin_head', 'formget_mailget_wordpress_style');
	
	function post_to_email_embeded_script() {
    wp_enqueue_script('post_email_script', plugins_url('js/post_email_script.js', __FILE__), array('jquery'));
    wp_localize_script('post_email_script', 'post_email_option', array('ajaxurl' => admin_url('admin-ajax.php'), 'post_email_option_nonce' => wp_create_nonce('post_email_option_nonce')));
	}
	
    add_action('init', 'post_to_email_embeded_script');
}



/**
  * menu & submenu function called
  */

add_action('admin_menu', 'post_to_email_menu_page');

function post_to_email_menu_page() {
    add_menu_page('pte', 'Post To Email', 'manage_options', 'post_to_email', 'post_to_email_setting_page', plugins_url('image/post_email_favicon.png', __FILE__));
}

 function post_to_email_setting_page() {
	   ?>
        <div class="mg-main-container123">
            <div id="mg_header78">
                <div class="mg-logo444">
                    <h2>Auto Send Posts to Subsribers via Email</h2>
                </div>
                <div class="clear"></div>
            </div>
            <div class="mg-nav wrap" >
                <h2 class="nav-tab-wrapper">
                    <span id="post_design_tab" class="nav-tab nav-tab-active ">Design Template</span>
					<span id="post_subscribe_tab" class="nav-tab">Subscriber</span>
                </h2>
            </div>
            <div class="mg-content">
                <div class="mg-group" id="post_design_panel">
                    <div class="mg-section section-text">
                        <h3 class="mg-heading">Setting to select the number of post after which mail send to subscriber regarding new blog post and design template.<div id="post_default_temp" onclick="post_default_prev();">Default Template</div></h3>
                    </div>
				    <div id="mg_msg_popup_option" class="mg-msg-popup-box" style="display: none;">Option Saved</div>
                    <div id = "mg_content_box">
                    <p class="mg-box-text">Add Header Image</p>
				<div class="mg-section section-text mg-form-text" style="height: 45px;margin-bottom: 0; width:350px;">
<div class="fg-upload-parent">
                                            <input id="logo_upload" type="file" class="file1" name="logo_upload" style="visibility:hidden; height:0px !important;" onchange="document.getElementById('pfile_pic_text').value = this.value;">	
                                            <input class="fg-input text inline_path" id="pfile_pic_text" placeholder="Header image for Template" type="text" disabled="">
                                            <span class="fg-upload-btn" onclick="document.getElementById('logo_upload').click();"><i class="icon-folder"></i>Choose File</span>
                                            <div class="fg-clear"></div>
								    		 <div id="post_email_head_img_err" class="post-email-form-help-box" style="display: none;"> </div>
											 
                                        </div>                       

				
                    </div>
					 <p class="mg-box-text"><b>Enter Company Name</b></p>
					<div class="mg-form-text">
                            <input class="mg-box-input" type="text" name="post_email_comp_name" id="post_email_comp_name" value="<?php echo esc_html(post_email_get_sub_option('post_to_email_sub_options','post_comp_name','save'));?>" placeholder="Company Name">
							<p class="post_help_txt">Appear in the footer of template as shown in default</p>
                           <div id="post_email_comp_name_err" class="post-email-form-help-box" style="display: none;">Enter Company Name  </div>
                        </div>
					 <p class="mg-box-text"><b>Enter Company Address</b></p>
					<div class="mg-form-text">
                            <input class="mg-box-input" type="text" name="post_email_comp_add" id="post_email_comp_add" value="<?php echo esc_html(post_email_get_sub_option('post_to_email_sub_options','post_comp_add','save'));?>" placeholder="Company Address">
							<p class="post_help_txt">Appear in the footer of template as shown in default</p>
                           <div id="post_email_comp_add_err" class="post-email-form-help-box" style="display: none;">Enter Company Address  </div>
                        </div>
						 <p class="mg-box-text"><b>Enter Email Subject</b></p>
					<div class="mg-form-text">
                            <input class="mg-box-input" type="text" name="post_email_subject" id="post_email_subject" value="<?php echo esc_html(post_email_get_sub_option('post_to_email_sub_options','post_email_subject','save'));?>" placeholder="Enter email subject">
							<p class="post_help_txt">Email Subject used with sending template</p>
                           <div id="post_email_subject_err" class="post-email-form-help-box" style="display: none;">Please enter email subject</div>
                        </div>
                        <p class="mg-box-text"><b>Send Email after number of Post</b></p>
                        <div class="mg-form-text">
                            <input class = "mg-box-input" type = "text" name = "post_email_post_cnt" id = "post_email_post_cnt" value = "<?php echo esc_html(post_email_get_sub_option('post_to_email_sub_options','post_cnt','save'));?>" placeholder = "Enter post count after which email send" />
							<p class="post_help_txt">Mail send to subscriber after above number of post count</p>
                           <div id="post_email_post_cnt_err" class="post-email-form-help-box" style="display: none;">Please enter valid number of post</div>
                        </div>
                       
                                      
                    </div>
                    <div class="mg-section section-text" style="height: 45px;margin-bottom: 0;">
					<?php 
					$post_counter = post_email_get_sub_option('post_to_email_sub_options','post_cnt','save'); 
					if(isset($post_counter) && $post_counter!="") {
						?>
                        <input type = "button" id="submit_mg_preview" class = "button-primary mg-submit-btn" name = "submit_mg_setting" value = "Preview" style="display:block" onclick="post_temp_prev();">
						<?php 
					}else{
						?>
                        <input type = "button" id="submit_mg_preview" class = "button-primary mg-submit-btn" name = "submit_mg_setting" value = "Preview" style="display:none" onclick="post_temp_prev();">
						<?php 
					}
					?>
						  <input type = "button" id="submit_mg_setting" class = "button-primary mg-submit-btn" name = "submit_mg_setting" value = "Save Option">
                    </div>
                </div>
                  <div class="mg-group" id="post_subscribe_panel">
                    <div class="mg-section section-text">
                        <h3 class="mg-heading">Setting for Subcribers</h3>
                    </div>
                    <div id="mg_msg_popup_option_2" class="mg-msg-popup-box" style="display: none;">Option Saved</div>
                    <div id = "mg_content_box">
                      
                        <p class = "mg-box-text">Send Email to:</p>
                        <div class="mg-form-text">
                         <ul class="element">
						 <?php 
						 $post_user_arr = post_email_get_sub_option('post_email_user_type','');
						 if(isset($post_user_arr) && empty($post_user_arr)){
							 $post_user_arr = array();
						 }
						 ?>
<li>
<input type="checkbox"  name = "post_email_chk_box" value = "admin" <?php echo (!in_array("admin",$post_user_arr)) ? '' : 'checked'; ?>/>
<label class="checkbox_label" >Administrator</label>
</li>
 <li>
<input type="checkbox"  name = "post_email_chk_box" value = "Contributor" <?php echo(!in_array("Contributor",$post_user_arr)) ? '' : 'checked'; ?>/>
<label class="checkbox_label">Contributor</label>
</li>
<li>
<input type="checkbox"  name = "post_email_chk_box" value = "Editor" <?php echo (!in_array("Editor",$post_user_arr)) ? '' : 'checked'; ?>/>
<label class="checkbox_label" >Editor</label>
</li>
<li>
<input type="checkbox"  name = "post_email_chk_box" value = "Author"  <?php echo (!in_array("Author",$post_user_arr)) ? '' : 'checked'; ?>/>
<label class="checkbox_label">Author</label>
</li>
<li>
<input type="checkbox"  name = "post_email_chk_box" value = "Subscriber" <?php echo (!in_array("Subscriber",$post_user_arr)) ? '' : 'checked'; ?>/>
<label class="checkbox_label" >Subscriber</label>
</li>
<li>
<?php if(!in_array("Custom",$post_user_arr)){ ?>  
<input type="checkbox"  name ="post_email_chk_box" id="checkbox_custom" value = "Custom"/>
<label class="checkbox_label">Custom </label>
<?php } 
else{
	global $wpdb;
	$sub_data = $wpdb->get_results("SELECT count('email') as cnt FROM ". $wpdb->prefix ."post_email_subscriber");
	if(isset($sub_data[0]->cnt) && $sub_data[0]->cnt != "")
    $total_count = $sub_data[0]->cnt;
else
	$total_count = 0;
?>
<input type="checkbox"  name ="post_email_chk_box" id="checkbox_custom" value = "Custom" checked />
<label class="checkbox_label">Custom (<b>count = <?php echo esc_attr($total_count); ?></b>)</label>
<?php } ?>
</li>
</ul>	

 <div id="post_email_user_role" class="post-email-form-help-box" style="display: none;">Please select user type to send mail</div>			 

       </div> 
<?php
if(!empty(post_email_get_sub_option( 'post_email_user_type','')) &&  in_array("Custom",post_email_get_sub_option('post_email_user_type',''))){
	$style = "display:block;";
}
else{
	$style = "display:none;";
}
 ?>	   
			<div id="import_div" style="<?php echo $style; ?>"><p class="mg-box-text">Import Contacts<a href="//www.formget.com/mailget/sample_file/SampleImport.csv" class="sample_csv">
(Download Sample CSV)</a></p>
<div class="mg-section section-text mg-form-text" style="height: 45px;margin-bottom: 0; width:375px;">
<div class="fg-upload-parent">
<input id="up_file" type="file" class="file1" name="up_file" style="visibility:hidden; height:0px !important;" onchange="document.getElementById('import_file_text').value = this.value;">	
<input class="fg-input text inline_path" id="import_file_text" placeholder="Import Contacts From (.csv) File" type="text" readonly="readonly">
<span class="fg-upload-btn" onclick="document.getElementById('up_file').click();"><i class="icon-folder"></i>Choose File</span>

<div class="fg-clear"></div>

<div id="post_email_import_csv" class="post-email-form-help-box" style="display: none;">Please upload csv file only</div>
</div>                       
</div>	
<p class="mg-box-text">Add contact in Textarea</p>
<div class="mg-form-text">
<textarea placeholder="Import email contacts directly by pasting here. Check sample format below. 
Paste names and emails separated by commas and individual contacts separated by semicolon. " 
cols="40" rows="5" id="import_emails_textarea"></textarea>
<div id="mg_form_description_help" class="mg-form-help-box" style="display: block;">	
<b style="color:black;">For Example</b>
<br>John Delavare, john.delavare@gmail.com;
<br>Mark Peters, mark@hotmail.com;
<br>jay.rony@gmail.com;
</div>
<div id="post_email_txt_import" class="post-email-form-help-box" style="display: none;"></div>
<p class="mg-box-text"></p>
<div class="mg-form-text">
<button class="button-primary mg-submit-btn" onclick="import_contacts()">Import Contacts</button>
</div> 
</div>		
</div>		                                                     
                    </div>
                    <div class="mg-section section-text" style="height: 45px;margin-bottom: 0;">
                        <input type = "button" id="submit_mg_options" class = "button-primary mg-submit-btn" name = "submit_mg_options" value = "Save Option">
                    </div>
                </div>
		    </div>
			
	
	<div id="send-confirm" class="post-email-preview fg-hidden">
        <div style="display: block;" class="post-email-inner-prev email-prev fg-hidden">
            <h3 class="ipu-heading">Email Template</h3>
            <div id="allWrapper">
                <div id="frameHolder">
                    <div class="tempPreview" id="tempPreview">
                    </div>
                    <button class="button-primary mg-submit-btn" onclick="close_temp_prev(this);">Cancel</button>
                    <span class="clearfix"></span>   
                </div>
            </div>  
        </div>
    </div>
        </div>
        <?php
    }
	
	
    /*
     * Function to get options data from datebase
     * @param : $name
     */

    function post_email_get_sub_option($option_name,$name,$param = "") {
        //$options = get_option('post_to_email_sub_options');
		$options = get_option($option_name);
		if($option_name != "post_email_user_type"){
		if (isset($name) && $name != "" && isset($options[$name])) {
            return $options[$name];
        }
		else{
			if(isset($param) && $param == "save")
		        return "";	
		    else
				 return array();	
		}}
		else{
			return $options;
		}
    }

	
      function post_email_sub_save_setting($name, $value){ 
	    $options = get_option('post_to_email_sub_options');
        $options[$name] = $value;
        update_option('post_to_email_sub_options', $options);
      }
	  
	  function post_email_save_design() {
		if (!check_ajax_referer('post_email_option_nonce', 'post_email_option_nonce') && !is_user_logged_in() && !current_user_can('manage_options')) {
		     return;
        }
		$comp_name = $comp_add = "";
		$cnt = $cnt1 = 0;
		$new_page_arr = array();
		$mg_old_val = get_option('post_to_email_sub_options');
		if (isset($_POST['post_comp_name']) && ($mg_old_val['post_comp_name'] != $_POST['post_comp_name'])) {
			post_email_sub_save_setting('post_comp_name', sanitize_text_field($_POST['post_comp_name']));
			$_POST['post_comp_name']= $comp_name;
        }
		if (isset($_POST['post_comp_add']) && ($mg_old_val['post_comp_add'] != $_POST['post_comp_add'])) {
			post_email_sub_save_setting('post_comp_add', sanitize_text_field($_POST['post_comp_add']));
			$_POST['post_comp_add']= $comp_add;
	    }
		if (isset($_POST['post_cnt']) && ($mg_old_val['post_cnt'] != $_POST['post_cnt']) && $_POST["post_cnt"] != "") {
			post_email_sub_save_setting('post_cnt', filter_var( $_POST['post_cnt'], FILTER_SANITIZE_NUMBER_INT ));
			$cnt++;
		}elseif(isset($_POST['post_cnt']) && $_POST["post_cnt"] != ""){
			$cnt++;
		}
		if (isset($_POST['post_email_subject']) && ($mg_old_val['post_email_subject'] != $_POST['post_email_subject']) && $_POST["post_email_subject"] != "") {
			post_email_sub_save_setting('post_email_subject', sanitize_text_field($_POST['post_email_subject']));
			$cnt1++;
			
        }elseif(isset($_POST['post_email_subject']) && $_POST["post_email_subject"] != ""){
			$cnt1++;
		}
		if($cnt1 == 0){
			echo "sub-empty";
		}
		elseif($cnt == 0){
			echo "empty";
		}
		else{
			echo "success";
		}
		die();
    }
	
	function post_to_email_upload(){	
	if (!check_ajax_referer('post_email_option_nonce', 'post_email_option_nonce') && !is_user_logged_in() && !current_user_can('manage_options')) {
				 return;
			}
	
	 if (isset($_POST['upload']) && $_POST['upload'] == 'upload') {
            if (isset($_FILES['logo_upload']['name']) && $_FILES['logo_upload']['name'] != '') {
                $remove_space = $_FILES['logo_upload']['name'];
			    $remove_space = preg_replace('/\s+/', '_', $remove_space);
			  //$extension = strtolower(pathinfo($_FILES['logo_upload']['name'], PATHINFO_EXTENSION));
				if (($_FILES['logo_upload']['type'] == "image/jpeg") || ($_FILES['logo_upload']['type'] == "image/png") || ($_FILES['logo_upload']['type'] == "image/jpg") || ($_FILES['logo_upload']['type'] == "image/gif") ) {
				$file_name = rand() ."-". $remove_space;
              //  $path_array  = wp_upload_dir();
				$path =  plugin_dir_path( __FILE__ )."image";
				$rel_path = plugins_url('image/', __FILE__);
		        //$path = str_replace('\\', '/', $path_array['path']);
        		move_uploaded_file($_FILES["logo_upload"]["tmp_name"],$path. "/" . $file_name);
				$url = $rel_path . $file_name;
				$url = filter_var($url, FILTER_SANITIZE_URL);
				post_email_sub_save_setting('post_email_head_img',$url);
      	     }
               else {
                    echo "incorrect_format";
			}}
			else{
				echo "please try again.";
			}
            }
	die();
		
	}
	
	function post_to_email_save_user_type(){
		 if (!check_ajax_referer('post_email_option_nonce', 'post_email_option_nonce') && !is_user_logged_in() && !current_user_can('manage_options')) {
				 return;
			}
			$update_arr = array();	
		 if (isset($_POST['selected_types']) && is_array($_POST['selected_types']) &&  !empty($_POST['selected_types'])) {
			foreach ( $_POST['selected_types'] as $val ) {
					 $update_arr[] = sanitize_text_field( $val );
					}
		    update_option("post_email_user_type", $update_arr);
		 }
	}
	
	function post_to_email_import(){
		 if (!check_ajax_referer('post_email_option_nonce', 'post_email_option_nonce') && !is_user_logged_in() && !current_user_can('manage_options')) {
				 return;
			}
	  global $wpdb;
	  $$txt_email = "no";
	            $contact_arr = $main_contact_arr1 = array();
                $main_contact_arr = array();
				$saved_arr = array();
                $mimes = array('application/vnd.ms-excel', 'text/csv');
             
                if (isset($_FILES['up_file']['tmp_name']) && ($_FILES['up_file']['size'] > 0)) {
                    $file = $_FILES['up_file']['tmp_name'];
                    $selected_delemeter = analyse_csv_file($file, 1);
                    ini_set("auto_detect_line_endings", "1");
                    $handle = fopen($file, "r");
                    $data = fgetcsv($handle, "", $selected_delemeter);
                    $data = array_map('trim', $data);
                    $data = array_map('strtolower', $data);
                    if (count($data) >= 1) {
                        if (in_array("name", $data) && in_array("email", $data)) {
                            $key_name = array_search('name', $data);
                            $key_name = intval($key_name);
                            $key_email = array_search('email', $data);
                            $key_email = intval($key_email);
						}else if (in_array("email", $data)) {
                            $key_name = 'no_name';
                            $key_email = array_search('email', $data);
                            $key_email = intval($key_email);
						} else {
							$key_name = 'no_name';
                            $key_email = 'no_email';
                         }
                    }
					  if ($key_email !== 'no_email') {
                         while ($data = fgetcsv($handle, "", $selected_delemeter)) {
                            if ($key_name !== 'no_name' && $key_email !== 'no_email' && isset($data[$key_name]) && isset($data[$key_email])) {
                                $name = trim($data[$key_name]);
                                $email = trim($data[$key_email]);
                            } else if ($key_email !== 'no_email' && isset($data[$key_email])) {
                                $name = '';
                                $email = trim($data[$key_email]);
                            }
                            if (filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
                                $contact_arr['name'] = htmlentities($name);
                                $contact_arr['email'] = $email;
                                $main_contact_arr = $contact_arr;
								$main_contact_arr1[$email] = $contact_arr;
								
                             }
                           
                        }
                    }
					else {
                       $csv = readCSV($file);
                       foreach ($csv as $single) {
                            for ($i = 0; $i < sizeof($single); $i++) {
                                if (filter_var(trim($single[$i]), FILTER_VALIDATE_EMAIL)) {
                                    $email = trim($single[$i]);
                                    $contact_arr['name'] = '';
                                    $contact_arr['email'] = $email;
                                    $main_contact_arr = $contact_arr;
									$main_contact_arr1[$email] = $contact_arr;
                       
                                }
                               
                            }
                        }
                    }
				}
                $import_emails_textarea = $_POST['import_emails_textarea'];
                if ($import_emails_textarea != '') {
                    $import_emails_textarea_arr = explode(';', $import_emails_textarea);
                    if (count($import_emails_textarea_arr) > 10000) {
                        $output = 'textarea_limit_over';
                        return;
                    }
                    if (!empty($import_emails_textarea_arr)) {
                          for ($i = 0; $i < sizeof($import_emails_textarea_arr); $i++) {
                            $email = 'no';
                            $name = '';
                            $email_data = explode(',', $import_emails_textarea_arr[$i]);
                            if (isset($email_data[0]) && filter_var(trim($email_data[0]), FILTER_VALIDATE_EMAIL)) {
                                $email = trim($email_data[0]);
                                $name = '';
                            } else if (isset($email_data[1]) && filter_var(trim($email_data[1]), FILTER_VALIDATE_EMAIL)) {
                                $name = trim($email_data[0]);
                                $email = trim($email_data[1]);
                            } else {
                                $email == "no";
                            }
                            if ($email != "no") {
                                $contact_arr['name'] = $name;
                                $contact_arr['email'] = $email;
                                $main_contact_arr = $contact_arr;
								$main_contact_arr1[$email] = $contact_arr;
								                             
                            }
							else{
								$txt_email = "no";
							}
                           
                        }
                    }
                }
				if (isset($main_contact_arr1) && !empty($main_contact_arr1)) {
					//echo "not empty";
                   $sub_data = $wpdb->get_results("SELECT name,email FROM ". $wpdb->prefix ."post_email_subscriber");  
				   if(isset($sub_data[0]->email) && $sub_data[0]->email != ""){
					   foreach($sub_data as $data){
						   $saved_arr[$data->email] = array("name"=>$data->name,"email"=>$data->email);
					   }
				   }
				  $email_list = array_diff_key($main_contact_arr1, $saved_arr);
				 
				
	
	foreach($email_list as $data){
		$name = sanitize_text_field($data["name"]);
		$email = sanitize_email($data["email"]);
        $wpdb->insert($wpdb->prefix ."post_email_subscriber", array("name"=>$data['name'],"email"=>$data['email']));
        }
               echo 'list_updated';
    }
		 if ($txt_email == "no") {
                    echo 'error';
               }
			die(); 
	}
	
	 function analyse_csv_file($file, $capture_limit_in_kb = 1) {
        // capture starting memory usage
        $output['peak_mem']['start'] = memory_get_peak_usage(true);
        // log the limit how much of the file was sampled (in Kb)
        $output['read_kb'] = $capture_limit_in_kb;
        // read in file
        $fh = fopen($file, 'r');
        $contents = fread($fh, ($capture_limit_in_kb * 1024)); // in KB
        fclose($fh);
        // specify allowed field delimiters
        $delimiters = array(
            'comma' => ',',
            'semicolon' => ';',
            'tab' => "\t",
            'pipe' => '|',
            'colon' => ':',
            'space' => ' '
        );
        // specify allowed line endings
        $line_endings = array(
            'rn' => "\r\n",
            'n' => "\n",
            'r' => "\r",
            'nr' => "\n\r"
        );
        // loop and count each line ending instance
        foreach ($line_endings as $key => $value) {
            $line_result[$key] = substr_count($contents, $value);
        }
        // sort by largest array value
        $line_result_demo = $line_result;
        asort($line_result);
        rsort($line_result_demo);
        //echo $line_result_demo[0];
        // log to output array
        $output['line_ending']['results'] = $line_result;
        $output['line_ending']['count'] = end($line_result);
        $output['line_ending']['key'] = key($line_result);
        $output['line_ending']['value'] = $line_endings[$output['line_ending']['key']];
        $lines = explode($output['line_ending']['value'], $contents);
        // remove last line of array, as this maybe incomplete?
        array_pop($lines);
        // create a string from the legal lines
        $complete_lines = implode(' ', $lines);
        // log statistics to output array
        $output['lines']['count'] = count($lines);
        $output['lines']['length'] = strlen($complete_lines);
        // loop and count each delimiter instance
        foreach ($delimiters as $delimiter_key => $delimiter) {
            $delimiter_result[$delimiter_key] = substr_count($complete_lines, $delimiter);
        }
        // sort by largest array value
        $delimiter_result_demo = $delimiter_result;
        asort($delimiter_result);
        rsort($delimiter_result_demo);
        //echo $delimiter_result_demo[1];
        // log statistics to output array with largest counts as the value
        $output['delimiter']['results'] = $delimiter_result;
        $output['delimiter']['count'] = end($delimiter_result);
        $output['delimiter']['key'] = key($delimiter_result);
        $output['delimiter']['value'] = $delimiters[$output['delimiter']['key']];
        // capture ending memory usage
        $output['peak_mem']['end'] = memory_get_peak_usage(true);
        //return $output;
        if (($line_result_demo[0] == $delimiter_result_demo[1]) || ($line_result_demo[0] * 2 == $delimiter_result_demo[1])) {
            foreach ($delimiter_result as $key => $value) {
                if ($value == $delimiter_result_demo[1]) {
                    $selected_delemeter_main = $delimiters[$key];
                }
            }
        } else {
            $selected_delemeter_main = $output['delimiter']['value'];
        }
        return $selected_delemeter_main;
    }
	
	
function post_email_temp_preview(){
	if (!check_ajax_referer('post_email_option_nonce', 'post_email_option_nonce') && !is_user_logged_in() && !current_user_can('manage_options')) {
		     return;
        }
	$after_post  = get_option('post_to_email_sub_options');
	$header = post_to_email_get_header();
	$footer = post_to_email_get_footer();
	$temp_cont = post_to_email_post_content("","prev");
			$temp_comp =  post_to_email_comp_content($after_post);
			$template = $header. $temp_cont. $temp_comp. $footer;		
	$temp = '<div style="background-color: rgb(1, 25, 29);" class="mg-body prev-mg-body" id="mg-body">
	'.$template.'
	</div>';

	echo $temp;
	die();
}

function post_email_default_preview(){
	if (!check_ajax_referer('post_email_option_nonce', 'post_email_option_nonce') && !is_user_logged_in() && !current_user_can('manage_options')) {
		     return;
        }
	$after_post  = get_option('post_to_email_sub_options');
	$header = post_to_email_get_header("default");
	$footer = post_to_email_get_footer();
	$temp_cont = post_to_email_post_content("","default");
	$temp_comp =  post_to_email_comp_content($after_post,"default");
	$template = $header. $temp_cont. $temp_comp. $footer;		
	$temp = '<div style="background-color: rgb(1, 25, 29);" class="mg-body prev-mg-body" id="mg-body">
	'.$template.'
	</div>';

	echo $temp;
	die();
}

  function readCSV($csvFile) {
        $file_handle = fopen($csvFile, 'r');
        while (!feof($file_handle)) {
            $line_of_text[] = fgetcsv($file_handle, 1024);
        }
        fclose($file_handle);
        return $line_of_text;
    }
	
    ?>