<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27.08.14
 * Time: 18:55
 */

namespace Avkdev\YmParserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Avkdev\YmParserBundle\Entity\Product;

class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // products
        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product
                ->setCurrency("грн")
                ->setDescr("стационарный, автомобильный, ПО: Garmin, дисплей 5 дюйм., 480x272 пикс., USB, слот MicroSD, голосовые сообщения")
                ->setName("Garmin nuvi 150LMT")
                ->setRetail(2560 + $i * 10)
                ->setCategory($manager->merge($this->getReference('cat1')))
                ->setYandexModelId('5345435435' . $i)
                ->setUrlOriginal("http://market.yandex.ua/model.xml?modelid=8512100&hid=294661")
                ->setUrlPhoto("http://mdata.yandex.net/i?path=b0922125700_img_id336785696886444143.jpeg");
            $manager->persist($product);
        }
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}
