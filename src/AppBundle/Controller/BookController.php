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
use AppBundle\Repository\BooksRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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
     * @Route("/", name="book_index")
     */
    public function listAllBooks()
    {
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository('AppBundle\Entity\Books')->findAll();

        return $this->render('books/index.html.twig', array(
            'books'=>$books,
        ));
    }

    /**
     * @Route("/searchAuthor", name="search_books_author")
     * @Method("GET")
     */
    public function searchAuthorAction(Request $request)
    {
        $form = $this->createForm(SearchType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $list = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $books = $em->getRepository('AppBundle:Books')->findAllBookMatchingSearch($list);

            $this->addFlash('success', 'list of books');
            return $this->render('books/searchResults.html.twig', ['books' => $books]);
        }

        return $this->render('books/search.html.twig', [
            'searchForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/search", name="search_books")
     * @Method({"GET", "POST"})
     */
    public function searchAction(Request $request)
    {
        $books = new BooksRepository();
        $form = $this->createForm(SearchType::class, $books);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $search = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $list = $em->getRepository('AppBundle:Books')->findAllBookMatchingSearch($search);
            $this->addFlash('success', 'list of books');
            return $this->render('books/searchResults.html.twig', [
                'list' => $list,
            ]);
        }

        return $this->render('books/search.html.twig', [
           'searchForm' => $form->createView(),
        ]);
    }

    /**
     * Creates a new books entity.
     *
     * @Route("/new", name="book_new")
     * @Security("is_granted('ROLE_STAFF')")
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

        return $this->render('books/oneBook.html.twig', array(
            'book' => $books,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing books entity.
     *
     * @Route("/{id}/edit", name="book_edit")
     * @Security("is_granted('ROLE_STAFF')")
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
     * @Security("is_granted('ROLE_STAFF')")
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