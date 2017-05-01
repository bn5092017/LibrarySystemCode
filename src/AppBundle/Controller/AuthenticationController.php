<?php
/**
 * Created by PhpStorm.
 * User: jennifer
 * Date: 14/04/17
 * Time: 18:06
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\LoginForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;//class containing routing methods
use Symfony\Bundle\FrameworkBundle\Controller\Controller;//base controller class
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AuthenticationController
 * @package AppBundle\Controller
 *
 */
class AuthenticationController extends Controller
{

    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
        //use built-in security error handling utility
        $authUtil = $this->get('security.authentication_utils');
        $e = $authUtil->getLastAuthenticationError();//displays error message from
        $lastUsername = $authUtil->getLastUsername();//autofills username on failed login
        $form = $this->createForm(LoginForm::class, [
            '_username' => $lastUsername,
        ]);
        if ($form->isSubmitted() && $form->isValid()) {

            return $this->redirectToRoute('my_loans');
        }
        return $this->render('security/login.html.twig', [
                'form' => $form->createView(),
                'error' => $e,
            ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
        //this controller method does not need to perform a function the /logout route will be handled
        // by built-in Symfony function but without a route, this would just throw a 404 error
        throw new \Exception('Problem with logout function');
    }

    /**
     * @Route("/myLoans", name="my_loans")
     */
    public function myLoansAction()
    {
        $user = new User;

        $loans = $user->getLoans();

        //if(!$loans){
          //  $this->addFlash('success', sprintf('There are no loans for %s', $this->getUser()->getUsername()));
            //$loans = ['isbn' => '1', 'dateDueBack' => 'NOW'];
        //}

        return $this->render('security/myLoans.html.twig', array('user' => $user, 'loans' => $loans));
    }


    /**
     * @Route("/adminHome", name="adminHome")
     */
    public function adminHomeAction()
    {

        return $this->render('security/adminHome.html.twig');
    }
}