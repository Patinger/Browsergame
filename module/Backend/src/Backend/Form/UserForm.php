<?php
namespace Backend\Form;

use Zend\Form\Form;
use Zend\Session\Container;
use Zend\Stdlib\Hydrator\ClassMethods;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Application\Entity\Userfahrzeug;
use Doctrine\Common\Persistence\ObjectManager;
use Backend\Form\UserFilter;

class UserForm extends Form
{

    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('user-form');
        $this->setHydrator(new DoctrineHydrator($objectManager, 'Application\Entity\User'));
        $this->setInputFilter(new UserFilter());
        //$this->setInputFilter(new AuthorFilter());
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'email',
            'type' => 'Zend\Form\Element\Email',
            'attributes' => array(
                'id' => 'user_email',
            ),
            'options' => array(
                'label' => 'Email',
            ),
        ));

        $this->add(array(
            'name' => 'name',
            'type' => 'Text',
            'attributes' => array(
                'id' => 'user_name',
            ),
            'options' => array(
                'label' => 'Vorname',
            ),
        ));

        $this->add(array(
            'name' => 'surname',
            'type' => 'Text',
            'attributes' => array(
                'id' => 'user_surname',
            ),
            'options' => array(
                'label' => 'Nachname',
            ),
        ));
       
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Speichern',
                'id' => 'submitbutton',
                'class' => 'form-control'  
            ),
        ));

        $this->add(array( 
            'name' => 'csrf', 
            'type' => 'Zend\Form\Element\Csrf', 
        ));   
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}