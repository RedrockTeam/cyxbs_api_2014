<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	
		check_login();
		
    	$LOGIN_URL = U("Login/index");
    	$this->assign("LOGIN_URL",$LOGIN_URL);
		
		$this->assign("my_login_name",session('login_name'));
    	
		
		$COMMENT_URL = U("Comment/index");
    	$this->assign("COMMENT_URL",$COMMENT_URL);
		
		$MENU_URL = U("Menu/index");
    	$this->assign("MENU_URL",$MENU_URL);
		
		$NODE_URL = U("Node/index");
		$this->assign("NODE_URL",$NODE_URL);
		
		$MENU_URL = U("Upload/shop_index");
    	$this->assign("UPLOAD_SHOP_URL",$MENU_URL);
		
		$MENU_URL = U("Upload/dish_index");
    	$this->assign("UPLOAD_DISH_URL",$MENU_URL);
		
    	$MENU_URL = U("Job/index");
    	$this->assign("JOB_URL",$MENU_URL);
		
		$MENU_URL = U("Push/alert_index");
    	$this->assign("push_alert",$MENU_URL);
		
		$MENU_URL = U("Push/message_index");
    	$this->assign("push_message",$MENU_URL);
		
		$MENU_URL = U("Suggestion/index");
    	$this->assign("suggestion_url",$MENU_URL);
    	
		$this->display();
	}
	
	

}