<?php
namespace Backend\Navigation\Service;

use Zend\Navigation\Service\DefaultNavigationFactory;

class MemberNavigationFactory extends DefaultNavigationFactory
{
    protected function getName()
    {
        return 'member';
    }
}