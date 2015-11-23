

var t_img; // 定时器
var isLoad = true; // 控制变量
$bubble = $(".bubble");
bool = 1;
Bool = 1;
time = 0;
counter=0;

function timedCount()
{
    time += 0.1;
    setTimeout("timedCount()",100) ;
}
function stopCount()
{
    clearTimeout(time);
}

// 判断图片加载状况，加载完成后回调
isImgLoad(function(){
    $click = $(".click");
    click2 = document.getElementsByClassName("click")[0];
    //var $flag = $(".flag img");


    height=$('.flag').offset().top;//末位置
    height_end=$('.flag_g').offset().top;//初位置
    distance_all=(height-height_end)/15;

    $("header span").click(function(){
        history.go(-1);
    });

    $("#up").on('click', function(e){
        e.stopPropagation();
        e.preventDefault();
        $('html, body').animate({scrollTop:0}, 'slow');
    });

    // $click.bind("touchstart",
    	function chan(){
        var img=$(".flag");
        //    if(toBack)clearTimeout(toBack);
        if(Bool){
            if(bool){
                bool = 0;
                timedCount();
            }

            if(height <= height_end){
                height = height_end;
                Bool = 0;
                stopCount();
                //            $('.button_img').attr('src','img/button2.png');
                //			$bubble.fadeIn(1000);
            }else{
                height -= distance_all;
            }
            if(!Bool){
                // alert(time);
                $.ajax({
                    type: "POST",
                    url: nat_url = 'http://hongyan.cqupt.edu.cn/cyxbs_api_2014/natday/index.php?s=/home/rank/show_rank',
                    data: {
                        stu_name:"匿名",
                        use_time:time
                    },
                    dataType: null,
                    success: function(data){
                        if(data.status == 200){
                            $(".name").html(data.all);
                            $(".rank").html(data.rank);
                            $(".time").html(time.toFixed(2));
                            $bubble.fadeIn(1000);
                            $('.button_img').attr('src','img/button2.png');
                            //                        $('.button_img').click(function(){
                            if(!Bool )$('.show').css('display','block');
                            //                        })
                            document.title = "'庆国庆 升国旗':我用时" + time.toFixed(2) + "秒，排" + data.rank + "名，大家快来一起升国旗吧~";
                        }else{
                            alert("网络异常，请稍后重试。");
                        }
                    }
                });
            }
            function upFlag() {
                var nowTop = img.offset().top;//现在所处的位置
                var endTop = height;//最终位置
                var distance = (nowTop - endTop);//现在位置到终点的距离
                if(distance>0.1) {
                    img.offset(function (index, current) {
                        return {left: current.left, top: current.top - distance / 10};
                    });
                    toBack=setTimeout(upFlag,20);
                }
                else{
                    img.offset(function (index, current) {
                        return {left: current.left, top: endTop};
                    });
                }
            }
            upFlag();
            counter+=1;
            //		$flag.animate({top:height},{queue:false},100);//show
        }
    }
//    )
    if (window.navigator.msPointerEnabled) {
        /*Events for IE only*/
        click2.addEventListener("MSPointerOver", function () {
            /*Add mouse over event for touch*/
            chan();
        });
    }
    else{
        click2.addEventListener("touchstart",function(){
            chan();
        });
    }
});

// 判断图片加载的函数
function isImgLoad(callback){
    // 注意我的图片类名都是cover，因为我只需要处理cover。其它图片可以不管。
    // 查找所有封面图，迭代处理
    $('img').each(function(){
        // 找到为0就将isLoad设为false，并退出each
        if(this.height === 0){
            isLoad = false;
            return false;
        }
    });
    // 为true，没有发现为0的。加载完毕
    if(isLoad){
        clearTimeout(t_img); // 清除定时器
        // 回调函数
        callback();
        // 为false，因为找到了没有加载完成的图，将调用定时器递归
    }else{
        isLoad = true;
        t_img = setTimeout(function(){
            isImgLoad(callback); // 递归扫描
        },500); // 我这里设置的是500毫秒就扫描一次，可以自己调整
    }
}








//        document.onreadystatechange = subSomething();//当页面加载状态改变的时候执行这个方法.
//        function subSomething()
//        {
//            if(document.readyState == "complete") //当页面加载状态
//            {
//}
//
//}


