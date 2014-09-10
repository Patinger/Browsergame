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

class PreiseController extends AppController
{
	protected $gtueData;

    public function indexAction()
    {
        return new ViewModel();
    }

    public function allepreiseAction(){
        $this->getGtueData();

        return new ViewModel(array(
            'gtueData' => $this->gtueData,
        ));
    }

    public function preisjsonAction(){
        $this->getGtueData();
        $view = new ViewModel(array(
            'gtueData' => $this->gtueData,
        ));
        $view->setTerminal(true);
        return $view;
    }

    public function getGtueData()
    {
        if (!$this->gtueData) {
            $sm = $this->getServiceLocator();
            $this->gtueData = $sm->get('Backend\Model\GtueData');
        }
        return $this->gtueData;
    }
}
