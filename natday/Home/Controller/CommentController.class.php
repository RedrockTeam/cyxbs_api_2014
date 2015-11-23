<?php
namespace Home\Controller;
use Think\Controller;
class CommentController extends Controller {
	public function index(){
			check_login();
	
			$NODE_URL = U("Comment/index");
			$this->assign("NODE_URL",$NODE_URL);
			
			$NODE_URL = U("Comment/node_add");
			$this->assign("node_add",$NODE_URL);
			
			
			$M_shop = M("scomment");
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
						      ->order('comment_id')
							  ->limit($Page->firstRow.','.$Page->listRows)
							  ->select();
			$this->assign('list',$list);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
			
			$this->display();  
	
	}
	
	public function node_add(){
		check_login();
		$NODE_URL = U("Comment/index");
		$this->assign("NODE_URL",$NODE_URL);
		
		$ADD_URL= U('Comment/add');
		$this->assign('ADD_URL',$ADD_URL);
			
		$this->display('add');
	}
	
	public function add(){
		check_login();
		
		$data['stu_id'] = I('post.stu_id','','number_int');
		$data['comment_date'] = I('post.comment_date');
		$data['stu_name'] = I('post.comment_author_name');
		$data['comment_content'] = I('post.comment_content');
		
		if($data['stu_id']  && $data['comment_date'] && $data['stu_name'] && $data['comment_content'])
		{
			$edit_comment = D('scomment');
			$h = $edit_comment->data();
			$edit_comment->add($data);
			$this->success('添加成功','index.php?s=Home/comment/index');
		}else{
			$this->error('非法操作！');
		}
	}

	public  function del(){
		check_login();
		check_level(3);
		
		$del_id = I("get.del_id",'','number_int');
		$data['comment_content'] = "我们要做个爱国的文明人哦~大家来争当爱国小能手吧O(∩_∩)O哈哈~";
		if($del_id){
			D('scomment')->where('comment_id='.$del_id)->save($data);
			$this->success('屏蔽成功','index.php?s=Home/comment/index');
		}else{
			$this->error('非法操作！');
		}
	}
	
	public  function show_comment(){
		$data = D('scomment')->order("comment_id desc")->select();
		if($data){
			$data["status"] = "200";
		}else{
			$data["status"] = "0";
		}
		$this->ajaxReturn($data);
	}
}
