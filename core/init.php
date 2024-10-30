<?php
add_action( 'wp_ajax_bestsplash_updated', 'bestsplash_updated' );
add_action('wp_ajax_nopriv_bestsplash_updated', 'bestsplash_updated');
function bestsplash_updated() {
	global $wpdb;
	if (is_user_logged_in()) {
		if (sanitize_text_field( $_POST['activate']) == 'on') {
			$update['activate_Splash_button'] = 1;
		}else{
			$update['activate_Splash_button'] = 0;
		}
		if($update['activate_Splash_button'] == 1){
			$update['splashSelect'] = sanitize_text_field( $_POST['splashSelect']);
			if (!$update['splashSelect']) {
				$update['splashSelect'] = 1;
			}
			$serialized_data = serialize($update);
			$content_plugin = update_option('splash_plugin_content', $serialized_data);
			if ($content_plugin) {
				$array = array('status'=>true, 'html'=>'Updated Successfully!');
			}else{
				$array = array('status'=>false, 'html'=>'Not Updated!');
			}
		}else{
			delete_option('splash_plugin_content');
			$array = array('status'=>true, 'html'=>'Deactivated Successfully!');
		}
	}
	echo wp_send_json($array);
	wp_die();
}
?>