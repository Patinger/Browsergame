<?php
namespace Backend\View\Helper;
use Zend\View\Helper\AbstractHelper;
 
class Convertdate extends AbstractHelper
{
    public function __invoke($date = '1970-01-01')
    {
        $dateArray = explode('-', $date);
        if (count($dateArray) != 3)
        {
            return '-';
        }
        return $dateArray[2].'.'.$dateArray[1].'.'.$dateArray[0];
    }
}