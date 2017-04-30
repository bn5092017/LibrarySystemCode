<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Loans
 *
 * @ORM\Table(name="loans")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LoansRepository")
 */
class Loans
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var int
     * @ORM\Column(name="book_isbn", type="integer")
     * @ORM\ManyToOne(targetEntity="Books")
     */
    private $bookIsbn;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="loans")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateOut", type="datetime")
     */
    private $dateOut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDueBack", type="datetime")
     */
    private $dateDueBack;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateOut
     *
     * @param \DateTime $dateOut
     *
     * @return Loans
     */
    public function setDateOut($dateOut)
    {
        $this->dateOut = $dateOut;

        return $this;
    }

    /**
     * Get dateOut
     *
     * @return \DateTime
     */
    public function getDateOut()
    {
        return $this->dateOut;
    }

    /**
     * Set dateDueBack
     *
     * @param \DateTime $dateDueBack
     *
     * @return Loans
     */
    public function setDateDueBack($dateDueBack)
    {
        $this->dateDueBack = $dateDueBack;

        return $this;
    }

    /**
     * Get dateDueBack
     *
     * @return \DateTime
     */
    public function getDateDueBack()
    {
        return $this->dateDueBack;
    }

    /**
     * @return int
     */
    public function getBookIsbn()
    {
        return $this->bookIsbn;
    }

    /**
     * @param int $bookIsbn
     */
    public function setBookIsbn($bookIsbn)
    {
        $this->bookIsbn = $bookIsbn;
    }

    /**
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param int $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
}

