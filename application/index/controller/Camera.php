<?php

namespace app\index\controller;
use app\admin\model\Camera as C;
class Camera extends Base
{
    //微信用户登录绑定

    public function index()
    {
        $this->webtitle('摄影师列表');
        if (request()->isAjax()) {
            if (request()->isAjax()) {
                $where[] = ['is_show', '=', 0];
                $page = (int) input('page') ? (int) input('page') : 1;
                $page_size = (int) input('limit') ? (int) input('limit') : 10;
                $order='sort desc';
                $data=C::where($where)->limit(($page - 1) * $page_size, $page_size)->order($order)->cache('camera_list_'.$page_size.'_'.$page,1000)->select();
                $url=url('camera/detail').'?id=';
                foreach ($data as &$v){
                    $v['img']='<img src="'.img($v['img']).'" style="width:100%" >';
                    $v['src']=$url.$v['id'];
                }
                $count=C::where($where)->cache('camera_count',1000)->count();
                return $this->return_data($data,$count);
            }
        }
        return $this->fetch();
    }

    public function detail()
    {
        $this->webtitle('摄影师详情');
        $id = input('id');
        if ($id) {
            $data = C::where('id', $id)->where('is_show', 0)->cache('camera_detail_'.$id, 3600)->find();
        } else {
            $data = C::order('sort desc')->cache('camera_default', 3600)->find();
        }
        $id=$data['id'];
        $cameraCase=\app\admin\model\UserCase::where('camera_id',$id)->cache('camera_case'.$id,3600)->limit(10)->select();
        $this->assign('camera', $data);
        $this->assign('cameraCase', $cameraCase);
        return $this->fetch();
    }
}
