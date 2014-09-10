<?php
namespace Backend\Navigation\Service;

use Zend\Navigation\Service\DefaultNavigationFactory;

class AdminNavigationFactory extends DefaultNavigationFactory
{
    protected function getName()
    {
        return 'admin';
    }
}