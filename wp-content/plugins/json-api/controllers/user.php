<?php

require_once('class-wc-api-client.php');
error_reporting( E_ALL );
ini_set('display_errors', 'On');

class JSON_API_User_Controller{

    public function order(){
        global $json_api;
        //在这里设置你自己的key和secret
        $consumer_key = 'ck_c3fdb1b6522e0bd3dc86f0e70dc64db7';
        $consumer_secret = 'cs_dcbaf44473807b1d9b6c18512137e3fb';
        $store_url = 'http://127.0.0.1:8080/wordpress/';

        $wc_api = new WC_API_Client($consumer_key, $consumer_secret, $store_url);
        $user_id = $json_api->query->id;
        return array("test" => $wc_api->get_customer_orders($user_id));
    }
}

?>
