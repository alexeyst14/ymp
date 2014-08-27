<?php

namespace Avkdev\YmParserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $products = $this->getDoctrine()
            ->getManager()
            ->getRepository('AvkdevYmParserBundle:Product')->findAll();
        return $this->render('AvkdevYmParserBundle:Default:index.html.twig', array('products' => $products));
    }
}
