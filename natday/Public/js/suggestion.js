var inputNum = 0;

function sendReply(){
	var formData=$("#all").serialize();
	//alert(formData);
	
	$.ajax({
	  type: "POST",
	  url: post_url,
	  processData:true,
	  data:formData,
	  success: function(data){
	   alert(data);
	  }
	 });
	return false;
}

function addInput(){
	
	if(inputNum>=9)
	{
		alert("你在逗我吗，乱加参数很好玩吗！(#‵′)凸");
	}else{
	
	inputNum += 1;
	var dom = '<div id="cusOuter'+ inputNum +'">Name'+ inputNum +'：<input name="cus'+ inputNum +'" /> Content'+ inputNum +'：<input name="cusContent'+ inputNum +'"/></div>'
	$('#cusBox').append(dom);
	//alert(inputNum);
	
	}
}

function delInput(){
	if(inputNum <=0 )
	{
		alert("遇见逗比了，喵=W=\n都全没了~");
	}else{
	$('#cusOuter'+ inputNum).remove(); //保留事件行为的删除

	//alert(inputNum);
	inputNum -= 1;
	
	}
}