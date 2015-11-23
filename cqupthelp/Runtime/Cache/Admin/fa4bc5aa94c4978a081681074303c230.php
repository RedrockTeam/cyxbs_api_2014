<?php if (!defined('THINK_PATH')) exit();?><!--
/**
 * 极光推送-V2. PHP服务器端
 */
-->
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="/cyxbs_api_2014/cqupthelp/Public/css/cyxbs_push.css" />
        <script src="/cyxbs_api_2014/cqupthelp/Public/js/jquery-1.8.1.min.js"></script>
           
        </script>     
    </head>
    <body>
    	<div class="head">
         <h1>message推送日志</h1>
		  <span><a href="<?php echo ($alert_index); ?>">alert推送</a></span>
         <span><a href="<?php echo ($message_index); ?>">message通知</a></span>
         <span><a href="">推送日志</a></span>
          <hr/>
        </div>    
     
				
      			<div class="container list">            
				 <ul class="devices">
					<li>
                        欢迎使用重邮小帮手推送平台!
                    </li>
                 <p style="font-weight:bold; color:#06F;"><span>序号</span><span style="width:150px;">发送时间</span><span >消息标题</span><span style="width:400px;">消息内容</span><span>发送账号</span><span>发送IP</span><span>推送类型</span></p>
						
						<?php if(is_array($message)): $i = 0; $__LIST__ = $message;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><p><span><?php echo ($vo["id"]); ?></span><span style="width:150px;"><?php echo ($vo["time"]); ?></span><span ><?php echo ($vo["title"]); ?></span><span style="width:400px;"><?php echo ($vo["content"]); ?></span><span><?php echo ($vo["push_user"]); ?></span><span><?php echo ($vo["send_ip"]); ?></span><span><?php echo ($vo["type"]); ?></span></p><?php endforeach; endif; else: echo "" ;endif; ?>
                    
                
            </ul>
			
            </div>
			<span style="float:right;margin:20px;margin-right:130px"><?php echo ($page); ?></span>
    </body>
</html>