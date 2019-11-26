<?php

namespace app\index\controller;

use app\admin\model\Cate;
use app\admin\model\Form;
use app\admin\model\goods as C;
use think\db;
class Goods extends Base
{

    public function index()
    {
        $this->webtitle('在线预约');
        $cate = input('cate', 0);
        if (request()->isAjax()) {
            $where[] = ['is_show', '=', 0];
            if ($cate != 0) {
                $where[] = ['cate_id', '=', $cate];
            }
            $page = (int)input('page') ? (int)input('page') : 1;
            $page_size = (int)input('limit') ? (int)input('limit') : 10;
            $order = 'sort desc';
            $data = C::where($where)->limit(($page - 1) * $page_size, $page_size)->order($order)->cache('goods_' . $page_size . '_' . $page . '_' . $cate, 1000)->select();
            $url = url('userCase/detail') . '?id=';
            foreach ($data as &$v) {
                $v['img'] = img($v['img']);
                $v['src'] = $url . $v['id'];
                $v['desc']=str_replace(["\r\n","\n"], "<br>", str_replace(" ", " ", $v['desc']));
            }
            $count = C::where($where)->cache('camera_count_' . $cate, 1000)->count();
            return $this->return_data($data, $count);
        }
        $cateList = Cate::where('is_delete', 0)->cache('cate_all', 6000)->order('sort desc')->select();
        $this->assign('cateList', $cateList);
        return $this->fetch();
    }
    public function  order(){
        if(request()->isAjax()){
            $data=input('post.');
            $insert['goods_id']=(int)$data['goods_id'];
            $goods = C::where('id', $insert['goods_id'])->cache('userCase_detail_' . $insert['goods_id'], 3600)->find();
            if(!$goods){
                return $this->return_msg('预约错误',2);
            }
            $arr=[];
            if(count($data['name'])>0){
                foreach ($data['name'] as $k=>$v){
                    $arr[$v]=$data['field'][$k];
                }
            }
            $insert['goods_content']=$goods['desc'];
            $insert['user_id']=$this->user['id'];
            $insert['money']=$goods['price'];
            $insert['order_no']=date("YmdHis").mt_rand(100000,999999);
            $insert['form_content']=json_encode($arr,true);
            $insert['status']=1;
            $insert['create_time']=$insert['update_time']=time();
            $res=DB::name('order')->insert($insert);
            if($res){
                return $this->return_msg('预约成功',0);
            }
            return $this->return_msg('预约错误',2);
        }
    }

    public function detail()
    {
        $this->webtitle('摄影师详情');
        $id = input('id');
        if ($id) {
            $data = C::where('id', $id)->where('is_show', 0)->cache('userCase_detail_' . $id, 3600)->find();
        } else {
            $data = C::order('sort desc')->cache('camera_default', 3600)->find();
        }
        $this->assign('goods', $data);
        return $this->fetch();
    }

    public function appointment()
    {
        $this->webtitle('预约');
        $id = input('id');
        if(!$id){
            $this->redirect('goods/index');
            return;
        }
        $data = C::where('id', $id)->where('is_show', 0)->cache('userCase_detail_' . $id, 3600)->find();
        $field=Form::find($data['form_id']);
        $this->assign('goods',$data);
        $this->assign('field',json_decode($field['content'],true));
        return $this->fetch();
    }
}
