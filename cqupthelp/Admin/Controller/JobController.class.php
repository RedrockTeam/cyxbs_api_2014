<?php
namespace Admin\Controller;
use Think\Controller;
class JobController extends Controller {
	public function index(){
			check_login();
		
			$NODE_URL = U("Job/index");
			$this->assign("NODE_URL",$NODE_URL);
			
			$NODE_URL = U("Job/job_add");
			$this->assign("node_add",$NODE_URL);
			
			
			$M_shop = M("job");
			$count      = $M_shop->count();// 查询满足要求的总记录数
			$Page       = new \Think\Page($count,10);
			$Page->setConfig('header','共 <span style="font-weight:bold;color:#FF6600;"> %TOTAL_ROW% </span>条记录');
			$Page->setConfig('prev','上一页');
			$Page->setConfig('next','下一页');
			$Page->setConfig('prev','上一页');
			$Page->setConfig('theme','%HEADER% <span style="font-weight:bold;color:blue;">%NOW_PAGE%</span>/<span style="font-weight:bold;">%TOTAL_PAGE%</span>页  %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
			$show       = $Page->show();// 分页显示输出
			// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$list = $M_shop->order('job_id')->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign('list',$list);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
			
			$this->display();
	
	}
	
	public function job_add(){
		check_login();
		$NODE_URL = U("Comment/index");
		$this->assign("NODE_URL",$NODE_URL);
		
		$ADD_URL= U('Comment/add');
		$this->assign('ADD_URL',$ADD_URL);
			
		$this->display('add');
	}
	
	public function add(){
		check_login();
		$data['shop_id'] = I('post.shop_id','','number_int');
		$data['comment_date'] = I('post.comment_date');
		$data['comment_author_name'] = I('post.comment_author_name');
		$data['comment_content'] = I('post.comment_content');
		
		if($data['shop_id']  && $data['comment_date'] && $data['comment_content'] && $data['comment_author_name'])
		{
			$edit_comment = D('dcomment');
			$edit_comment->add($data);
			$this->success('添加成功','index.php?s=Admin/comment/index');
		}else{
			$this->error('非法操作！');
		}
	}
	
	public function job_edit(){
		check_login();
		check_level(2);
		$edit_id = I('get.edit_id','','number_int');
		if($edit_id)
		{
			
			
			$M_shop = M("job");
			$edit_list = $M_shop->where('job_id='.$edit_id)->find();
			$this->assign('edit_list',$edit_list);
			
		}else{
			$edit_id = -1;
		}
		
		$NODE_URL = U("Job/index");
		$this->assign("NODE_URL",$NODE_URL);
			
		$NODE_URL = U("Job/edit_job");
		$this->assign("NODE_EDIT",$NODE_URL);
		
		$this->assign('this_id',$edit_id);
		$this->display('edit');
		
	}
	
	public function edit_job(){
		check_login();
		check_level(2);
		$id= I('post.job_id','','number_int');
		
		$data['job_company'] = I('post.job_company');
		$data['job_address'] = I('post.job_address');
		$data['job_time'] = I('post.job_time');
		$data['job_position'] = I('post.job_position');
		$data['job_apply'] = I('post.job_apply');
		$data['job_content'] = I('post.job_content');
		
		if( $id && $data['job_company'] && 
			$data['job_address'] && $data['job_time'] && 
			$data['job_position'] && $data['job_apply'] &&
			$data['job_content'])
		{
			
			if($id != -1){
				$data['job_id'] = $id;
				$edit_shop = D('job');
				$edit_shop->save($data);
				$this->success('修改成功','index.php?s=Admin/job/index');
			}else{
				$edit_comment = D('job');
				$edit_comment->add($data);
				$this->success('添加成功','index.php?s=Admin/job/index');
			}
			
		}else{
			$this->error('非法操作！');
		}
	}
	
	public  function del(){
		check_login();
		check_level(3);
		$del_id = I("get.del_id",'','number_int');
		if($del_id){
			//echo $del_id;
			D('job')->where('job_id='.$del_id)->delete();
			$this->success('删除成功','index.php?s=Admin/job/index');
		}else{
			$this->error('非法操作！');
		}
	}
}