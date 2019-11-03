<?php
$LANG = [
	'index' => '列表',
	'add' => '添加',
	'edit' => '编辑',
	'search_array' => [
		'goodsname' => '输入商品名称查找',
      	'cate_id' => [
			'name' => '一级分类', 'type' => 'select_table', 'value' => 'cate',
			'where' => 'pid=0', 'list_key' => 'id', 'group' => "",
			'list_value' => 'name', 'width' => 160,
		],
	],
	'field' => [
		'goodsname' => '商品名称',
        'form_id'=>'自定义字段模板',
        'desc'=>'内容描述',
        'content'=>'内容',
        'sort'=>'排序',
        'img'=>'缩略图',
		'price' => '商品价格',
		'goods_img' => '商品图片',
		'create_time' => '创建时间',
		'update_time' => '更新时间',
	],

];
return $LANG;