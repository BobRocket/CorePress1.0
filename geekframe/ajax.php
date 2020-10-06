<?php
function CorePress_saveThemeset()
{
    global $set;
    $data['code'] = 200;
    $setdata['version'] = THEME_VERSION;
    $json = json_decode(file_get_contents('php://input'), true);
    if ($json) {
        $setdata['option'] = base64_decode($json['save']);

        if (options::saveData($setdata)) {
            $data['code'] = 1;
        } else {
            $data['code'] = 0;
        }
    } else {
        $data['code'] = 503;
    }
    wp_die(json_encode($data));
}

function CorePress_login()
{
    global $set;
    session_start();
    $array = array();
    $array['user_login'] = $_POST['user'];
    $array['user_password'] = $_POST['pass'];
    $array['remember'] = $_POST['remember'];
    $code = $_POST['code'];
    if ($set['user']['VerificationCode'] == 1) {
        if (strtoupper($code) != $_SESSION['authcode']) {
            $json['code'] = 0;
            $json['msg'] = '登录失败，验证码错误';
            wp_die(json_encode($json));
        }
    }
    $user = wp_signon($array);
    if (is_wp_error($user)) {
        $json['code'] = 0;
        $json['msg'] = '登录失败，账号或密码错误';
    } else {
        $json['code'] = 1;
        $json['msg'] = '登录成功';
    }
    wp_die(json_encode($json));
}

function corepress_save_post_meta($post_id)
{
    // 安全检查
    // 检查是否发送了一次性隐藏表单内容
    if (!isset($_POST['corepress_meta_box_nonce'])) {
        return;
    }
    // 判断隐藏表单的值与之前是否相同
    if (!wp_verify_nonce($_POST['corepress_meta_box_nonce'], 'corepress_meta_box')) {
        return;
    }
    // 判断该用户是否有权限
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    // 判断 Meta Box 是否为空
    if (!isset($_POST['corepress_post_meta'])) {
        return;
    }
    update_post_meta($post_id, 'corepress_post_meta', $_POST['corepress_post_meta']);
}

add_action('wp_ajax_nopriv_corepress_login', 'CorePress_login');
add_action('wp_ajax_save', 'CorePress_saveThemeset');//管理员调用
add_action('save_post', 'corepress_save_post_meta');
