<?php
/**
 * Created by PhpStorm.
 * User: jennifer
 * Date: 04/04/17
 * Time: 16:56
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;//base controller class

class MainController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepageAction()
    {
        return $this->render('main/homepage.html.twig');
    }

    /**
     * @Route("/about", name="about")
     */
    public function aboutAction()
    {

        return $this->render('main/about.html.twig');
    }
}