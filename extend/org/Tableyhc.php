<?php
namespace org;
use think\Config;
use think\Db;

/**
 * @Author   萤火虫
 * @DateTime 2018-04-23
 * @email    445727994@qq.com
 * @function
 * @param    [type]           $data [description]
 * @return   [type]                 [description]
 */
class Tableyhc {
	/**
	 * 获取数据库字段注释
	 * @param string $table_name 数据表名称(必须，不含前缀)
	 * @param string $field 字段名称(默认获取全部字段,单个字段请输入字段名称)
	 * @param string $table_schema 数据库名称(可选)
	 * @return string
	 */
	public function check_field($tablename, $file) {
		// 接收参数
		$database = config('database');
		$table_schema = empty($table_schema) ? $database['database'] : $table_schema;
		$table_name = $database['prefix'] . $table_name;
		// 缓存名称
		$fieldName = $field === true ? 'allField' : $field;
		$cacheKeyName = 'db_' . $table_schema . '_' . $table_name . '_' . $fieldName;

		// 处理参数
		$param = [
			$table_name,
			$table_schema,
		];

		// 字段
		$columeName = '';
		if ($field !== true) {
			$param[] = $field;
			$columeName = "AND COLUMN_NAME = ?";
		}

		// 查询结果
		$result = Db::query("SELECT COLUMN_NAME as field,column_comment as comment FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = ? AND table_schema = ? $columeName", $param);
		if (empty($result) && $field !== true) {
			return 0;
		}
		// 处理结果
		foreach ($result as $k => $v) {
			if ($v == 'is_limit') {
				return 1;
			}
		}
		return 0;
	}
	public function get_column($table_name = '', $field = true, $table_schema = '') {
		// 接收参数
		$database = config('database');
		$table_schema = empty($table_schema) ? $database['database'] : $table_schema;
		$table_name = $database['prefix'] . $table_name;
		// 缓存名称
		$fieldName = $field === true ? 'allField' : $field;
		$cacheKeyName = 'db_' . $table_schema . '_' . $table_name . '_' . $fieldName;
		// 处理参数
		$param = [
			$table_name,
			$table_schema,
		];

		// 字段
		$columeName = '';
		if ($field !== true) {
			$param[] = $field;
			$columeName = "AND COLUMN_NAME = ?";
		}

		// 查询结果
		$result = Db::query("SELECT COLUMN_NAME as field,column_comment as comment FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = ? AND table_schema = ? $columeName", $param);
		// pp(Db :: getlastsql());
		if (empty($result) && $field !== true) {
			return $table_name . '表' . $field . '字段不存在';
		}
		// 处理结果
		foreach ($result as $k => $v) {
			if (strpos($v['comment'], '#*#') !== false) {
				$tmpArr = explode('#*#', $v['comment']);
				$data[$v['field']] = json_decode(end($tmpArr), true);
			}
		}
		// 字段注释格式不正确
		if (empty($data)) {
			return $table_name . '表' . $field . '字段注释格式不正确';
		}

		return count($data) == 1 ? reset($data) : $data;
	}

	/* 获取数据库字段
		 * @param string $table_name 数据表名称(必须，不含前缀)
		 * @param string $table_schema 数据库名称(可选)
		 * @return string
	*/
	public function get_field($table_name = '', $field = true, $table_schema = '') {
		// 接收参数
		$database = config()["database"];
		$table_schema = empty($table_schema) ? $database['database'] : $table_schema;

		$table_name = $database['prefix'] . $table_name;
		// 缓存名称
		$fieldName = $field === true ? 'allField' : $field;
		$cacheKeyName = 'db_' . $table_schema . '_' . $table_name . '_' . $fieldName;
		// 处理参数
		$param = [
			$table_name,
			$table_schema,
		];

		// 字段
		$columeName = '';
		if ($field !== true) {
			$param[] = $field;
			$columeName = "AND COLUMN_NAME = ?";
		}

		// 查询结果
		$result = Db::query("SELECT IS_NULLABLE,COLUMN_NAME as field,column_comment as comment FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = ? AND table_schema = ? $columeName", $param);

		// pp(Db :: getlastsql());
		if (empty($result) && $field !== true) {
			return $table_name . '表' . $field . '字段不存在';
		}
		$arr = ['yhc_name', 'yhc_type', 'yhc_value', 'yhc_validate', 'yhc_recheck', 'yhc_editor'];

		// 处理结果
		foreach ($result as $k => $v) {
			$arrTmp = $this->get_value($arr, $v['comment']);
			if (isset($arrTmp['yhc_type'])) {
				$data[$k]['field_name'] = $v['field'];
				foreach ($arrTmp as $key => $value) {
					$data[$k][$key] = $value;
				}
				$data[$k]['yhc_validate'] = isset($data[$k]['yhc_validate']) ? $data[$k]['yhc_validate'] : '';
				$data[$k]['yhc_note'] = isset($data[$k]['note']) ? $data[$k]['note'] : '';
			}

		}
		return count($data) == 1 ? reset($data) : $data;
	}
	protected function is_null($field, $value, $validate) {
		if (!in_array($field, ['create_time', 'add_time', 'update_time', 'id'])) {
			if ($validate != "") {
				return explode($validate, ',');
			}
			return $value == 'YES' ? '0' : 'required';
		}
		return 0;
	}

	protected function get_name() {
		$str = 'yhc_type';
		if (strpos($value, $str) !== false) {
			$tmpArr = explode($str, $value);
			$tmpArr = trim(end($tmpArr), '#');
			return json_decode($tmpArr, true);
		}
		return "";
	}
	protected function get_value($name, $str) {
		$data = [];
		$arr = explode("#", trim($str, "#"));

		foreach ($arr as $k => $v) {
			foreach ($name as $key => $value) {
				if ($v == $value) {
					$data[$value] = is_null(json_decode($arr[($k + 1)], true)) ? $arr[($k + 1)] : json_decode($arr[($k + 1)], true);
				}
			}
		}

		return $data;
	}

}