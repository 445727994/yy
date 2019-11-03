<?php

//字典php  根据此函数 判断自动生成的index页面 确定不同字段 是否排序 字段长度  是否现在在列表中
namespace org\view;
use org\Tableyhc;

class Add {
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
		$Tableyhc = new Tableyhc();
		$data = $Tableyhc->get_field($table);

		//遍历获取
		//html公共头部
		$return_html = '{include file="base/' . $type . 'head"/}' . "\n";
		if (count($data) == count($data, 1)) {
			$new[] = $data;
			$data = $new;
		}

		foreach ($data as $key => $value) {
			$function = 'return_' . $value['yhc_type'];
			if (isset($value['yhc_show'])) {
				//1不显示 默认显示
				if ($value['yhc_show'] == 1) {
					if (method_exists($this, $function)) {
						$return_html .= $this->$function($value);
					}
				}
			} else {
				if (method_exists($this, $function)) {
					$return_html .= $this->$function($value);
					if (isset($value['yhc_recheck']) && $value['yhc_recheck'] == 1) {
						$value['field_name'] = $value['field_name'] . '_check';
						$value['yhc_name'] = '确认' . $value['yhc_name'];
						$return_html .= $this->$function($value);
					}
				}
			}
		}
		$return_html .= file_get_contents(__DIR__ . '/html/script_' . $type . '.html');
		$return_html .= "\n" . '{include file="base/' . $type . 'foot"/}';
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
	protected function return_input($data) {
		$validate = "";
		if (isset($data['yhc_validate'])) {
			$validate = 'lay-verify="' . $data['yhc_validate'] . '"';
		}
		if (in_array($data['yhc_validate'], $this->validate_arr));
		$html = '<input type="input" name="' . $data['field_name'] . '" class="layui-input" ' . $validate . '  value="">';
		return $this->html_head($data['yhc_name']) . $html . $this->html_foot();
	}
	protected function return_password($data) {
		$validate = "";
		if (isset($data['yhc_validate'])) {
			$validate = 'lay-verify="' . $data['yhc_validate'] . '"';
		}
		if (in_array($data['yhc_validate'], $this->validate_arr));
		$html = '<input type="password" name="' . $data['field_name'] . '" class="layui-input" ' . $validate . '   value="">';
		return $this->html_head($data['yhc_name']) . $html . $this->html_foot();

	}
	protected function return_recheck($data) {
		$validate = "";
		if (isset($data['yhc_validate'])) {
			$validate = 'lay-verify="require"';
		}
		if (in_array($data['yhc_validate'], $this->validate_arr));
		$html = '<input type="password" name="' . $data['field_name'] . '" class="layui-input" ' . $validate . '   value="">';
		return $this->html_head($data['yhc_name']) . $html . $this->html_foot();

	}
	protected function return_uploadimg($data) {
		$validate = "";
		if (isset($data['yhc_validate'])) {
			$validate = 'lay-verify="' . $data['yhc_validate'] . '"';
		}
		if (in_array($data['yhc_validate'], $this->validate_arr));
		$html = '<button type="button" class="layui-btn" id="uploadimg' . $data['field_name'] . '">
		<i class="layui-icon">&#xe67c;</i>上传图片</button>' . "\n";
		$html .= '<div class="layui-upload-list">' . "\n";
		$html .= '<img class="layui-upload-img" id="img' . $data['field_name'] . '"  style="max-width: 200px;">' . "\n";
		$html .= '<p></p>' . "\n";
		$html .= '</div>' . "\n";
		$html .= '<input type="hidden" name="' . $data['field_name'] . '"  id="' . $data['field_name'] . '">' . "\n";
		$html .= "<script>" . "\n";
		$html .= "layui.use('upload', function(){var upload = layui.upload;" . "\n";
		$html .= "var uploadInst = upload.render({" . "\n";
		$html .= "elem: '#uploadimg" . $data['field_name'] . "' " . "\n";
		$html .= ",url: '{:url(\"base/upload\")}'" . "\n";
		$html .= ",accept:'images'" . "\n";
		$html .= ",acceptMime:'image/*'" . "\n";
		$html .= ",exts:'jpg|png|gif|bmp|jpeg'" . "\n";
		$html .= ",before: function(obj){" . "\n";
		$html .= "obj.preview(function(index, file, result){" . "\n";
		$html .= "$('#img" . $data['field_name'] . "').attr('src', result); " . "\n";
		$html .= "});" . "\n";
		$html .= "}" . "\n";
		$html .= ",done: function(res){" . "\n";
		$html .= "if(res.code==0){" . "\n";
		$html .= "$('#" . $data['field_name'] . "').val(res.msg);" . "\n";
		$html .= "layer.msg('上传图片成功');" . "\n";
		$html .= "}else{" . "\n";
		$html .= "layer.msg(res.msg);" . "\n";
		$html .= "}" . "\n";
		$html .= "},error: function(){" . "\n";
		$html .= "}" . "\n";
		$html .= "});" . "\n";
		$html .= "});" . "\n";
		$html .= "</script>" . "\n";
		return $this->html_head($data['yhc_name']) . $html . $this->html_foot();
	}
	protected function return_textarea($data) {
		$validate = "";
		if (isset($data['yhc_validate'])) {
			$validate = 'lay-verify="' . $data['yhc_validate'] . '"';
		}
		if (in_array($data['yhc_validate'], $this->validate_arr));
		if (isset($data['yhc_editor'])) {
			$html = '{:get_editor("' . $data['yhc_editor'] . '")}';
		} else {
			$html = '<textarea name="' . $data['field_name'] . '" class="layui-textarea"   ' . $validate . ' ></textarea>';
		}
		return $this->html_head($data['yhc_name']) . $html . $this->html_foot();

	}
	protected function return_switch($data) {
		$lay_text = $data['yhc_value'][0] . '|' . $data['yhc_value'][1];

		$html = '<input type="checkbox" lay-skin="switch" lay-text="' . $lay_text . '" name="' . $data['field_name'] . '" value="">';
		return $this->html_head($data['yhc_name']) . $html . $this->html_foot();
	}
	protected function return_redio($data) {
		if (!isset($data['yhc_validate'])) {
			$html = '';
			foreach ($data['yhc_value'] as $key => $value) {
				$html .= '<input type="radio"  name="' . $data['field_name'] . '"  lay-skin="switch"  value=""  title="' . $value . '">';
			}
			return $this->html_head($data['yhc_name']) . $html . $this->html_foot();
		}
		if (in_array($data['yhc_validate'], $this->validate_arr));
		$html = '<input type="checkbox" lay-skin="switch" name="' . $data['field_name'] . '"   value="">';
		return $this->html_head($data['yhc_name']) . $html . $this->html_foot();
	}
	protected function return_layer_edit() {
		if ($this->check()) {
			return $this->check();
		}

	}

	protected function return_select($data) {
		// select 情况下 从yhc_value 中获取表格 和字段
		$validate = "";
		if (isset($data['yhc_validate'])) {
			$validate = 'lay-verify="' . $data['yhc_validate'] . '"';
		}
		$html = '<select name="' . $data['field_name'] . '" ' . $validate . ' >' . "\n";
		if (isset($data['yhc_value'])) {
			$html .= $this->select_option($data['yhc_value'], $data['field_name']);
		}
		$html .= "</select>";
		return $this->html_head($data['yhc_name']) . $html . $this->html_foot();
	}
	protected function select_option($table, $field_name) {
		//暂定义select 传入的data格式  data.filed.db//取数据的表 data.filed.where//取数据条件//data.filed.filed  取的字段0 为key 1为value
		//data.filed.order 排序

		if (isset($table['where'])) {
			return '{:select_option("' . base64_encode(json_encode($table, true)) . '")}';
		} else {
			$option = '';
			foreach ($table as $key => $value) {
				$option .= '<option value="' . $key . '"  >' . $value . '</option>' . "\n";
			}
			return $option;
		}

	}

	protected function return_ue_editor() {

	}
	protected function return_layui_image() {

	}
	protected function return_ue_image() {

	}
	protected function return_ue_images() {

	}
	protected function return_layui_images() {

	}

}
