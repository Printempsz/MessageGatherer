<?php
/**
 * Created by PhpStorm.
 * User: zhanghaolan(zhanghaolan@zuoyebang.com)
 * Date: 2018/11/23
 * Time: 20:38
 */

use QL\QueryList;

//知乎文章的爬虫
class zhihu_article_spider implements spider_interface
{
    private $ql;

    public function __construct($headers)
    {
        $this->headers = ['headers' => $headers];
    }

    /**
     * @param $seed
     * @deprecated 爬虫工作的主函数
     * @return \QL\Dom\Elements
     */
    public function work($seed)
    {
        $this->ql = QueryList::get($seed,[],$this->headers);
        return $this->ql->find('#root > div > main > div > article > div:nth-child(2) > div');
    }
}