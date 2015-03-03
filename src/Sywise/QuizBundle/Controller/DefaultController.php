<?php

namespace Sywise\QuizBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sywise\QuizBundle\Entity\Question;

class DefaultController extends Controller
{
    public function indexAction($name)
    {

        return $this->render('SywiseQuizBundle:Default:index.html.twig', array('name' => $name ));
    }

    public function createAction() {



        $question = new Question();
        $question->setDescription('A Foo Bar');
        $question->setOption1('19.99');
        $question->setAnswer('9');

        $em = $this->getDoctrine()->getManager();

        $em->persist($question);
        $em->flush();

        return new Response('Created Question id '.$question->getId());
        

    }
}
