<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 29.08.14
 * Time: 20:52
 */

namespace Avkdev\YmParserBundle\Parser;

use Avkdev\YmParserBundle\Parser\AbstractParser;

class YandexMarket extends AbstractParser
{

    public function parse()
    {
        $this->buildUrl();
        
    }

    protected function buildUrl()
    {
        $yandexCatId = $this->task->getCategory()->getYandexCatId();
        $pattern = "http://market.yandex.ua/guru.xml?CMD=-RR=0,0,0,0-VIS=270-CAT_ID=%d-PG=%d";
        return sprintf($pattern, $yandexCatId, $this->buildPageOffset($this->numPage));
    }

    protected function buildPageOffset($numPage)
    {
        return $numPage * 10 - 10;
    }

}
