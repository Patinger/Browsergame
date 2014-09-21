<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Miniontype extends \Application\Entity\Entity {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** @ORM\Column(type="integer") */
    protected $radius;


    /* SETTER */
    public function setId($val='')
    {
        $this->id = $val;
    }

    public function setRadius($val='')
    {
        $this->radius = $val;
    }

    /* GETTER */
    public function getId()
    {
        return $this->id;
    }

    public function getRadius()
    {
        return $this->radius;
    }
}