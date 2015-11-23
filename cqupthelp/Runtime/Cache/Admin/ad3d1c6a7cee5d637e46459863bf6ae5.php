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
<form action="<?php echo ($ADD_URL); ?>" method="post" class="definewidth m20">
<input type="hidden" name="id" value="" />
<table class="table table-bordered table-hover ">
    <tr>
        <td width="10%" class="tableleft">商店编号</td>
        <td><input type="text" name="shop_id" value="<?php echo ($shop["shop_id"]); ?>" style="display:none;"/><span style="font-weight:bold;font-size:20px;color:blue;margin-left:5px;"><?php echo ($shop["shop_id"]); ?></span></td>
    </tr>
	 <tr>
        <td class="tableleft">商店名称</td>
        <td ><span style="font-weight:bold;font-size:20px;color:blue;margin-left:5px;"><?php echo ($shop["shop_name"]); ?></span></td>
    </tr>  
	 <tr>
        <td class="tableleft">菜名</td>
        <td ><input type="text" name="dish_name" value="" required="true"/></td>
    </tr>  
	<tr>
        <td class="tableleft">价格 </td>
        <td >
        	<input type="text" name="dish_price" value="" required="true"/>
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