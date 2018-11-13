<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/13
 * Time: 9:35
 */
require_once(__DIR__ . '/vendor/autoload.php');

use Beanbun\Beanbun;
$beanbun = new Beanbun;
$beanbun->seed = [
    'https://www.zhihu.com/api/v4/members/zhang-jia-wei/followers?include=data%5B*%5D.following_count%2Cfollower_count&limit=20&offset=0'
];

$beanbun->beforeDownloadPage = function ($beanbun) {
    $beanbun->options['headers'] = [
        'Host' => 'www.zhihu.com',
        'Connection' => 'keep-alive',
        'Cache-Control' => 'max-age=0',
        'Upgrade-Insecure-Requests' => '1',
        'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
        'Accept' => 'application/json, text/plain, */*',
        'Accept-Encoding' => 'gzip, deflate, sdch, br',
    ];
};

$beanbun->afterDownloadPage = function($beanbun) {
    var_dump($beanbun->page);
    file_put_contents(__DIR__ . '/' . 'downloads' . '/' . md5($beanbun->url) . '.html', $beanbun->page);
    //TODO
    /* add a queue and use BFS
     * fix charset bug
     */
};
$beanbun->start();
