<?php
/**
 * Created by PhpStorm.
 * User: zhl19
 * Date: 2019/4/7
 * Time: 22:46
 */


require 'vendor/autoload.php';


use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\Finalseg;
use Fukuball\Jieba\JiebaAnalyse;

class Segmentation {
    public static function extractTags($data,$top_k = 10)
    {
        Jieba::init();
        Finalseg::init();
        \Fukuball\Jieba\JiebaAnalyse::init();
//        Jieba::loadUserDict('user_dict.txt');
        Jieba::addWord('电子科大',2000);
//    $seg_list = Jieba::cut($data);
//    $out = array_count_values($seg_list);
        $out = JiebaAnalyse::extractTags($data,$top_k);
        arsort($out);
        return $out;
    }

    /**
     * @param $data
     * @param int $search_mode 0 默认模式；1 搜索引擎模式
     */
    public static function cut($data,$search_mode = 0)
    {
        Jieba::init();
        Finalseg::init();
        \Fukuball\Jieba\JiebaAnalyse::init();
        Jieba::addWord('电子科大',2000);
//        Jieba::loadUserDict(' /mnt/c/Users/zhl19/MessageGatherer/vendor/fukuball/jieba-php/src/dict/user_dict.txt');
        if($search_mode == 1) {
            return Jieba::cutForSearch($data);
        } else {
            return Jieba::cut($data);
        }
    }
}
