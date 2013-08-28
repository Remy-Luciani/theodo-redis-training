<?php

namespace Theodo\Bundle\ScrumOrNotScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Theodo\Bundle\ScrumOrNotScrumBundle\Entity\User;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        $user = new User();
        $user->setName($name);

        return $this->render('TheodoScrumOrNotScrumBundle:Default:index.html.twig', array('user' => $user));
    }
}
