<?php

namespace App\Http\Controllers\chat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    /**
     * 聊天室视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function chat(Request $request){
        $user_id=$request->cookie('user_id');
        return view('chat',['user_id'=>$user_id]);
    }

    /**
     * 聊天内容入库
     * @param Request $request
     * @return false|string
     */
    public function chatDo(Request $request){
        $user_id=$request->input('user_id');
        if(empty($user_id)){
            $res=[
                'code'=>1,
                'msg'=>'您还没有登录，不能进入聊天'
            ];
            return json_encode($res,JSON_UNESCAPED_UNICODE);
        }
        $talkwords=$request->input('talkwords');
        $chatInfo=[
            'user_id'=>$user_id,
            'chat_content'=>$talkwords
        ];
        DB::table('chat')->insert($chatInfo);
    }

    /**
     * 获取用户返回的信息
     * @param Request $request
     */
    public function getMessage(Request $request){
        $user_id=$request->input('user_id');
        $userInfo=DB::table('user_reg')->where('user_id',$user_id)->first();
        $user_name=$userInfo->user_name;
        $dataInfo=DB::table('chat')
            ->where('user_id',$user_id)
            ->orderBy('chat_content','desc')->first();
        $content=$dataInfo->chat_content;
        $info=[
            'user_name'=>$user_name,
            'content'=>$content
        ];
        return $info;
    }

    /**
     * 聊天室视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('index');
    }
}