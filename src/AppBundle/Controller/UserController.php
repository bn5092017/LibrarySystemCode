<?php
/**
 * Created by PhpStorm.
 * User: jennifer
 * Date: 05/04/17
 * Time: 19:12
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;//class containing routing methods
use Symfony\Bundle\FrameworkBundle\Controller\Controller;//base controller class
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class UserController
 * @Route("user")
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="list_users")
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

    /**
     * @Route("/edit/{id}", name="edit_user")
     */
    public function editUser($id)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle\Entity\User')->findOneById($id);
        return $this->render('user/editUser.html.twig', [
                'users'=>$users
            ]
        );
    }

//$password = password_hash("blckD0g", PASSWORD_DEFAULT);
}