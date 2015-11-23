<?php
namespace Admin\Controller;
use Think\Controller;
class NodeController extends Controller {
    public function index(){
			check_login();
			
			$NODE_URL = U("Node/index");
			$this->assign("NODE_URL",$NODE_URL);
			
			$NODE_URL = U("Node/node_add");
			$this->assign("node_add",$NODE_URL);
			
			$M_shop = M("shop");
			$count      = $M_shop->count();// 查询满足要求的总记录数
			$Page       = new \Think\Page($count,10);
			$Page->setConfig('header','共 <span style="font-weight:bold;color:#FF6600;"> %TOTAL_ROW% </span>条记录');
			$Page->setConfig('prev','上一页');
			$Page->setConfig('next','下一页');
			$Page->setConfig('prev','上一页');
			$Page->setConfig('theme','%HEADER% <span style="font-weight:bold;color:blue;">%NOW_PAGE%</span>/<span style="font-weight:bold;">%TOTAL_PAGE%</span>页  %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
			$show       = $Page->show();// 分页显示输出
			// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$list = $M_shop->order('shop_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign('list',$list);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
			
			$this->display();
			//print_r($show);
	}
	
	public function content_edit(){
		check_login();
		check_level(2);
		
		$edit_id = I('get.edit_id','','number_int');
		if($edit_id)
		{
			$NODE_URL = U("Node/index");
			$this->assign("NODE_URL",$NODE_URL);
			
			$NODE_URL = U("Node/edit_shop");
			$this->assign("NODE_EDIT",$NODE_URL);
			
			$M_shop = M("shop");
			$edit_list = $M_shop->where('shop_id='.$edit_id)->find();
			$this->assign('edit_list',$edit_list);
			$this->display('edit');
		}else{
			$this->error('非法操作！');
		}
	}
	
	public function edit_shop(){
		check_login();
		check_level(2);
		
		$data['shop_id'] = I('post.shop_id','','number_int');
		$data['shop_name'] = I('post.shop_name');
		$data['shop_address'] = I('post.shop_address');
		$data['shop_tel'] = I('post.shop_tel');
		$data['shop_content'] = I('post.shop_content');
		$data['shop_sale_content'] = I('post.shop_sale_content');
		
		if($data['shop_sale_content'] && $data['shop_content'] && $data['shop_id'] && $data['shop_name'] && $data['shop_address'] && $data['shop_tel'])
		{
			$edit_shop = D('shop');
			//print_r($_POST);
			$edit_shop->save($data);
			$this->success('修改成功','index.php?s=Admin/node/index');
		}else{
			$this->error('非法操作！');
		}
	}
	
	public function node_add(){
		check_login();
		
		$NODE_URL = U("Node/index");
		$this->assign("NODE_URL",$NODE_URL);
			
		$ADD_URL= U('Node/add');
		$this->assign('ADD_URL',$ADD_URL);
		$this->display('add');
	}
	
	public function add(){
		check_login();
		
		$data['shop_name'] = I('post.shop_name');
		$data['shop_address'] = I('post.shop_address');
		$data['shop_tel'] = I('post.shop_tel');
		$data['shop_content'] = I('post.shop_content');
		$data['shop_sale_content'] = I('post.shop_sale_content');
		if($data['shop_sale_content'] && $data['shop_content'] && $data['shop_name'] && $data['shop_address'] && $data['shop_tel'])
		{
			$edit_shop = D('shop');
			$edit_shop->add($data);
			$this->success('添加成功','index.php?s=Admin/node/index');
		}else{
			$this->error('非法操作！');
		}
	}
	
	public  function del(){/*不要乱删店，评论等也会全没了*/
		check_login();
		check_level(3);
		
		$del_id = I("get.del_id",'','number_int');
		if($del_id){
			//echo $del_id;
			D('shop')->where('shop_id='.$del_id)->delete();
			D('dcomment')->where('shop_id='.$del_id)->delete();
			D('dish')->where('shop_id='.$del_id)->delete();
			$this->success('删除成功','index.php?s=Admin/node/index');
			
		}else{
			$this->error('非法操作！');
		}
	}
}