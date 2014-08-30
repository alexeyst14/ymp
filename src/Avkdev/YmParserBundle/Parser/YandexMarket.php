<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 29.08.14
 * Time: 20:52
 */

namespace Avkdev\YmParserBundle\Parser;

use Avkdev\YmParserBundle\Entity\Product;
use Avkdev\YmParserBundle\Parser\AbstractParser;
use Symfony\Component\HttpFoundation\Request;

class YandexMarket extends AbstractParser
{

    /**
     * {@inherit}
     */
    public function parse()
    {
        $num = $this->container->getParameter('ymparser_num_pages');
        // start parsing
        for ($i = 2; $i <= $num; $i++) {
            $this->setNumPage($i);
            $url = $this->buildUrl();

            echo "$url\n";
            $browser = $this->container->get('buzz.browser');
            $entities = $this->makeOutHtml($browser->get($url, $this->getHeaders()));
            $this->persistProducts($entities);


            die();
            sleep(3);
        }

    }

    /**
     * @param $response \Buzz\Message\Response
     */
    protected function makeOutHtml($response)
    {
        $xpath = new \DOMXPath($response->toDomDocument());
        $nodes = $xpath->query("//div[@id]");

        $entities = [];
        $i = 0;

        /** @var $node \DOMElement */
        foreach ($nodes as $node) {
            $product = new Product();
            $product->setCategory($this->task->getCategory());

            // yandex_model_id
            $product->setYandexModelId($node->getAttribute('id'));

            // parse <a> tag
            $tag = $node->getElementsByTagName('a')->item(1);
            $product->setUrlOriginal($tag->attributes->getNamedItem('href')->nodeValue);
            $product->setName($tag->nodeValue);

            // parse <img> tag
            $product->setUrlPhoto(
                $node->getElementsByTagName('img')
                ->item(0)->attributes
                ->getNamedItem('src')->nodeValue
            );

            // parse <p> tag
            $product->setDescr(trim($node->getElementsByTagName('p')->item(0)->nodeValue));
            $entities[$i++] = $product;
        }

        // parse retail and currency
        $nodes = $xpath->query('//span[starts-with(@class,"b-prices")]');
        $i = -1;
        /** @var $node \DOMElement */
        foreach ($nodes as $node) {
            $i++;
            $childs = $node->getElementsByTagName('span');
            if ($childs->length == 0) {
                continue;
            }
            /** @var $childNode \DOMElement */
            $entities[$i]->setRetail((double)trim($childs->item(0)->nodeValue));
            $entities[$i]->setCurrency(trim($childs->item(1)->nodeValue));
        }

        return $entities;
    }

    /**
     * {@inherit}
     */
    protected function buildUrl()
    {
        $yandexCatId = $this->task->getCategory()->getYandexCatId();
        $pattern = "CMD=-RR=0,0,0,0-VIS=270-CAT_ID=%d-BPOS=%d";
        return "http://market.yandex.ua/guru.xml?" .
            sprintf($pattern, $yandexCatId, $this->buildPageOffset($this->numPage));
    }

    /**
     * {@inherit}
     */
    protected function buildPageOffset($numPage)
    {
        return $numPage * 10 - 10;
    }

    /**
     * @return array
     */
    protected function getHeaders()
    {
        return array(
            'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.94 Safari/537.36',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
            'Accept-Language' => 'ru,uk;q=0.8,en-US;q=0.6,en;q=0.4',
            'Accept-Encoding' => 'gzip,deflate,sdch',
            'Connection' => 'keep-alive',
            'Cookie' => 'fuid01=533555a26a8f3b82.2L4g2_Nbsh7iUYY7k6mBMJevRvcTw7O1tAFPw5aWQTqGF1uLkWlv9vlDZymS9n16J2PO7is5FEQsQe-ajbKnHoAD-6TBDJjDptRjYB7Ed_iAw9f-XhNocNd2IdiaBFBc; yandexuid=106970761394314933; ys=wprid.1403073436079795-480307191671301785517789-8-047-PPS; yabs-frequency=/4/0000000000000000/jSznS7GPH_RFSN1q6Lm0/; Session_id=noauth:1406622004; M=1409147239420; ps_gch=1863671348593794048; uid=CmZNWlP94WcYr20AByV0Ag==; TOP10=9281948,10406906,8226328,10413823,10505954,9367527,10711495,10848877,10481279,10692975; markethistory=<h><cm>686672-10404684</cm><cm>160043-10495456</cm><cm>971072-8512100</cm><m>160043-10495456</m><m>686672-10404684</m><m>106388-6211881</m><m>971072-8512100</m><c>686672</c><c>160043</c><c>115828</c></h>; ps_bch=3467907325981784064; yandexmarket=10,UAH,1,,,,2,0,0; cuts=0; _ym_visorc_160656=w',
        );
    }


    protected function persistProducts(array $entities)
    {

    }

}
