<?php
namespace Backend\Form;
use Zend\InputFilter\InputFilter;
 
class PreiseFilter extends InputFilter {
 
    public function __construct() {
 
        $this->add(array(
            'name' => 'id',
            'required' => false,
            'filters'  => array(
                array('name' => 'Int'),
            ),
        ));

        $this->add(array(
            'name' => 'name',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 0,
                        'max'      => 100,
                    ),
                ),
            ),
        ));
        $this->add(array(
            'name' =>  'surname',

            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 0,
                        'max'      => 100,
                    ),
                ),
            ),
        ));
        $this->add(array(
            'name' =>  'birthdate',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 0,
                        'max'      => 100,
                    ),
                ),
            ),
        ));
    }
}