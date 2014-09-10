<?php
namespace Backend\Form;

use Zend\Form\Form;
use Zend\Session\Container;
use Zend\Stdlib\Hydrator\ClassMethods;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Application\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Backend\Form\RegistrationFilter;

class RegistrationForm extends Form
{

    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('user-form');
        $this->setHydrator(new DoctrineHydrator($objectManager, 'Application\Entity\User'));
        $this->setInputFilter(new RegistrationFilter());
        //$this->setInputFilter(new AuthorFilter());
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
       
        $this->add(array(
            'name' => 'username',
            'type' => 'Text',
            'attributes' => array(
                'id' => 'registration_username',
            ),
            'options' => array(
                'label' => '*Benutzername',
            ),
        ));

        $this->add(array(
            'name' => 'name',
            'type' => 'Text',
            'attributes' => array(
                'id' => 'registration_name',
            ),
            'options' => array(
                'label' => 'Vorname',
            ),
        ));

        $this->add(array(
            'name' => 'surname',
            'type' => 'Text',
            'attributes' => array(
                'id' => 'registration_surname',
            ),
            'options' => array(
                'label' => 'Nachname',
            ),
        ));

         $this->add(array(
            'name' => 'password',
            'type' => 'Password',
            'attributes' => array(
                'id' => 'registration_password',
            ),
            'options' => array(
                'label' => '*Passwort',
            ),
        ));

         $this->add(array(
            'name' => 'confirmPassword',
            'type' => 'Password',
            'attributes' => array(
                'id' => 'registration_confirmPassword',
            ),
            'options' => array(
                'label' => '*Passwort bestätigen',
            ),
        ));

         $this->add(array(
            'name' => 'email',
            'type' => 'Zend\Form\Element\Email',
            'attributes' => array(
                'id' => 'registration_email',
            ),
            'options' => array(
                'label' => 'Email',
            ),
        ));
       
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Registrieren',
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