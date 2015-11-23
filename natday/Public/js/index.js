var height = 436;
var $click = $(".click");
var $flag = $(".flag img");
var $bubble = $(".bubble");
var bool = 1;
var Bool = 1;
var time = 0;
var $send_m = $("#send_m");;

function timedCount()
{
	time += 0.1;
	setTimeout("timedCount()",100) ;
}
function stopCount()
{
	clearTimeout(time);
}


$click.click(function(){
	if(Bool){
		if(bool){
			bool = 0;
			timedCount();
		}
		if(height <= 16){
			height = 16;
			Bool = 0;
			stopCount();
			
		}else{
			height -= 28;
		}
		if(!Bool){
			// alert(time);
			 $.ajax({
             type: "POST",
             url: nat_url,
             data: {
				stu_name:"匿名",
				use_time:time
			},
             dataType: null,
             success: function(data){
                       if(data.status == 200){
							$("#num").html(data.all);
							$("#rank").html(data.rank);
							$("#yourTime").html(time.toFixed(2));	
							$bubble.fadeIn(1000);
							
						}else{
							alert("网络异常，请稍后重试。");
						}
                      }
         });
		}
		$flag.animate({top:height},{queue:false},100);//show
		
	}
});

$send_m.click(function(){
	var send_content = $("#the_name").val();
	var send_content = $("#the_comment").val();
	
});

$("header span").click(function(){
	history.go(-1);
});

$("#up").on('click', function(e){
	e.stopPropagation();
	e.preventDefault();
	$('html, body').animate({scrollTop:0}, 'slow');
});

