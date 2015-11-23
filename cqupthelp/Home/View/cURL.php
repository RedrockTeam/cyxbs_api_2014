<?php
header('Content-Type:application/json; charset=utf-8');
if(1){//isset($_POST['user'])&&isset($_POST['pass'])
	$user = "a1234567@163.com";
	$pass = "a1234567";
	//$user = $_POST['user'];
//	$pass = $_POST['pass'];
	$curlPost = "email=".$user."&password=".$pass."&rememberme=y";


	$web1 = "www.zhihu.com/login";

	 $header = array(
				'Content-Type: application/json',
			);

	// 初始化一个curl对象	
	$curl = curl_init();

	// 设置url
	curl_setopt($curl,CURLOPT_URL,$web1);

	// 设置参数，输出或否
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

	// 设置编码
	//curl_setopt($curl, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));

	// 模拟用户使用的浏览器
	 curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
	 
	 // 使用自动跳转
	// curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); 

	//数据
	curl_setopt($curl,CURLOPT_POSTFIELDS,$curlPost);

	//temp
	$cookie_jar = tempnam('./mytemp','cookie');
	curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_jar);


	// 运行curl，获取网页。
	$contents = curl_exec($curl);

	// 关闭请求
	curl_close($curl);


	//跳转


	/*重定向*/

	$url='http://www.zhihu.com/';
	$curl = curl_init($url);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curl, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));
	curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
	curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_jar);
	$contents2 = curl_exec($curl);

	/*先全切*/
	preg_match_all('/<div class="feed-item-inner">([\s\S]+?)<\/div>\n<\/div>\n<\/div>/',$contents2,$arr,PREG_PATTERN_ORDER);
	curl_close($curl);

	//print_r($arr[0]);
	/*分块：time action img link title content*/
	for($i=0;$i<count($arr[0]);$i++){
		//匹配 time
		preg_match('/<span class="time" data-timestamp="\d{13}">([\s\S]+?)<\/span>/' ,$arr[0][$i],$temp);
		$data[$i]['time'] = $temp[1];//去重<span class="zm-item-link-avatar">([\s\S]+?)<\/span>
		
		
		//匹配 action
		preg_match('/<div class="source">([\s\S]+?)<span/' ,$arr[0][$i],$temp);
		$data[$i]['action'] = $temp[1];//去重|(<img title="(\S+)" class="zm-item-img-avatar" src="(\S+)"\/>)
		
		
		//匹配 img
		preg_match('/(<img src="(\S+)" class="zm-item-img-avatar">)/' ,$arr[0][$i],$temp);
		if($temp){
			$data[$i]['img'] = $temp[2];//非匿名图片
		}else{
			$data[$i]['img'] = "http://pic4.zhimg.com/aadd7b895_m.jpg";//匿名的默认图片
		}
		
		//匹配 link title
		preg_match('/(<a class="question_link" target="_blank" href="(\S+)">([\s\S]+?)<\/a>)|(<a target=\'_blank\' class="post-link" href="(\S+)">([\s\S]+?)<\/a>)/' ,$arr[0][$i],$temp);
		if($temp[3]!=''){
			$data[$i]['title'] = $temp[3];//匹配 title
		}else{
			$data[$i]['title'] = $temp[6];
		}
		$data[$i]['link'] = "http://www.zhihu.com". $temp[2];//匹配 link
		//print_r($temp);
		

		
		//匹配 content
		preg_match('/<textarea class="content hidden">([\s\S]+?)<\/textarea>/' ,$arr[0][$i],$temp);
		$data[$i]['content'] = ($temp[1]);//去重
		
		
	}
	
	
	echo (json_encode($data, JSON_FORCE_OBJECT));//JSON_FORCE_OBJECT：强制格式 
	
}else{
	echo '错误的操作.';
}




