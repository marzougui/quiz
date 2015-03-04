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
        $theQuestion = $repository->findBy(array('id' => '2' ));


        //$questions = $repository->findAll();
        $total = 0; //count ($questions);


        //Fetch a random question by ID

        $t= 7;
        $theQuestion = $repository->find( $t );


        print_r ('<pre>');
        //print_r ( $questions );
        print_r ('</pre>');

        return $this->render('SywiseQuizBundle:Play:index.html.twig',
            array('total' => $total,
                'theQuestion' => $theQuestion,
            'description' => "eeeeeeeee"));
    }
}
