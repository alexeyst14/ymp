<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27.08.14
 * Time: 16:49
 */

namespace Avkdev\YmParserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Avkdev\YmParserBundle\Entity\Product;

class LoadProductData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product
                ->setCurrency("грн")
                ->setDescr("стационарный, автомобильный, ПО: Garmin, дисплей 5 дюйм., 480x272 пикс., USB, слот MicroSD, голосовые сообщения")
                ->setName("Garmin nuvi 150LMT")
                ->setRetail(2560 + $i * 10)
                ->setUrlOriginal("http://market.yandex.ua/model.xml?modelid=8512100&hid=294661")
                ->setUrlPhoto("http://mdata.yandex.net/i?path=b0922125700_img_id336785696886444143.jpeg");
            $manager->persist($product);
        }
        $manager->flush();


    }
} 