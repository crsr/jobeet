<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Job;
use AppBundle\Form\JobType;
use Symfony\Component\Security\Core\Security;

/**
 * Job controller.
 *
 */
class JobController extends Controller
{
    /**
     * Lists all Job entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $jobs = $em->getRepository('AppBundle:Job')->findAll();

        return $this->render('job/index.html.twig', array(
            'jobs' => $jobs,
        ));
    }


     public function jobdescriptionAction()
    {
        $em = $this->getDoctrine()->getManager();

        $jobs = $em->getRepository('AppBundle:Job')->findAll();
        
        var_dump($jobs);
        die;

        return $this->render('job/job_description.html.twig', array(
            'job_description' => $job_description,
        ));
    }


     public function index1Action(Request $request )
    {

        $em = $this->getDoctrine()->getManager();
        $jobs = $em->getRepository('AppBundle:Job')->findAll();
        $users = $em->getRepository('UsersBundle:Users')->findAll();



        // if($request->isMethod('POST'))
        // {

        //   $data=$request->request->get('emailsend');



        //     $message = \Swift_Message::newInstance()
        //         ->setSubject('Contact enquiry from symblog')
        //         ->setFrom('enquiries@symblog.co.uk')
        //         ->setTo( $data )
        //         ->setBody("Hi i apply for your job, read my Cv")
        //         ->attach(Swift_Attachment::fromPath());

             
        //         $mailer = $this->get('mailer');
        //         $mailer->send($message);
        //         $spool = $mailer->getTransport()->getSpool();
        //         $transport = $this->get('swiftmailer.transport.real');
        //         $spool->flushQueue($transport);
        //  /* $user = $this->container->get('security.context')->getToken()->getUser();
        //   $user->getId();*/
      
        // }

        return $this->render('job/userindex.html.twig', array(
            'jobs' => $jobs,
        ));
    }

    /**
     * Creates a new Job entity.
     *
     */
    public function newAction(Request $request)
    {
        $job = new Job();
        $form = $this->createForm('AppBundle\Form\JobType', $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $job->upload();
            $em->persist($job);
            $em->flush();

            return $this->redirectToRoute('job_show', array('id' => $job->getIdJob()));
        }

        return $this->render('job/new.html.twig', array(
            'job' => $job,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Job entity.
     *
     */
    public function showAction(Job $job)
    {
        $deleteForm = $this->createDeleteForm($job);

        return $this->render('job/show.html.twig', array(
            'job' => $job,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Job entity.
     *
     */
    public function editAction(Request $request, Job $job)
    {
        $job1 = new Job();
        $deleteForm = $this->createDeleteForm($job);
        $editForm = $this->createForm('AppBundle\Form\JobType', $job);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $job->upload();
            $em->persist($job);
            $em->flush();

            return $this->redirectToRoute('job_edit', array('id' => $job->getIdJob()));
        }

        return $this->render('job/edit.html.twig', array(
            'job' => $job,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Job entity.
     *
     */
    public function deleteAction(Request $request, Job $job)
    {
        $form = $this->createDeleteForm($job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($job);
            $em->flush();
        }

        return $this->redirectToRoute('job_index');
    }

    /**
     * Creates a form to delete a Job entity.
     *
     * @param Job $job The Job entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Job $job)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('job_delete', array('id' => $job->getIdJob())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
