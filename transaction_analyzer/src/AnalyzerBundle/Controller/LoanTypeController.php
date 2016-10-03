<?php

namespace AnalyzerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AnalyzerBundle\Entity\LoanType;
use AnalyzerBundle\Form\LoanTypeType;

/**
 * LoanType controller.
 *
 * @Route("/loantype")
 */
class LoanTypeController extends Controller
{
    /**
     * Lists all LoanType entities.
     *
     * @Route("/", name="loantype_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $loanTypes = $em->getRepository('AnalyzerBundle:LoanType')->findAll();

        return $this->render('loantype/index.html.twig', array(
            'loanTypes' => $loanTypes,
        ));
    }

    /**
     * Creates a new LoanType entity.
     *
     * @Route("/new", name="loantype_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $loanType = new LoanType();
        $form = $this->createForm('AnalyzerBundle\Form\LoanTypeType', $loanType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($loanType);
            $em->flush();

            return $this->redirectToRoute('loantype_show', array('id' => $loanType->getId()));
        }

        return $this->render('loantype/new.html.twig', array(
            'loanType' => $loanType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a LoanType entity.
     *
     * @Route("/{id}", name="loantype_show")
     * @Method("GET")
     */
    public function showAction(LoanType $loanType)
    {
        $deleteForm = $this->createDeleteForm($loanType);

        return $this->render('loantype/show.html.twig', array(
            'loanType' => $loanType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing LoanType entity.
     *
     * @Route("/{id}/edit", name="loantype_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, LoanType $loanType)
    {
        $deleteForm = $this->createDeleteForm($loanType);
        $editForm = $this->createForm('AnalyzerBundle\Form\LoanTypeType', $loanType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($loanType);
            $em->flush();

            return $this->redirectToRoute('loantype_edit', array('id' => $loanType->getId()));
        }

        return $this->render('loantype/edit.html.twig', array(
            'loanType' => $loanType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a LoanType entity.
     *
     * @Route("/{id}", name="loantype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, LoanType $loanType)
    {
        $form = $this->createDeleteForm($loanType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($loanType);
            $em->flush();
        }

        return $this->redirectToRoute('loantype_index');
    }

    /**
     * Creates a form to delete a LoanType entity.
     *
     * @param LoanType $loanType The LoanType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(LoanType $loanType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('loantype_delete', array('id' => $loanType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
