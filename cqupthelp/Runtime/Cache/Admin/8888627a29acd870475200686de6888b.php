<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/cyxbs_api_2014/cqupthelp/Public/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/cyxbs_api_2014/cqupthelp/Public/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/cyxbs_api_2014/cqupthelp/Public/css/style.css" />
    <script type="text/javascript" src="/cyxbs_api_2014/cqupthelp/Public/js/jquery.js"></script>
    <script type="text/javascript" src="/cyxbs_api_2014/cqupthelp/Public/js/jquery.sorted.js"></script>
    <script type="text/javascript" src="/cyxbs_api_2014/cqupthelp/Public/js/bootstrap.js"></script>
    <script type="text/javascript" src="/cyxbs_api_2014/cqupthelp/Public/js/ckform.js"></script>
    <script type="text/javascript" src="/cyxbs_api_2014/cqupthelp/Public/js/common.js"></script>

    <style type="text/css">
        body {
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }

        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }


    </style>
</head>
<body>
<form class="form-inline definewidth m20" action="index.html" method="get">  
    搜索引擎：
    <input type="text" name="rolename" id="rolename"class="abc input-default" placeholder="" value="">&nbsp;&nbsp;  
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp;
    <a href="<?php echo ($ADD_URL); ?>"><button type="button" class="btn btn-success" >新增</button></a>
</form>
<div class="form-inline definewidth m20">
	<strong style="font-size:20px">
	店名：
		<span style="font-weight:bold;font-size:20px;color:blue;margin-right:25px;"><?php echo ($shop_thing["shop_name"]); ?></span>
	编号：
		<span style="font-weight:bold;font-size:20px;color:blue;"><?php echo ($shop_thing["shop_id"]); ?></span>
	</strong>
</div>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
		<th>本页编号</th>
        <th>菜名编号</th>
        <th>菜名</th>
		 <th>价格</th>
		<th>操作</th>
    </tr>
    </thead>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
			 <td><?php echo $i;?></td>
			  <td><?php echo ($vo["dish_id"]); ?></td>
			  <td><?php echo ($vo["dish_name"]); ?></td>
			  <td><?php echo ($vo["dish_price"]); ?></td>
            <td>
                  <a href="<?php echo U("Menu/dish_edit?edit_id=".$vo['dish_id']."&shop_id=".$shop_thing['shop_id']); ?>">编辑</a> 
				  <a   onclick="return del()"  href="<?php echo U("Menu/del?del_id=".$vo['dish_id']."&shop_id=".$shop_thing['shop_id']); ?>">删除</a> 
            </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>
<div class="inline pull-right page" style="font-size:20px;"><?php echo ($page); ?></div>
</body>
</html>
<script>

	
	function del()
	{
		
		
		if(confirm("确定要删除吗？"))
		{
		
			return true;	
		
		}else{
			return false;
		}
	
	
	
	
	}
</script>