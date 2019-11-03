<?php

//字典php  根据此函数 判断自动生成的index页面 确定不同字段 是否排序 字段长度  是否现在在列表中
namespace org;
use org\view\Add;
use org\view\Edit;
use org\view\Index;

class Field {
	private $table;
	private $type;
	private $validate;
	private $field;
	private $html;
	private $controller;
	private $data;
	private $validate_js;
	private $js;
	private $layui_form_js;
	private $validate_arr;
	/**
	 * @Author   萤火虫
	 * @email    445727994@qq.com
	 * @DateTime 2018-04-06
	 * @param    控制器           $controller    [description]
	 * @param    字段名称           $field         [description]
	 * @param    类型/input/textarea/..           $type          [description]
	 * @param    数据           $data          [description]
	 * @param    简单验证           $validate      [description]
	 * @param    js验证           $validate_type [description]
	 */
	function __construct() {
		$this->validate_arr = ['require', 'number'];
	}

	public function get_view($table, $type) {
		switch ($type) {
		case 'index':
			$Index = new Index();
			return $Index->get_view($table, $type);
			break;

		case 'add':
			$Index = new Add();
			return $Index->get_view($table, $type);
			break;

		default:
			$Edit = new Edit();
			return $Edit->get_view($table, $type);
			break;
		}

	}

}
