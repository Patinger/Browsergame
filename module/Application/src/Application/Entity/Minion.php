<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Minion extends \Application\Entity\Entity {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** @ORM\Column(type="integer") */
    protected $id_user;

    /** @ORM\Column(type="integer") */
    protected $pos_x;

    /** @ORM\Column(type="integer") */
    protected $pos_y;

    /* SETTER */
    public function setId($val='')
    {
        $this->id = $val;
    }

    public function setId_user($val='')
    {
        $this->id_user = $val;
    }

    public function setPos_x($val='')
    {
        $this->pos_x = $val;
    }

    public function setPos_y($val='')
    {

        $this->pos_y = $val;
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

    public function getPos_x()
    {
        return $this->pos_x;
    }

    public function getPos_y()
    {
        return $this->pos_y;
    }
}