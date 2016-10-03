<?php

namespace AnalyzerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AnalyzerBundle\Entity\BankType;
use AnalyzerBundle\Form\BankTypeType;

/**
 * BankType controller.
 *
 * @Route("/banktype")
 */
class BankTypeController extends Controller
{
    /**
     * Lists all BankType entities.
     *
     * @Route("/", name="banktype_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bankTypes = $em->getRepository('AnalyzerBundle:BankType')->findAll();

        return $this->render('banktype/index.html.twig', array(
            'bankTypes' => $bankTypes,
        ));
    }

    /**
     * Creates a new BankType entity.
     *
     * @Route("/new", name="banktype_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $bankType = new BankType();
        $form = $this->createForm('AnalyzerBundle\Form\BankTypeType', $bankType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bankType);
            $em->flush();

            return $this->redirectToRoute('banktype_show', array('id' => $bankType->getId()));
        }

        return $this->render('banktype/new.html.twig', array(
            'bankType' => $bankType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a BankType entity.
     *
     * @Route("/{id}", name="banktype_show")
     * @Method("GET")
     */
    public function showAction(BankType $bankType)
    {
        $deleteForm = $this->createDeleteForm($bankType);

        return $this->render('banktype/show.html.twig', array(
            'bankType' => $bankType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing BankType entity.
     *
     * @Route("/{id}/edit", name="banktype_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, BankType $bankType)
    {
        $deleteForm = $this->createDeleteForm($bankType);
        $editForm = $this->createForm('AnalyzerBundle\Form\BankTypeType', $bankType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bankType);
            $em->flush();

            return $this->redirectToRoute('banktype_edit', array('id' => $bankType->getId()));
        }

        return $this->render('banktype/edit.html.twig', array(
            'bankType' => $bankType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a BankType entity.
     *
     * @Route("/{id}", name="banktype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, BankType $bankType)
    {
        $form = $this->createDeleteForm($bankType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bankType);
            $em->flush();
        }

        return $this->redirectToRoute('banktype_index');
    }

    /**
     * Creates a form to delete a BankType entity.
     *
     * @param BankType $bankType The BankType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BankType $bankType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('banktype_delete', array('id' => $bankType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
