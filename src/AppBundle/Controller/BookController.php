<?php
/**
 * Created by PhpStorm.
 * User: jennifer
 * Date: 03/04/17
 * Time: 14:08
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Books;
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
     * @Route("/searchAuthor", name="search_books_author")
     */
    public function searchAuthorAction(Request $request)
    {
        $form = $this->createForm(SearchType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $list = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $books = $em->getRepository('AppBundle:Books')->findAllBookMatchingSearch();

            $this->addFlash('success', 'list of books');
            return $this->render('books/searchResults.html.twig', ['books' => $books, 'list' => $list]);
        }

        return $this->render('books/search.html.twig', [
            'searchForm' => $form->createView(),
        ]);
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

    /**
     * Creates a new books entity.
     *
     * @Route("/new", name="book_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $book = new Books();
        $form = $this->createForm('AppBundle\Form\BooksType', $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush($book);

            return $this->redirectToRoute('book_show', array('id' => $book->getIsbn()));
        }

        return $this->render('books/new.html.twig', array(
            'book' => $book,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a books entity.
     *
     * @Route("/{id}", name="book_show")
     * @Method("GET")
     */
    public function showAction(Books $books)
    {
        $deleteForm = $this->createDeleteForm($books);

        return $this->render('books/show.html.twig', array(
            'book' => $books,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing books entity.
     *
     * @Route("/{id}/edit", name="book_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Books $books)
    {
        $deleteForm = $this->createDeleteForm($books);
        $editForm = $this->createForm('AppBundle\Form\BooksType', $books);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('book_edit', array('id' => $books->getIsbn()));
        }

        return $this->render('books/edit.html.twig', array(
            'book' => $books,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a books entity.
     *
     * @Route("/{id}", name="book_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Books $books)
    {
        $form = $this->createDeleteForm($books);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($books);
            $em->flush($books);
        }

        return $this->redirectToRoute('book_index');
    }

    /**
     * Creates a form to delete a books entity.
     *
     * @param Books $books The books entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Books $books)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('book_delete', array('id' => $books->getIsbn())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}