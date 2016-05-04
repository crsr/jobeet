<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Categoryaffiliate;
use AppBundle\Form\CategoryaffiliateType;

/**
 * Categoryaffiliate controller.
 *
 */
class CategoryaffiliateController extends Controller
{
    /**
     * Lists all Categoryaffiliate entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categoryaffiliates = $em->getRepository('AppBundle:Categoryaffiliate')->findAll();

        return $this->render('categoryaffiliate/index.html.twig', array(
            'categoryaffiliates' => $categoryaffiliates,
        ));
    }

    /**
     * Creates a new Categoryaffiliate entity.
     *
     */
    public function newAction(Request $request)
    {
        $categoryaffiliate = new Categoryaffiliate();
        $form = $this->createForm('AppBundle\Form\CategoryaffiliateType', $categoryaffiliate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoryaffiliate);
            $em->flush();

            return $this->redirectToRoute('categoryaffiliate_show', array('id' => $categoryaffiliate->getId()));
        }

        return $this->render('categoryaffiliate/new.html.twig', array(
            'categoryaffiliate' => $categoryaffiliate,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Categoryaffiliate entity.
     *
     */
    public function showAction(Categoryaffiliate $categoryaffiliate)
    {
        $deleteForm = $this->createDeleteForm($categoryaffiliate);

        return $this->render('categoryaffiliate/show.html.twig', array(
            'categoryaffiliate' => $categoryaffiliate,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Categoryaffiliate entity.
     *
     */
    public function editAction(Request $request, Categoryaffiliate $categoryaffiliate)
    {
        $deleteForm = $this->createDeleteForm($categoryaffiliate);
        $editForm = $this->createForm('AppBundle\Form\CategoryaffiliateType', $categoryaffiliate);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoryaffiliate);
            $em->flush();

            return $this->redirectToRoute('categoryaffiliate_edit', array('id' => $categoryaffiliate->getId()));
        }

        return $this->render('categoryaffiliate/edit.html.twig', array(
            'categoryaffiliate' => $categoryaffiliate,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Categoryaffiliate entity.
     *
     */
    public function deleteAction(Request $request, Categoryaffiliate $categoryaffiliate)
    {
        $form = $this->createDeleteForm($categoryaffiliate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categoryaffiliate);
            $em->flush();
        }

        return $this->redirectToRoute('categoryaffiliate_index');
    }

    /**
     * Creates a form to delete a Categoryaffiliate entity.
     *
     * @param Categoryaffiliate $categoryaffiliate The Categoryaffiliate entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Categoryaffiliate $categoryaffiliate)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categoryaffiliate_delete', array('id' => $categoryaffiliate->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
