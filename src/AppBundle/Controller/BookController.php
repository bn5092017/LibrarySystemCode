<?php
/**
 * Created by PhpStorm.
 * User: jennifer
 * Date: 03/04/17
 * Time: 14:08
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    /**
     * @Route("/book/{bookId}")
     */
    public function listAllBooks($bookId)
    {
        $listOfCatagories = 'Fiction, *Sci-fi*, Biography, Childrens';
        $listOfCatagories = $this->get('markdown.parser')->transform($listOfCatagories);
        return $this->render('book/listAll.html.twig', array(
            'name'=>$bookId,
            'list'=>$listOfCatagories
        ));
    }

    /**
     * @return jsonResponse
     * @Route("/book/{bookId}/details", name="book_show_details")
     * @Method("GET")
     */
    public function getDetailsAction()
    {
        $details = [
            ['title'=>'book1', 'author'=>'J. Bloggs'],
            ['title'=>'book2', 'author'=>'A. N. Other']
        ];
        $data = ['details'=>$details];

        return new jsonResponse($data);
    }
}