<?php
/**
 * Created by PhpStorm.
 * User: jennifer
 * Date: 03/04/17
 * Time: 14:08
 */

namespace AppBundle\Controller;


use AppBundle\Form\SearchType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;//base controller class
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BookController
 * @Route("books")
 */
class BookController extends Controller
{
    /**
     * @Route("/", name="list_books")
     */
    public function listAllBooks()
    {
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository('AppBundle\Entity\Books')->findAll();
        $listOfCatagories = 'Fiction, Sci-fi, Biography, Childrens';
        return $this->render('books/listAll.html.twig', array(
            'books'=>$books,
            'list'=>$listOfCatagories
        ));
    }

    /**
     * @Route("/search", name="search_books")
     */
    public function searchAction(Request $request)
    {
        $form = $this->createForm(SearchType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $list = $form->getData();

            $this->addFlash('success', 'list of books');
            return $this->redirectToRoute('list_books');
        }

        return $this->render('books/search.html.twig', [
           'searchForm' => $form->createView(),
        ]);
    }

    /**
     * @return jsonResponse
     * @Route("/books/{bookId}/details", name="book_show_details")
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