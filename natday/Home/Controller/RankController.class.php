<?php
namespace Home\Controller;
use Think\Controller;
class RankController extends Controller {
	public function index(){
			check_login();
	
			$NODE_URL = U("Rank/index");
			$this->assign("NODE_URL",$NODE_URL);
			
			$NODE_URL = U("Rank/node_add");
			$this->assign("node_add",$NODE_URL);
			
			
			$M_shop = M("rank");
			$count      = $M_shop->count();// 查询满足要求的总记录数
			$Page       = new \Think\Page($count,10);
			$Page->setConfig('header','共 <span style="font-weight:bold;color:#FF6600;"> %TOTAL_ROW% </span>条记录');
			$Page->setConfig('prev','上一页');
			$Page->setConfig('next','下一页');
			$Page->setConfig('prev','上一页');
			$Page->setConfig('theme','%HEADER% <span style="font-weight:bold;color:blue;">%NOW_PAGE%</span>/<span style="font-weight:bold;">%TOTAL_PAGE%</span>页  %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
			$show       = $Page->show();// 分页显示输出
			// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$list = $M_shop
							  ->order('use_time')
							  ->limit($Page->firstRow.','.$Page->listRows)
							  ->select();
			$this->assign('list',$list);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
			
			$this->display();  
	
	}
	
	public function node_add(){
		check_login();
		$NODE_URL = U("Rank/index");
		$this->assign("NODE_URL",$NODE_URL);
		
		$ADD_URL= U('Rank/add');
		$this->assign('ADD_URL',$ADD_URL);
			
		$this->display('add');
	}
	
	public function add(){
		check_login();
		
		$data['stu_id'] = I('post.stu_id','','number_int');
		$data['date'] = I('post.date');
		$data['stu_name'] = I('post.stu_name');
		$data['use_time'] = I('post.use_time');
		
		if($data['stu_id']  &&  $data['date'] && $data['stu_name'] && $data['use_time'])
		{
			$edit_comment = D('rank');

			//print_r($edit_comment);
			for($i=1;$i<=7777;$i++){
				$edit_comment->add($data);
			}
			$this->success('添加成功','index.php?s=Home/rank/index');
		}else{
			//$this->error('非法操作！');
			print_r($data);
		}
	}
	
	
	public  function del(){
		check_login();
		check_level(3);
		
		$del_id = I("get.del_id",'','number_int');
		if($del_id){
			$data['use_time']="90";
			D('rank')->where('id='.$del_id)->save($data);
			$this->success('废除成功','index.php?s=Home/rank/index');
		}else{
			$this->error('非法操作！');
		}
	}
	
	public  function show_rank(){
		$time = date("Y-m-d",time());
		$receive["stu_id"] = "10000";
		$receive["stu_name"] = I('post.stu_name',session('openid'));
		// $end_time = microtime(true);
		// $start_time = session('start_time');
		// $spend = $end_time - $start_time;

		$receive["use_time"] = I('post.use_time')/1000;	
		$receive["date"] =	$time;	
		
		if($receive["date"] && $receive["use_time"] && $receive["stu_name"] && $receive["stu_id"] ){
			D('rank')->add($receive);
			$data["all"] = (D('rank')->count())+7;
			$map['use_time'] = array('LT', $receive['use_time']);
			$data["rank"] = (D('rank')->where($map)->count())+7;
			if($data){
				$data["status"] = "200";
			}else{
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				$ua = $_SERVER['HTTP_USER_AGENT'];
				$error = session('openid').','.$receive["use_time"].','.$ip.','.$ua;
				M('error')->add(array('error' => $error));
				$data["status"] = "0";
			}
			$this->ajaxReturn($data);
		}else{
			$this->error("非法操作！");
		}
	}
}
