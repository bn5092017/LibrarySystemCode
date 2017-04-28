<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Loans;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Loan controller.
 *
 * @Route("loans")
 */
class LoansController extends Controller
{
    /**
     * Lists all loan entities.
     *
     * @Route("/", name="loans_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $loans = $em->getRepository('AppBundle:Loans')->findAll();

        return $this->render('loans/index.html.twig', array(
            'loans' => $loans,
        ));
    }

    /**
     * Creates a new loan entity.
     *
     * @Route("/new", name="loans_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $loan = new Loan();
        $form = $this->createForm('AppBundle\Form\LoansType', $loan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($loan);
            $em->flush($loan);

            return $this->redirectToRoute('loans_show', array('id' => $loan->getId()));
        }

        return $this->render('loans/new.html.twig', array(
            'loan' => $loan,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a loan entity.
     *
     * @Route("/{id}", name="loans_show")
     * @Method("GET")
     */
    public function showAction(Loans $loan)
    {
        $deleteForm = $this->createDeleteForm($loan);

        return $this->render('loans/show.html.twig', array(
            'loan' => $loan,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing loan entity.
     *
     * @Route("/{id}/edit", name="loans_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Loans $loan)
    {
        $deleteForm = $this->createDeleteForm($loan);
        $editForm = $this->createForm('AppBundle\Form\LoansType', $loan);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('loans_edit', array('id' => $loan->getId()));
        }

        return $this->render('loans/edit.html.twig', array(
            'loan' => $loan,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a loan entity.
     *
     * @Route("/{id}", name="loans_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Loans $loan)
    {
        $form = $this->createDeleteForm($loan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($loan);
            $em->flush($loan);
        }

        return $this->redirectToRoute('loans_index');
    }

    /**
     * Creates a form to delete a loan entity.
     *
     * @param Loans $loan The loan entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Loans $loan)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('loans_delete', array('id' => $loan->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
