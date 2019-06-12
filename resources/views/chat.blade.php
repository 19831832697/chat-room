<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css">
        .talk_con{
            width:600px;
            height:500px;
            border:1px solid #666;
            margin:50px auto 0;
            background:#f9f9f9;
        }
        .talk_show{
            width:580px;
            height:420px;
            border:1px solid #666;
            background:#fff;
            margin:10px auto 0;
            overflow:auto;
        }
        .talk_input{
            width:580px;
            margin:10px auto 0;
        }
        .whotalk{
            width:80px;
            height:30px;
            float:left;
            outline:none;
        }
        .talk_word{
            width:420px;
            height:26px;
            padding:0px;
            float:left;
            margin-left:10px;
            outline:none;
            text-indent:10px;
        }
        .talk_sub{
            width:56px;
            height:30px;
            float:left;
            margin-left:10px;
        }
        .atalk{
            margin:10px;
        }
        .atalk span{
            display:inline-block;
            background:#0181cc;
            border-radius:10px;
            color:#fff;
            padding:5px 10px;
        }
        .btalk{
            margin:10px;
            text-align:right;
        }
        .btalk span{
            display:inline-block;
            background:#ef8201;
            border-radius:10px;
            color:#fff;
            padding:5px 10px;
        }
    </style>
    {{--<script type="text/javascript">--}}
        {{--window.onload = function(){--}}
            {{--var Words = document.getElementById("words");--}}
            {{--var Who = document.getElementById("who");--}}
            {{--var TalkWords = document.getElementById("talkwords");--}}
            {{--var TalkSub = document.getElementById("talksub");--}}

            {{--TalkSub.onclick = function(){--}}
                {{--//定义空字符串--}}
                {{--var str = "";--}}
                {{--if(TalkWords.value == ""){--}}
                    {{--// 消息为空时弹窗--}}
                    {{--alert("消息不能为空");--}}
                    {{--return;--}}
                {{--}--}}
                {{--if(Who.value == 0){--}}
                    {{--//如果Who.value为0n那么是 A说--}}
                    {{--str = '<div class="btalk"><span>myself说 :' + TalkWords.value +'</span></div>';--}}
                {{--}--}}
                {{--else{--}}
                    {{--str = '<div class="atalk"><span>B说 :' + TalkWords.value +'</span></div>' ;--}}
                {{--}--}}
                {{--Words.innerHTML = Words.innerHTML + str;--}}
            {{--}--}}
        {{--}--}}
    {{--</script>--}}
</head>
<body>
<input type="hidden" name="user_id" id="user_id" value="{{$user_id}}">
<div align="center">
    <h1>欢迎来到聊天室</h1>
</div>
<div class="talk_con">
    <div class="talk_show" id="msg">
        <div class="atalk"><span id="asay"></span></div>
        <div class="btalk"><span id="bsay"></span></div>
    </div>
    <input type="text" name="content" id="content">
    <input type="button" value="发送" id="btn"><hr/>
    <div class="talk_input">
        <select class="whotalk" id="who">
            <option value="0">myself</option>
            {{--<option value="1"></option>--}}
        </select>
    </div>
</div>

</body>
</html>
<script src="js/jquery.js"></script>
<script>
    //初始化
    var ws_server='ws://swoole.ffddd.top:9502';
    var ws=new WebSocket(ws_server);
    //建立web连接
    ws.onopen=function(){
        //绑定事件
        $(document).on('click','#btn',function(){
            var content=$('#content').val();
            var data={
                type:"message",
                text:content,
                id:1,
                date:Date.now()
            };
            ws.send(JSON.stringify(data));
        })

    }
    //接收服务器发送的数据
    ws.onmessage=function(d){
        var str=d.data;
        var arr=JSON.parse(str);
        //转化成对象
        // var arr = $.parseJSON(d.data);
        $("#msg").append(arr.text).append("<br/>");
        // document.getElementById("msg").innerHTML=d.data
    }
    console.log(ws);
</script>




{{--<script>--}}
    {{--$(document).ready(function(){--}}
        {{--$('.talk_show').empty();--}}
        {{--$(document).on('click','#talksub',function () {--}}
            {{--var user_id=$('#user_id').val();--}}
            {{--var TalkWords = document.getElementById("talkwords");--}}
            {{--$.ajax({--}}
                {{--url:"chatDo",--}}
                {{--method:"POST",--}}
                {{--data:{user_id:user_id,talkwords:TalkWords.value},--}}
                {{--dataType:"json",--}}
                {{--success:function (res) {--}}
                    {{--if(res.code==1){--}}
                        {{--alert(res.msg);--}}
                        {{--window.location.href="/login";--}}
                    {{--}--}}
                {{--}--}}
            {{--})--}}
        {{--})--}}
    {{--})--}}
    {{--//获取用户发送的信息--}}
    {{--$(function(){--}}
        {{--$('.talk_show').empty();--}}
        {{--setInterval(function(){--}}
            {{--var user_id=$('#user_id').val();--}}
            {{--var Words = document.getElementById("words");--}}
            {{--$.ajax({--}}
                {{--url:"getMessage",--}}
                {{--method:"POST",--}}
                {{--data:{user_id:user_id},--}}
                {{--success:function (res) {--}}
                    {{--if(res==''){--}}

                    {{--}else{--}}
                        {{--str = '<div class="atalk"><span>res.user_name说 :' + res.content +'</span></div>' ;--}}
                    {{--}--}}
                    {{--Words.innerHTML = Words.innerHTML + str;--}}
                {{--}--}}
            {{--})--}}
        {{--},10000)--}}
    {{--})--}}
{{--</script>--}}