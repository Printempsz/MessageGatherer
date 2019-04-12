<?php
/**
 * Created by PhpStorm.
 * User: zhanghaolan(zhanghaolan@zuoyebang.com)
 * Date: 2018/11/23
 * Time: 19:58
 */

require 'vendor/autoload.php';
require 'Segmentation.php';
require 'conf_file.php';

use QL\QueryList;

$urlConf = ConfFile::$urlConf;

//zhihu_article
$conf = $urlConf['zhihu_article'];
$domain = 'zhuanlan.zhihu.com';
$headers = [
    'host' => $domain,
    'authority' => 'zhuanlan.zhihu.com',
    "user-agent" => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36',
    'accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
    'cookie' => '_zap=9a3ca75c-f200-41d2-b20d-d9908815e813; _xsrf=2vS10VVjVwKGHv4RgT92pdaaElE7PUVr; d_c0="AMBg-NoN9w6PTkvqURiINW2SQ4BIbd8MgVs=|1549877690"; z_c0="2|1:0|10:1549877694|4:z_c0|92:Mi4xTnN3d0FnQUFBQUFBd0dENDJnMzNEaVlBQUFCZ0FsVk52bzlPWFFBb0hLMjhCUHhOYzgyelUtb0JhSmpwd2l2aGR3|22aed38c0be78913a75f22394329bc9a46dae70d5b6c6a96bc26f492188883bf"; q_c1=ab91798c4e6f493eb47b61987173b269|1551675335000|1551675335000; tgw_l7_route=a37704a413efa26cf3f23813004f1a3b'
];
$count_conf = count($conf);
$chan = new Swoole\Coroutine\Channel(count($conf));
foreach ($conf as $id) {
    go(function () use ($domain,$headers,$chan,$id) {
        $url = '/p/'.$id;
        $cli = new Swoole\Coroutine\Http2\Client($domain,443,true);
        $cli->set([
            'timeout' => -1,
            'ssl_host_name' => $domain
        ]);
        $cli->connect();
        $req = new swoole_http2_request;
        $req->method = 'GET';
        $req->path = $url;
        $req->headers = $headers;
        $cli->send($req);
        $response = $cli->recv();
        $html = QueryList::html($response->data);
        $text = $html->find('#root > div > main > div > article > div:nth-child(2) > div')->text();
        $title = $html->find('#root > div > main > div > article > header > h1')->text();
        $cover = $html->find('#root > div > main > div > img')->src;
        if($cover == null) $cover = 'http://nwzimg.wezhan.cn/contents/sitefiles2002/10012495/images/606933.jpg';
        $data = [
            'id' => $id,
            'url' => 'zhuanlan.zhihu.com'.$url,
            'text' => $text,
            'title' => $title,
            'cover' => $cover,
        ];

        $chan->push($data);
    });
}

//循环取通道里的数据
go(function () use ($chan,$count_conf) {
    $redis = new Swoole\Coroutine\Redis();
    $redis->connect('127.0.0.1', 6379);

    $mysql = new Swoole\Coroutine\Mysql();
    $mysql->connect([
        'host' => '127.0.0.1',
        'port' => 3306,
        'user' => 'root',
        'password' => '',
        'database' => 'MessageGather',
    ]);
    $count = 0;
    while (1) {
        $data = $chan->pop();
        if(!empty($data)) {
            $id = $data['id'];
            $text = $data['text'];
            $seg = Segmentation::extractTags($text,10);
            $strSeg = implode(',',array_keys($seg));
            $data['seg'] = ','.$strSeg.',';
            $redis->hMset('zhihu_article_'.$id,$data);

            $flag = $mysql->query("select id from zhihu_articles where article_id = $id");

            if($flag == null) {
                $sql = 'INSERT INTO zhihu_articles (article_id,url,title,text,seg,cover) VALUES (?,?,?,?,?,?)';
                $stmt = $mysql->prepare($sql);
                $stmt->execute([
                    $data['id'],
                    $data['url'],
                    $data['title'],
                    $data['text'],
                    $data['seg'],
                    $data['cover'],
                ]);
            }

            $count ++;
            if($count == $count_conf) break;
        }
    }
});