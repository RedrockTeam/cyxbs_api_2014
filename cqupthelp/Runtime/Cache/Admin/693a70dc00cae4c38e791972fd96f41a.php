<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/cyxbs_api_2014/cqupthelp/Public/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/cyxbs_api_2014/cqupthelp/Public/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/cyxbs_api_2014/cqupthelp/Public/css/style.css" />
    <script type="text/javascript" src="/cyxbs_api_2014/cqupthelp/Public/js/jquery.js"></script>
   <!--<script type="text/javascript" src="/cyxbs_api_2014/cqupthelp/Public/js/jquery.sorted.js"></script>-->
    <script type="text/javascript" src="/cyxbs_api_2014/cqupthelp/Public/js/bootstrap.js"></script>
    <script type="text/javascript" src="/cyxbs_api_2014/cqupthelp/Public/js/ckform.js"></script>
    <script type="text/javascript" src="/cyxbs_api_2014/cqupthelp/Public/js/common.js"></script> 
    
    
    <link rel="stylesheet"  href="/cyxbs_api_2014/cqupthelp/Public/editor/themes/simple/simple.css" />
    <script charset="utf-8" src="/cyxbs_api_2014/cqupthelp/Public/editor/kindeditor.js"></script>
	<script charset="utf-8" src="/cyxbs_api_2014/cqupthelp/Public/editor/lang/zh_CN.js"></script>
	<script>
	 var editor;
     KindEditor.ready(function(K) {
             editor = K.create('#editor_id', {themeType : 'simple'});
             editor = K.create('#editor_id2', {themeType : 'simple'});
             
     });
	</script>

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
<form action="<?php echo ($NODE_EDIT); ?>" method="post" class="definewidth m20">
<input type="hidden" name="id" value="" />
<table class="table table-bordered table-hover ">
	<tr>
        <td width="10%" class="tableleft">兼职编号</td>
        <td>
        	<input type="text" name="job_id" value="<?php echo ($this_id); ?>" style="display:none;"/>
        	<span style="font-weight:bold;font-size:20px;color:blue;margin-left:5px;">
        	<?php if($this_id != -1){ echo $this_id; }else{ echo '新增'; }?>
            </span>
        </td>
    </tr>
    <tr>
        <td width="10%" class="tableleft">发布单位</td>
        <td><input type="text" name="job_company" value="<?php echo ($edit_list['job_company']); ?>" required="true"/></td>
    </tr>
	
    <tr>
        <td class="tableleft">应招地址</td>
        <td ><input type="text" name="job_address" value="<?php echo ($edit_list['job_address']); ?>" required="true"/></td>
    </tr>  
	 <tr>
        <td class="tableleft">发布时间</td>
        <td ><input type="text" name="job_time" value="<?php echo ($edit_list['job_time']); ?>" required="true"/><span>格式:(2014-12-03)</span></td>
    </tr>  
	 <tr>
        <td class="tableleft">需求职位</td>
        <td ><input type="text" name="job_position" value="<?php echo ($edit_list['job_position']); ?>" required="true"/></td>
    </tr>  
    <tr>
        <td class="tableleft">报名方式</td>
        <td ><input type="text" name="job_apply" value="<?php echo ($edit_list['job_apply']); ?>" required="true"/></td>
    </tr>  
	<tr>
        <td class="tableleft">工作内容</td>
        <td >
        	<textarea id="job_content" name="job_content" style="width:700px;height:300px;" required="true"><?php echo ($edit_list['job_content']); ?></textarea>
		</td>
    </tr>  
	

    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button">保存</button> &nbsp;&nbsp;<button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
        </td>
    </tr>
</table>
</form>
</body>
</html>
<script>
    $(function () {       
		$('#backid').click(function(){
				window.location.href="<?php echo ($NODE_URL); ?>";
		 });

    });
</script>