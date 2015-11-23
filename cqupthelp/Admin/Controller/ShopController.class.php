<?php

	namespace Admin\Controller;
	use Think\Controller;
	class ShopController extends  Controller{
		
		/*
		 * 餐厅列表信息 ok
		 */
	    public function shopList(){
			
	    	$pid = I('post.pid');
	    	$pagenum = 15;
			$Shop =	M('shop');
			$shops = $Shop
						  ->field("shop.shop_id as id,shop.shop_name as name,shop.shop_address,shopimg.shopimg_src")
						  ->join("shopimg ON shopimg.shop_id = shop.shop_id")
						  ->group("shopimg.shop_id")
						  ->order("shop.shop_id asc")
						  ->limit($pagenum*($pid-1),$pagenum)
						  ->select();
			foreach ($shops as $key => $value) {
				$shops[$key]['shopimg_src'] = C('URL').$shops[$key]['shopimg_src'];
			}
			$data = array(
				'status'=>200,
				'info'=>'success',
				'data'=>$shops
			);
			echo $this->ajaxReturn($data);
	    }
	    
        
	    /*
	     * 餐厅详细信息 ok(pagecount)
	     */
	    public function shopInfo(){
	    	$shop_id = I('post.id');
	    	$Shop =	M('shop');
	    	$shop_info = $Shop->field()->where("shop_id = '$shop_id'")->select();//具体信息
	    	$ShopImg = M('shopimg');

	    	$Imgcount = $ShopImg->where("shop_id = '$shop_id'")->count();
	    	$Imgcount = $Imgcount - 1;//详情图片的张数

	    	$shop_img = array();//存放最终结果

	    	$temp = $ShopImg->where("shop_id = '$shop_id'")->limit(1,$Imgcount)->getField("shopimg_src",true);//详情图片
	    	foreach ($temp as $value) {
	    		$shop_img[] = C('URL').$value;
	    	}
	    	$Scomment = M('scomment');
	    	$comCount = $Scomment->where("shop_id = '$shop_id'")->count();
           $pageCount = (ceil($comCount / 5) == 0) ? 1 : ceil($comCount / 5);

	    	foreach ($shop_info as $v){
	    		$v['shop_image'] = $shop_img;
	    		$v['page_count'] =$pageCount;
	    	}

	    	$returnData = array(
	    		'status'=>200,
	    		'info'=>'success',
	    		'data'=>$v,
	    	);
	    	echo $this->ajaxReturn($returnData);
	    }  
	    
        
	    /*
	     * 餐厅菜单
	     */
	    public function menuList(){
            //$pid = I('post.pid');
	    	$shop_id = I('post.shop_id');
	    	$Dish = M('dish');
	    	$dishs = $Dish
	    				  ->field("dish.dish_id,dish.dish_name,dishimg.dishimg_src as dish_image,dish.dish_price,dish.dish_praise_count")
	    				  ->join("dishimg ON dishimg.dish_id = dish.dish_id")
	    				  ->where("shop_id = '$shop_id'")
                //->limit(($pid-1)*1,1)
	    				  ->group("dish_id")
	    				  ->order("dish_id asc")
	    				  ->select();
	    	foreach ($dishs as $key => $value) {
	    		$dishs[$key]['dish_image'] = C('URL').$dishs[$key]['dish_image'];
	    	}
	    	$returnData = array(
	    		'status'=>200,
	    		'info'=>'success',
	    		'data'=>$dishs,
	    	);
	    	echo $this->ajaxReturn($returnData);
	    }
	    
        
	    /*
	     * 菜品点赞
	     */
	    public function praise(){
	    	$dish_id = I('post.dish_id');
	    	$user_number = I('post.user_number');//session里取
	    	$user_password = I('post.user_password');//session里取
	    	$Praise = M('praise');
	    	$isPraise = $Praise->where("dish_id = '$dish_id' AND user_number = '$user_number' AND user_password = '$user_password'")->find();
	    	if ($isPraise) {
                //echo "不能重复点赞";
	    		$returnData = array(
    				'status'=>0,
    				'info'=>'不能重复点赞'
	    		);
	    		echo $this->ajaxReturn($returnData);
	    	}else {
	    		$data = array(
	    			'dish_id'=>$dish_id,
	    			'user_number'=>$user_number,
	    			'user_password'=>$user_password,
	    		);
	    		if ($Praise->add($data)) {
                    //echo "点赞成功";
	    			$Dish = M('dish');
	    			$Dish->where("dish_id = '$dish_id'")->setInc("dish_praise_count");
	    			$returnData = array(
	    				'status'=>200,
	    				'info'=>'success'
	    			);
	    			echo $this->ajaxReturn($returnData);
	    		}
	    	}
	    }
	    
        
	    /*
	     * 评论列表
	     */
	    public function comList(){
	    	$pid = I('post.pid');
	    	$pagenum = 5;
	    	$shop_id = I('post.shop_id');
	    	$Scomment = M('scomment');
	    	$scomments = $Scomment
	    						  ->field("comment_id,comment_content,comment_date,comment_author_name")
	    						  ->where("shop_id = '$shop_id'")
	    						  ->limit(($pid-1)*$pagenum,$pagenum)
                				  ->order("comment_date desc")
	    						  ->select();
	    	$returnData = array(
	    		'status'=>200,
	    		'info'=>'success',
	    		'data'=>$scomments,
	    	);
	    	echo $this->ajaxReturn($returnData);
	    }
	    
        
	    /*
	     * 对餐馆添加评论
	     */
	    public function addCom(){
	    	$data = array(
	    		'shop_id'=>I('post.shop_id'),
	    		'comment_content'=>I('post.comment_content'),
	    		'comment_date'=>time(),
	    		'comment_author_name'=>I('post.comment_author_name'),
	    		'user_number'=>I('post.user_number'),
	    		'user_password'=>I('post.user_password'),
	    	);
	    	$Scomment = M('scomment');
	    	if ($Scomment->add($data)) {
	    		$returnData = array(
	    			'status'=>200,
	    			'info'=>'success'
	    		);
	    		$this->ajaxReturn($returnData);
	    	}else {
	    		$returnData = array(
	    			'status'=>0,
	    			'info'=>'评论失败'
	    		);
	    		$this->ajaxReturn($returnData);
	    	}
	    }
	    

	    /*
	     * 兼职列表
	     */
	    public function jobList(){
	    	$Job = M('job');
	    	$pid = I('post.pid');
            $pageNum = 2; 
	    	$jobsCount = $Job->count();
	    	$jobs = $Job
	    				->field("job_id as id,job_company as name,job_address,job_time,job_content")
	    				->limit(($pid-1)*2,2)
	    				->select();
	    	$returnData = array(
	    		'status'=>200,
	    		'info'=>'success',
	    		'data'=>$jobs?$jobs:array(),
	    	);
	    	echo $this->ajaxReturn($returnData);
	    }
        

	    /*
	     * 兼职详细信息
	     */
	    public function jobInfo(){
	    	$Job = M('job');
	    	$job_id = I('post.id');
	    	$jobs = $Job
				    	->field("")
						->where("job_id = '$job_id'")
				    	->find();
	    	$returnData = array(
	    			'status'=>200,
	    			'info'=>'success',
	    			'data'=>$jobs,
	    	);
	    	echo $this->ajaxReturn($returnData);
	    }
	    

	    /**
	     * [shake description]
	     * @return [type] [description]
	     */ 
	    public function shake(){
	    	$Shop = M('shop');
	    	$ShopImg = M('shopimg');
	    	// $first = $Shop->order("shop_id asc")->limit(1)->getField("shop_id");
	    	// $last = $Shop->order("shop_id desc")->limit(1)->getField("shop_id");
	    	$allId = $Shop->getField('shop_id',true);
	    	$allId = array_flip($allId);
	    	$id = array_rand($allId,1);
	    	// $id = mt_rand($first,$last);
	    	$shop_info = $Shop->field("shop_id as id,shop_name as name,shop_address as address")->where("shop_id = '$id'")->find();
	    	$shop_img = $ShopImg->field("shopimg_src")->where("shop_id = '$id'")->order("shopimg_date asc")->limit(1)->getField("shopimg_src");
	    	foreach ($shop_info as $key => $value) {
	    		$shop_info['img'] = C('URL').$shop_img;
	    	}
	    	$returnData = array(
    			'status'=>200,
    			'info'=>'success',
    			'data'=>$shop_info,
	    	);
	    	echo $this->ajaxReturn($returnData);
	    }
	    
	    /**
	     * [test description]
	     * @return [type] [description]
	     */
	    public function test(){
	    	// $ShopImg = M('shopimg');
	    	// $temp = array();
	    	// $shop_img = $ShopImg->where("shop_id = '24'")->getField("shopimg_src",3);//具体图片
	    	// foreach ($shop_img as $value) {
	    	// 	// $value = C('URL').$value;
	    	// 	$temp[] = C('URL').$value;
	    	// }
	    	// print_r($temp);
	    		// $Scomment = M('scomment');
	    		// $Scomment->where("comment_id = 17")->delete();
	    	// $ShopImg = M('shopimg');
	    	
	    	// $ShopImg = M('shopimg');
	    	// // $Imgcount = $ShopImg->where("shop_id = 24")->count();
	    	// // $Imgcount = $Imgcount - 1;
	    	
	    	// $shop_img = array();
	    	$m = M('shopimg');
	    	print_r($m->select());
	    	// $m->query("drop table shopimg");
	    	// $sql = "select shopimg_src from shopimg where shop_id = 24 limit 1,2";
	    	// $temp = $ShopImg->where("shop_id = '$shop_id'")->getField("shopimg_src",3);//具体图片
	    	
	    	// $sql = "select shopimg_src from shopimg where shop_id = 24 limit 1,{$Imgcount}";
	    	
	    	// $temp = $ShopImg->query($sql);//具体图片
	    	// // print_r($temp);
	    	// foreach ($temp as $key=> $value) {
	    	// 	$shop_img[$key]['shopimg_src'] = C('URL').$shop_img[$key]['shopimg_src'];
	    	// }
	    	// $temp = $ShopImg->where("shop_id = '24'")->limit(1,$Imgcount)->getField("shopimg_src",true);
	    	// print_r($temp);
	    }
		
		/*
		*by Orange.W
		*date 2014.09.12
		*for  cyxbs_api suggestion
		*
		*/
		
		public function registSuggestion(){
			$paw = I("post.paw");
			$data['deviceInfo'] = I('post.deviceInfo');
			$data['content'] = I('post.content');
			if( $paw == "cyxbs_suggestion" && $data['deviceInfo'] && $data['content'] ){
			
				D('cyxbs_suggestion')->add($data);
				$returnData = array(
    			'status'=>200,
    			'info'=>'success',
	    	   );
				
			}else{
				$returnData = array(
    			'status'=>0,
    			'info'=>'false',
				'error'=>'lack the suggestion passworad or suggestion content',
	    	   );
			}
			$this->ajaxReturn($returnData);
		}
	    
	    
	    
	    
	    
	    
	    
	    
	}
?>
