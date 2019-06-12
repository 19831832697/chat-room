<?php

namespace App\Http\Controllers\mongo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
}
