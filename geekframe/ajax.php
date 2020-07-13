<?php
function CorePress_saveThemeset()
{
    global $set;
    $data['code'] = 200;
    $setdata['version'] = THEME_VERSION;

    $json = json_decode(file_get_contents('php://input'),true);
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
add_action('wp_ajax_save', 'CorePress_saveThemeset');//管理员调用