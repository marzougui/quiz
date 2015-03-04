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

        return $this->render('SywiseQuizBundle:Play:index.html.twig', array('name' => "eeeeeeeee"));
    }
}
