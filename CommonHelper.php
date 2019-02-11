<?php
/**
 * Created by PhpStorm.
 * User: zhl19
 * Date: 2019/2/8
 * Time: 15:41
 */

class CommonHelper
{
    static public function getHeader($domain)
    {
        $headers = [
            'Cookie' => '_zap=28bea275-ab69-4f7e-8841-b1a0c3629924; d_c0="AKDihtwCgg6PTtR_E926JXEplub-Ite6sxE=|1542023071"; q_c1=0c83bc8b169042e0872cc8c863a43801|1542023072000|1542023072000; capsion_ticket="2|1:0|10:1542074085|14:capsion_ticket|44:ZjQ1MDIyZTU1NGQ0NDk5MmE4ODI1NDAzMzdmM2NmMWU=|b57628f4da366c83ea7f80bfd20b6eb82d64674e9a1beca1cf586fda0c2bf0be"; z_c0="2|1:0|10:1542074086|4:z_c0|92:Mi4xTnN3d0FnQUFBQUFBb09LRzNBS0NEaVlBQUFCZ0FsVk41bnpYWEFEMnVQblBKLWRFMHRGS2tZQnVGYTVUckxyN1R3|23455ad185e3cc342382bc63c189c864f8c5aeef706e5e041d9d258082e9b2a4"; tst=r; __utma=155987696.1408205289.1542074341.1542074341.1542074341.1; __utmz=155987696.1542074341.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none); _xsrf=qab6ySNKdTmyt2rJA7C8DjbQbU54vhS1; tgw_l7_route=56f3b730f2eb8b75242a8095a22206f8',
            'Referer' => 'https://www.zhihu.com',
            'Origin' => 'https://www.zhihu.com'
        ];
        return $headers;
    }

}