<?php

/*
    方倍工作室 http://www.fangbei.org/
    CopyRight 2014 All Rights Reserved
*/

/*
    require_once('weixin.class.php');
    $weixin = new class_weixin();
*/

define('APPID',         	"wxebee63fa4a23266d");
define('APPSECRET',        	"vRbeROG81jmptk1IN0xpWqHQGH-ucP6sMdlFNgps0GnEH_F4SMwWts_ceSOTYxyN");


class class_weixin
{
    var $appid = APPID;
    var $appsecret = APPSECRET;
	var $access_token = "null";
    //构造函数，获取Access Token
    public function __construct($appid = NULL, $appsecret = NULL)
    {
        if($appid && $appsecret){
            $this->appid = $appid;
            $this->appsecret = $appsecret;
        }
        //从token.json中获取存储的access_token
		$res = file_get_contents('token.json');
		$result = json_decode($res, true);
		$this->saves_time = $result["saves_time"];
		$this->access_token = $result["access_token"];
		$this->expires_in = $result['expires_in'];
		if($this->access_token && $this->access_token != ""){//如果存过access_token
				echo "token exist ";
			if (time() > ($this->saves_time + $this->expires_in)){//如果token过期了，要重新获取
				echo "token outdate ";
				$this->get_and_save_access_token();
			}
		}else{
			echo "token not exist ";
			$this->get_and_save_access_token();
		}		
    }

	/*
	 * 获取并保存access_token
	 */
	function get_and_save_access_token(){
		$url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=".$this->appid."&corpsecret=".$this->appsecret;
		$res = $this->http_request($url);
		$result = json_decode($res, true);
		var_dump($result);
		$this->access_token = $result["access_token"];
		$this->expires_in = $result["expires_in"];
		$this->saves_time = time();
		file_put_contents('token.json', '{"access_token": "'.$this->access_token.'", "saves_time": '.$this->saves_time.'", "expires_in": '.$this->expires_in.'}');
	}

    /*
    测试接口，获取微信服务器IP地址
    */
    public function get_callback_ip()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=".$this->access_token;
        $res = $this->http_request($url);
        return json_decode($res, true);
    }

    /*
    *  PART1 网页授权部分
    */

    //生成OAuth2的URL
    public function oauth2_authorize($redirect_url, $scope, $state = NULL)
    {
    	$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$this->appid."&redirect_uri=".urlencode($redirect_url)."&response_type=code&scope=".$scope."&state=".$state."#wechat_redirect";
        //$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$this->appid."&redirect_uri=".urlencode($redirect_url)."&response_type=code&scope=".$scope."&state=".$state."#wechat_redirect";
        return $url;
    }

    //生成OAuth2的Access Token
    public function oauth2_access_token($code)
    {  	
    	$url = "https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token=".$this->access_token."&code=".$code;
        //$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->appid."&secret=".$this->appsecret."&code=".$code."&grant_type=authorization_code";
        $res = $this->http_request($url);
        return json_decode($res, true);
    }

    //获取用户基本信息（OAuth2 授权的 Access Token 获取 未关注用户，Access Token为临时获取）
    public function oauth2_get_user_info($access_token, $openid)
    {
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
        $res = $this->http_request($url);
        return json_decode($res, true);
    }

    //获取用户基本信息（全局Access Token 获取 已关注用户，注意和OAuth时的区别）
    public function get_user_info($openid)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$this->access_token."&openid=".$openid."&lang=zh_CN";
        $res = $this->http_request($url);
        return json_decode($res, true);
    }

    //HTTP请求（支持HTTP/HTTPS，支持GET/POST）data是json格式的
    public function http_request($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_HTTPHEADER, 
            array('Content-Type: application/json', 
				'Content-Length: ' . strlen($data)));
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

    //日志记录
    private function logger($log_content)
    {
        if(isset($_SERVER['HTTP_APPNAME'])){   //SAE
            sae_set_display_errors(false);
            sae_debug($log_content);
            sae_set_display_errors(true);
        }else if($_SERVER['REMOTE_ADDR'] != "127.0.0.1"){ //LOCAL
            $max_size = 500000;
            $log_filename = "log.xml";
            if(file_exists($log_filename) and (abs(filesize($log_filename)) > $max_size)){unlink($log_filename);}
            file_put_contents($log_filename, date('Y-m-d H:i:s').$log_content."\r\n", FILE_APPEND);
        }
    }
    /*获取二维码的ticket*/
    public function getTicket(){
    	$url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$this->access_token;
        $data = '{
				    "expire_seconds": 1800,
				    "action_name": "QR_SCENE",
				    "action_info": {
				        "scene": {
				            "scene_id": 100000
				        }
				    }
				}';
        $res = $this->http_request($url,$data);
        return json_decode($res, true);
    }
}
