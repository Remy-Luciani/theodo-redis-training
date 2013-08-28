<?php

namespace Theodo\Bundle\ScrumOrNotScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TheodoScrumOrNotScrumBundle:Default:index.html.twig', array('name' => $name));
    }
}
