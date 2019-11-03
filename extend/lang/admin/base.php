<?php
namespace org\lang;
/*
Auther :  萤火虫
email  : 445727994@qq.com
 */
$LANG['operate'] = [
	'edit' => '编辑',
	'add' => '添加',
	'view' => '查看',
	'del' => '删除',
	'unbind' => '解绑',
	'del_confirm' => '确认要删除吗？',
	'unbind_confirm' => '确认要解绑吗？',
	'examine' => '审核',
	'show' => '显示',
	'excel1' => 'excel导出',
	'excel2' => 'excel导入',
	'search' => '搜索',
	'getCheckData' => '操作',
	'operate' => '操作',
	'checked' => ['checked', ''],
	'checked_word' => ['否', '是'],
	'explode_err' => "数据错误，导出失败",
	'explode_suc' => "导出成功",
	'upload_suc' => "上传成功",
	'upload_err' => "上传失败",
];

$LANG['time'] = [
	'create' => '创建时间',
	'update' => '修改时间',
];
$LANG['return_msg'] = [
	'add' => ["msg" => '添加成功', "code" => 0],
	'edit' => ["msg" => "修改成功", "code" => 0],
	'del' => ["msg" => "删除成功", "code" => 0],
	'err' => ["msg" => "操作失败", "code" => 1],
	'suc' => ["msg" => "操作成功", "code" => 0],
	'select' => ["msg" => "请选择修改条件", "code" => 1],
	'add_err' => ["msg" => "添加失败", "code" => 1],
	'edit_err' => ["msg" => "修改失败", "code" => 1],
	'success' => ["msg" => '登录成功,正在跳转', "code" => 0],
	'not_exist' => ["msg" => '用户名不存在', "code" => 1],
	'password_error' => ["msg" => '密码错误', "code" => 1],
	'csrf' => ['msg' => '非法提交', 'code' => 1],
];
$LANG['Webconfig'] = [
	'edit' => "编辑网站信息",

];
return $LANG;
