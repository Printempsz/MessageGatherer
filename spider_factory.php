<?php
/**
 * Created by PhpStorm.
 * User: zhanghaolan(zhanghaolan@zuoyebang.com)
 * Date: 2018/11/23
 * Time: 20:14
 */
require_once 'zhihu_activities_spider.php';
require_once 'zhihu_article_spider.php';


class spider_factory
{
    public static function GetWorker($domain,$headers)
    {
        switch ($domain) {
            case 'zhihu' :
                return new zhihu_article_spider($headers);
        }
    }
}