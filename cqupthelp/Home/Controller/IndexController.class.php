<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
	
		$url = "http://api.jpush.cn/v3/push";
		$appkeys = "b3f641e86cfc241f122535ac";
		$masterSecret = "9829097b08f8a7db9e55459d";
        $param='{"options":{"sendno":"1"},"platform":"all","audience":"all","notification" : {"alert" : "555"},"message":{"msg_content":"999","title":"555"}}';
		$header=array("Authorization:Basic $base64","Content-Type:application/json");
		
		$postUrl = $url;
        $curlPost = $param;
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        // 增加 HTTP Header（头）里的字段 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        // 终止从服务端进行验证
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);
        echo $data;
	}
}