<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Loans;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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
        $loan = new Loans();
        $form = $this->createForm('AppBundle\Form\LoansType', $loan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $loan->setDateOut(new \DateTime('NOW'));//sets date to today
            $loan->setDateDueBack(new \DateTime('NOW + 21 days')) ;//sets to 3 weeks from today
            $em = $this->getDoctrine()->getManager();
            $em->persist($loan);
            $em->flush($loan);

            return $this->redirectToRoute('loans_index');
        }

        return $this->render('loans/new.html.twig', array(
            'loan' => $loan,
            'form' => $form->createView(),
        ));
    }

    /**
     * Renew loan entity.
     * Selecting this will automatically add 3 weeks to loan due back date
     * @Route("/{id}", name="loans_renew")
     * @Method({"POST"})
     */
    public function renewAction(Request $request, Loans $loan)
    {
        $form = $this->createRenewForm($loan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $loan->setDateDueBack(new \DateTime('NOW + 21 days'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($loan);
            $em->flush($loan);
        }

        return $this->redirectToRoute('loans_index');
    }

    /**
     * Creates a form to renew a loan entity.
     * This displays as an option, not a full form
     *
     * @param Loans $loan The loan entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createRenewForm(Loans $loan)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('loans_renew', array('id' => $loan->getId())))
            ->setMethod('POST')
            ->getForm()
            ;
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
        $renewForm = $this->createRenewForm($loan);
        //needs a different form to show different fields to the 'new' form
        $editForm = $this->createForm('AppBundle\Form\EditLoans', $loan);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('loans_index');
        }

        return $this->render('loans/edit.html.twig', array(
            'loan' => $loan,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'renew_form' => $renewForm->createView()
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
