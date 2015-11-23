<?php
namespace Home\Controller;
use Think\Controller;
class FloagController extends Controller {
	public function index(){
      //  $openid =I('get.openid');
      //  if(!$openid) {
      //  echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>升国旗</title></head><body><h1>由于同学们积极的参与热情，“升国旗”游戏出现了一点小故障，我们的工作人员正在加紧抢修，不要着急，马上回来。</h1><br><h1>程序员正在更新维护，扔个肥皂加快进度吧...</h1></body></html>';
    //    return;
   // }
     // $start_time = microtime(true);
     // session('start_time', $start_time);
      
      $data = $this->GetOpenid();
      $openid = $data['openid'];
	  if($openid) { 
	    session('openid', $openid);
	  } else {
	  	$openid = session('openid');
	  
	  } 
      $this->assign('openid', $openid);
	  $this->display();
	}

	public function GetOpenid()
    {
        //通过code获得openid
        if (!isset($_GET['code'])){
            //触发微信返回code码
            $baseUrl = urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            $url = $this->__CreateOauthUrlForCode($baseUrl);
            Header("Location: $url");
            exit();
        } else {
            //获取code码，以获取openid
            $code = $_GET['code'];
            $token = $this->getOpenidFromMp($code);
            $userInfo = $this->__GetUserInfo($token);
            return $userInfo;
        }
    }

    /**
     *
     * 构造获取code的url连接
     * @param string $redirectUrl 微信服务器回跳的url，需要url编码
     *
     * @return 返回构造好的url
     */
    private function __CreateOauthUrlForCode($redirectUrl)
    {
        $urlObj["appid"] = 'wx81a4a4b77ec98ff4';
        $urlObj["redirect_uri"] = "$redirectUrl";
        $urlObj["response_type"] = "code";
        $urlObj["scope"] = "snsapi_base";
        $urlObj["state"] = "STATE"."#wechat_redirect";
        $bizString = $this->ToUrlParams($urlObj);
        return "https://open.weixin.qq.com/connect/oauth2/authorize?".$bizString;
    }

    /**
     *
     * 通过code从工作平台获取openid机器access_token
     * @param string $code 微信跳转回来带上的code
     *
     * @return openid
     */
    public function GetOpenidFromMp($code)
    {
        $url = $this->__CreateOauthUrlForOpenid($code);
        $ch = curl_init();
//        设置超时
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,FALSE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//        运行curl，结果以json形式返回
        $res = curl_exec($ch);
        curl_close($ch);
        //取出openid
        $data = json_decode($res,true);
//        $openid = $data['openid'];
        return $data;
    }


    /**
     *
     * 拼接签名字符串
     * @param array $urlObj
     *
     * @return 返回已经拼接好的字符串
     */
    private function ToUrlParams($urlObj)
    {
        $buff = "";
        foreach ($urlObj as $k => $v)
        {
            if($k != "sign"){
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");
        return $buff;
    }
    /**
     *
     * 构造获取open和access_toke的url地址
     * @param string $code，微信跳转带回的code
     *
     * @return 请求的url
     */
    private function __CreateOauthUrlForOpenid($code)
    {
        $urlObj["appid"] = 'wx81a4a4b77ec98ff4';
        $urlObj["secret"] = '436e85f53285ed7a0038f448a78fda66';
        $urlObj["code"] = $code;
        $urlObj["grant_type"] = "authorization_code";
        $bizString = $this->ToUrlParams($urlObj);
        return "https://api.weixin.qq.com/sns/oauth2/access_token?".$bizString;
    }


    private function __GetUserInfo($token) {
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$token['access_token']."&openid=".$token['openid']."&lang=zh_CN";
        $ch = curl_init();
//        设置超时
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,FALSE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//        运行curl，结果以json形式返回
        $res = curl_exec($ch);
        curl_close($ch);
        //取出openid
        $data = json_decode($res,true);
//        $openid = $data['openid'];
        return $data;
    }	
}
