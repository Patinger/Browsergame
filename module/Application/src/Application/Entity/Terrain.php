<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Terrain extends \Application\Entity\Entity {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** @ORM\Column(type="integer") */
    protected $pos_x;

    /** @ORM\Column(type="integer") */
    protected $pos_y;

    /** @ORM\Column(type="integer") */
    protected $type;

    /** @ORM\Column(type="integer") */
    protected $exploreable;

    /* SETTER */
    public function setId($val='')
    {
        $this->id = $val;
    }

    public function setPos_x($val='')
    {
        $this->pos_x = $val;
    }

    public function setPos_y($val='')
    {

        $this->pos_y = $val;
    }

    public function setType($val='')
    {
        $this->type = $val;
    }

    public function setExploreable($val='')
    {
        $this->exploreable = $val;
    }

    /* GETTER */
    public function getId()
    {
        return $this->id;
    }

    public function getPos_x()
    {
        return $this->pos_x;
    }

    public function getPos_y()
    {
        return $this->pos_y;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getExploreable()
    {
        return $this->exploreable;
    }
}