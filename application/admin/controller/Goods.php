<?php
/*
 * @auther 萤火虫 
 * @email  445727994@qq.com
 * @create_time 2019-10-22 22:42:37
 */
namespace app\admin\controller;
use think\Controller;
use think\Db;
class Goods extends Base{
	public function __construct() {
		parent::__construct();
	}
	public function _initialize() {

	}
    public function _befor_index(){

    }
    public function _end_search(&$list) {
        if (count($list['data']) > 0) {
            foreach ($list['data'] as $key => &$value) {
                $value['form_id'] = form($value['form_id']);
            }
        }
    }
}
