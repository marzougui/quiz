<?php

namespace Sywise\QuizBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {

        return $this->render('SywiseQuizBundle:Default:index.html.twig', array('name' => $name ));
    }
}
