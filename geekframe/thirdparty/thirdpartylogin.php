<?php
global $set;
require_once(FRAMEWORK_PATH . '/thirdparty/qq.php');

if (isset($_GET['thirdparty']) && !isset($_GET['action']) && !isset($_GET['bind'])) {
    $thirdparty = $_GET['thirdparty'];
    if ($thirdparty == 'qq') {
        corepress_can_thirdparty('qq');
        $appid = $set['user']['thirdparty_login_qq']['appid'];
        $appkey = $set['user']['thirdparty_login_qq']['appkey'];
        session_start();
        $_SESSION['state'] = md5(uniqid(rand(), TRUE));
        if (isset($_GET['redirect_to'])) {
            $redirect_to = $_GET['redirect_to'];
        } else {
            $redirect_to = home_url();
        }
        $qqlogin = new qqlogin($appid, $appkey, home_url(add_query_arg(array('action' => 'callback', 'type' => 'qq', 'redirect_to' => $redirect_to))), $_SESSION['state']);
        $qqlogin->qq_login();
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'callback' && isset($_GET['type']) && !isset($_GET['bind'])) {
    $type = $_GET['type'];
    if ($type == 'qq') {
        corepress_can_thirdparty('qq');
        $state = $_GET['state'];
        session_start();
        if ($_SESSION['state'] != $state) {
            die('非法提交');
        }
        $appid = $set['user']['thirdparty_login_qq']['appid'];
        $appkey = $set['user']['thirdparty_login_qq']['appkey'];
        $qqlogin = new qqlogin($appid, $appkey, home_url(add_query_arg(array('action' => 'callback', 'type' => 'qq'))), '');
        $token = $qqlogin->get_accessToken($_GET['code']);
        if ($token != false) {
            $openid = $qqlogin->get_openid($token);
            $user_query = new WP_User_Query(array('meta_key' => 'corepress_thirdparty_qq', 'meta_value' => $openid));
            $users = $user_query->get_results();
            if (empty($users)) {
                die('QQ未绑定，请在用户设置中先绑定QQ再使用'. '<a href="' . $_GET['redirect_to'] . '">点击返回</a>');
            } else {
                wp_set_current_user($users[0]->ID, $users[0]->user_login);
                wp_set_auth_cookie($users[0]->ID);
                wp_redirect($_GET['redirect_to']);
            }
        } else {
            die('QQ登录失败'. '<a href="' . $_GET['redirect_to'] . '">点击返回</a>');
        }
    }
}


if (isset($_GET['thirdparty']) && !isset($_GET['action']) && isset($_GET['bind'])) {
    $thirdparty = $_GET['thirdparty'];
    if ($thirdparty == 'qq') {
        corepress_can_thirdparty('qq');
        $appid = $set['user']['thirdparty_login_qq']['appid'];
        $appkey = $set['user']['thirdparty_login_qq']['appkey'];
        session_start();
        $_SESSION['state'] = md5(uniqid(rand(), TRUE));
        if (isset($_GET['redirect_to'])) {
            $redirect_to = $_GET['redirect_to'];
        } else {
            $redirect_to = home_url();
        }
        $qqlogin = new qqlogin($appid, $appkey, home_url(add_query_arg(array('action' => 'callback', 'type' => 'qq', 'redirect_to' => $redirect_to))), $_SESSION['state']);
        $qqlogin->qq_login();
    }
}
if (isset($_GET['action']) && $_GET['action'] == 'callback' && isset($_GET['type']) && isset($_GET['bind'])) {
    $type = $_GET['type'];
    if ($type == 'qq') {
        corepress_can_thirdparty('qq');
        $state = $_GET['state'];
        session_start();
        if ($_SESSION['state'] != $state) {
            die('非法提交');
        }
        $appid = $set['user']['thirdparty_login_qq']['appid'];
        $appkey = $set['user']['thirdparty_login_qq']['appkey'];
        $qqlogin = new qqlogin($appid, $appkey, home_url(add_query_arg(array('action' => 'callback', 'type' => 'qq'))), '');
        $token = $qqlogin->get_accessToken($_GET['code']);
        if ($token != false) {
            $openid = $qqlogin->get_openid($token);
            $user_query = new WP_User_Query(array('meta_key' => 'corepress_thirdparty_qq', 'meta_value' => $openid));
            $users = $user_query->get_results();
            if (empty($users)) {
                $currentUser = wp_get_current_user();
                update_user_meta($currentUser->ID, 'corepress_thirdparty_qq', $openid);
                wp_redirect($_GET['redirect_to']);
            } else {
                die('当前QQ已经绑定用户' . '<a href="' . $_GET['redirect_to'] . '">点击返回</a>');
            }
        } else {
            die('QQ登录失败'. '<a href="' . $_GET['redirect_to'] . '">点击返回</a>');
        }
    }
}


?>
