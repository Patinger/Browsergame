<?php
namespace Backend\Form;
use Zend\InputFilter\InputFilter;

class UserFilter extends InputFilter {

    public function __construct() {

        $this->add(array(
            'name'     => 'id',
            'required' => false,
            'filters'  => array(
                array('name' => 'Int'),
                ),
            )
        );

        $this->add(array(
            'name'     => 'name',
            'required' => false,
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
            )
        );


        $this->add(array(
            'name'     => 'surname',
            'required' => false,
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
            )
        );

        $this->add(array(
            'name' => 'email',
            'required' => false,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'EmailAddress',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 5,
                        'max'      => 255,
                        'messages' => array(
                            \Zend\Validator\EmailAddress::INVALID_FORMAT => 'Email ist nicht korrekt.'
                        ),
                    ),
                ),
            ),
        ));
    }
}
