<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
    $(document).ready(function(){
        $(document).on('click','#btn',function(){
            var user_name=$("input[name='user_name']").val();
            var user_pwd=$("input[name='user_pwd']").val();
            var data={};
            data.user_name=user_name;
            data.user_pwd=user_pwd;
            $.ajax({
                url:"loginDo",
                method:"POST",
                data:data,
                dataType:"json",
                success:function(res){
                    if(res.code==1){
                        alert(res.msg);
                    }else if(res.code==2){
                        alert(res.msg);
                        window.location.href="/chat";
                    }
                }
            })
        })
    })
</script>