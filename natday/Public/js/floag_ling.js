!function () {
    var nowStep = 0,
        endStep = 10;
    var startTime, endTime, block;
    FastClick.attach(document.body);
    $('.btn-up').on('click', function (e) {
        if (nowStep == 0) {
            startTime = +new Date();
        }

        nowStep++;
        if (nowStep >= endStep) {
            endTime = +new Date();
            if(block) return false;
            block = true;
            $.ajax({
                type: "POST",
                url: 'http://hongyan.cqupt.edu.cn/cyxbs_api_2014/natday/index.php?s=/home/rank/show_rank',
                data: {stu_name: openid, use_time: endTime - startTime},
                success: uploadRankHandler
            });
        }

        $('.flag').css({
            top: ( 70 - nowStep * 7 )+ "%"
        });
        
    });

    function uploadRankHandler(data){
        if(data.status == 200){
            $(".name").html(data.all);
            $(".rank").html(data.rank);
            $(".time").html(    (endTime - startTime)/1000    );
            $('.bubble').show();
            // $('.button_img').attr('src','img/button2.png');
            $('.shareTip').show();
            document.title = '"庆国庆, 升国旗, 比排名, 赢大奖! ":我用时' + ((endTime - startTime)/1000) + '秒，排第' + data.rank + '名，大家快来一起升国旗吧~';
        }else{
            console.log(data);
            alert("网络异常，请稍后重试。");
            // alert(JSON.stringify(data) + openid);
        }
    }
    $('.btn-retry').on('click', function () {
        location.reload();
    });
    $('.btn-start').on('click', function () {
        $(this).hide();
        $('.btn-up').show();
        document.body.scrollTop = $('#cyxbs').offset().top - $('html')[0].clientHeight;
    });
}();