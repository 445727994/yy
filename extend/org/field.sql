

CREATE TABLE `yhc_other` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '#yhc_name#id#',
  `web_show` Text NOT NULL DEFAULT '' COMMENT '#yhc_name#个人拍照信息查看说明#yhc_type#textarea#',
  `pay_show` Text NOT NULL DEFAULT '' COMMENT '#yhc_name#缴费说明#yhc_type#textarea#',
  `correct_errors` Text NOT NULL DEFAULT '' COMMENT '#yhc_name#照片勘误#yhc_type#textarea#',
  `img_show` Text NOT NULL DEFAULT '' COMMENT '#yhc_name#照片说明#yhc_type#textarea#',
  `photo_require` Text NOT NULL DEFAULT '' COMMENT '#yhc_name#拍照要求#yhc_type#textarea#',
  `light_require` Text NOT NULL DEFAULT '' COMMENT '#yhc_name#照明光线要求#yhc_type#textarea#',
  `img_require` Text NOT NULL DEFAULT '' COMMENT '#yhc_name#数字化图像文件要求#yhc_type#textarea#',
  `shooting_require` Text NOT NULL DEFAULT '' COMMENT '#yhc_name#拍摄要求#yhc_type#textarea#',
  `retark_addr` Text NOT NULL DEFAULT '' COMMENT '#yhc_name#补拍地址#yhc_type#textarea#',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE TABLE `yhc_school` (
 `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '#yhc_name#id#',
  `code` varchar(50) DEFAULT NULL COMMENT '#yhc_name#学校编码#yhc_type#input#yhc_validate#require#',
 `school_name` varchar(100) DEFAULT NULL COMMENT '#yhc_name#学校名称#yhc_type#input#yhc_validate#require#',
 `city` varchar(50) NOT NULL DEFAULT '' COMMENT '#yhc_name#所在地#yhc_type#input#yhc_validate#require#',
  `address` char(250) NOT NULL DEFAULT COMMENT '#yhc_name#院校通讯地址#yhc_type#input#yhc_validate#require#',
 `connect` char(50) NOT NULL DEFAULT COMMENT '#yhc_name#联系人#yhc_type#input#yhc_validate#require#',
 `mobile` char(20) DEFAULT NULL COMMENT '#yhc_name#联系电话#yhc_type#input#yhc_validate#require#',
 `money` int(11) NOT NULL DEFAULT '0'  COMMENT '#yhc_name#邮费#yhc_type#input#yhc_validate#require#'
  `pay_money` int(11) NOT NULL DEFAULT '0'  COMMENT '#yhc_name#缴费金额#yhc_type#input#yhc_validate#require#'
 PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;


CREATE TABLE IF NOT EXISTS `yhc_orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '#yhc_name#id#',

  `openid` varchar(50) DEFAULT NULL COMMENT '#yhc_name#openid#yhc_type#input#yhc_validate#require#',

  `uptime` int(11) NOT NULL DEFAULT '0' COMMENT '#yhc_name#缴费时间#yhc_type#laydate#yhc_show#1',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '#yhc_name#创建时间#yhc_type#laydate#yhc_show#1',
  `oid` char(50) NOT NULL DEFAULT '' COMMENT '#yhc_name#订单号#yhc_type#input#yhc_validate#require#',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT  '#yhc_name#支付状态#yhc_type#select#yhc_value#{"0":"未支付","1":"已支付"}#',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '#yhc_name#金额#yhc_type#input#yhc_validate#require#',
  `need_send` tinyint(1) NOT NULL DEFAULT '1' COMMENT '#yhc_name#邮寄#yhc_type#select#yhc_value#{"1":"邮寄","2":"自取"}#',
   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1650 DEFAULT CHARSET=utf8 COMMENT='用户缴费表';

/**
 *yhc_name  名称
 *yhc_type  edit add 表单填写方式
 *yhc_show  1不显示  默认不填为0 显示
 *yhc_radio 单选
 *yhc_value   json格式 需要选值时填写
 */
 CREATE TABLE `information` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '#yhc_name#id#',
  `usercard` char(18) DEFAULT NULL COMMENT '#yhc_name#身份证#yhc_type#input#yhc_validate#require#',
  `ps_number` varchar(50) DEFAULT NULL COMMENT '#yhc_name#拍摄序号#yhc_type#input#yhc_validate#require#',
  `study_level` varchar(40) DEFAULT NULL COMMENT '#yhc_name#学历层次#yhc_type#select#yhc_validate#require',
  `study_id` varchar(20) DEFAULT NULL COMMENT '#yhc_name#学号#yhc_type#input#yhc_validate#require#',
  `user_name` varchar(20) DEFAULT NULL COMMENT '#yhc_name#学生姓名#yhc_type#input#yhc_validate#require#',
  `sex` varchar(10) DEFAULT NULL COMMENT '#yhc_name#性别#yhc_type#switch#yhc_value#{"1":"男","0":"女"}',
  `schooldistinction` varchar(30) DEFAULT NULL COMMENT '#yhc_name#所在校别#yhc_type#input#yhc_validate#require#',
  `schoolname` varchar(50) DEFAULT NULL COMMENT '#yhc_name#院校名称#yhc_type#input#yhc_validate#require#',
  `schoolcode` varchar(50) DEFAULT NULL COMMENT '#yhc_name#院校代码#yhc_type#input#',
  `major` varchar(50) DEFAULT NULL COMMENT '#yhc_name#专业#yhc_type#input#',
  `departmentname` varchar(50) DEFAULT NULL COMMENT '#yhc_name#院系名称#yhc_type#input#',
  `departmentcode` varchar(50) DEFAULT NULL COMMENT '#yhc_name#院系代码#yhc_type#input#',
  `class` varchar(50) DEFAULT NULL COMMENT '#yhc_name#班级#yhc_type#input#',
  `is_pay` int(1) NOT NULL COMMENT '#yhc_name#是否付款#yhc_type#switch#yhc_value#{"1":"是","0":"否"}',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '#yhc_name#创建时间#yhc_type#laydate#yhc_show#1',
  `is_ok` int(11) NOT NULL DEFAULT '0'  COMMENT '#yhc_name#创建时间#yhc_type#laydate#yhc_show#1',
  `tb_time` int(11) NOT NULL DEFAULT '0' COMMENT '#yhc_name#同步时间#yhc_type#laydate#yhc_show#0',
  `mobile` char(11) NOT NULL DEFAULT ''  COMMENT  '#yhc_name#手机号#yhc_type#input#',
  `is_confirm` tinyint(3) NOT NULL DEFAULT '0' COMMENT '#yhc_name#信息确认#yhc_type#select#yhc_validate#require',
  `exam_id` varchar(50) DEFAULT '0'  COMMENT '#yhc_name#考生号#yhc_type#input#yhc_validate#require',
  `view_subscribe` int(1) DEFAULT '0' COMMENT '#yhc_name#预约补拍权限#yhc_type#switch#yhc_value#{"1":"是","0":"否"}',
  `view_voluntarily` int(1) DEFAULT '0' COMMENT '#yhc_name#自行补拍权限#yhc_type#switch#yhc_value#{"1":"是","0":"否"}',
  `educational_type` varchar(50) NOT NULL COMMENT '#yhc_name#学历类别#yhc_type#select#yhc_value#{"0":"普通","1":"成人","2":"研究生","3":"网络"}#',
  `cj_time` int(11) DEFAULT NULL COMMENT '#yhc_name#采集年份#yhc_type#input#yhc_validate#require',
  `batch_id` int(255) DEFAULT NULL COMMENT '#yhc_name#批次号#yhc_type#input#',
  `batchcode` varchar(255) DEFAULT '' COMMENT '#yhc_name#批次注释#yhc_type#input#',
  PRIMARY KEY (`id`),
  KEY `ps_number` (`ps_number`),
  KEY `usercard` (`usercard`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


