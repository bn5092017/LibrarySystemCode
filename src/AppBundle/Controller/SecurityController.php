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

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="security_login")
     */
    public function loginAction()
    {
        //use built-in security error handling utility
        $authUtil = $this->get('security.authentication_utils');
        $error = $authUtil->getLastAuthenticationError();
        $lastUsername = $authUtil->getLastUsername();
        $form = $this->createForm(LoginForm::class, [
            '_username' => $lastUsername,
        ]);
        return $this->render('security/login.html.twig', [
                'form' => $form->createView(),
                'error' => $error,
            ]);
    }
}