<?php
namespace Backend\Form;

use Zend\Form\Form;
use Zend\Session\Container;
use Zend\Stdlib\Hydrator\ClassMethods;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Application\Entity\Author;
use Doctrine\Common\Persistence\ObjectManager;
use Backend\Form\AuthorFilter;

class BookForm extends Form
{

    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('book-form');

        $this->setHydrator(new DoctrineHydrator($objectManager, 'Application\Entity\Book'));
        $this->setInputFilter(new BookFilter());
        //$this->setInputFilter(new AuthorFilter());
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'title',
            'type' => 'Text',
            'attributes' => array(
                'id' => 'book_title'
            ),
            'options' => array(
                'label' => 'Titel',
            ),
        ));

        $this->add(array(
            'name' => 'pages',
            'type' => 'Text',
            'attributes' => array(
                'id' => 'book_pages'
            ),
            'options' => array(
                'label' => 'Seiten',
            ),
        ));

         $this->add(array(
            'name' => 'releasedate',
            'type' => 'Date',
            'attributes' => array(
                'id' => 'book_releaseDate'
            ),
            'options' => array(
                'label' => 'Erscheinungsdatum (JJJJ-MM-TT)',
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
}