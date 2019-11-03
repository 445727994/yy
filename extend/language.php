<?php
/*
Auther :  萤火虫
email  : 445727994@qq.com
 */
$LANG['operate'] = [
	'edit' => '编辑',
	'add' => '添加',
	'view' => '查看',
	'del' => '删除',
	'del_confirm' => '确认要删除吗？',
	'examine' => '审核',
	'show' => '显示',
	'search' => '搜索',
	'getCheckData' => '操作',
	'checked' => ['checked', ''],
	'checked_word' => ['否', '是'],
];

$LANG['time'] = [
	'create' => '创建时间',
	'update' => '修改时间',
];
$LANG['return_msg'] = [
	'add' => ["msg" => '添加成功', "code" => 0],
	'edit' => ["msg" => "修改成功", "code" => 0],
	'err' => ["msg" => "操作失败", "code" => 1],
	'suc' => ["msg" => "操作成功", "code" => 0],
	'add_err' => ["msg" => "添加失败", "code" => 1],
	'edit_err' => ["msg" => "修改失败", "code" => 1],
	'success' => ["msg" => '登录成功,正在跳转', "code" => 0],
	'not_exist' => ["msg" => '用户名不存在', "code" => 1],
	'password_error' => ["msg" => '密码错误', "code" => 1],
	'csrf' => ['msg' => '非法提交', 'code' => 1],
];
$LANG['Index'] = [
	'index' => "管理员列表",
	'add' => "添加管理员",
	'edit' => "编辑管理员",
	'search' => 'user_name|email|mobile',
	'search_name' => '输入用户名|邮箱|手机号码搜索',
	'field' => [
		'aid' => 'ID',
		'user_name' => '用户名',
		'role_id' => '角色',
		'last_login_time' => '最后登录时间',
		'last_login_ip' => '最后登录ip',
		'email' => '邮箱',
		'mobile' => '手机',
		'is_authen' => "认证",
		'is_limit' => '审核',
		'salt' => '加密串',
		'type' => '级别',
		'prov_id' => '省份',
		'city_id' => '城市',
	],
	'validate' => [
		'user_name_require' => '用户名不能为空',
		'user_name_uniqid' => '用户名已存在',
	],
];
$LANG['Login'] = [
	'index' => "管理员列表",
	'add' => "添加管理员",
	'edit' => "编辑管理员",
	'search' => 'user_name|email|mobile',
	'search_name' => '输入用户名|邮箱|手机号码搜索',
	'field' => [
		'aid' => 'ID',
		'user_name' => '用户名',
		'role_id' => '角色',
		'last_login_time' => '最后登录时间',
		'last_login_ip' => '最后登录ip',
		'email' => '邮箱',
		'mobile' => '手机',
		'is_authen' => "认证",
		'is_limit' => '审核',
		'salt' => '加密串',
		'type' => '级别',
		'prov_id' => '省份',
		'city_id' => '城市',
	],
	'validate' => [
		'user_name_require' => '用户名不能为空',
		'user_name_uniqid' => '用户名已存在',
	],
];
return $LANG;
