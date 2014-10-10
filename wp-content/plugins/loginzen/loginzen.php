<?php
/*
  Plugin Name: Loginzen
  Plugin URI: http://github.com/youngershen
  Description: a custom login interface for the wp sites
  Version: 0.1
  Author: younger shen
  Author URI: http://github.com/youngershen
 */


function loginzen_check_login_status(){
    echo is_user_logged_in();
    return is_user_logged_in();
}
function loginzen_registration_function() {

    if(is_user_logged_in()){
        
        echo 'you loged in ';
        loginzen_already_login_display();
        return;
    }

    if (isset($_POST['submit'])) {
        
        loginzen_registration_validation(
            $_POST['username'],
            $_POST['password'],
            $_POST['regemail'],
            $_POST['fname'],
            $_POST['lname'],
            $_POST['nickname']
		);
		
        global $username, $password, $email, $first_name, $last_name, $nickname ;
        $username	= 	sanitize_user($_POST['username']);
        $password 	= 	esc_attr($_POST['password']);
        $email 		= 	sanitize_email($_POST['regemail']);
        $first_name = 	sanitize_text_field($_POST['fname']);
        $last_name 	= 	sanitize_text_field($_POST['lname']);
        $nickname 	= 	sanitize_text_field($_POST['nickname']);

        loginzen_complete_registration(
            $username,
            $password,
            $email,
            $first_name,
            $last_name,
            $nickname
		);
    }

    loginzen_registration_form(
    	$username,
        $password,
        $email,
        $first_name,
        $last_name,
        $nickname
		);
}

function loginzen_already_login_display(){

    $html = "你已经登录了";
    echo $html;
}
function loginzen_registration_form( $username, $password, $email, $first_name, $last_name, $nickname ) {
    

    echo '
    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
	<div>
	<label for="username">用户名<strong>*</strong></label>
	<input type="text" name="username" value="' . (isset($_POST['username']) ? $username : null) . '">
	</div>
	
	<div>
	<label for="password">密码<strong>*</strong></label>
	<input type="password" name="password" value="' . (isset($_POST['password']) ? $password : null) . '">
	</div>
	
	<div>
	<label for="regemail">邮箱<strong>*</strong></label>
	<input type="text" name="regemail" value="' . (isset($_POST['email']) ? $email : null) . '">
	</div>
	
	<div>
	<label for="firstname">姓氏</label>
	<input type="text" name="fname" value="' . (isset($_POST['fname']) ? $first_name : null) . '">
	</div>
	
	<div>
	<label for="lastname">名字</label>
	<input type="text" name="lname" value="' . (isset($_POST['lname']) ? $last_name : null) . '">
	</div>
	
	<div>
	<label for="nickname">昵称</label>
	<input type="text" name="nickname" value="' . (isset($_POST['nickname']) ? $nickname : null) . '">
    </div>'.
    '<input type="hidden" name="submit" value="submit" >'.
    '</br><input type="submit" value = "注册">'.
    '&nbsp<input type="button" value="清空">'
    
    ;
}

function loginzen_registration_validation( $username, $password, $email, $first_name, $last_name, $nickname )  {
    global $reg_errors;
    $reg_errors = new WP_Error;

    if ( empty( $username ) || empty( $password ) || empty( $email ) ) {
        $reg_errors->add('field', '字段缺失');
    }

    if ( strlen( $username ) < 4 ) {
        $reg_errors->add('username_length', '用户名太短，至少4个英文字符');
    }

    if ( username_exists( $username ) )
        $reg_errors->add('user_name', '对不起，用户名已存在');

    if ( !validate_username( $username ) ) {
        $reg_errors->add('username_invalid', '用户名不合法');
    }

    if ( strlen( $password ) < 5 ) {
        $reg_errors->add('password', '密码长度至少为5个字符');
    }

    if ( !is_email( $email ) ) {
        $reg_errors->add('email_invalid', '邮箱地址不合法');
    }

    if ( email_exists( $email ) ) {
        $reg_errors->add('email', '邮件地址已存在');
    }
   
    if ( is_wp_error( $reg_errors ) ) {

        foreach ( $reg_errors->get_error_messages() as $error ) {
            echo '<div>';
            echo '<strong>注册失败</strong>:';
            echo $error . '<br/>';

            echo '</div>';
        }
    }
}

function loginzen_complete_registration() {
    global $reg_errors, $username, $password, $email,  $first_name, $last_name, $nickname ;
    if ( count($reg_errors->get_error_messages()) < 1 ) {
        $userdata = array(
        'user_login'	=> 	$username,
        'user_url'      =>  "",
        'user_email' 	=> 	$email,
        'user_pass' 	=> 	$password,
        'first_name' 	=> 	$first_name,
        'last_name' 	=> 	$last_name,
        'nickname' 		=> 	$nickname,
		);
        $user = wp_insert_user( $userdata );
        if( is_wp_error($user) ){
            
            echo ' 注册失败';
            return;
        }
        echo ' 注册完成，即将转向 <a href="' . get_site_url() . '/wp-login.php">登录页面</a>.';   
	}
}

add_shortcode('loginzen_registration', 'loginzen_registration_shortcode');

function loginzen_registration_shortcode() {
    ob_start();
    loginzen_registration_function();
    return ob_get_clean();
}
        
