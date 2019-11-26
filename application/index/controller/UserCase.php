<?php

namespace app\index\controller;

use app\admin\model\Cate;
use app\admin\model\Order;
use app\admin\model\UserCase as C;
use think\Db;

class userCase extends Base
{

    public function index()
    {
        $this->webtitle('用户案例');
        $cate = input('cate', 0);
        if (request()->isAjax()) {
            $where[] = ['is_show', '=', 0];
            if($cate!=0){
                $where[]=['cate_id','=',$cate];
            }
            $page = (int)input('page') ? (int)input('page') : 1;
            $page_size = (int)input('limit') ? (int)input('limit') : 10;
            $order = 'sort desc';
            $data = C::where($where)->limit(($page - 1) * $page_size, $page_size)->order($order)->cache('userCase_' . $page_size . '_' . $page . '_' . $cate, 1000)->select();
            $url = url('userCase/detail') . '?id=';
            foreach ($data as &$v) {
                $v['img'] = img($v['img']);
                $v['src'] = $url . $v['id'];
            }
            $count = C::where($where)->cache('camera_count_'.$cate, 1000)->count();
            return $this->return_data($data, $count);
        }
        $cateList=Cate::where('is_delete',0)->cache('cate_all',6000)->order('sort desc')->select();
        $this->assign('cateList',$cateList);
        return $this->fetch();
    }


    public function detail()
    {
        $this->webtitle('案例详情');
        $id = input('id');
        if ($id) {
            $data = C::where('id', $id)->where('is_show', 0)->cache('userCase_detail_' . $id, 3600)->find();
        } else {
            $data = C::order('sort desc')->cache('case_default', 3600)->find();
        }
        $this->assign('userCase', $data);
        return $this->fetch();
    }


}
