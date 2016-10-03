<?php

namespace AnalyzerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AnalyzerBundle\Entity\BankEntity;
use AnalyzerBundle\Form\BankEntityType;

/**
 * BankEntity controller.
 *
 * @Route("/bankentity")
 */
class BankEntityController extends Controller
{
    /**
     * Lists all BankEntity entities.
     *
     * @Route("/", name="bankentity_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bankEntities = $em->getRepository('AnalyzerBundle:BankEntity')->findAll();

        return $this->render('bankentity/index.html.twig', array(
            'bankEntities' => $bankEntities,
        ));
    }

    /**
     * Creates a new BankEntity entity.
     *
     * @Route("/new", name="bankentity_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $bankEntity = new BankEntity();
        $form = $this->createForm('AnalyzerBundle\Form\BankEntityType', $bankEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bankEntity);
            $em->flush();

            return $this->redirectToRoute('bankentity_show', array('id' => $bankEntity->getId()));
        }

        return $this->render('bankentity/new.html.twig', array(
            'bankEntity' => $bankEntity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a BankEntity entity.
     *
     * @Route("/{id}", name="bankentity_show")
     * @Method("GET")
     */
    public function showAction(BankEntity $bankEntity)
    {
        $deleteForm = $this->createDeleteForm($bankEntity);

        return $this->render('bankentity/show.html.twig', array(
            'bankEntity' => $bankEntity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing BankEntity entity.
     *
     * @Route("/{id}/edit", name="bankentity_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, BankEntity $bankEntity)
    {
        $deleteForm = $this->createDeleteForm($bankEntity);
        $editForm = $this->createForm('AnalyzerBundle\Form\BankEntityType', $bankEntity);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bankEntity);
            $em->flush();

            return $this->redirectToRoute('bankentity_edit', array('id' => $bankEntity->getId()));
        }

        return $this->render('bankentity/edit.html.twig', array(
            'bankEntity' => $bankEntity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a BankEntity entity.
     *
     * @Route("/{id}", name="bankentity_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, BankEntity $bankEntity)
    {
        $form = $this->createDeleteForm($bankEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bankEntity);
            $em->flush();
        }

        return $this->redirectToRoute('bankentity_index');
    }

    /**
     * Creates a form to delete a BankEntity entity.
     *
     * @param BankEntity $bankEntity The BankEntity entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BankEntity $bankEntity)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bankentity_delete', array('id' => $bankEntity->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
