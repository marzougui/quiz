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
        //Get count of questions
        $repository = $this->getDoctrine()->getRepository('SywiseQuizBundle:Question');
        $questions = $repository->findAll();
        $total = count($questions);

        $theQuestion = $questions[round(rand(0, $total - 1))];

        //Creating the Form:
        $form = $this->createFormBuilder()
            ->add('save', 'submit', array('label' => 'Create Question'))
            ->add('answer', 'choice', array(
                'label' => 'Possible answers:',
                'choices' => array(
                    '1' => $theQuestion->getOption1(),
                    '2' => $theQuestion->getOption2(),
                    '3' => $theQuestion->getOption3(),
                    '4' => $theQuestion->getOption4(),
                ),
                'expanded' => true,
                'multiple' => false
            ))
            ->add('questionId', 'hidden', array(
                'data' => $theQuestion->getId()
            ))
            ->add('save', 'submit', array('label' => 'Check answer'))
            ->setAction($this->generateUrl('sywise_process'))
            ->getForm();


        return $this->render('SywiseQuizBundle:Play:index.html.twig',
            array('total' => $total,
                'theQuestion' => $theQuestion,
                'form' => $form->createView()
            )
        );
    }

    public function processAction(Request $request)
    {

        $question = new Question();
        //Get count of questions
        $repository = $this->getDoctrine()->getRepository('SywiseQuizBundle:Question');
        $questions = $repository->findAll();
        $total = count($questions);


        $theQuestion = $questions[round(rand(0, $total - 1))];

        //Creating the Form:
        $form = $this->createFormBuilder()
            ->add('save', 'submit', array('label' => 'Create Question'))
            ->add('answer', 'choice', array(
                'label' => 'Possible answers:',
                'choices' => array(
                    '1' => $theQuestion->getOption1(),
                    '2' => $theQuestion->getOption2(),
                    '3' => $theQuestion->getOption3(),
                    '4' => $theQuestion->getOption4(),
                ),
                'expanded' => true,
                'multiple' => false
            ))
            ->add('questionId', 'hidden', array(
                'data' => $theQuestion->getId()
            ))
            ->add('save', 'submit', array('label' => 'Check answer'))
            ->getForm();


        $form->handleRequest($request);

        if ($form->isValid()) {


            $data = $form->getData();
            $theQuestion = $repository->find($data['questionId']);


            $session = $this->getRequest()->getSession();

            if ($data['answer'] == $theQuestion->getAnswer()) {
                $session->getFlashBag()->add('message', 'Correct !');

            } else {
                $session->getFlashBag()->add('message', 'Wrong !');
            }

            return $this->render('SywiseQuizBundle:Play:answer.html.twig',
                array('theQuestion' => $theQuestion,
                    'userResponse' => $data['answer']));

        } else {


        }


        return $this->render('SywiseQuizBundle:Play:index.html.twig',
            array('total' => $total,
                'theQuestion' => $theQuestion,
                'form' => $form->createView()
            )
        );


    }
}
