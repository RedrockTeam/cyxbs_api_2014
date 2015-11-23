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
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>商店编号</th>
        <th>商店名称</th>	
        <th>修改信息</th>
		
    </tr>
    </thead>
	<?php $tem_id = -1;?>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <?php  if($tem_id!= $vo['shop_id']){ echo '<td><span style="font-size:20px;color:green;font-weight:bold;">'.$vo['shop_id'].'</span></td>'; echo '<td>'.$vo['shop_name'].'</td>'; $tem_id = $vo['shop_id']; }else{ echo '<td></td>
						 <td></td>'; } ?>
			</td>

            <td style="text-align:center;">
                  <a href="<?php echo U("Menu/shop_edit?edit_id=".$vo['shop_id']); ?>">进入本店编辑</a> 
            </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>
<div class="inline pull-right page" style="font-size:20px;"><?php echo ($page); ?></div>
</body>
</html>
<script>
    $(function () {
        
		$('#addnew').click(function(){

				window.location.href="<?php echo ($NODE_ADD_URL); ?>";
		 });


    });

	function del(id)
	{
		
		
		if(confirm("确定要删除吗？"))
		{
		
			var url = "inde12x.html";
			
			window.location.href=url;		
		
		}
	
	
	
	
	}
</script>