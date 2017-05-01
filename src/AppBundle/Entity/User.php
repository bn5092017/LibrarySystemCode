<?php

namespace AppBundle\Entity;

//Doctrine Object-Relational Mapper, a service that maps objects of classes to entries in a database table
use Doctrine\ORM\Mapping as ORM;
//An interface that contains the methods getRoles(), getPassword(), getSalt(), getUsername(), eraseCredentials()
use Symfony\Component\Security\Core\User\UserInterface;
//Symfony class for user roles
use Symfony\Component\Security\Core\Role\Role;

/**
 * User
 * Doctrine entity, a class with connections to the related table in the database
 * The User class implements UserInterface to take advantage of Symfony built-in authentication and
 * authorisation methods
 *
 * @ORM\Table(name="user")
 * A repository is a class that holds methods that query the database
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @var int
     * Id column is auto-generated although in reality it would be a staff number or membership number for
     * a customer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * temporary property to store plaintext password
     * not saved in database
     *
     * @var string
     */
    private $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="roles", type="json_array")
     */
    private $roles = [];

    /**
     * @ORM\OneToMany(targetEntity="Loans", mappedBy="user")
     */
    private $loans;

    /**
     * @return mixed
     */
    public function getLoans()
    {
        return $this->loans;
    }

    /**
     * @param mixed $loans
     */
    public function setLoans($loans)
    {
        $this->loans = $loans;
    }

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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        //this is important for changing passwords in the database table using a Doctrine
        //listener function as otherwise it will not be called if only this property is updated
        $this->password = null;
    }

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return User
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return array
     */
    public function getRoles()
    {
        $roles = $this->roles;
        if(!in_array('ROLE_USER', $roles)){
            $roles[]='ROLE_USER';
        }
        return $roles;
    }

    public function getSalt()
    {
        // Automatic salting of passwords will be used
    }

    public function eraseCredentials()
    {
        //this will prevent the plainPassword being saved
        $this->plainPassword = null;
    }

    public function addLoan(Loans $loans){
        if(!$this->loans->contains($loans)){
            $loans->setUser($this);
            $this->loans->add($loans);
        }
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->username;
    }

}

