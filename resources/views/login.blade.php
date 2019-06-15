<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户登录</title>
</head>
<body>
<h3><a href="reg">还没有账号，去注册</a></h3>
<form action="">
    <p>
        用户名:<input type="text" name="user_name">
    </p>
    <p>
        密码:<input type="password" name="user_pwd">
    </p>
    <p>
        <input type="button" value="登录" id="btn">
    </p>
</form>
</body>
</html>
<script src="js/jquery.js"></script>
<script>
    //初始化
    var ws_server='ws://vm.swoole.com:9501';
    var ws=new WebSocket(ws_server);
    //建立web连接
    ws.onopen=function(){
        //绑定事件
        $(document).on('click','#btn',function(){
            var user_name=$("input[name='user_name']").val();
            var user_pwd=$("input[name='user_pwd']").val();
            var data={};
            data.user_name=user_name;
            data.user_pwd=user_pwd;

            var data={
                type:"message",
                text:data,
                // id:1,
                // date:Date.now()
            };
            ws.send(JSON.stringify(data));
        })
    }
    //接收服务器发送的数据
    ws.onmessage=function(d){
        var str=d.data;
        var arr=JSON.parse(str);
        if(arr.code==1){
            var user_id=arr.user_id;
            var user_name=arr.user_name;
            localStorage.setItem("user_id",user_id);
            localStorage.setItem("user_name",user_name);
            alert(arr.msg);
            window.location.href="/chat";
        }else if(arr.code==2){
            alert(arr.msg);
        }
    }
    console.log(ws);
</script>