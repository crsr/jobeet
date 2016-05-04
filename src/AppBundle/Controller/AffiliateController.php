<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Affiliate;
use AppBundle\Form\AffiliateType;

/**
 * Affiliate controller.
 *
 */
class AffiliateController extends Controller
{
    /**
     * Lists all Affiliate entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $affiliates = $em->getRepository('AppBundle:Affiliate')->findAll();

        return $this->render('affiliate/index.html.twig', array(
            'affiliates' => $affiliates,
        ));
    }

    /**
     * Creates a new Affiliate entity.
     *
     */
    public function newAction(Request $request)
    {
        $affiliate = new Affiliate();
        $form = $this->createForm('AppBundle\Form\AffiliateType', $affiliate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($affiliate);
            $em->flush();

            return $this->redirectToRoute('affiliate_show', array('id' => $affiliate->getIdAffiliate()));
        }

        return $this->render('affiliate/new.html.twig', array(
            'affiliate' => $affiliate,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Affiliate entity.
     *
     */
    public function showAction(Affiliate $affiliate)
    {
        $deleteForm = $this->createDeleteForm($affiliate);

        return $this->render('affiliate/show.html.twig', array(
            'affiliate' => $affiliate,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Affiliate entity.
     *
     */
    public function editAction(Request $request, Affiliate $affiliate)
    {
        $deleteForm = $this->createDeleteForm($affiliate);
        $editForm = $this->createForm('AppBundle\Form\AffiliateType', $affiliate);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($affiliate);
            $em->flush();

            return $this->redirectToRoute('affiliate_edit', array('id' => $affiliate->getIdAffiliate()));
        }

        return $this->render('affiliate/edit.html.twig', array(
            'affiliate' => $affiliate,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Affiliate entity.
     *
     */
    public function deleteAction(Request $request, Affiliate $affiliate)
    {
        $form = $this->createDeleteForm($affiliate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($affiliate);
            $em->flush();
        }

        return $this->redirectToRoute('affiliate_index');
    }

    /**
     * Creates a form to delete a Affiliate entity.
     *
     * @param Affiliate $affiliate The Affiliate entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Affiliate $affiliate)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('affiliate_delete', array('id' => $affiliate->getIdAffiliate())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
