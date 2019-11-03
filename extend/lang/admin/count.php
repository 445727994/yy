<?php
$LANG = [
	'index' => '列表',
	'add' => '添加',
	'edit' => '编辑',
	'search_array' => [
		'a.user_id' => [
			'name' => '用户名', 'type' => 'select_table', 'value' => 'user',
			'where' => '', 'list_key' => 'id', 'group' => "",
			'list_value' => 'username', 'width' => 160,
		],
		'a.store_id' => [
			'name' => '店铺名', 'type' => 'select_table', 'value' => 'store',
			'where' => '', 'list_key' => 'id', 'group' => "",
			'list_value' => 'name', 'width' => 160,
		],
		'a.create_time' => [
			'name' => '选择订单开始时间',
			'type' => 'date',
			'num' => '2',
		],
		'a.status' => [
			'name' => '状态',
			'type' => 'select',
			'value' => ['0' => '全部', '1' => '已下单', '2' => '已发货', '3' => '确认收货'],
			'width' => 90,
		],
	],
	'field' => [
		'order_no' => '订单号',
		'user_id' => '购买人',
		'store_id' => '购买店铺',
		'username' => '购买时用户名',
		'storename' => '购买时店铺名',
		'money' => '总金额',
		'status' => '状态',
		'create_time' => '创建时间',
		'update_time' => '更新时间',
	],

];
return $LANG;