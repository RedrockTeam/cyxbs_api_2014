<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html>
<head>
    <title>后台管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/cyxbs_api_2014/cquptHelp/Public/css/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="/cyxbs_api_2014/cquptHelp/Public/css/bui-min.css" rel="stylesheet" type="text/css" />
    <link href="/cyxbs_api_2014/cquptHelp/Public/css/main-min.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="header">

    <div class="dl-title">
        <!--<img src="/cyxbs_api_2014/cquptHelp/Public/img/top.png">-->
    </div>

    <div class="dl-log">欢迎您，<span class="dl-log-user">root</span><a href="<?php echo ($LOGIN_URL); ?>" title="退出系统" class="dl-log-quit">[退出]</a>
    </div>
</div>
<div class="content">
    <div class="dl-main-nav">
        <div class="dl-inform"><div class="dl-inform-title"><s class="dl-inform-icon dl-up"></s></div></div>
        <ul id="J_Nav"  class="nav-list ks-clear">
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-home">商店信息</div></li>		
			  <li class="nav-item dl-selected"><div class="nav-item-inner nav-order">评论管理</div></li>
			  <li class="nav-item dl-selected"><div class="nav-item-inner nav-order">兼职管理</div></li>
        </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>
</div>
<script type="text/javascript" src="/cyxbs_api_2014/cquptHelp/Public/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="/cyxbs_api_2014/cquptHelp/Public/js/bui-min.js"></script>
<script type="text/javascript" src="/cyxbs_api_2014/cquptHelp/Public/js/common/main-min.js"></script>
<script type="text/javascript" src="/cyxbs_api_2014/cquptHelp/Public/js/config-min.js"></script>
<script>
	var Node = '<?php echo ($NODE_URL); ?>';
	var Comment = '<?php echo ($COMMENT_URL); ?>';
	var Menu = '<?php echo ($MENU_URL); ?>';
	var Upload_shop = '<?php echo ($UPLOAD_SHOP_URL); ?>';
	var Upload_dish = '<?php echo ($UPLOAD_DISH_URL); ?>';
	var Job = '<?php echo ($JOB_URL); ?>';
    BUI.use('common/main',function(){
        var config = [{id:'1',menu:[
                                    {text:'系统管理',items:[{id:'2',text:'信息管理',href:Node },
                                    {id:'3',text:'餐馆菜单',href:Menu},{id:'4',text:'商店图片',href:Upload_shop},
                                    {id:'5',text:'菜单图片',href:Upload_dish}]}]},
        {id:'7',homePage : "",menu:[
                                    {text:'管理',items:[{id:'9',text:'评论信息',href:Comment}]}]},
        {id:'10',homePage : "",menu:[
                                    {text:'兼职管理',items:[{id:'11',text:'兼职信息',href:Job}]}]}];
        new PageUtil.MainPage({
            modulesConfig : config
        });
    });
</script>
</body>
</html>