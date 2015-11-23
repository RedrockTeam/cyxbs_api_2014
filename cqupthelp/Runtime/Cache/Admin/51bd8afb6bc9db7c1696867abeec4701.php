<?php if (!defined('THINK_PATH')) exit();?><!--
/**
 * 极光推送-V3. PHP服务器端
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
         <h1>alert推送管理</h1>
         <span><a href="<?php echo ($message_index); ?>">alert推送</a></span>
         <span><a href="<?php echo ($message_show); ?>">推送日志</a></span>
          <hr/>
        </div>    
   
        <div class="container">            
            
            <ul class="devices">            
                 <li>
                <form id="all" method="post"  action="<?php echo ($alert_push); ?>">  
                 <p><label>弹框内容:</label>                   
                <textarea rows="3" name="content" cols="105" class="content" placeholder="Type message here"></textarea><p>
               	<p><input type="submit" class="send_btn" value="Send" onclick=""/></p>
                 </form>    
                </li>
                <li>
                <h3>回馈信息：</h3>
                <div class="info">
                </div>
            </ul>
           </div>   
    </body>
</html>