<?php

namespace AppBundle\Repository;
use AppBundle\Entity\Books;
use Doctrine\ORM\EntityRepository;

/**
 * BooksRepository
 *
 * This is a Doctrine Entity repository class. This is a class that holds methods that query the database,
 * the Doctrine service auto-generates the class but there are no methods generated, these must be customised.
 * It is related to a Doctrine Entity class.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BooksRepository extends EntityRepository
{
    /**
     * @param Books $books
     *
     * @return mixed
     */
    public function findAllBooksMatchingSearch(Books $books)
    {
        return $this->createQueryBuilder('books')
            ->select(array('books'))
            ->from('Books', 'books')
            ->Where('books.author = :author')
            ->setParameter('author', $books[2])
            ->orWhere('books.title = :title')
            ->setParameter('title', $books[1])
            ->orWhere('books.catagory = :catagory')
            ->setParameter('catagory', $books[5])
            ->getQuery()
            ->execute();
    }

    public function findAllFiction()
    {
        return $this->createQueryBuilder('books')
            ->andWhere('books.catagory = :catagory')
            ->setParameter('catagory', 'fiction')
            ->getQuery()
            ->execute();
    }
}
