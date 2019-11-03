<?php
/*
 * @auther 萤火虫 445727994@qq.com
 * @create_time !$time!
 */
namespace app\!$module!\validate;
use think\Validate;
class !$table! extends Validate
{
    protected $rule =[
        !$rule!
    ];

    protected $message =[
        !$msg!
    ];
    protected $scene = [
        'add'   => [!$add!],
        'edit'  => [!$edit!],
    ];
}
