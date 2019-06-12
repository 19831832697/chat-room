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
<h3><a href="login">已有账号，去登录</a></h3>
<form action="">
    <p>
        用户名:<input type="text" name="user_name">
    </p>
    <p>
        邮箱:<input type="email" name="user_email">
    </p>
    <p>
        密码:<input type="password" name="user_pwd">
    </p>
    <p>
        <input type="button" value="立即注册" id="btn">
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
            var user_email=$("input[name='user_email']").val();
            var data={};
            data.user_name=user_name;
            data.user_pwd=user_pwd;
            data.user_email=user_email;
            $.ajax({
                url:"regDo",
                method:"POST",
                data:data,
                dataType:"json",
                success:function(res){
                    if(res.code==1){
                        alert(res.msg);
                    }else if(res.code==2){
                        alert(res.msg);
                        window.location.href="/login";
                    }
                }
            })
        })
    })
</script>