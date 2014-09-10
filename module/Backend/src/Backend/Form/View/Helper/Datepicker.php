<?php
namespace Backend\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormDate;
use Zend\Form\Exception;   
use Zend\Form\Element\Date;

class Datepicker extends FormDate
{
    /**
     * Render a form <input> element from the provided $element
     *
     * @param  ElementInterface $element
     * @return string
     */
    public function render(ElementInterface $element)
    {
        if (!$element instanceOf Date)
        {
            throw new Exception\InvalidArgumentException(sprintf(
                    '%s requires that the element is of type Zend\Form\Element\Date',
                    __METHOD__
            ));
        }

        return '<div class="input-group date datetimepicker"  data-date-format="YYYY-MM-DD">
                    <input name="'.$element->getName().'" type="text" class="form-control" value="'.$element->getValue().'" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>';

    }
}
