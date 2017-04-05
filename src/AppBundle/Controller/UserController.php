<?php
/**
 * Created by PhpStorm.
 * User: jennifer
 * Date: 05/04/17
 * Time: 19:12
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class UserController extends Controller
{
    /**
     * @Route("/user", name="list_users")
     */
    public function listAllUsers()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle\Entity\User')->findAll();
        return $this->render('user/listAll.html.twig', [
            'users'=>$users
        ]
        );
    }
}