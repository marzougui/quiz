<?php

namespace Sywise\QuizBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request; //necessary for processing the Request.
use Sywise\QuizBundle\Entity\Question;
use Sywise\QuizBundle\Form\QuestionType;

class PlayController extends Controller
{
    public function indexAction()
    {
        //Get count of question

        $repository = $this->getDoctrine()->getRepository('SywiseQuizBundle:Question');

        $theQuestion = $repository->find(20);

        $questions = $repository->findAll();
        $total = count ($questions);


        //Fetch a random question by ID

        return $this->render('SywiseQuizBundle:Play:index.html.twig',
            array('total' => $total,
                'theQuestion' => $theQuestion);
    }
}
