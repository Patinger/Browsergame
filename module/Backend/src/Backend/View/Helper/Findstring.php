<?php
namespace Backend\View\Helper;
use Zend\View\Helper\AbstractHelper;
 
class Findstring extends AbstractHelper
{
    public function __invoke($str, $find)
    {

        var_Dump($this->view->basePath());
        if (! is_string($str)){
            return 'must be string';
        }
 
        if (strpos($str, $find) === false){
            return 'not found';
        }
 
        return 'found';
    }
}