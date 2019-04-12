<?php
/**
 * Created by PhpStorm.
 * User: zhl19
 * Date: 2019/4/6
 * Time: 15:29
 */

require 'vendor/autoload.php';
require 'Segmentation.php';

//use QL\QueryList;
//
//
//$domain = 'zhuanlan.zhihu.com';
//$headers = [
//    'host' => $domain,
//    'authority' => 'zhuanlan.zhihu.com',
//    "user-agent" => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36',
//    'accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
//    'cookie' => '_zap=9a3ca75c-f200-41d2-b20d-d9908815e813; _xsrf=2vS10VVjVwKGHv4RgT92pdaaElE7PUVr; d_c0="AMBg-NoN9w6PTkvqURiINW2SQ4BIbd8MgVs=|1549877690"; z_c0="2|1:0|10:1549877694|4:z_c0|92:Mi4xTnN3d0FnQUFBQUFBd0dENDJnMzNEaVlBQUFCZ0FsVk52bzlPWFFBb0hLMjhCUHhOYzgyelUtb0JhSmpwd2l2aGR3|22aed38c0be78913a75f22394329bc9a46dae70d5b6c6a96bc26f492188883bf"; q_c1=ab91798c4e6f493eb47b61987173b269|1551675335000|1551675335000; tgw_l7_route=a37704a413efa26cf3f23813004f1a3b'
//];
//
//$chan = new Swoole\Coroutine\Channel(2);

//echo microtime(true).'-----------------1--------start'.PHP_EOL;
go(function () use ($domain,$headers,$chan) {
//    $cli = new Swoole\Coroutine\Http2\Client($domain, 443, true);
//    $cli->set([
//        'timeout' => -1,
//        'ssl_host_name' => $domain
//    ]);
//    $cli->connect();
//    $req = new swoole_http2_request;
//    $req->method = 'GET';
////    $req->path = '/p/44593798';
//    $req->path = '/p/20577638';
//    $req->headers = $headers;
//    $cli->send($req);
//    $response = $cli->recv();
//
//    $data = QueryList::html($response->data)->find('#root > div > main > div > article > div:nth-child(2) > div')->text();

    $data = '我在电子科大刷知乎看到了一个关于nlp的论文';
//    $data = '李小福是创新办主任也是云计算方面的专家';
//    $out = Segmentation::cut($data,0);
    $out = Segmentation::extractTags($data,5);
    echo $data.PHP_EOL;
    print_r($out);
});

