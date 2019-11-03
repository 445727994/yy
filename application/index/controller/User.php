<?php
namespace app\index\controller;
use think\Db;

class User extends Base {
	//微信用户登录绑定

	public function index() {
		$this->webtitle('个人中心');
		$this->assign('user', $this->user);
		return $this->fetch();
	}
	public function out() {
		session('user', null);
		$this->redirect('index/index');
	}
	public function about_us() {
		$this->webtitle('关于我们');
		$msg = Db::name("about")->cache('about_us',6000)->find();
		$this->assign('msg', $msg['about']);
		return $this->fetch();
	}
    public function info(){
        $this->webtitle('个人信息');
        if (request()->isAjax()) {
            $data['username']=input('username');
            $data['mobile']=input('mobile');
            \app\admin\model\User::where('id',$this->user['id'])->update($data);
            $user=\app\admin\model\User::find(['id'=>$this->user['id']]);
            session('user',$user);
            return $this->return_msg('修改成功');
        }
	    $user=$this->user;
	    $this->assign('user',$user);
	    return $this->fetch();
    }
}
