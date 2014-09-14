<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Explored extends \Application\Entity\Entity {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** @ORM\Column(type="integer") */
    protected $id_user;

    /** @ORM\Column(type="integer") */
    protected $id_terrain;

    /* SETTER */
    public function setId($val='')
    {
        $this->id = $val;
    }

    public function setId_user($val='')
    {
        $this->id_user = $val;
    }

    public function setId_terrain($val='')
    {

        $this->id_terrain = $val;
    }

    /* GETTER */
    public function getId()
    {
        return $this->id;
    }

    public function getId_user()
    {
        return $this->id_user;
    }

    public function getId_terrain()
    {
        return $this->id_terrain;
    }
}