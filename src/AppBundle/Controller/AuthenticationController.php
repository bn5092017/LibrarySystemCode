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
        $e = $authUtil->getLastAuthenticationError();//displays error message
        $lastUsername = $authUtil->getLastUsername();//autofills username on failed login
        $form = $this->createForm(LoginForm::class, [
            '_username' => $lastUsername,
        ]);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', sprintf('Welcome %s', $this->getUser()->getUsername()));

            return $this->render('main/myLoans.html.twig');
        }
        return $this->render('security/login.html.twig', [
                'form' => $form->createView(),
                'error' => $e,
            ]);
    }

    /**
     * @Route("/staffLogin", name="staff_login")
     */
    public function staffLoginAction()
    {
        //use built-in security error handling utility
        $authUtil = $this->get('security.authentication_utils');
        $e = $authUtil->getLastAuthenticationError();//displays error message
        $lastUsername = $authUtil->getLastUsername();//autofills username on failed login
        $form = $this->createForm(LoginForm::class, [
            '_username' => $lastUsername,
        ]);
        if ($form->isSubmitted() && $form->isValid()) {

            return $this->redirectToRoute('adminHome');
        }
        return $this->render('security/staffLogin.html.twig', [
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
     * @Route("/myLoans", name="myLoans")
     */
    public function myLoansAction()
    {
        $user = ['username' => 'fred'];

        return $this->render('security/myLoans.html.twig', array('user' => $user));
    }


    /**
     * @Route("/adminHome", name="adminHome")
     */
    public function adminHomeAction()
    {

        return $this->render('security/adminHome.html.twig');
    }
}