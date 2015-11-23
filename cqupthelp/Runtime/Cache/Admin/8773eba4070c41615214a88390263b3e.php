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
    <a href="<?php echo U("Job/job_edit"); ?>"><button type="button" class="btn btn-success" >新增</button></a>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
         <th>兼职编号</th>
         <th>发布单位</th>
		 <th>应招地址</th>
         <th>发布时间</th>
		 <th>需求职位</th>
		 <th>报名方式</th>	
		 <th>工作内容</th>	
        <th>修改信息</th>
		
    </tr>
    </thead>
    
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
             <td><?php echo ($vo["job_id"]); ?></td>
			 <td><?php echo ($vo["job_company"]); ?></td>
             <td><?php echo ($vo["job_address"]); ?></td>
			 <td><?php echo ($vo["job_time"]); ?></td>
			 <td><?php echo ($vo["job_position"]); ?></td>
			  <td><?php echo (substr($vo["job_apply"],0,54)); ?>...</td>
			 <td><?php echo (substr($vo["job_content"],0,42)); ?>...</td>
            <td>
                  <a href="<?php echo U("Job/job_edit?edit_id=".$vo['job_id']); ?>">编辑</a> 
				  <a  onclick="return del()"  href="<?php echo U("Job/del?del_id=".$vo['job_id']); ?>">删除</a> 
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