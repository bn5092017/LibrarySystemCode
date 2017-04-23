<?php
/**
 * Created by PhpStorm.
 * User: jennifer
 * Date: 05/04/17
 * Time: 19:12
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\ChangePassword;
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
        $users = $em->getRepository('AppBundle:User')->findAll();
        return $this->render('user/listAll.html.twig', [
                'users' => $users
            ]
        );
    }

    /**
     * @Route("/new", name="new_user")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('AppBundle:CRUDuser', $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush($user);
            return $this->redirectToRoute('list_users', ['id' => $user->getId()]);
        }

        return $this->render('user/CRUD.html.twig',
            ['user' => $user, 'form' => $form->createView()]);
    }

    /**
     * @Route("/edit/{id}", name="edit_user")
     */
    public function editUser($id)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle\Entity\User')->findOneById($id);
        return $this->render('user/editUser.html.twig', [
                'users' => $users
            ]
        );
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