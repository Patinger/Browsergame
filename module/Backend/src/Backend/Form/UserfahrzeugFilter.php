<?php
namespace Backend\Form;
use Zend\InputFilter\InputFilter;

class UserfahrzeugFilter extends InputFilter {

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
            'name'     => 'user_id',
            'required' => false,
            'filters'  => array(
                array('name' => 'Int'),
                ),
            )
        );


        $this->add(array(
            'name'     => 'fahrzeugart',
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
            )
        );


        $this->add(array(
            'name'     => 'beschreibung',
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
                        'min'      => 1,
                        'max'      => 100,
                        ),
                    ),
                ),
            )
        );

        $this->add(array(
            'name'     => 'letztepruefung',
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
            )
        );
    }
}
