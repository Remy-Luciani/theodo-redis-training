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

        $this->get('theodo_scrum_or_not_scrum.manager.user')->register($user);

        return $this->render('TheodoScrumOrNotScrumBundle:Default:index.html.twig', array('user' => $user));
    }
}
