<?php
/**
 * Created by PhpStorm.
 * User: jennifer
 * Date: 04/04/17
 * Time: 16:56
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function homepageAction()
    {
        return $this->render('main/homepage.html.twig');
    }

    public function aboutAction()
    {
        $password = password_hash("blckD0g", PASSWORD_DEFAULT);
        return $this->render('main/about.html.twig', [
            'password' => $password
        ]);
    }
}