<?php
/**
 * Created by PhpStorm.
 * User: zhl19
 * Date: 2019/2/8
 * Time: 15:08
 */

require_once 'vendor/autoload.php';
require_once 'CommonHelper.php';

use QL\QueryList;

/**
 * Class zhihu_spider
 * @desc 将知乎动态和知乎文章的爬虫函数写在一个类里面
 */
class zhihu_spider
{
    static private $header = [];

    static public function getInfo($url)
    {
        if(self::$header == []) {

        }
        $arr_url = explode('/',$url);
        if(in_array('p',$arr_url)) {
            $tpye = 'article';
            //todo
        } else {
            $type = 'activity';
            //todo
        }
    }

    static private function getArticleInfo($url)
    {
    }

    static private function getActivity($url)
    {
        $ql = QueryList::get($url,[],self::$header);
        $imgs = $ql->find('img')->attrs('*')->all();
        //TODO 存储图片？
        //关注内容的基本信息
        $focusInfo = $ql->find('.List-item .ContentItem.ArticleItem')->attrs('data-zop')->all();

    }
}