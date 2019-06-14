<?php

namespace App\Http\Controllers\mongo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use MongoDB\Client;

class MongoController extends Controller
{
    public $db_host="mongodb://127.0.0.1:27017";
    public $client;

    /**
     * 添加
     */
    public function insert(){

       $this->client=new Client($this->db_host);
       $collection=$this->client->a1809->test;
       //单条插入文档
       $data=[
           'name'=>'lisi',
           'age'=>20,
           'email'=>'lisi@qq.com'
       ];
       $res=$collection->insertOne($data);
        //多条插入文档
       $arrInfo=[
           [
               'name'=>'王五',
               'age'=>20,
               'email'=>'wangwu@qq.com'
           ],
           [
               'name'=>Str::random(5),
               'age'=>25,
               'email'=>'asdd@qq.com'
           ],
       ];
       $rs=$collection->insertMany($arrInfo);
       var_dump($rs);
    }

    /**
     * 查询
     */
    public function show(){
        $this->client=new Client($this->db_host);
        $collection=$this->client->a1809->test;
        $res=$collection->find(['name'=>'王五']);
        var_dump($res);
    }

    /**
     * 删除
     */
    public function del(){
        $this->client=new Client($this->db_host);
        $collection=$this->client->a1809->test;
        $res=$collection->deleteOne(['name'=>'fXgwG']);
        var_dump($res);
    }

    /**
     * 修改
     */
    public function update(){
        $this->client=new Client($this->db_host);
        $collection=$this->client->a1809->test;
        $res = $collection->updateOne(['name' => '王五'], ['$inc' => ['age' => 1200]]);
        var_dump($res);
    }

    /**
     * 循环添加数据
     */
    public function insertAll(){
        for($i=0;$i<100000;$i++){
            $user_name=mt_rand(5,10);
            $user_email=mt_rand(5,10);
            $u_email=mt_rand(0,3);
            $user_pwd=rand(100000,999999);
            $user_tel=rand(11111111111,99999999999);
            $email=[
                '@qq.com',
                '@163.com',
                '@sohu.com',
                '@gmail.com'
            ];
            $dataInfo=[
                'user_name'=>Str::random($user_name),
                'user_email'=>Str::random($user_email).$email[$u_email],
                'user_tel'=>$user_tel,
                'user_pwd'=>$user_pwd,

            ];
            $data=DB::table('user')->insertGetId($dataInfo);
        }
    }
}
