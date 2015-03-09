<?php

namespace Sywise\QuizBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request; //necessary for processing the Request.
use Sywise\QuizBundle\Entity\Question;
use Sywise\QuizBundle\Form\QuestionType;

class DefaultController extends Controller
{
    public function indexAction($name)
    {

        return $this->render('SywiseQuizBundle:Default:index.html.twig', array('name' => $name));
    }

    public function addAction(Request $request)
    {
        $question = new Question();

        $form = $this->createForm(new QuestionType());

        $form = $this->createFormBuilder($question)
            ->add('description', 'text')
            ->add('option1', 'text')
            ->add('option2', 'text')
            ->add('option3', 'text')
            ->add('option4', 'text')
            ->add('comment', 'text')
            ->add('answer', 'integer')
            ->add('save', 'submit', array('label' => 'Create Question'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            // Persisting data
            $em = $this->getDoctrine()->getManager();
            $em->persist($question);
            $em->flush();
            $session = $this->getRequest()->getSession();
            $session->getFlashBag()->add('message', 'Article saved!');
            return $this->redirect($this->generateUrl('_welcome'));
        }
        $session->getFlashBag()->add('message', 'Problem in saving the Question !');
        return $this->render('SywiseQuizBundle:Default:new.html.twig', array('form' => $form->createView()));
    }

    public function createAction()
    {
        $question = new Question();
        $question->setDescription('Question description');
        $question->setOption1('Possible answer 1');
        $question->setOption2('Possible answer 2');
        $question->setOption3('Possible answer 3');
        $question->setOption4('Possible answer 4');
        $question->setComment('Comments to show');
        $question->setAnswer('1'); //TODO: change it to select list.

        $form = $this->createFormBuilder($question)
            ->add('description', 'text', array('label' => 'Announcement of the question: '))
            ->add('option1', 'text', array('label' => 'Possible answer 1: '))
            ->add('option2', 'text', array('label' => 'Possible answer 2: '))
            ->add('option3', 'text', array('label' => 'Possible answer 3: '))
            ->add('option4', 'text', array('label' => 'Possible answer 4: '))
            ->add('answer', 'integer', array('label' => 'ID numbre of the answer: '))
            ->add('comment', 'text', array('label' => 'Additional comments to show if the answer is incorrect: '))
            ->add('save', 'submit', array('label' => 'Create Question'))
            ->setAction($this->generateUrl('sywise_add'))
            ->getForm();


        //return new Response('Created Question id '.$question->getId());
        return $this->render('SywiseQuizBundle:Default:new.html.twig', array('form' => $form->createView()));

    }
}
