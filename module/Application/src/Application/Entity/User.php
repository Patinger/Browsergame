<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class User extends \Application\Entity\Entity {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $surname;

    /** @ORM\Column(type="string") */
    protected $name;

    /** @ORM\Column(type="string") */
    protected $email;

    /** @ORM\Column(type="string") */
    protected $username;

    /** @ORM\Column(type="string") */
    protected $password;

    /** @ORM\Column(type="string") */
    protected $role = 'member';	

        /* SETTER */
    public function setId($val='')
    {
        $this->id = $val;
    }

    public function setSurname($val='')
    {
        $this->surname = $val;
    }

    public function setName($val='')
    {

        $this->name = $val;
    }

    public function setEmail($val='')
    {
        $this->email = $val;
    }

    public function setUsername($val='')
    {
        $this->username = $val;
    }

    public function setPassword($val='')
    {
        $this->password = $val;
    }

    public function setRole($val='')
    {
        $this->role = $val;
    }

    /* GETTER */
    public function getId()
    {
        return $this->id;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRole()
    {
        return $this->role;
    }
}