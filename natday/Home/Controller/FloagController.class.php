<?php
namespace Home\Controller;
use Think\Controller;
class FloagController extends Controller {
	public function index(){
        $code = I('get.code');
        if($code == null){
            return redirect("https://open.weixin.qq.com/connect/oauth2/authorize?appid=$this->appid&redirect_uri=http%3a%2f%2fhongyan.cqupt.edu.cn%2fcquptluck%2fHome%2fIndex%2findex.html&response_type=code&scope=snsapi_userinfo&state=sfasdfasdfefvee#wechat_redirect");
        }else{
            session('code', $code);
            $return =  json_decode($this->getOpenId());
            $openid = $return->data->openid;
        }
	  if($openid) { 
	    session('openid', $openid);
	  } else {
	  	$openid = session('openid');
	  
	  } 
      $this->assign('openid', $openid);
	  $this->display();
	}

    private function getOpenId () {
        $code = session('code');
        $time=time();
        $str = 'abcdefghijklnmopqrstwvuxyz1234567890ABCDEFGHIJKLNMOPQRSTWVUXYZ';
        $string='';
        for($i=0;$i<16;$i++){
            $num = mt_rand(0,61);
            $string .= $str[$num];
        }
        $secret =sha1(sha1($time).md5($string)."redrock");
        $t2 = array(
            'timestamp'=>$time,
            'string'=>$string,
            'secret'=>$secret,
            'token'=>$this->acess_token,
            'code' => $code,
        );
        $url = "http://hongyan.cqupt.edu.cn/MagicLoop/index.php?s=/addon/Api/Api/webOauth";
        return json_encode($this->curl_api($url, $t2));
    }
}
