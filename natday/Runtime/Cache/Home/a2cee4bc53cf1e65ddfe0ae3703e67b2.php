<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html>
<head>
    <title>后台管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/cyxbs_api_2014/natday/Public/css/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="/cyxbs_api_2014/natday/Public/css/bui-min.css" rel="stylesheet" type="text/css" />
    <link href="/cyxbs_api_2014/natday/Public/css/main-min.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="header">

    <div class="dl-title">
        <!--<img src="/cyxbs_api_2014/natday/Public/img/top.png">-->
    </div>

    <div class="dl-log">欢迎您，<span class="dl-log-user"><?php echo ($my_login_name); ?></span><a href="<?php echo ($LOGIN_URL); ?>" title="退出系统" class="dl-log-quit">[退出]</a>
    </div>
</div>
<div class="content">
    <div class="dl-main-nav">
        <div class="dl-inform"><div class="dl-inform-title"><s class="dl-inform-icon dl-up"></s></div></div>
        <ul id="J_Nav"  class="nav-list ks-clear">
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-home">爱国小能手</div></li>		
			 
        </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>
</div>
<script type="text/javascript" src="/cyxbs_api_2014/natday/Public/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="/cyxbs_api_2014/natday/Public/js/bui-min.js"></script>
<script type="text/javascript" src="/cyxbs_api_2014/natday/Public/js/common/main-min.js"></script>
<script type="text/javascript" src="/cyxbs_api_2014/natday/Public/js/config-min.js"></script>
<script>
	var Node = '<?php echo ($RANK_URL); ?>';
	var Comment = '<?php echo ($COMMENT_URL); ?>';
    BUI.use('common/main',function(){
        var config = [
				{id:'1',menu:[
                                    {text:'管理后台',items:[
										{id:'2',text:'升旗rank',href:Node },
										{id:'3',text:'评论管理',href:Comment}
									]}
							 ]}												
		];
        new PageUtil.MainPage({
            modulesConfig : config
        });
    });
</script>
</body>
</html>