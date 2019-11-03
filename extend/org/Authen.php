<?php
namespace org\Authen;
use think\Db;
use think\Config;
use think\Session;
use think\Request;
use think\Loader; 
/*
    Auther :  萤火虫
    email  : 445727994@qq.com
 */
/*
-- ----------------------------
-- think_auth_rule，规则表，
-- id:主键，name：规则唯一标识, title：规则中文名称 status 状态：为1正常，为0禁用，condition：规则表达式，为空表示存在就验证，不为空表示按照条件验证
-- ----------------------------
CREATE TABLE `yhc_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '分组',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父id',
  `name` char(200) NOT NULL DEFAULT '' COMMENT '名称',
  `url` char(50) NOT NULL DEFAULT '0' COMMENT '菜单路径',
  `icon` char(200) NOT NULL DEFAULT 'fa-folder-open-o' COMMENT '样式',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `code` varchar(1000) DEFAULT '' COMMENT '其他相关授权code',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- yhc_role 角色表，
-- id：主键， title:用户组中文名称， ：用户组拥有的规则id， json，is_limit状态：为1正常，为0禁用
-- ----------------------------
CREATE TABLE `yhc_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `rule_id` text NOT NULL COMMENT '权限  json',
  `is_limit` tinyint(1) NOT NULL DEFAULT '1',
  `note` varchar(1000) NOT NULL DEFAULT '' COMMENT '备注',
  `create_id` tinyint(3) NOT NULL DEFAULT '0',
  `prov_id` int(11) NOT NULL DEFAULT '0',
  `city_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

 */
class Authen extends Common{
	 /**
     * @var object 对象实例
     */
    protected static $instance;
    /**
     * 当前请求实例
     * @var Request
     */
    protected $request;

    //默认配置
    protected $config = [
        'auth_on'           => 1, // 权限开关
        'auth_type'         => 1, // 认证方式，1为实时认证；2为登录认证。
        'auth_group'        => 'auth_group', // 用户组数据表名
        'auth_group_access' => 'auth_group_access', // 用户-用户组关系表
        'auth_rule'         => 'auth_rule', // 权限规则表
        'auth_user'         => 'member', // 用户信息表
    ];

}