<?php

//字典php  根据此函数 判断自动生成的index页面
namespace org\view;
use org\Tableyhc;

class Index {
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
	public function get_view($table, $type = '') {
		$Tableyhc = new Tableyhc();
		$data = $Tableyhc->get_field($table);
		$file_path = __DIR__ . DS . "html" . DS . "Indexjs" . DS;
		//遍历获取
		//html公共头部
		$return_html = '{include file="base/head"/}' . "\n";
		$middle = file_get_contents($file_path . "script_index.html");
		$field = "";

		foreach ($data as $k => $v) {
			if (file_exists($file_path . $v['field_name'] . ".js")) {
				$field .= file_get_contents($file_path . $v['field_name'] . ".js");

			} else {
				$common = file_get_contents($file_path . "common.js");
				$field .= str_replace("!name!", $v['field_name'], $common);
			}
		}
		$return_html .= str_replace('!field!', $field, $middle);
		$return_html .= "\n" . '{include file="base/foot"/}';
		return $return_html;
	}
	protected function html_head($name) {
		//固定html
		$html = '<div class="layui-form-item">' . "\n";
		$html .= '<label class="layui-form-label">';
		$html .= $name . '</label>' . "\n";
		$html .= '<div class="layui-input-block">' . "\n";
		return $html;
	}
	protected function html_foot() {
		return "\n" . "</div>" . "\n" . "</div>" . "\n";
	}

}
