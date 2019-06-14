<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>简易聊天室</title>
    <style type="text/css">
        @media screen and (min-width: 320px) and (max-width: 1156px){
            .talk_con_mob{
                width:600px;
                height:500px;
                border:1px solid #666;
                margin:50px auto 0;
                background:#f9f9f9;
            }
            .talk_show_mob{
                width:580px;
                height:420px;
                border:1px solid #666;
                background:#fff;
                margin:10px auto 0;
                overflow:auto;
            }
            .talk_input_mob{
                width:580px;
                margin:10px auto 0;
            }
            .talk_word_mob{
                width:420px;
                height:26px;
                padding:0px;
                float:left;
                margin-left:10px;
                outline:none;
                text-indent:10px;
            }
        }
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
            float:right;
            margin-right:10px;
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
</head>
<body>
<div class="talk_con" id="talk_con_id">
    <div class="talk_show" id="words">
        <div class="atalk"><span id="asay">欢迎进入聊天室</span></div>
    </div>
    <div class="talk_input"  id="talk_input_id">>
        <input type="text" class="talk_word" id="talkwords">
        <input type="button" value="发送" class="talk_sub" id="talksub" >
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
        $(document).on('click','#talksub',function(){
            var content=$('#talkwords').val();
            var data={
                type:"message",
                text:content,
                id:1,
                date:Date.now()
            };
            ws.send(JSON.stringify(data));
            $('.talk_word').empty();
        })
    }
    //接收服务器发送的数据
    ws.onmessage=function(d){
        var str=d.data;
        var arr=JSON.parse(str);
        $(".talk_show").append(arr.text).append("<br/>");
    }
    console.log(ws);
</script>