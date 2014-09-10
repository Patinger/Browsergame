<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Frontend\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Controller\AppController;

class KontaktController extends AppController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    public function mapAction()
    {
        return new ViewModel();
    }
    public function mitarbeiterAction()
    {
        return new ViewModel();
    }
}
