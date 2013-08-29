<?php

namespace Theodo\Bundle\ScrumOrNotScrumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;
use Symfony\Component\HttpFoundation\RedirectResponse;

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
        $scrumQuizs = $this->get('theodo_scrum_or_not_scrum.manager.scrum_quiz')->findAll();

        return array(
            'scrumQuizs' => $scrumQuizs,
        );
    }

    /**
     * @param Request $request
     *
     * @Config\Route("/add-scrum-quiz")
     * @Config\Template()
     *
     * @return array|RedirectResponse
     */
    public function addScrumQuizAction(Request $request)
    {
        // Generate Form
        $form = $this->createForm(new RegisterScrumQuizType(), new ScrumQuiz);

        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                // Save the quiz through a ScrumQuizManager service
                $this->get('theodo_scrum_or_not_scrum.manager.scrum_quiz')->save($form->getData());                

                // Redirect somewhere
                return $this->redirect($this->generateUrl('theodo_scrumornotscrum_scrumquiz_index'));
            }
        }

        // Return form
        return array(
            'form' => $form->createView()
        );
    }
}
