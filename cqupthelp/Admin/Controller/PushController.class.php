<?php
namespace Admin\Controller;
use Think\Controller;
class PushController extends Controller {
    public function message_index(){
    	
		check_login();
		$this->assign('message_index',U('Push/message_index'));
		$this->assign('message_push',U('Push/message_push'));
    	$this->assign('message_show',U('Push/show_message'));
		
		$this->display();
	}
	
	public function message_push(){//message_push推送
		$title = I('post.title','');
		$content = I('post.content','');
		if($title && $content){
			$result = $this->send_push($title,$message);
			$data['title'] = $title;
			$data['content'] = $content;
			$data['time'] =  date("Y-m-d h:i:s");
			$data['push_user'] = session('login_name');
			$data['msg_id'] = $result['msg_id'];
			$data['send_ip'] = get_client_ip();
			$data['push_type'] = $result['sendno'];
			if(isset($result['error'])){
				$data['errcode'] = $result['error']['code'];
				$this->error('推送错误：错误信息=>'.$result['error']['message'].'|错误码:'.$result['error']['code']);
				D('cyxbs_push')->add($data);
				$this->error('发送失败!');
			}else{
				
				D('cyxbs_push')->add($data);
				//print_r($data);
				//$this->success('发送成功!');
				print_r($result);
				//print_r($title ."||".$content);
				
			}
		}else{
			$this->error('非法操作');
		}
	}
	
	private function send_push($title,$message,$alert='',$type=1) //配置发送
    {
        $url = C('PUSH_URL');
		$appkeys = C("appkeys");
		$masterSecret = C("masterSecret");
        $base64=base64_encode("$appkeys:$masterSecret");
        $header=array("Authorization:Basic $base64","Content-Type:application/json");
        $param='{"options":{"sendno":"'.$type.'"},"platform":"all","audience":"all","notification" : {"alert" : "'.$alert.'"},"message":{"msg_content":"'.$message.'","title":"'.$title.'"}}';
        $res = $this->request_post($url,$param,$header);
        $res_arr = json_decode($res, true);
		
        return $res_arr;
    }

	private  function request_post($url="",$param="",$header="") {//CURL
        if (empty($url) || empty($param)) {
        return false;
        }
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
        return $data;
    }
	
	public function show_message(){
		check_login();
		$this->assign('message_index',U('Push/message_index'));
		$this->assign('alert_index',U('Push/alert_index'));
		$M_shop = M("cyxbs_push");
			$count      = $M_shop->join('push_type ON cyxbs_push.push_type = push_type.type_id')->count();// 查询满足要求的总记录数
			$Page       = new \Think\Page($count,20);
			$Page->setConfig('header','共 <span style="font-weight:bold;color:#FF6600;"> %TOTAL_ROW% </span>条记录');
			$Page->setConfig('prev','上一页');
			$Page->setConfig('next','下一页');
			$Page->setConfig('prev','上一页');
			$Page->setConfig('theme','%HEADER% <span style="font-weight:bold;color:blue;">%NOW_PAGE%</span>/<span style="font-weight:bold;">%TOTAL_PAGE%</span>页  %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
			$show       = $Page->show();// 分页显示输出
			// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$list = $M_shop->join('push_type ON cyxbs_push.push_type = push_type.type_id')->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign('message',$list);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
		
		//$message = D('cyxbs_push')->join('push_type ON cyxbs_push.push_type = push_type.type_id')->select();
		
		
		//$this->assign('message',$message);
		$this->display();
	}
	
	public function alert_index(){
	
		check_login();
		$this->assign('alert_index',U('Push/message_index'));
		$this->assign('alert_push',U('Push/alert_push'));
    	$this->assign('message_show',U('Push/show_message'));
		$this->display();
	}
	
	public function alert_push(){//阿勒rt_push推送
		$content = I('post.content','');
		if($content){
			$result = $this->send_push('','',$content,2);
			
			$data['title'] = 'alert';
			$data['content'] = $content;
			$data['time'] =  date("Y-m-d h:i:s");
			$data['push_user'] = session('login_name');
			$data['msg_id'] = $result['msg_id'];
			$data['send_ip'] = get_client_ip();
			$data['push_type'] = $result['sendno'];
			if(isset($result['error'])){
				$data['errcode'] = $result['error']['code'];
				$this->error('推送错误：错误信息=>'.$result['error']['message'].'|错误码:'.$result['error']['code']);
				D('cyxbs_push')->add($data);
				$this->error('发送失败!');
			}else{
				
				D('cyxbs_push')->add($data);
				//print_r($data);
				//$this->success('发送成功!');
				print_r($result);
				//print_r($title ."||".$content);
				
			}
		}else{
			$this->error('非法操作');
		}
	}
	
	public function curlTest(){//测试curl
		 $param='{"options":{"sendno":"1"},"platform":"all","audience":"all","message":{"msg_content":"111","title":"222"}}';
		$url = C('PUSH_URL');
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
        echo ($data."111");
	}
}