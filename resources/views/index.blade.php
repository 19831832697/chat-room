<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>聊天室</title>
</head>
<body>
<input type="text" name="content" id="content">
<input type="button" value="发送" id="btn"><hr/>
<div id="msg">

</div>
</body>
</html>
<script src="js/jquery.js"></script>
<script>
    //初始化
    var ws_server='ws://vm.swoole.com:9502';
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