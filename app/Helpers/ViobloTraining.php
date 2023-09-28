<?php

namespace App\Helpers;

use Sunra\PhpSimple\HtmlDomParser;

class ViobloTraining
{
    private $url;

    public function __construct($link)
    {
        $this->url = $link;
    }

    private function getDom($link)
    {
        $ch = curl_init($link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Khi thực thi lệnh sẽ k view ra trình duyệt mà lưu lại vào 1 biến kiểu string
        $content = curl_exec($ch);
        curl_close($ch);
        $dom = HtmlDomParser::str_get_html($content);

        return $dom;
    }

    public function getList()
    {
        $dom = $this->getDom($this->url);
        foreach ($dom->find('.container .post-title-box a.link') as $link) {
            echo $link->innertext.'<br>';
        }
    }
}

//$a = new ViobloTraining('https://viblo.asia');
//$a->getList();
