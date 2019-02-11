<?php
/**
 * Created by PhpStorm.
 * User: zhanghaolan(zhanghaolan@zuoyebang.com)
 * Date: 2018/11/23
 * Time: 20:41
 */

require_once 'spider_factory.php';

use QL\QueryList;

class zhihu_activities_spider implements spider_interface
{
    public function work($seed)
    {
        $this->ql = QueryList::get($seed,$this->headers);
        return $this->ql->find();
    }
}