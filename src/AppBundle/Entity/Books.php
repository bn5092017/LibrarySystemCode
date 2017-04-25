<?php

namespace AppBundle\Entity;

//Doctrine Object-Relational Mapper, a service that maps objects of classes to entries in a database table
use Doctrine\ORM\Mapping as ORM;

/**
 * Books
 * Doctrine entity, a class with connections to the related table in the database
 *
 * @ORM\Table(name="books")
 * A repository is a class that holds methods that query the database
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BooksRepository")
 */
class Books
{
    /**
     * @var int
     * Isbn column is the ID for a book object as this is a unique identifier for a particular publication
     *
     * @ORM\Column(name="isbn", type="integer")
     * @ORM\Id
     *
     */
    private $isbn;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="publisher", type="string", length=255)
     */
    private $publisher;

    /**
     * @var int
     *
     * @ORM\Column(name="date", type="integer")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="catagory", type="string", length=255)
     */
    private $catagory;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;


    /**
     * Get id
     *
     * @return int
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Books
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Books
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set publisher
     *
     * @param string $publisher
     *
     * @return Books
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * Get publisher
     *
     * @return string
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * Set date
     *
     * @param integer $date
     *
     * @return Books
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return int
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set catagory
     *
     * @param string $catagory
     *
     * @return Books
     */
    public function setCatagory($catagory)
    {
        $this->catagory = $catagory;

        return $this;
    }

    /**
     * Get catagory
     *
     * @return string
     */
    public function getCatagory()
    {
        return $this->catagory;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Books
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}

