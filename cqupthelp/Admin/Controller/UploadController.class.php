<?php
namespace Admin\Controller;
use Think\Controller;
class UploadController extends Controller {
    public function shop_index(){
		check_login();
		
    	$NODE_URL = U("Menu/index");
		$this->assign("NODE_URL",$NODE_URL);
		
		
			
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
			
		$this->display("shop_index");
	}
	
	public function shop_edit(){
		check_login();
		$edit_id = I('get.edit_id','','number_int');	
		if($edit_id)
		{			
			$this->assign("UPLOAD_ROOT_URL","./Upload/");
			
			$NODE_URL = U("Upload/img_add?add_id=".$edit_id);
			$this->assign("ADD_URL",$NODE_URL);
			
			$shop_thing = M('shop')->where('shop_id='.$edit_id)->find();
			$this->assign("shop_thing",$shop_thing);
			
			$M_shop = M("shopimg");
			
			$count      = $M_shop->where('shop_id='.$edit_id)->count();// 查询满足要求的总记录数
			$Page       = new \Think\Page($count,5);
			$Page->setConfig('header','共 <span style="font-weight:bold;color:#FF6600;"> %TOTAL_ROW% </span>条记录');
			$Page->setConfig('prev','上一页');
			$Page->setConfig('next','下一页');
			$Page->setConfig('prev','上一页');
			$Page->setConfig('theme','%HEADER% <span style="font-weight:bold;color:blue;">%NOW_PAGE%</span>/<span style="font-weight:bold;">%TOTAL_PAGE%</span>页  %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
			$show       = $Page->show();// 分页显示输出
			// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$list = $M_shop->where('shop_id='.$edit_id)->order('shopimg_id')->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign('list',$list);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
			
			$this->display('shop_img');
		}else{
			$this->error('非法操作！');
		}
	}
	
	public function img_add(){
		check_login();
		$add_id = I('get.add_id','','number_int');

		if($add_id){
			$NODE_URL = U("Upload/shop_edit?edit_id=".$add_id);
			$this->assign("NODE_URL",$NODE_URL);
			
			$ADD_URL= U('Upload/shopImg_add');
			$this->assign('ADD_URL',$ADD_URL);
			
			$shop=D('shop')->field('shop_id,shop_name')->where('shop_id='.$add_id)->find();
			$this->assign('shop',$shop);
			$this->display('shop_add');
		}else{
			$this->error('非法操作!');
		}
	}
	
	public function  shopImg_add(){
		check_login();
		$id = I("post.shop_id",'','number_int');
		if($id ){
			$my_save_name = "shop_".$id."_".time();
			$mysave = $my_save_name;
			$config = array(
				'maxSize'    =>    5242880,
				'rootPath'   =>    './Upload/',
				'savePath'   =>    '',
				'saveName'   =>    $my_save_name,
				'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
				'autoSub'    =>    true,
				'subName'    =>    "shop/".$id,
			);
			//print_r($config);
			// 上传文件 
			$upload = new \Think\Upload($config);// 实例化上传类
			$info   =   $upload->upload();
			if(!$info) {// 上传错误提示错误信息
				$this->error($upload->getError());
			}else{// 上传成功
				$data['shop_id'] = $id;
				$data['shopimg_src'] = $info['photo']['savepath'].$info['photo']['savename'];
				$data['shopimg_date'] = time();
				
				$Img = D('shopimg')->add($data);
				$this->success('上传成功！','index.php?s=Admin/upload/shop_edit/edit_id/'.$id);
			}
		}else{
			$this->error("非法操作！");
		}
	}
	
	public function del(){
		check_login();
		check_level(3);
		
		$del_id = I("get.del_id",'','number_int');
		$shop_id = I("get.shop_id",'','number_int');
		
		if($del_id && $shop_id){
			$find = D('shopimg')->where('shopimg_id='.$del_id)->find();
			$src='./Upload/'.$find['shopimg_src'];
			 if (unlink($src)){
					D('shopimg')->where('shopimg_id='.$del_id)->delete();
					$this->success('删除成功','index.php?s=Admin/upload/shop_edit/edit_id/'.$shop_id);
			} else {
				$this->error('无此文件');
			}
			
			
		}else{
			$this->error('非法操作！');
		}
	}
	
	
	public function dish_index(){
			check_login();
			
			$NODE_URL = U("Upload/dish_add");
			$this->assign("node_add",$NODE_URL);
			
			
			$M_shop = M("dish");
			$count      = $M_shop->count();// 查询满足要求的总记录数
			$Page       = new \Think\Page($count,10);
			$Page->setConfig('header','共 <span style="font-weight:bold;color:#FF6600;"> %TOTAL_ROW% </span>条记录');
			$Page->setConfig('prev','上一页');
			$Page->setConfig('next','下一页');
			$Page->setConfig('prev','上一页');
			$Page->setConfig('theme','%HEADER% <span style="font-weight:bold;color:blue;">%NOW_PAGE%</span>/<span style="font-weight:bold;">%TOTAL_PAGE%</span>页  %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
			$show       = $Page->show();// 分页显示输出
			// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$list = $M_shop ->join('shop ON dish.shop_id = shop.shop_id')
							->order('shop.shop_id')->limit($Page->firstRow.','.$Page
							->listRows)->select();
			$this->assign('list',$list);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
			$this->display();
	}
	

	
	public function dish(){
		check_login();
		
		$edit_id = I('get.edit_id','','number_int');
		if($edit_id){
			
			
			$dish = D('dish')->where('dish_id='.$edit_id)->find();
			$this->assign('dish',$dish);
			
			$list = D('dishimg')->where('dish_id='.$edit_id)->select();
			$this->assign('list',$list);

			$this->assign("ADD_URL",U('Upload/shop_dish_img?add_id='.$edit_id));
			
			$this->display();
		}else{
			$this->error('非法操作!');
		}
	}
	
		public function shop_dish_img(){
		check_login();
		
		$add_id = I('get.add_id','','number_int');
		if($add_id){
			$NODE_URL = U("Upload/dish?edit_id=".$add_id);
			$this->assign("NODE_URL",$NODE_URL);
			
			$ADD_URL= U('Upload/dishImg_add');
			$this->assign('ADD_URL',$ADD_URL);
			
			$shop=D('dish')->field('dish_id,dish_name')->where('dish_id='.$add_id)->find();
			$this->assign('shop',$shop);
			
			$this->display('dish_add');
		}else{
			$this->error('非法操作!');
		}
	}
	
	public function dishImg_add(){
		check_login();
		$id = I("post.dish_id",'','number_int');
		if($id){
			$my_save_name = "dish_".$id."_".time();
			$mysave = $my_save_name;
			$config = array(
				'maxSize'    =>    3145728,
				'rootPath'   =>    './Upload/',
				'savePath'   =>    '',
				'saveName'   =>    $my_save_name,
				'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
				'autoSub'    =>    true,
				'subName'    =>    "dish/".$id,
			);
			//print_r($config);
			// 上传文件 
			$upload = new \Think\Upload($config);// 实例化上传类
			$info   =   $upload->upload();
			if(!$info) {// 上传错误提示错误信息
				$this->error($upload->getError());
			}else{// 上传成功
				$data['dish_id'] = $id;
				$data['dishimg_src'] = $info['photo']['savepath'].$info['photo']['savename'];
				
				$Img = D('dishimg')->add($data);
				$this->success('上传成功！','index.php?s=Admin/upload/dish/edit_id/'.$id);
			}
		}else{
			$this->error("非法操作！");
		}
	}
	
	public function dishimg_del(){
		check_login();
		check_level(3);
		
		$del_id = I("get.del_id",'','number_int');
		$dish_id = I("get.dish_id",'','number_int');
		if($del_id && $dish_id ){
			$find = D('dishimg')->where('dishimg_id='.$del_id)->find();
			$src='./Upload/'.$find['dishimg_src'];
			if (unlink($src)){
					D('dishimg')->where('dishimg_id='.$del_id)->delete();
					$this->success('删除成功','index.php?s=Admin/upload/dish/edit_id/'.$dish_id);
			} else {
				$this->error('无此文件');
			}
			
			
		}else{
			$this->error('非法操作！');
		}
	}
}
