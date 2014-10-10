

<?php
/*
Template Name: 自定义注册页面
*/
if( !empty($_POST['ludou_reg']) ) {
    $error = '';
    $sanitized_user_login = sanitize_user( $_POST['user_login'] );
    $user_email = apply_filters( 'user_registration_email', $_POST['user_email'] );

    // Check the username
    if ( $sanitized_user_login == '' ) {
        $error .= '<strong>错误</strong>：请输入用户名。<br />';
    } elseif ( ! validate_username( $sanitized_user_login ) ) {
        $error .= '<strong>错误</strong>：此用户名包含无效字符，请输入有效的用户名<br />。';
        $sanitized_user_login = '';
    } elseif ( username_exists( $sanitized_user_login ) ) {
        $error .= '<strong>错误</strong>：该用户名已被注册，请再选择一个。<br />';
    }
    // Check the e-mail address
    if ( $user_email == '' ) {
        $error .= '<strong>错误</strong>：请填写电子邮件地址。<br />';
    } elseif ( ! is_email( $user_email ) ) {
        $error .= '<strong>错误</strong>：电子邮件地址不正确。！<br />';
        $user_email = '';
    } elseif ( email_exists( $user_email ) ) {
        $error .= '<strong>错误</strong>：该电子邮件地址已经被注册，请换一个。<br />';
    }

    // Check the password
    if(strlen($_POST['user_pass']) < 6)
        $error .= '<strong>错误</strong>：密码长度至少6位!<br />';
    elseif($_POST['user_pass'] != $_POST['user_pass2'])
        $error .= '<strong>错误</strong>：两次输入的密码必须一致!<br />';

    if($error == '') {
        $user_id = wp_create_user( $sanitized_user_login, $_POST['user_pass'], $user_email );

        if ( ! $user_id ) {
            $error .= sprintf( '<strong>错误</strong>：无法完成您的注册请求... 请联系<a href="mailto:%s">管理员</a>！<br />', get_option( 'admin_email' ) );
        }
        else if (!is_user_logged_in()) {
            $user = get_userdatabylogin($sanitized_user_login);
            $user_id = $user->ID;

            // 自动登录
            wp_set_current_user($user_id, $user_login);
            wp_set_auth_cookie($user_id);
            do_action('wp_login', $user_login);
        }
    }
}?>



<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main"
            <?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<div class="entry-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div>
						<?php endif; ?>
                        <h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->
                    <div class="entry-content">
                        <?php the_content(); ?>
                        <?php if(!empty($error)) {
                            echo '<p class="ludou-error">'.$error.'</p>';
                        }
                        if (!is_user_logged_in()) { ?>
                            <form name="registerform" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" class="ludou-reg">
                                <p>
                                    <label for="user_login">用户名<br />
                                        <input type="text" name="user_login" tabindex="1" id="user_login" class="input" value="<?php if(!empty($sanitized_user_login)) echo $sanitized_user_login; ?>" />
                                    </label>
                                </p>

                                <p>
                                    <label for="user_email">电子邮件<br />
                                        <input type="text" name="user_email" tabindex="2" id="user_email" class="input" value="<?php if(!empty($user_email)) echo $user_email; ?>" size="25" />
                                    </label>
                                </p>

                                <p>
                                    <label for="user_pwd1">密码(至少6位)<br />
                                        <input id="user_pwd1" class="input" tabindex="3" type="password" tabindex="21" size="25" value="" name="user_pass" />
                                    </label>
                                </p>

                                <p>
                                    <label for="user_pwd2">重复密码<br />
                                        <input id="user_pwd2" class="input" tabindex="4" type="password" tabindex="21" size="25" value="" name="user_pass2" />
                                    </label>
                                </p>

                                <p class="submit">
                                    <input type="hidden" name="ludou_reg" value="ok" />
                                    <button class="button button-primary button-large" type="submit">注册</button>
                                </p>
                            </form>
                        <?php } else {
                            echo '<p class="ludou-error">您已注册成功，并已登录！</p>';
                        } ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div>
                    <!-- .entry-content -->

					<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post -->

				<?php comments_template(); ?>
			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>