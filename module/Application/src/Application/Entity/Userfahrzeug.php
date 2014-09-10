<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Userfahrzeug extends \Application\Entity\Entity {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $user_id;

    /** @ORM\Column(type="string") */
    protected $fahrzeugart;

    /** @ORM\Column(type="date") */
    protected $letztepruefung;

    /** @ORM\Column(type="string") */
    protected $beschreibung;

        /* SETTER */
    public function setId($val='')
    {
        $this->id = $val;
    }

    public function setUser_id($val='')
    {
        $this->user_id = $val;
    }

    public function setFahrzeugart($val='')
    {

        $this->fahrzeugart = $val;
    }

    public function setLetztepruefung($val='')
    {
        $this->letztepruefung = $val;
    }

    public function setBeschreibung($val='')
    {
        $this->beschreibung = $val;
    }

    /* GETTER */
    public function getId()
    {
        return $this->id;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }

    public function getFahrzeugart()
    {
        return $this->fahrzeugart;
    }

    public function getLetztepruefung()
    {
        return $this->letztepruefung;
    }

    public function getBeschreibung()
    {
        return $this->beschreibung;
    }
}