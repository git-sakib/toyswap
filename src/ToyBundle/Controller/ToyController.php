<?php

namespace ToyBundle\Controller;

use ToyBundle\Entity\Toy;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Toy controller.
 *
 */
class ToyController extends Controller
{
    /**
     * Lists all toy entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $toys = $em->getRepository('ToyBundle:Toy')->findAll();

        return $this->render('toy/index.html.twig', array(
            'toys' => $toys,
        ));
    }

    /**
     * Creates a new toy entity.
     *
     */
    public function newAction(Request $request)
    {
        $toy = new Toy();
        $form = $this->createForm('ToyBundle\Form\ToyType', $toy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($toy);
            $em->flush();

            return $this->redirectToRoute('toy_show', array('id' => $toy->getId()));
        }

        return $this->render('toy/new.html.twig', array(
            'toy' => $toy,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a toy entity.
     *
     */
    public function showAction(Toy $toy)
    {
        $deleteForm = $this->createDeleteForm($toy);

        return $this->render('toy/show.html.twig', array(
            'toy' => $toy,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing toy entity.
     *
     */
    public function editAction(Request $request, Toy $toy)
    {
        $deleteForm = $this->createDeleteForm($toy);
        $editForm = $this->createForm('ToyBundle\Form\ToyType', $toy);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('toy_edit', array('id' => $toy->getId()));
        }

        return $this->render('toy/edit.html.twig', array(
            'toy' => $toy,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a toy entity.
     *
     */
    public function deleteAction(Request $request, Toy $toy)
    {
        $form = $this->createDeleteForm($toy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($toy);
            $em->flush();
        }

        return $this->redirectToRoute('toy_index');
    }

    /**
     * Creates a form to delete a toy entity.
     *
     * @param Toy $toy The toy entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Toy $toy)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('toy_delete', array('id' => $toy->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
