<?php
/**
 * Created by PhpStorm.
 * User: jennifer
 * Date: 04/04/17
 * Time: 16:56
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
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

    /**
     * @Route("/sitemap", name="sitemap")
     */
    public function sitemapAction()
    {

        return $this->render('main/sitemap.html.twig');
    }

    /**
     * @Route("/myLoans", name="myLoans")
     */
    public function myLoansAction()
    {
        $user = ['username' => 'fred'];

        return $this->render('main/myLoans.html.twig', array('user' => $user));
    }

    /**
     * @Route("/adminHome", name="adminHome")
     */
    public function adminHomeAction()
    {

        return $this->render('main/adminHome.html.twig');
    }
}