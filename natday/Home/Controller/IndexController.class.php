<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	
		check_login();
		
		$RANK_URL = U("Rank/index");
    	$this->assign("RANK_URL",$RANK_URL);
		
    	$LOGIN_URL = U("Login/index");
    	$this->assign("LOGIN_URL",$LOGIN_URL);
		
		$this->assign("my_login_name",session('login_name'));
    	
		
		$COMMENT_URL = U("Comment/index");
    	$this->assign("COMMENT_URL",$COMMENT_URL);
		
		
    	
		$this->display();
	}
	
	public function show_natDay(){
	
		$nat_url = U("rank/show_rank");
    	$this->assign("nat_url",$nat_url);
		
		$nat_url = U("index/show_natday");
    	$this->assign("show_natday",$nat_url);
		
		$data = D('scomment')->order("comment_id desc")->select();
		
		$this->assign("scomment",$data);
		
		$this->display("nat_day");
	}

}