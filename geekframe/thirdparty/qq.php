<?php

class qqlogin
{
    private $appid = '';
    private $appkey = '';
    private $callback = '';
    private $state = '';
    const VERSION = "2.0";
    const GET_AUTH_CODE_URL = "https://graph.qq.com/oauth2.0/authorize";
    const GET_ACCESS_TOKEN_URL = "https://graph.qq.com/oauth2.0/token";
    const GET_OPENID_URL = "https://graph.qq.com/oauth2.0/me";

    function __construct($appid, $appkey, $callback, $state)
    {
        $this->appid = $appid;
        $this->appkey = $appkey;
        $this->state = $state;
        $this->callback = $callback;
    }

    public function qq_login()
    {


        //-------构造请求参数列表
        $keysArr = array(
            "response_type" => "code",
            "client_id" => $this->appid,
            "redirect_uri" => urlencode($this->callback),
            "state" => $this->state,
            "scope" => 'get_user_info'
        );
        $login_url = combineURL(self::GET_AUTH_CODE_URL, $keysArr);
        header("Location:$login_url");
    }

    public function get_accessToken($code)
    {

        //-------请求参数列表
        $keysArr = array(
            'grant_type' => 'authorization_code',
            'client_id' => $this->appid,
            'client_secret' => $this->appkey,
            'code' => $code,
            'redirect_uri' => $this->callback,
            'fmt'=>'json'
        );

        $graph_url = combineURL(self::GET_ACCESS_TOKEN_URL, $keysArr);

        $request = new WP_Http;
        $result = $request->request($graph_url);

        if (!is_wp_error($result)) {
            $response = $result['body'];
            parse_str($response,$query_arr);
            if (isset($query_arr['access_token'])) {
                return $query_arr['access_token'];
            }
        } else {
            return false;
        }

    }

    public function get_openid($access_token){

        //-------请求参数列表
        $keysArr = array(
            "access_token" => $access_token,
            'fmt'=>'json'
        );


        $graph_url = combineURL(self::GET_OPENID_URL, $keysArr);
        $request = new WP_Http;
        $result = $request->request($graph_url);
        $response = $result['body'];
        //--------检测错误是否发生
        if(strpos($response, "callback") !== false){
            $lpos = strpos($response, "(");
            $rpos = strrpos($response, ")");
            $response = substr($response, $lpos + 1, $rpos - $lpos -1);
        }

        $user = json_decode($response);
        if(isset($user->error)){
            $this->error->showError($user->error, $user->error_description);
        }

        return $user->openid;

    }
}