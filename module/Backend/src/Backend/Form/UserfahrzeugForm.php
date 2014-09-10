<?php
namespace Backend\Form;

use Zend\Form\Form;
use Zend\Session\Container;
use Zend\Stdlib\Hydrator\ClassMethods;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Application\Entity\Userfahrzeug;
use Doctrine\Common\Persistence\ObjectManager;
use Backend\Form\UserfahrzeugFilter;

class UserfahrzeugForm extends Form
{

    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('user-form');
        $this->setHydrator(new DoctrineHydrator($objectManager, 'Application\Entity\User'));
        $this->setInputFilter(new UserfahrzeugFilter());
        //$this->setInputFilter(new AuthorFilter());
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));


        $this->add(array(
            'name' => 'user_id',
            'type' => 'Hidden',
        ));

        $this->add(
            array(
                'name' => 'fahrzeugart',
                'type' => 'Select',
                'attributes' => array(
                    'id' => 'userfahrzeug_fahrzeugart',
                ),
                'options' => array(
                    'label' => 'Fahrzeugart',
                    'options' => array(
                         'kraftrad' => 'Kraftrad',
                         'pkw' => 'PKW',
                         'kraftfahrzeug' => 'Kraftfahrzeug',
                         'lof' => 'Lof',
                         'anhaenger' => 'Anhaenger',
                    ),
                )
            )
        );

        $this->add(array(
            'name' => 'beschreibung',
            'type' => 'Text',
            'attributes' => array(
                'id' => 'userfahrzeug_beschreibung',
            ),
            'options' => array(
                'label' => 'Beschreibung (z.B. Autokennzeichen)',
            ),
        ));

         $this->add(array(
            'name' => 'letztepruefung',
            'type' => 'Date',
            'attributes' => array(
                'id' => 'userfahrzeug_letztepruefung'
            ),
            'options' => array(
                'label' => 'Letzte Prüfung (JJJJ-MM-TT)',
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