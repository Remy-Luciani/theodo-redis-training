<?php

namespace Theodo\Bundle\ScrumOrNotScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;

use Theodo\Bundle\ScrumOrNotScrumBundle\Entity\User;

class ScrumQuizController extends Controller
{
    /**
     * @param $name
     *
     * @Config\Route("/hello/{name}")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($name)
    {
        $user = new User();
        $user->setName($name);

        $this->get('theodo_scrum_or_not_scrum.manager.user')->register($user);

        return $this->render('TheodoScrumOrNotScrumBundle:Default:index.html.twig', array('user' => $user));
    }
}
