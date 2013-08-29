<?php

namespace Theodo\Bundle\ScrumOrNotScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;

use Symfony\Component\HttpFoundation\Request;
use Theodo\Bundle\ScrumOrNotScrumBundle\Form\RegisterScrumQuizType;
use Theodo\Bundle\ScrumOrNotScrumBundle\Entity\ScrumQuiz;

class ScrumQuizController extends Controller
{
    /**
     * @Config\Route("/")
     * @Config\Template()
     *
     * @return array
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @param Request $request
     *
     * @Config\Route("/add-scrum-quiz")
     * @Config\Template()
     *
     * @return array
     */
    public function addScrumQuizAction(Request $request)
    {
        // Generate Form
        $form = $this->createForm(new RegisterScrumQuizType(), new ScrumQuiz);

        // Handle the request

        // Save the quiz through a ScrumQuizManager service

        // Redirect somewhere
        return array(
            'form' => $form->createView()
        );
    }
}
