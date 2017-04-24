<?php
/**
 * Created by PhpStorm.
 * User: jennifer
 * Date: 14/04/17
 * Time: 18:06
 */

namespace AppBundle\Controller;

use AppBundle\Form\LoginForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;//class containing routing methods
use Symfony\Bundle\FrameworkBundle\Controller\Controller;//base controller class

class AuthenticationController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
        //use built-in security error handling utility
        $authUtil = $this->get('security.authentication_utils');
        $e = $authUtil->getLastAuthenticationError();
        $lastUsername = $authUtil->getLastUsername();
        $form = $this->createForm(LoginForm::class, [
            '_username' => $lastUsername,
        ]);
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
     * @Route("/changePassword", name="change_password")
     *
     * uses the Request class which contains methods to process submitted information
     */
    public function changePasswordAction(Request $request)
    {
        //createForm is a built-in Controller method, this class extends the Controller class
        $form = $this->createForm(ChangePassword::class, []);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($password);
            $em->flush;

            return $this->redirectToRoute('homepage');
        }
        return $this->render('user/changePassword.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}