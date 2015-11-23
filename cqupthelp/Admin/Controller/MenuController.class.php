<?php
namespace Admin\Controller;
use Think\Controller;
class MenuController extends Controller {
	public function index(){
			check_login();
			
			$NODE_URL = U("Menu/index");
			$this->assign("NODE_URL",$NODE_URL);
			
			$NODE_URL = U("Menu/node_add");
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
			$list = $M_shop->order('shop.shop_id')->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign('list',$list);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
			
			$this->display();
	
	}

	public function shop_edit(){
		check_login();
		$edit_id = I('get.edit_id','','number_int');
		
		if($edit_id)
		{			
			$NODE_URL = U("Menu/dish_add?add_id=".$edit_id);
			$this->assign("ADD_URL",$NODE_URL);
			
			$shop_thing = M('shop')->where('shop_id='.$edit_id)->find();
			$this->assign("shop_thing",$shop_thing);
		
			
			$M_shop = M("dish");
			
			$count      = $M_shop->where('shop_id='.$edit_id)->count();// 查询满足要求的总记录数
			$Page       = new \Think\Page($count,10);
			$Page->setConfig('header','共 <span style="font-weight:bold;color:#FF6600;"> %TOTAL_ROW% </span>条记录');
			$Page->setConfig('prev','上一页');
			$Page->setConfig('next','下一页');
			$Page->setConfig('prev','上一页');
			$Page->setConfig('theme','%HEADER% <span style="font-weight:bold;color:blue;">%NOW_PAGE%</span>/<span style="font-weight:bold;">%TOTAL_PAGE%</span>页  %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
			$show       = $Page->show();// 分页显示输出
			// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$list = $M_shop->where('shop_id='.$edit_id)->order('dish_id')->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign('list',$list);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
			
			$this->display('shop');
		}else{
			$this->error('非法操作！');
		}
	}
	
	public function dish_add(){
		check_login();
	
		$add_id = I('get.add_id','','number_int');
		
		
		if($add_id){
			$NODE_URL = U("Menu/shop_edit?edit_id=".$add_id);
			$this->assign("NODE_URL",$NODE_URL);
			
			$ADD_URL= U('Menu/add');
			$this->assign('ADD_URL',$ADD_URL);
			
			$shop=D('shop')->field('shop_id,shop_name')->where('shop_id='.$add_id)->find();
			$this->assign('shop',$shop);
			$this->display('add');
		}else{
			$this->error('非法操作!');
		}
	}
	
	public function add(){
		check_login();
		
		$data['shop_id'] = I('post.shop_id','','number_int');
		$data['dish_name'] = I('post.dish_name');
		$data['dish_price'] = I('post.dish_price');
		
		if($data['shop_id']  && $data['dish_name'] && $data['dish_price'])
		{
			$edit_menu = D('dish');
			
			$edit_menu->add($data);
			$this->success('添加成功','index.php?s=Admin/menu/shop_edit/edit_id/'.$data['shop_id']);
		}else{
			$this->error('非法操作！');
		}
	}
	
	public function dish_edit(){
		check_login();
		check_level(2);
		$edit_id = I('get.edit_id','','number_int');
		$shop_id = I('get.shop_id','','number_int');
		
		if($edit_id)
		{
			$this->assign('shop_id',$shop_id);
			
			$NODE_URL = U("Menu/shop_edit?edit_id=".$edit_id);
			$this->assign("NODE_URL",$NODE_URL);
			
			$NODE_URL = U("Menu/edit_dish");
			$this->assign("NODE_EDIT",$NODE_URL);
			
			$M_shop = M("dish");
			$edit_list = $M_shop->where('dish_id='.$edit_id)->find();
			$this->assign('edit_list',$edit_list);
			$this->display('edit');
		}else{
			$this->error('非法操作！');
		}
	}
	
	public function edit_dish(){
		check_login();
		check_level(2);
		$shop_id = I('post.shop_id','','number_int');
		$data['dish_id'] = I('post.dish_id','','number_int');
		$data['dish_name'] = I('post.dish_name');
		$data['dish_price'] = I('post.dish_price');

		
		if($data['dish_id'] && $data['dish_name'] && $data['dish_price'] && $shop_id)
		{
			$edit_shop = D('dish');
			$edit_shop->save($data);
			//echo $shop_id;
			$this->success('修改成功','index.php?s=Admin/menu/shop_edit/edit_id/'.$shop_id);
		}else{
			//print_r($data);
			$this->error('非法操作！');
		}
	}
	
	public  function del(){
		check_login();
		check_level(3);
		$del_id = I("get.del_id",'','number_int');
		$shop_id = I("get.shop_id",'','number_int');
		if($del_id && $shop_id){
			//echo $del_id.$shop_id;
			D('dish')->where('dish_id='.$del_id)->delete();
			$this->success('删除成功','index.php?s=Admin/menu/shop_edit/edit_id/'.$shop_id);
		}else{
			$this->error('非法操作！');
		}
	}
}