<?php

namespace AnalyzerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AnalyzerBundle\Entity\Loan;
use AnalyzerBundle\Form\LoanType;

/**
 * Loan controller.
 *
 * @Route("/loan")
 */
class LoanController extends Controller
{
    /**
     * Lists all Loan entities.
     *
     * @Route("/", name="loan_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $loans = $em->getRepository('AnalyzerBundle:Loan')->findAll();

        return $this->render('loan/index.html.twig', array(
            'loans' => $loans,
        ));
    }

    /**
     * Creates a new Loan entity.
     *
     * @Route("/new", name="loan_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $loan = new Loan();
        $form = $this->createForm('AnalyzerBundle\Form\LoanType', $loan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($loan);
            $em->flush();

            return $this->redirectToRoute('loan_show', array('id' => $loan->getId()));
        }

        return $this->render('loan/new.html.twig', array(
            'loan' => $loan,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Loan entity.
     *
     * @Route("/{id}", name="loan_show")
     * @Method("GET")
     */
    public function showAction(Loan $loan)
    {
        $deleteForm = $this->createDeleteForm($loan);

        return $this->render('loan/show.html.twig', array(
            'loan' => $loan,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Loan entity.
     *
     * @Route("/{id}/edit", name="loan_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Loan $loan)
    {
        $deleteForm = $this->createDeleteForm($loan);
        $editForm = $this->createForm('AnalyzerBundle\Form\LoanType', $loan);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($loan);
            $em->flush();

            return $this->redirectToRoute('loan_edit', array('id' => $loan->getId()));
        }

        return $this->render('loan/edit.html.twig', array(
            'loan' => $loan,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Loan entity.
     *
     * @Route("/{id}", name="loan_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Loan $loan)
    {
        $form = $this->createDeleteForm($loan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($loan);
            $em->flush();
        }

        return $this->redirectToRoute('loan_index');
    }

    /**
     * Creates a form to delete a Loan entity.
     *
     * @param Loan $loan The Loan entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Loan $loan)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('loan_delete', array('id' => $loan->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
