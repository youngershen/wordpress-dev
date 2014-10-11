<?php

require_once('class-wc-api-client.php');
error_reporting( E_ALL );
ini_set('display_errors', 'On');


class JSON_API_User_Controller{

    public function info(){
			//Consumer Key: ck_7cd37b68daf30f3e94eeb0f5ebb0b130
			//Consumer Secret: cs_225dbf2def691bcac8f8050b253bcf6e
        	global $json_api;
        	global $wpdb;
        	$consumer_key = 'ck_7cd37b68daf30f3e94eeb0f5ebb0b130';
        	$consumer_secret = 'cs_225dbf2def691bcac8f8050b253bcf6e';
            $store_url = 'http://127.0.0.1/spyapp/wordpress-dev/';
            $wc_api = new WC_API_Client($consumer_key, $consumer_secret, $store_url);
            //$orders = $wc_api->get_orders();
            //print_r( $orders );
            $user_id = $json_api->query->id;
        	$query = "select id, user_login, user_nicename, user_email,display_name from wp_users where id = " . $user_id; 
        	$ret = $wpdb->get_results( $query );
        	return array("info" =>  $wc_api->get_index());
    }

    public function order(){
        return array("test" => "test");
    }
}

?>
