<?php

require_once('class-wc-api-client.php');
error_reporting( E_ALL );
ini_set('display_errors', 'On');

class JSON_API_User_Controller{


    public function order(){
        global $json_api;
        //这里设置你的key和secret
        $consumer_key = "ck_0f62a2b9484d96a5b6b447763eac6acd";
        $consumer_secret = "cs_139b51d84006828f306273e54cfa3fec";
        //这里设置网站url
        $store_url = "http://127.0.0.1:8080/wordpress/";


        $wc_api = new WC_API_Client($consumer_key,$consumer_secret, $store_url);
        $user_id = $json_api->query->id;
        return array($wc_api->get_customer_orders($user_id));
    }
}

?>
