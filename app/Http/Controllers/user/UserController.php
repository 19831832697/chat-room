<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * 注册视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reg(){
        return view('reg');
    }

    /**
     * 注册执行
     * @param Request $request
     */
    public function regDo(Request $request){
        $data=$request->input();
        $user_name=$data['user_name'];
        $user_pwd=$data['user_pwd'];
        if(empty($user_name)){
            $res=[
                'code'=>1,
                'msg'=>'用户名不能为空'
            ];
            return json_encode($res,JSON_UNESCAPED_UNICODE);
        }else if(empty($user_pwd)){
            $res=[
                'code'=>1,
                'msg'=>'密码不能为空'
            ];
            return json_encode($res,JSON_UNESCAPED_UNICODE);
        }
        $where=[
            'user_email'=>$data['user_email']
        ];
        $dataInfo=DB::table('user_reg')->where($where)->first();
        if($dataInfo){
            $res=[
                'code'=>1,
                'msg'=>'邮箱已存在'
            ];
            return json_encode($res,JSON_UNESCAPED_UNICODE);
        }
        $pwd=password_hash($user_pwd,PASSWORD_BCRYPT);
        $arrInfo=[
            'user_name'=>$user_name,
            'user_pwd'=>$pwd,
            'user_email'=>$data['user_email']
        ];
        $res=DB::table('user_reg')->insert($arrInfo);
        if($res){
            $arr=[
                'code'=>2,
                'msg'=>'注册成功,前往登录'
            ];
            return json_encode($arr,JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * 登录视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login(){
        return view('login');
    }

    /**
     * 登录执行
     * @param Request $request
     * @return false|string
     */
    public function loginDo(Request $request){
        $data=$request->input();
        $user_name=$data['user_name'];
        $user_pwd=$data['user_pwd'];
        $where=[
            'user_name'=>$user_name
        ];
        $info=DB::table('user_reg')->where($where)->first();
        if($info){
            $user_id=$info->user_id;
            $pwd=$info->user_pwd;
            if(password_verify($user_pwd,$pwd)){
                Cookie::queue('user_id',$user_id);
                $token=substr(Str::random(11).md5($user_id),5,15);
                $key="user_list".$user_id;
                Redis::set($key,$token);
                $res=[
                    'code'=>2,
                    'msg'=>'登录成功,进入聊天室'
                ];
                return json_encode($res,JSON_UNESCAPED_UNICODE);
            }else{
                $res=[
                    'code'=>1,
                    'msg'=>'密码错误'
                ];
                return json_encode($res,JSON_UNESCAPED_UNICODE);
            }
        }else{
            $res=[
                'code'=>1,
                'msg'=>'没有此用户'
            ];
            return json_encode($res,JSON_UNESCAPED_UNICODE);
        }
    }
}
